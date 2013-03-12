<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = '..';
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/elements/WYGalleryElement.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYFileUpload.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYHiddenField.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYTextArea.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYEditor.php');

  $bOK = false;
	$sHelpFile = 'gallery-element.php';

	$oEditor = new WYEditor();
	$oHFImageID = new WYHiddenField(WY_QK_GALLERY_IMAGE_ID);
	$iImageID = (int)$oHFImageID->sValue();
	$oHFTNWidth = new WYHiddenField(WY_QK_THUMB_WIDTH);
	$iTNWidth = (int)$oHFTNWidth->sValue();
	$oHFTNHeight = new WYHiddenField(WY_QK_THUMB_HEIGHT);
	$iTNHeight = (int)$oHFTNHeight->sValue();
	$oHFImageWidth = new WYHiddenField(WY_QK_IMAGE_WIDTH);
	$iImageWidth = (int)$oHFImageWidth->sValue();
	$oHFImageHeight = new WYHiddenField(WY_QK_IMAGE_HEIGHT);
	$iImageHeight = (int)$oHFImageHeight->sValue();
	$oElement = new WYGalleryElement($oEditor->sFieldName, $oEditor->bGlobal, $iTNWidth, $iTNHeight, 0, $iImageWidth, $iImageHeight);
	$oHFNewImage = new WYHiddenField(WY_QK_GALLERY_ADD, 'false');
	$bNewImage = $oHFNewImage->sValue() == 'true';
	$oTA = new WYTextArea('TEXT', $bNewImage ? '':$oElement->sTextForID($iImageID));
	$oTA->setWidth(30);
	$oTA->setHeight(7);
	$oFU = new WYFileUpload('IMAGE_FILE', $bNewImage);
	$oFP = od_nil;
	$sResponse = '';
	$iNrOfErrors = 0;

	if ($oEditor->bSave) { // if about to save, ...
		if ($bNewImage) { // ...and there is at least one new image, ...
			for($j = 0; $j < $oFU->iNrOfFiles; $j++) { // ...save ALL files, ...
				$bHasError = false;
				$iImageID++;

				if ($oFU->bFileUploaded($j) && !$oFU->bUploadOK($j)) {
					$sResponse .= $oFU->sErrorMessage(true, $j);
					$iNrOfErrors++;
					$iImageID--;
					$bHasError = true;
				} else { // ...which DONT have errors
					if ($oFU->bFileUploaded($j)) {
						$oFP =& $oFU->oFilePath($j);
						$oOFP =& $oFU->oOriginalFilename($j);
						if ($oOFP->bCheck(WYPATH_CHECK_JUSTIMAGE|WYPATH_CHECK_NOPATH)) {
							$oElement->newImageAfter($iImageID - 1); // insert new slot, only if upload happened AND is ok
							$oElement->useUploadedImageFileForID($oFP, $oOFP, $iImageID);
						} else {
							$goApp->log('Illegal file/type on image upload: ' . $oOFP->sPath);
							$sResponse .= '<span style="color:red">' . WYTS('FileUploadErrorUnknown')
							            . ' &quot;' . $oOFP->sPath . "&quot;</span><br />\n";
							$iNrOfErrors++;
							$iImageID--;
							$bHasError = true;
						}
						$oFU->deleteTmpFile($j);
					}
					if (!$bHasError) { // if no errors
						$oElement->setTextForID($iImageID, $oTA->sText);
						$oElement->save();
						$sResponse .= WYTS('ImageSaved') . ' ('.$oOFP->sPath.")<br />";
					}
				}
			}
		} else { // ...and there is no new image (edit of caption and/or image)
			if ($oFU->bFileUploaded(0) && !$oFU->bUploadOK(0)) {
				$sResponse .= $oFU->sErrorMessage(true, 0);
				$iNrOfErrors++;
				$bHasError = true;
			} else {
				if ($oFU->bFileUploaded(0)) {
					$oFP =& $oFU->oFilePath(0);
					$oOFP =& $oFU->oOriginalFilename(0);
					if ($oOFP->bCheck(WYPATH_CHECK_JUSTIMAGE|WYPATH_CHECK_NOPATH)) {
						$oElement->useUploadedImageFileForID($oFP, $oOFP, $iImageID);
					} else {
						$goApp->log('Illegal file/type on image upload: ' . $oOFP->sPath);
						$sResponse = '<span style="color:red">' . WYTS('FileUploadErrorUnknown')
								   . ' &quot;' . $oOFP->sPath . "&quot;</span><br />\n";
						$iNrOfErrors++;
						$bHasError = true;
					}
					$oFU->deleteTmpFile();
				}
				$oElement->setTextForID($iImageID, $oTA->sText);
				$oElement->save();
				$sResponse = $sResponse ? $sResponse : WYTS('ImageSaved') . "<br />\n";
			}
		}
		$bOK = ($iNrOfErrors) ? false : true;
	}
	else {
		if ($bNewImage) {
			if ($goApp->bIsSafari || $goApp->bIsNavigator) {
				$sFormat = WYTS('MultiFileUploadNoteTemplate');
				$sMultiUploadNote = sprintf($sFormat, $goApp->bIsMac ? 'Cmd':'Ctrl');
			} else {
				$sMultiUploadNote = WYTS('MultiFileUploadNoteNoGo');
			}
		} else {
			$sMultiUploadNote = ''; // no remark if we only change a picture
		}
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("GalleryEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin: 0px;
}
textarea {
	font-family: "Courier New", Courier, mono;
	font-size: 12px;
	width: 100%;
	height: 99%;
}
-->
</style>
<?php include("remember-editor-size.js.php"); ?>
</head>
<?php
	if (!isset($bOK)) $bOK = false;
	if ($oEditor->bSave) $bDidSave = true;
	else if (!isset($bDidSave)) $bDidSave = false;
?>
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php if (!$bNewImage) echo WYTS("GalleryEditorTitle") . " Nr.:</span> " . ($iImageID + 1); else echo WYTS("GalleryNewFotos"); ?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php if (!$bDidSave) { ?>
      <form style="margin:0; padding:0; height:95%; width:100%;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <table border="0" cellspacing="0" cellpadding="6" style="height: 95%; width: 100%;">
        <tr>
          <td style="width: 50px; height: 30px" align="left" valign="top" nowrap class="formFieldTitle"><?php WYTSD("GalleryFile", true); ?>:</td>
          <td align="left" valign="top"><?php echo $oFU->sDisplay(); ?><div class="remark"><?php echo $sMultiUploadNote; ?></div></td>
        </tr>
        <tr>
          <td align="left" valign="top" nowrap class="formFieldTitle"><?php WYTSD("GalleryText", true); ?></td>
          <td align="left" valign="top" nowrap><?php echo $oTA->sDisplay(); ?></td>
        </tr>
        <tr>
          <td style="height: 20px" nowrap>&nbsp;</td>
          <td align="left" valign="top"><input type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">&nbsp;<input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>">
<?php if (!WYImage::bCanResizeImages()) {  ?>
   <div class="warning remark" style="padding-top: 8px"><?php echo WYTS("ImageCannotResize")?></div>
<?php } ?>
              <?php
					echo WYEditor::sHiddenFieldsForElement($oElement);
					echo $oHFImageID->sDisplay();
					echo $oHFTNWidth->sDisplay();
					echo $oHFTNHeight->sDisplay();
					echo $oHFImageWidth->sDisplay();
					echo $oHFImageHeight->sDisplay();
					echo $oHFNewImage->sDisplay();
				?></td></tr>
      </table>
      </form>
	<?php echo $goApp->sHelpLink($sHelpFile); ?>
	<?php } else { /* else for 'if(!$bDidSave)' */
      echo "<div class='formFieldTitle'>";
		echo "<div class='response' style='font-size:12px'>$sResponse</div>";
		if ($bOK)
			echo WYEditor::sPostSaveScript();
      else {
			echo WYEditor::sPostSaveScript(true); // new parameter for static method, meaning: keep editor window (defaults to false)
			echo "<p class='textButton'>$iNrOfErrors Fehler!</p>";
			echo "<div style='width:100%'><div style='width:auto;margin:10px auto'><input type='button' class='formButton' value='".WYTS("CloseWindow")."' onclick='window.close()' /></div></div>"; //  no backlink, because of problems keeping track of internal state!
		}
		echo "</div>";
	}?></td>
  </tr>
</table>
</body>
</html>
