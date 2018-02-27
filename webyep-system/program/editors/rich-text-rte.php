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
	if (isset($_REQUEST['WEBYEP_ACTION'])) {
		$oElement->setText($goApp->sFormFieldValue('RTE_FORM_ELEMENT'));
		$oElement->save();
      $bOK = true;
       if($bOK){
		  echo "<script>window.parent.location.reload(true);</script>";
	    }
	}
	else {
      $sContent = rteSafe($oElement->sText());
      $sCSSURL = $goApp->sFormFieldValue(WY_QK_RICH_TEXT_CSS);
	}
	
	$goApp->outputWarningPanels(); // give App a chance to say something
   
   if (file_exists("../opt/rte/cbrte")) $sRTEIncludePath = "../opt/rte/cbrte";
   else $sRTEIncludePath = "../opt/rte";
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("RichTextEditorTitle", true); ?></title>
	<meta name="viewport" content="width = 700, minimum-scale = 0.25, maximum-scale = 1.60">
	<meta name="generator" content="Freeway Pro 6.1.2">
	<link rel="stylesheet" href="../css/themes/lightblue/pace-theme-minimal.css" />
	<script src="../javascript/pace.js"></script>
	<link rel=stylesheet href="css/CSS-mini-reset.css">
	<style type="text/css">
		<!-- 
		body {
			color: #404040;
			font-size: 13px;
			margin: 0px;
			height: 100%
		}
		html {
			height: 100%
		}
		form {
			margin: 0px
		}
		body > form {
			height: 100%
		}
		img {
			margin: 0px;
			border-style: none
		}
		button {
			margin: 0px;
			border-style: none;
			padding: 0px;
			background-color: transparent;
			vertical-align: top
		}
		table {
			empty-cells: hide
		}
		td {
			padding: 0px
		}
		.f-sp {
			font-size: 1px;
			visibility: hidden
		}
		.f-lp {
			margin-bottom: 0px
		}
		.f-fp {
			margin-top: 0px
		}
		#logon,
		#save,
		#cancel {
			min-width: 92px;
			height: 29px;
			padding: 0 6px 1px 6px;
		}
		/* CSS3 attribute-equals selector */
		#logon,
		#save,
		.resetButtonClass-Name {
			color: #fff;
			transition: all 0.2s ease-in-out;
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			background-color: #9C9C9C;
			font-weight: normal;
		}
		#cancel {
			color: #444;
			transition: all 0.2s ease-in-out;
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			background-color: #F5F5F5;
		}
		#cancel:hover {
			color: #BC1434;
		}
		input[type=submit]:hover,
		#logon:hover,
		#save:hover,
		.resetButtonClass-Name:hover {
			background-color: #444;
		}
		input[type=submit]:active,
		#logon:active,
		#save:active,
		.resetButtonClass-Name:active {
			background-color: #444;
		}
		input[type=submit]:focus,
		#logon:focus,
		#save:focus,
		.resetButtonClass-Name:focus {
			background-color: #444;
			/* the reset button when focussed by keyboard-navigation */
		}
		.WYhelp {
			color: #969696;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px;
			text-decoration: none
		}
		.WYhelp a {
			color: #969696;
			text-decoration: none;
			transition: color 0.2s ease-in-out;
			-webkit-transition: color 0.2s ease-in-out;
			-moz-transition: color 0.2s ease-in-out
		}
		.WYhelp a:hover {
			color: #6e6e6e;
			text-decoration: none
		}
		.WYhelp img {
			float: left
		}
		.WYinput {
			width: 100%;
			height: 100%;
			overflow: auto;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.WYobd-link {
			color: #bebebe;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px
		}
		.WYobd-link a {
			color: #bebebe;
			text-decoration: none;
			transition: color 0.2s ease-in-out;
			-webkit-transition: color 0.2s ease-in-out;
			-moz-transition: color 0.2s ease-in-out
		}
		.WYobd-link a:hover {
			color: #969696;
			text-decoration: none
		}
		.WYtextfieldST input {
			height: 26px;
			width: 548px;
			max-height: 26px;
			max-width: 548px;
			min-height: 26px;
			min-width: 548px;
		}
		.WYwarning {
			color: #bc1434;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px
		}
		.r2 {
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			-webkit-background-clip: padding-box;
			background-clip: padding-box
		}
		.r3 {
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			-webkit-background-clip: padding-box;
			background-clip: padding-box
		}
		.r5 {
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			-webkit-background-clip: padding-box;
			background-clip: padding-box
		}
		.r6 {
			-webkit-border-radius: 6px;
			-moz-border-radius: 6px;
			border-radius: 6px;
			-webkit-background-clip: padding-box;
			background-clip: padding-box
		}
		.textarea100 {
			width: 100%;
			height: 100%
		}
		::-webkit-input-placeholder {
			color: #b8d0d3;
		}
		:-moz-placeholder {
			color: #b8d0d3;
			/* Firefox 18- */
		}
		::-moz-placeholder {
			color: #b8d0d3;
			/* Firefox 19+ */
		}
		:-ms-input-placeholder {
			color: #b8d0d3;
		}
		em {
			font-style: italic
		}
		h1 {
			font-weight: bold;
			font-size: 18px
		}
		h1:first-child {
			margin-top: 0px
		}
		h2 {
			font-weight: bold;
			font-size: 16px
		}
		h2:first-child {
			margin-top: 0px
		}
		h3 {
			font-weight: bold;
			font-size: 14px
		}
		h3:first-child {
			margin-top: 0px
		}
		p.WYwarning {
			color: #bc1434;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px
		}
		strong {
			font-weight: bold
		}
		.WYsimplemodal {
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
			font-size: 13px;
			background-color: #fff;
			line-height: 18px
		}
		h1.simplemodal {
			color: #404040;
			font-weight: bold;
			font-size: 18px;
			line-height: 24px;
			margin-top: 0px;
			padding-top: 3px
		}
		h1:first-child {
			margin-top: 0px
		}
		.grey {
			color: #6e6e6e
		}
		.WYcenteralign {
			text-align: center
		}
		.WYmainbuttons {
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
			font-size: 13px;
			line-height: 13px;
			font-weight: normal;
			cursor: pointer;
			letter-spacing: 1px;
			text-shadow: 0 1px 0 rgba(64, 64, 64, 0.1);
			height: auto;
			color: #fff;
			min-width: 92px;
			text-align: center
		}
		.WYhelpstyle {
			color: #969696;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			text-transform: uppercase;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px
		}
		.borderboxsizing {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box
		}
		.WYtextfield {
			color: #404040;
			font-family: 'Courier New', Courier;
			font-size: 14px;
			background-color: #fbfdff;
			line-height: 15px;
			text-align: left;
			border: 1px solid #6AC7FD;
			resize: none;
			padding: 5px 6px 5px 6px;
			transition: all 0.25s ease-in-out;
			-webkit-transition: all 0.25s ease-in-out;
			-moz-transition: all 0.25s ease-in-out;
			box-shadow: 0 0 4px rgba(81, 203, 238, 0);
			-webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 0);
			-moz-box-shadow: 0 0 4px rgba(81, 203, 238, 0);
		}
		.WYtextfield:focus {
			box-shadow: 0 0 4px rgba(81, 203, 238, 1);
			-webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
			-moz-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
			border-color: #58bbf4;
		}
		#PageDiv {
			position: relative;
			max-width: 100% !important;
			min-width: 100% !important;
			width: 100% !important;
			min-height: 100%;
			margin: auto
		}
		#simplemodal {
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 1;
			padding: 11px 18px 16px;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box
		}
		#WebYeplogo {
			position: absolute;
			top: 11px;
			right: 44px;
			height: 31px;
			z-index: 1;
			width: auto;
			overflow:hidden
		}
		#WebYeplogo > img {
			max-height: 31px;
		}
		#WY-simple-modal-header {
			position: absolute;
			left: 0px;
			top: 0px;
			width: 100%;
			min-height: 48px;
			z-index: 2;
			border-bottom: solid #eee 1px
		}
		#wy-simple-modal-footer {
			position: absolute;
			left: 0px;
			width: 100%;
			bottom: 0px;
			min-height: 46px;
			z-index: 10;
			padding-top: 13px;
			background-color: #f5f5f5;
			border-top: solid #eee 1px;
			-webkit-box-shadow: inset 0 1px 0 #FFF;
			-moz-box-shadow: inset 0 1px 0 #FFF;
			box-shadow: inset 0 1px 0 #FFF
		}
		#save {
			position: relative
		}
		#cancel {
			position: relative
		}
		#WY-Debug-Message {
			position: absolute;
			left: 18px;
			top: 55px;
			z-index: 4
		}
		#formcontainerouter {
			position: absolute;
			left: 0px;
			top: 87px;
			width: 100%;
			bottom: 78px;
			min-height: 28px;
			z-index: 6;
			padding-left: 18px;
			padding-right: 18px
		}
		#textarea {
			position: absolute;
			left: 18px;
			top: 11px;
			width: 100%;
			height: 143px;
			z-index: 1
		}
		.WYhelp {
			position: absolute;
			right: 18px;
			bottom: 24px;
			min-height: 8px;
			z-index: 1
		}
		.WYobd-link {
			position: absolute;
			top: 55px;
			right: 18px;
			z-index: 5
		}
		-->
	</style>
	<!--[if lt IE 9]>
	<script src="javascript/html5shiv.js"></script>
	<![endif]-->
	<link rel=stylesheet href="css/extra-css.css">
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

<?php include("remember-editor-size.js.php"); ?>
</head>
<?php if (!isset($bOK)) $bOK = false; if ($oEditor->bSave) $bDidSave = true; else if (!isset($bDidSave)) $bDidSave = false; ?>
<body onload="wy_rteInit(); wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<?php if (!$bDidSave) { ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return submitForm();">
		<div id="PageDiv">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp"><?php echo WYTS("RichTextEditorTitle"); ?> (RTE): <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
				<div id="WebYeplogo">
					<img src="../images/webyep-logo.png" width=59 height=31 alt="WebYeplogo" style="float:left">
				</div>
				<div id="WY-simple-modal-header"></div>
				<div id="wy-simple-modal-footer" class="WYcenteralign">
					<p class="f-fp f-lp">
                    	<input type="submit" class="WYmainbuttons r2" id="save" value="<?php WYTSD("SaveButton", true); ?>">
                        <?php echo (new WYEditor())->sHiddenFieldsForElement($oElement); ?>
						<?php if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous'){?>
                        <input type="button" class="WYmainbuttons r2" id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                        <?php }elseif($webyep_sModalWindowType == 'jquery'){?>
                        <input type="button" class="WYmainbuttons r2" id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">
                        <?php }else{?>
                        <input type="button" class="WYmainbuttons r2" id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
                        <?php }?>
                    </p>
					<div class="WYhelp">
						<p class="WYhelpstyle"><a href="/webyep-system/program/help/english/access-denied.php"> <?php echo $goApp->sHelpLink($sHelpFile); ?> </a></p>
					</div>
				</div>
				<div id="WY-Debug-Message" class="WYwarning">
					<?php if ($webyep_bDebug) echo '<p>WebYep Debug Mode<em>!</em></p>'; ?>
				</div>
				<div class="WYobd-link">
					<p><a href="<?php echo $webyep_sCompanyLink?>" target="_blank"> <?php echo $webyep_sCompanyName?> </a>
					</p>
				</div>
				<div id="formcontainerouter" class="borderboxsizing">
					<script type="text/javascript">
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
				  </script>
				</div>
			</div>
		</div>
	</form>
    
<?php } else { echo "<blockquote>"; echo "<div class='response'>$sResponse</div>"; if ($bOK) echo (new WYEditor())->sPostSaveScript(); else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>"; echo "</blockquote>"; } ?>
</body>

</html>
