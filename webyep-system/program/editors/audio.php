<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");
	
	include_once("$webyep_sIncludePath/lib/WYCommon.php"); // Include the common file with WYTSD

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAudioElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFileUpload.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

   define("WY_QK_POST_MAX_CHECK", "POST_MAX_CHECK");

	$sHelpFile = "audio-element.php";

    $oEditor = new WYEditor();
	$oHFDelete = new WYHiddenField("DELETE_FILE");
	$oFU = new WYFileUpload("ATTACHMENT_FILE");
	$oFU->setAttribute('class', 'WYchoose r3 t1');
	$oFU->setAttribute('id', 'choose');
	
	$oElement = new WYAudioElement($oEditor->sFieldName, $oEditor->bGlobal);
	$oFP = od_nil;
	$sMaxUpload = $goApp->sFormattedByteSizeString($goApp->iMaxUploadBytes());
	$bOK = false;
	$bDidSave = false;

	if ((int)$oHFDelete->sValue() == 1) {
		$oElement->deleteFile(); // implicit save
		$sResponse = WYTS("FileDeleted");
		
		$sOnLoadScript = 'window.parent.location.reload(true)';
		//$bOK = true;
	
	} else if (isset($_REQUEST['WEBYEP_ACTION'])) {
		if ($oFU->bUploadOK()) {
			@$oFP =& $oFU->oFilePath();
			@$oOFP =& $oFU->oOriginalFilename();
			if ($oOFP->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
				$oElement->useUploadedFile($oFP, $oOFP);
				$oElement->save();
				$sResponse = WYTS("FileSaved");
				$sOnLoadScript = 'window.parent.location.reload(true);window.close();';
				$bOK = true;
				$bDidSave = true;
				
			}
			else {
				$goApp->log("Illegal file/type on audio upload: " . $oOFP->sPath);
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
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("AudioEditorTitle", true); ?></title> <!-- Updated this line -->
	<meta name="viewport" content="width = 600, minimum-scale = 0.25, maximum-scale = 1.60">
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
		#PageDiv {
			width: 100% !important;
			max-width: 100% !important;
			min-height: 100% !important;
			position: relative
		}
		#delete {
			min-width: 92px;
			height: 29px;
			padding: 0 6px 1px 6px;
		}
		/* CSS3 attribute-equals selector */
		#delete,
		.resetButtonClass-Name {
			color: #fff;
			background-color: #BC1434;
			font-weight: normal;
		}
		input[type=submit]:hover,
		#delete:hover,
		.resetButtonClass-Name:hover {
			background-color: #ED0039;
		}
		input[type=submit]:active,
		#delete:active,
		.resetButtonClass-Name:active {
			background-color: #BC1434;
		}
		input[type=submit]:focus,
		#delete:focus,
		.resetButtonClass-Name:focus {
			background-color: #BC1434;
			/* the reset button when focussed by keyboard-navigation */
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
			color: #979797;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px;
			text-decoration: none
		}
		.WYhelp a {
			color: #979797;
			text-decoration: none;
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			transition: all 0.2s ease-in-out;
		}
		.WYhelp a:hover {
			color: #6e6e6e;
			text-decoration: none
		}
		.WYhelp img {
			float: left
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
		.t1 {
			-webkit-transition: all 0.1s ease-in-out;
			-moz-transition: all 0.1s ease-in-out;
			transition: all 0.1s ease-in-out;
		}
		.t2 {
			-webkit-transition: all 0.2s ease-in-out;
			-moz-transition: all 0.2s ease-in-out;
			transition: all 0.2s ease-in-out;
		}
		.vcenter {
			display: table
		}
		.vcenter p {
			display: table-cell;
			vertical-align: middle
		}
		::-webkit-input-placeholder {
			color: #b8d0d3;
		}
		:-moz-placeholder {
			color: #b8d0d3;
		}
		::-moz-placeholder {
			color: #b8d0d3;
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
		input #delete {
			background-color: #f00;
			width: 92px;
			height: 26px;
			padding: 1px 2px 1px 2px;
			margin: 0 2px;
			text-align: center;
			cursor: pointer;
			letter-spacing: 0px;
			width: 96px;
			font: normal 13px/13px'Helvetica Neue', Helvetica, Arial, sans-serif;
			-webkit-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, 0.19);
			-moz-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, 0.19);
			box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, 0.19)
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
			letter-spacing: 0px;
			text-shadow: 0 1px 0 rgba(64, 64, 64, 0);
			height: auto;
			color: #fff;
			min-width: 92px;
			text-align: center
		}
		.WYhelpstyle {
			color: #979797;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 11px;
			text-transform: uppercase;
			line-height: 11px;
			margin-top: 0px;
			margin-bottom: 0.1px
		}
		.midgrey {
			color: #969696
		}
		.s12 {
			font-size: 12px
		}
		.lightgrey {
			color: #cecece
		}
		.borderboxsizingcenter {
			text-align: center;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box
		}
		.uploadStyle {
			color: #969696;
			font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
			font-size: 12px;
			text-align: left
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
			z-index: 100;
			padding-top: 13px;
			background-color: #f5f5f5;
			border-top: solid #eee 1px;
			-webkit-box-shadow: inset 0 1px 0 #FFF;
			-moz-box-shadow: inset 0 1px 0 #FFF;
			box-shadow: inset 0 1px 0 #FFF
		}
		.greyPanelGrad {
			background-color: #FDFCFC;
			background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, 0.5)), to(rgba(255, 255, 255, 0)));
			/* Saf4+, Chrome */
			background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
			/* Saf5.1+, Chrome 10+ */
			background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
			/* FF3.6 */
			background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
			/* IE10 */
			background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
			/* Opera 11.10+ */
			background-image: linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
			/* Standard CSS3 */
		}	
		#WYhelp {
			position: absolute;
			right: 18px;
			bottom: 24px;
			min-height: 8px;
			z-index: 1
		}
		#WY-Debug-Message {
			position: absolute;
			left: 18px;
			top: 55px;
			z-index: 4
		}
		#WYobd-link {
			position: absolute;
			top: 55px;
			right: 18px;
			z-index: 5
		}
		#formcontainerouter {
			position: absolute;
			left: 18px;
			top: 87px;
			right: 18px;
			min-height: 56px;
			z-index: 6
		}
		#formcontainerinner {
			width: 100%;
			height: 53px;
			min-height: 41px;
			z-index: 0;
			padding-left: 8px;
			padding-right: 8px;
			background-color: #fdfcfc;
			border: solid #ddd 1px
		}
		#choose {
			max-width: 225px;
			margin: 0 10px 0 0
		}
		#delete {
			min-width: 62px;
			height: 29px;
			padding: 0 10px 1px 10px;
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
		@media screen and (max-width: 490px) {
			#choose {
				max-width: 100px
			}
		}
		@media screen and (max-width: 370px) {
			#formcontainerinner {
				padding: 8px
			}
			#delete {
				margin: 8px 8px 0 8px
			}
		}
		.response {
			font-family:helvetica;
			font-size:14px;
			text-align:center;
			padding-top:40px;
			color:#555555;
		}
		.response:before { 
			font-size:18px;
			font-family:webyepfontregular; 
			margin-left:0px; 
			margin-right:8px; 
			content:"\e80F";
			color:#555555;
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

<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript : "" ?>" onresize="wy_saveSize();">
    <?php if (!$bDidSave) { ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <script type="text/javascript">
    function confirmDelete() {
        if (confirm("<?php WYTSD('DeleteFileQuestion'); ?>")) {
            document.forms[0].<?php echo $oHFDelete->dAttributes["name"]; ?>.value = 1;
            document.forms[0].submit();
        }
    }
    </script>
        <div id="PageDiv">
            <div id="simplemodal" class="WYsimplemodal">
                <h1 class="simplemodal f-lp"><?php echo WYTS("AudioEditorTitle")?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1> <!-- Updated line -->
                <div id="WebYeplogo">
                    <img src="../images/webyep-logo.png" width=59 height=31 alt="WebYeplogo" style="float:left">
                </div>
                <div id="WY-simple-modal-header"></div>
                <div id="wy-simple-modal-footer" class="WYcenteralign">
                    <p class="f-fp f-lp">
                        <input type="submit" class="WYmainbuttons r3 t2" id="save" value="<?php WYTSD("SaveButton", true); ?>">
                       <?php
                            echo WYEditor::sHiddenFieldsForElement($oElement);
                            echo $oHFDelete->sDisplay();
                        ?>
                        <?php if ($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous') { ?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                <?php } elseif ($webyep_sModalWindowType == 'jquery') { ?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">
                <?php } else { ?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
                <?php } ?>
                    </p>
                    <div class="WYhelp">
                        <p class="WYhelpstyle">
                        <!-- <a href="/webyep-system/program/help/english/access-denied.php"> </a> -->
                        <?php echo $goApp->sHelpLink($sHelpFile); ?>
                        </p>
                    </div>
                </div>
                <div id="WY-Debug-Message" class="WYwarning">
                    <?php if ($webyep_bDebug) echo '<p>WebYep Debug Mode<em>!</em></p>'; ?>                    
                </div>
                <div class="WYobd-link">
                    <p><a href="<?php echo $webyep_sCompanyLink?>" target="_blank"> <?php echo $webyep_sCompanyName?> </a>
                    </p>
                </div>
                <div id="formcontainerouter">
                    <div id="formcontainerinner" class="borderboxsizingcenter r2 vcenter greyPanelGrad">
                        <p class="f-fp f-lp">
                            <strong><?php WYTSD("AttachmentFile", true); ?>:</strong>  <span class="midgrey">
                                <span class="s12">
                                <em><?php echo "(max. $sMaxUpload)&nbsp;"; ?></em>
                            </span>
                        </span>
                            <span class="lightgrey"><?php echo $oFU->sDisplay(); ?> | </span>
                            <input id="delete" name="Button" type="button" class="WYmainbuttons  r3 t1" value="<?php WYTSD("DeleteFileButton", true); ?>" onClick="confirmDelete();">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php } else { echo "<blockquote>"; echo "<div class='response'>$sResponse</div>"; if ($bOK) echo WYEditor::sPostSaveScript(); else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>"; echo "</blockquote>"; } ?>
</body>

</html>

