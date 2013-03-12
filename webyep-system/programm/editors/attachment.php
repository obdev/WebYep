<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAttachmentElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFileUpload.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

   define("WY_QK_POST_MAX_CHECK", "POST_MAX_CHECK");

	$sHelpFile = "attachment-element.php";

   $oEditor = new WYEditor();
	$oHFDelete = new WYHiddenField("DELETE_FILE");
	$oFU = new WYFileUpload("ATTACHMENT_FILE");
	$oElement = new WYAttachmentElement($oEditor->sFieldName, $oEditor->bGlobal);
	$oFP = od_nil;
	$sMaxUpload = $goApp->sFormattedByteSizeString($goApp->iMaxUploadBytes());
	$bOK = false;
	$bDidSave = false;


	if ((int)$oHFDelete->sValue() == 1) {
		$oElement->deleteFile(); // implicit save
		$sResponse = WYTS("FileDeleted");
		$bOK = true;
	} else if ($oEditor->bSave) {
		if ($oFU->bUploadOK()) {
			$oFP =& $oFU->oFilePath();
			$oOFP =& $oFU->oOriginalFilename();
			if ($oOFP->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
				$oElement->useUploadedFile($oFP, $oOFP);
				$oElement->save();
				$sResponse = WYTS("FileSaved");
				$bOK = true;
				$bDidSave = true;
			}
			else {
				$goApp->log("Illegal file/type on attachment upload: " . $oOFP->sPath);
				$sResponse = WYTS("FileUploadErrorUnknown");
			}
			$oFU->deleteTmpFile();
		}
		else $sResponse = $oFU->sErrorMessage();
	}
	else if (isset($_GET[WY_QK_POST_MAX_CHECK])) {
		$sResponse = WYTS("FileUploadErrorSize");
		$bDidSave = true;
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("FileEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin: 0px;
}
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
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:""?>" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php echo WYTS("FileEditorTitle") . ":</span> " . $oEditor->sFieldName; ?></h1></td>
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
      <form action="<?php echo $_SERVER['PHP_SELF'] . "?" . WY_QK_POST_MAX_CHECK . "=1"; ?>" method="post" enctype="multipart/form-data">
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
