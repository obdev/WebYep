<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYRichTextElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextArea.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

   $oFCKPath = od_clone($goApp->oProgramPath);
   $oFCKPath->addComponent("opt");
   $oFCKPath->addComponent("fckeditor");
   $oFCKPath->addComponent("fckeditor.php");
   include_once($oFCKPath->sPath);

   $bOK = false;
	$sResponse = WYTS("RichTextSaved");
	$sHelpFile = "richtext-fckeditor-element.php";

	$oEditor = new WYEditor();
	$oElement = new WYRichTextElement($oEditor->sFieldName, $oEditor->bGlobal, "", false);
	if ($oEditor->bSave) {
		$oElement->setText($goApp->sFormFieldValue('FCKeditor1'));
		$oElement->save();
      $bOK = true;
	}
	else {
      $sContent = $oElement->sText();
      $sCSSURL = $goApp->sFormFieldValue(WY_QK_RICH_TEXT_CSS);
	}

   $oFCKBaseURL = od_clone($goApp->oProgramURL);
   $oFCKBaseURL->addComponent("opt");
   $oFCKBaseURL->addComponent("fckeditor");

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("RichTextEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
.FCKEditorCell div {  height: 100% }
</style>
<?php include("remember-editor-size.js.php"); ?>
</head>
<?php
	if (!isset($bOK)) $bOK = false;
	if ($oEditor->bSave) $bDidSave = true;
	else if (!isset($bDidSave)) $bDidSave = false;
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0; padding:0;" onload="wy_restoreSize();" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php echo WYTS("RichTextEditorTitle") . " (FCKEditor):</span> " . $oEditor->sFieldName; ?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php if (!$bDidSave) { ?>
      <table border="0" cellspacing="0" cellpadding="6" style="height: 95%; width: 100%;">
        <tr>
          <td align="left" valign="top" class="FCKEditorCell">
<?php
   $oFCKeditor = new FCKeditor('FCKeditor1') ;
   $oFCKeditor->BasePath = $oFCKBaseURL->sURL(false, false, true) . "/";

   $oInitCodePath = od_clone($goApp->oProgramPath);
   $oInitCodePath->addComponent("opt");
   $oInitCodePath->addComponent("fckeditor_init.php");
	$oFCKeditor->Config['EditorAreaCSS'] = $sCSSURL;
	$oFCKeditor->Config['ToolbarComboPreviewCSS'] = $sCSSURL;
	if ($oInitCodePath->bExists()) include_once($oInitCodePath->sPath);
	else {
		$oFCKeditor->Config['AutoDetectLanguage']	= true ;
		$oFCKeditor->Config['DefaultLanguage'] = 'en' ;
		$oFCKeditor->Config['StartupFocus'] = true;
		$oFCKeditor->Config['AutoDetectPasteFromWord'] = true;
	}
   $oFCKeditor->Width = "100%";
   $oFCKeditor->Height = "100%";
   $oFCKeditor->Value = $sContent;
   $oFCKeditor->Create();
?>
          </td>
        </tr>
        <tr>
          <td style="height: 30px"><input name="Button" type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onClick="window.close();"><input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>"><?php echo WYEditor::sHiddenFieldsForElement($oElement); ?></td>
        </tr>
      </table>
	<?php echo $goApp->sHelpLink($sHelpFile); ?>
	<?php } else {
      echo "<blockquote>";
		echo "<div class='response'>$sResponse</div>";
		if ($bOK) echo WYEditor::sPostSaveScript();
      else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>";
      echo "</blockquote>";
	}?></td>
  </tr>
</form>
</table>
</body>
</html>
