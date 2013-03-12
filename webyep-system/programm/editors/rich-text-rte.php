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


   function rteSafe($strText) {
      //returns safe code for preloading in the RTE
      $tmpString = $strText;
      
      //convert all types of single quotes
      $tmpString = str_replace(chr(145), chr(39), $tmpString);
      $tmpString = str_replace(chr(146), chr(39), $tmpString);
      $tmpString = str_replace("'", "&#39;", $tmpString);
      
      //convert all types of double quotes
      $tmpString = str_replace(chr(147), chr(34), $tmpString);
      $tmpString = str_replace(chr(148), chr(34), $tmpString);
   //	$tmpString = str_replace("\"", "\"", $tmpString);
      
      //replace carriage returns & line feeds
      $tmpString = str_replace(chr(10), " ", $tmpString);
      $tmpString = str_replace(chr(13), " ", $tmpString);
      
      return $tmpString;
   }

   $bOK = false;
	$sResponse = WYTS("RichTextSaved");
	$sHelpFile = "richtext-rte-element.php";

	$oEditor = new WYEditor();
	$oElement = new WYRichTextElement($oEditor->sFieldName, $oEditor->bGlobal, "", false);
	if ($oEditor->bSave) {
		$oElement->setText($goApp->sFormFieldValue('RTE_FORM_ELEMENT'));
		$oElement->save();
      $bOK = true;
	}
	else {
      $sContent = rteSafe($oElement->sText());
      $sCSSURL = $goApp->sFormFieldValue(WY_QK_RICH_TEXT_CSS);
	}
	
	$goApp->outputWarningPanels(); // give App a chance to say something
   
   if (file_exists("../opt/rte/cbrte")) $sRTEIncludePath = "../opt/rte/cbrte";
   else $sRTEIncludePath = "../opt/rte";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("RichTextEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $sRTEIncludePath ?>/html2xhtml.js"></script>
<script type="text/javascript" src="<?php echo $sRTEIncludePath ?>/richtext_compressed.js"></script>
<script type="text/javascript">
<!--
   function submitForm() {
      updateRTE('RTE_FORM_ELEMENT');
      return true;
   }

   //Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML)
   initRTE("<?php echo $sRTEIncludePath ?>/images/", "<?php echo $sRTEIncludePath ?>/", "<?php echo $sCSSURL?>", false, false);
//-->
</script>
<style type="text/css">
<!--
.rteField {
   font-size: 9px;
}
-->
</style>
<script type="text/javascript">
	<?php
		$WYEditor_sWC = $WYEditor_sHC = "";
		$oElement->getSizeCookieNames($WYEditor_sWC, $WYEditor_sHC);
	?>

	function wy_saveSize()
   {
      var iW = <?php echo $goApp->bIsExplorer ? "document.body.clientWidth+29":"window.outerWidth" ?>;
      var iH = <?php echo $goApp->bIsExplorer ? "document.body.clientHeight+61":"window.outerHeight" ?>;
      
      document.cookie = "<?php echo $WYEditor_sWC?>=" + iW + "; path=/";
      document.cookie = "<?php echo $WYEditor_sHC?>=" + iH + "; path=/";

      wy_resizeRTE(iH);
   }

   function wy_sTrimString(sInString)
   {
     sInString = sInString.replace( /^\s+/g, "" );
     return sInString.replace( /\s+$/g, "" );
   }

   function wy_restoreSize()
   {
		iW = <?php echo isset($_COOKIE[$WYEditor_sWC]) ? (int)$_COOKIE[$WYEditor_sWC]:0 ?>;
		iH = <?php echo isset($_COOKIE[$WYEditor_sHC]) ? (int)$_COOKIE[$WYEditor_sHC]:0 ?>;
      if (iW>0 && iH>0) {
         window.resizeTo(iW, iH);
         wy_resizeRTE(iH);
      }
   }

   var wy_rteHeightOffset = 280;

   function wy_rteInit()
   {
      var iWinH = <?php echo $goApp->bIsExplorer ? "document.body.clientHeight+61":"window.outerHeight" ?>;
      var o = document.getElementById("RTE_FORM_ELEMENT");
      var iRteH = parseInt(o.style.height);
	   // wy_rteHeightOffset = iWinH - iRteH;
   }

   function wy_resizeRTE(newWinH)
   {
      var o = document.getElementById("RTE_FORM_ELEMENT");
      var newRteHeight = newWinH - wy_rteHeightOffset;
      if (newRteHeight > 250) {
	      o.style.height = newRteHeight + "px";
      }
   }
</script>
</head>
<?php
	if (!isset($bOK)) $bOK = false;
	if ($oEditor->bSave) $bDidSave = true;
	else if (!isset($bDidSave)) $bDidSave = false;
?>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0; padding:0;" onload="wy_rteInit(); wy_restoreSize();" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php echo WYTS("RichTextEditorTitle") . " (RTE):</span> " . $oEditor->sFieldName; ?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php if (!$bDidSave) { ?>
      <form style="margin:0; padding:0; height:95%; width:100%;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return submitForm();">
      <table border="0" cellspacing="0" cellpadding="6" style="height: 95%; width: 100%;">
        <tr>
          <td align="left" valign="top" class="rteField"><script type="text/javascript">
            var theRTE = new richTextEditor('RTE_FORM_ELEMENT');
            theRTE.html = '<?php echo $sContent?>';

            theRTE.width = '100%';
            theRTE.height = '340';

            theRTE.cmdFormatBlock = true;
            theRTE.cmdFontName = true;
            theRTE.cmdFontSize = true;
            theRTE.cmdIncreaseFontSize = true;
            theRTE.cmdDecreaseFontSize = true;

            theRTE.cmdBold = true;
            theRTE.cmdItalic = true;
            theRTE.cmdUnderline = true;
            theRTE.cmdStrikethrough = true;
            theRTE.cmdSuperscript = true;
            theRTE.cmdSubscript = true;

            theRTE.cmdJustifyLeft = true;
            theRTE.cmdJustifyCenter = true;
            theRTE.cmdJustifyRight = true;
            theRTE.cmdJustifyFull = true;

            theRTE.cmdInsertHorizontalRule = true;
            theRTE.cmdInsertOrderedList = true;
            theRTE.cmdInsertUnorderedList = true;

            theRTE.cmdOutdent = true;
            theRTE.cmdIndent = true;
            theRTE.cmdForeColor = true;
            theRTE.cmdHiliteColor = true;
            theRTE.cmdInsertLink = true;
            theRTE.cmdInsertImage = true;
            theRTE.cmdInsertSpecialChars = true;
            theRTE.cmdInsertTable = true;
            theRTE.cmdSpellcheck = true;

            theRTE.cmdCut = true;
            theRTE.cmdCopy = true;
            theRTE.cmdPaste = true;
            theRTE.cmdUndo = true;
            theRTE.cmdRedo = true;
            theRTE.cmdRemoveFormat = true;
            theRTE.cmdUnlink = true;

            theRTE.toggleSrc = true;

          	theRTE.build();
          </script></td>
        </tr>
        <tr>
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
