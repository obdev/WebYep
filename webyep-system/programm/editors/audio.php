<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAudioElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFileUpload.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

	$sHelpFile = "audio-element.html";

	$oEditor = new WYEditor();
	$oHFDelete = new WYHiddenField("DELETE_FILE");
	$oFU = new WYFileUpload("AUDIO_FILE");
	$oElement = new WYAudioElement($oEditor->sFieldName, "");
	$oFP = od_nil;
   $sMaxUpload = ini_get("upload_max_filesize");
   $sMaxUpload = str_replace("M", "MB", $sMaxUpload);
   $bOK = false;


	if ((int)$oHFDelete->sValue() == 1) {
		$oElement->deleteFile(); // implicit save
		$sResponse = WYTS("FileDeleted");
      $bOK = true;
	} else if ($oEditor->bSave) {
		if ($oFU->bUploadOK()) {
         $oFP =& $oFU->oFilePath();
         $oOFP =& $oFU->oOriginalFilename();
         if ($oOFP->bCheck(WYPATH_CHECK_JUSTAUDIO|WYPATH_CHECK_NOPATH)) {
	         $oElement->useUploadedFile($oFP, $oFU->oOriginalFilename());
				$oElement->save();
				$sResponse = WYTS("FileSaved");
	         $bOK = true;
         }
         else {
            $goApp->log("Illegal file/type on audio upload: " . $oOFP->sPath);
            @unlink($oFP->sPath);
            $sResponse = WYTS("FileUploadErrorUnknown");
         }
		}
		else $sResponse = $oFU->sErrorMessage();
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("AudioEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.textAreaField {
	font-family: "Courier New", Courier, mono;
	font-size: 12px;
	height: 70%;
	width: 98%;
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
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0; padding:0;" onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:""?>" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php echo WYTS("AudioEditorTitle") . ":</span> " . $oEditor->sFieldName; ?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php if (!$bDidSave) { ?>
<script type="text/javascript">
function confirmDelete()
{
	if (confirm("<?php WYTSD('DeleteFileQuestion'); ?>")) {
		document.forms[0].<?php echo $oHFDelete->dAttributes["name"]; ?>.value = 1;
		document.forms[0].submit();
	}
}
</script>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
      <table border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td align="left" valign="middle" nowrap class="formFieldTitle"><?php WYTSD("AttachmentFile", true); ?>:</td>
          <td align="left" valign="middle" nowrap><span class="remark"><?php echo "(max. $sMaxUpload)&nbsp;"; ?></span><?php echo $oFU->sDisplay(); ?></td>
        </tr>
        <tr>
          <td nowrap>&nbsp;</td>
          <td align="left" valign="top" nowrap><input name="Button" type="button" class="formButton" value="<?php WYTSD("DeleteFileButton", true); ?>" onClick="confirmDelete();"><img src="../images/nix.gif" width="24" height="8"><input type="button" class="formButton" value="<?php WYTSD("CancelButton"); ?>" onClick="window.close();">&nbsp;<input type="submit" class="formButton" value="<?php WYTSD("SendFileButton", true); ?>">
            <?php
					echo WYEditor::sHiddenFieldsForElement($oElement);
					echo $oHFDelete->sDisplay();
				?></td>
        </tr>
      </table>
      </form>
	<?php echo $goApp->sHelpLink($sHelpFile); ?>
	<?php } else {
      echo "<blockquote>";
		echo "<div class='response'>$sResponse</div>";
		if ($bOK) echo WYEditor::sPostSaveScript();
      else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>";
      echo "</blockquote>";
	}?></td>
  </tr>
</table>
</body>
</html>
