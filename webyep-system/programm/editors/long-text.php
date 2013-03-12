<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYLongTextElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextArea.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");


   $bOK = false;
	$sResponse = WYTS("LongTextSaved");
	$sHelpFile = "longtext-element.php";

	$oEditor = new WYEditor();
	$oElement = new WYLongTextElement($oEditor->sFieldName, $oEditor->bGlobal, "");
	$oTA = new WYTextArea("TEXT", $oElement->sText());
	if ($oEditor->bSave) {
		$oElement->setText($oTA->sText());
		$oElement->save();
      $bOK = true;
	}
	else {
		$sOnLoadScript = 'document.forms[0].TEXT.focus();';
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("LongTextEditorTitle", true); ?>
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
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:""?>" onresize="wy_saveSize();">
   <table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
     <tr>
       <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
   <h1><span class="editorTitle"><?php echo WYTS("LongTextEditorTitle") . ":</span> " . $oEditor->sFieldName; ?></h1></td>
           <td align="right"><img src="../images/logo.gif"></td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td valign="top"><?php if (!$bDidSave) { ?>
         <form style="margin:0; padding:0; height:95%; width:100%;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <table border="0" cellspacing="0" cellpadding="6" style="height: 95%; width: 100%;">
           <tr>
             <td style="width: 50px" align="left" valign="top" class="formFieldTitle">Text:</td>
             <td align="left" valign="top"><?php echo $oTA->sDisplay(); ?></td>
           </tr>
           <tr>
             <td style="width: 50px; height: 30px">&nbsp;</td>
             <td style="height: 30px"><input name="Button" type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onClick="window.close();">
             <input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>">
               <?php echo WYEditor::sHiddenFieldsForElement($oElement); ?></td>
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
