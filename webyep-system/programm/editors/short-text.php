<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYShortTextElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");


   $bOK = false;
	$sResponse = WYTS("ShortTextSaved");
	$sHelpFile = "shorttext-element.php";


	$oEditor = new WYEditor();
	$oTF = new WYTextField("TEXT");
	$oTF->setWidth($goApp->bIsiPhone ? 40:40);
	$oTF->setAttribute("id", "inputTextField");
	$oElement = new WYShortTextElement($oEditor->sFieldName, $oEditor->bGlobal);
	if ($oEditor->bSave) {
		$oElement->setText($oTF->sValue());
		$oElement->save();
      $bOK = true;
	}
	else {
		$oTF->setValue($oElement->sText());
		$sOnLoadScript = 'document.forms[0].TEXT.focus();';
	}
	
	$goApp->outputWarningPanels();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("ShortTextEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
<?php if ($goApp->bIsiPhone) { ?>
html {
	-webkit-text-size-adjust:none;
}
body {
	margin: 4px;
}
#title {
	font-weight: bold;
	font-size: 14px;
}
#textfield {
   margin-top: 10px;
}
#buttons {
   margin-top: 10px;
}
#logo {
   float: left;
}
#help {
   text-align: right;
}
#response {
   margin-top: 10px;
}
input.formButton {
	font-weight: bold;
	font-size: 12px;
}
<?php } else { ?>
body {
	margin: 0px;
}
#inputTextField {
	width: 100%;
}
<?php } ?>
-->
</style>
<?php if ($goApp->bIsiPhone) { ?>
<script type="text/javascript">
   function wy_updateOrientation()
   {
      window.scrollTo(0, 1);
   }

	function wy_saveSize()
   {
   }

   function wy_restoreSize()
   {
      window.setTimeout("window.scrollTo(0, 1);", 100);
   }
</script>
<?php } else {
	include("remember-editor-size.js.php");
} ?>
<meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1">
</head>
<?php
	if (!isset($bOK)) $bOK = false;
	if ($oEditor->bSave) $bDidSave = true;
	else if (!isset($bDidSave)) $bDidSave = false;
?>
<body onorientationchange="wy_updateOrientation();" onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<?php if ($goApp->bIsiPhone) { ?>
   <div id="title"><?php echo $oEditor->sFieldName ?><div>
   <?php if (!$bDidSave) { ?>
   <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <div id="textfield"><?php echo $oTF->sDisplay(); ?></div>
   <div id="buttons"><input type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">&nbsp;<input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>"></div>
   <?php echo WYEditor::sHiddenFieldsForElement($oElement); ?>
   </form>
   <div id="logo"><img src="../images/logo.gif"></div>
   <div id="help"><?php echo $goApp->sHelpLink($sHelpFile); ?></div>
   <?php } else {
      echo "<div id=\"response\" class=\"response\">$sResponse</div>";
      if ($bOK) echo WYEditor::sPostSaveScript();
      else echo "<p class=\"textButton\">" . webyep_sBackLink() . "</p>";
   }?>
<?php } else { ?>
   <table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
     <tr>
       <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
   <h1><span class="editorTitle"><?php echo WYTS("ShortTextEditorTitle") . ":</span> " . $oEditor->sFieldName; ?></h1></td>
           <td align="right"><img src="../images/logo.gif"></td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td valign="top"><?php if (!$bDidSave) { ?>
         <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <table border="0" cellspacing="0" cellpadding="6" width="100%">
           <tr>
             <td class="formFieldTitle" width="1%">Text:</td>
             <td><?php echo $oTF->sDisplay(); ?></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td><input type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">&nbsp;<input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>">
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
<?php } ?>
</body>
</html>
