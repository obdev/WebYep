<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

    $webyep_bDocumentPage = false;
    $webyep_sIncludePath = "..";
    include_once("$webyep_sIncludePath/webyep.php");

    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYReadMoreElement.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");


    $bOK = false;
    $sResponse = WYTS("ReadMoreSaved");
    $sHelpFile = "readmore-element.php";


    $oEditor = new WYEditor();
    $oTF = new WYTextField("TEXT");
    $oTF->setWidth($goApp->bIsiPhone ? 40:40);
    $oTF->setAttribute("id", "inputTextField");
	$oTF->setAttribute('class', 'WYtextfield WYinput r3');
	$oTF->setAttribute('placeholder', '...');
    $oElement = new WYReadMoreElement($oEditor->sFieldName, $oEditor->bGlobal);
    if (isset($_REQUEST['WEBYEP_ACTION'])) {
        $oElement->setText($oTF->sValue());
        $oElement->save();
        $bOK = true;
        if($bOK){
			$sOnLoadScript = 'window.parent.location.reload(true)';
		}
    } else {
        $oTF->setValue($oElement->sText());
        $sOnLoadScript = 'document.forms[0].TEXT.focus();';
    }
    
    $goApp->outputWarningPanels();
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("ReadMoreEditorTitle", true); ?></title>
	<meta name="viewport" content="width = 600, minimum-scale = 0.25, maximum-scale = 1.60">
	<meta name="generator" content="Freeway Pro 6.1.2">
	<link rel="stylesheet" href="../css/themes/lightblue/pace-theme-minimal.css" />
	<script src="../javascript/pace.js"></script>
	<link rel=stylesheet href="css/CSS-mini-reset.css">
	<link rel=stylesheet href="css/wyfontstylesheet.css">
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
		height: 28px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		overflow: auto
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
		text-align: center;
		cursor: pointer;
		letter-spacing: 1px;
		text-shadow: 0 1px 0 rgba(64, 64, 64, 0.1);
		height: auto;
		color: #fff;
		min-width: 92px;
		font-weight: normal
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
		line-height: 14px;
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
		top: 107px;
		right: 0;
		bottom: 78px;
		min-height: 41px;
		z-index: 6;
		padding-left: 18px;
		padding-right: 18px
	}
	#textarea {
		position: absolute;
		left: 17px;
		top: 6px;
		width: 100%;
		height: auto;
		z-index: 1
	}
	#formcontainerinner1 {
		position: absolute;
		left: 18px;
		top: 84px;
		right: 196px;
		z-index: 7
	}
	#arrowdown1 {
		position: relative
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
	.arrowdownafter:after {
	     color: #a9aaa9;
	     content:"\e806";
	     font-family: webyepfontregular,arial;
	     font-size: 13px;
	     margin-left: 2px;
	}
	.response {
		font-family:helvetica;
		font-size:14px;
		text-align:center;
	}
	.response:before {
		font-family:webyepfontregular; 
		margin-left:0px; 
		margin-right:8px; 
		content:"\e80F";
	}
	-->
	</style>
	<!--[if lt IE 9]>
	<script src="../javascript/html5shiv.js"></script>
	<![endif]-->
<?php include("remember-editor-size.js.php"); ?>
</head>
<?php
    if (!isset($bOK)) $bOK = false; if ($oEditor->bSave) $bDidSave = true; else if (!isset($bDidSave)) $bDidSave = false;
?>
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<?php if (!$bDidSave) { ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">

		<div id="PageDiv">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp"><?php echo WYTS("ReadMoreEditorTitle")?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
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
						<p class="WYhelpstyle">
						<!-- <a href="/webyep-system/program/help/english/access-denied.php"> </a> -->
						<?php echo $goApp->sHelpLink($sHelpFile); ?></p>
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
                	<?php echo $oTF->sDisplay(); ?>
				</div>
				<div id="formcontainerinner1">
					<p class="f-fp f-lp arrowdownafter">Text
						<!-- <img id="arrowdown1" src="../images/arrow-down.png" alt="Text input"> -->
					</p>
				</div>
			</div>
		</div>
	</form>
    <?php } else { echo "<blockquote>"; echo "<div class='response'>$sResponse</div>"; if ($bOK) echo (new WYEditor())->sPostSaveScript(); else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>"; echo "</blockquote>"; }
	?>
</body>

</html>
