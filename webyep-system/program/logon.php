<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

    $webyep_bDocumentPage = false;
    $webyep_sIncludePath = ".";
    include_once("$webyep_sIncludePath/webyep.php");

    include_once("lib/WYApplication.php");
    include_once("lib/WYTextField.php");
    include_once("lib/WYHiddenField.php");
    include_once("lib/WYEditor.php");

    define("WY_QV_LOGON", "LOGON");

    $bSuccess = false;
    $oPageURL = od_nil;
    $bDoLogon = $goApp->sFormFieldValue(WY_QK_ACTION) == WY_QV_LOGON;

    $oHFPageURL = new WYHiddenField(WY_QK_LOGON_PAGE_URL);
    if ($oHFPageURL->sValue()) {
        $oPageURL = new WYURL($oHFPageURL->sValue());
        $oPageURL->dQuery[WY_QK_EDITMODE] = "yes" . mt_rand(1000, 9999);
        unset($oPageURL->dQuery[WY_QK_LOGOUT]);
    }
    $oTFUsername = new WYTextField("USERNAME");
	$oTFUsername->makeUsernameField();
	$oTFUsername->setAttribute("class", "WYtextfieldLogon WYinput r3");
	
    $oTFPassword = new WYTextField("PASSWORD");
    $oTFPassword->makePasswordField();
	$oTFPassword->setAttribute("class", "WYtextfieldLogon WYinput r3");
    if ($bDoLogon) {
        $bSuccess = $goApp->bAuthenticate($oTFUsername->sValue(), $oTFPassword->sValue());
        webyep_checkDataFolderIntegrity();
        if (webyep_bHasFilemanager()) {
            session_start();
            $_SESSION[WY_SV_IS_AUTH] = $bSuccess;
        }
    }

    if (!$bDoLogon) $sOnLoadScript = 'document.forms[0].USERNAME.focus();';
?>

<!DOCTYPE HTML>
<html>

<head>
	<link rel="stylesheet" href="css/themes/lightblue/pace-theme-minimal.css" />
	<script src="javascript/pace.js"></script>

	<meta charset="UTF-8">
	<title><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepLogon");?></title>
	<meta name="viewport" content="width = 420, minimum-scale = 0.25, maximum-scale = 1.60">
	<meta name="generator" content="Freeway Pro 6.1.2">
	<link rel=stylesheet href="css/CSS-mini-reset.css">
	<link rel="stylesheet" href="css/fontstylesheet.css">
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
		position: relative;
		width: 100% !important;
		min-width: 100% !important;
		max-width: 100% !important;
		min-height: 100%;
		margin: auto
	}
	#choose,
	#delete {
		width: 92px;
		height: 26px;
		padding: 1px 2px 1px 2px;
		margin: 0 2px;
		text-align: center;
		cursor: pointer;
		letter-spacing: 0px;
		width: 96px;
		font: normal 13px/13px'Helvetica Neue', Helvetica, Arial, sans-serif;
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
		-webkit-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19);
		-moz-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19);
		box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19)
	}
	#choose.WYchoose {
		color: #2f7fbb;
		background-color: #def7fe;
		border: 1px solid #b8d0d3
	}
	#choose:hover.WYchoose {
		color: #2f7fbb;
		background-color: #d1e5eb;
		border: 1px solid #b8d0d3
	}
	#delete.WYdelete {
		color: #bc1434;
		background-color: #ffe9f0;
		border: 1px solid #D3C2C5
	}
	#delete:hover.WYdelete {
		color: #bc1434;
		background-color: #f0dce4;
		border: 1px solid #D3C2C5
	}
	#logon,
	#save,
	#cancel {
		width: 92px;
		height: 29px;
		padding: 0 0 1px 0;
	}
	/* CSS3 attribute-equals selector */
	#logon,
	#save,
	.resetButtonClass-Name {
		color: #fff;
		background-color: #9C9C9C;
		font-weight: normal;
		letter-spacing: 1px;
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
	.textButton:link {
		display: inline-block;
		color: #fff;
		background-color: #9C9C9C;
		font-weight: normal;
		letter-spacing: 1px;
		text-decoration: none;
		padding: 8px 10px;
		margin-top: 10px;
		transition: all 0.2s ease-in-out;
		-webkit-transition: all 0.2s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
	}
	.textButton:hover {
		background-color: #444;
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
		-webkit-transition: : all 0.2s ease-in-out;
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
	.t1 {
		-webkit-transition: : all 0.1s ease-in-out;
		-moz-transition: all 0.1s ease-in-out;
		transition: all 0.1s ease-in-out;
	}
	.t2 {
		-webkit-transition: : all 0.2s ease-in-out;
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
		letter-spacing: 0px;
		text-shadow: 0 1px 0 rgba(64, 64, 64, 0);
		height: auto;
		color: #fff;
		width: 96px;
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
	.lightgrey {
		color: #cecece
	}
	.WYtextfieldLogon {
		color: #404040;
		font-family: Helvetica, Arial, sans-serif;
		font-size: 13px;
		background-color: #fbfdff;
		line-height: 13px;
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
	.WYtextfieldLogon:focus {
		box-shadow: 0 0 4px rgba(81, 203, 238, 1);
		-webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
		-moz-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
		border-color: #58bbf4;
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
		width: auto
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
	#logon {
		position: relative
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
	#url-alt-container {
		position: absolute;
		left: 18px;
		top: 90px;
		right: 18px;
		min-height: 37px;
		z-index: 6;
		height: auto
	}
	#textareaURL {
		position: relative;
		width: 100%;
		height: auto
	}
	#textareaAlt {
		position: relative;
		width: 100%;
		height: auto
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
	
	#infor { 
		position:absolute;
		left:0px; 
		top:0px; 
		width:100%; 
		min-height:100%; 
		z-index:20; 
		padding-left:8px; 
		padding-top:102px; 
		background-color:#fff; 
		background-image:url(images/wy-splash-screen.jpg); 
		background-position:center; 
		background-size:cover; 
		background-repeat:no-repeat;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	.loading { 
		color:#674380; 
		font-family:Helvetica,Arial,sans-serif; 
		font-size:16px; 
		text-transform:uppercase; 
		font-variant:normal; 
		letter-spacing:0.5em; 
		line-height:1; 
		margin-top:0px; 
		margin-bottom:0px; 
		text-align:center 
	}
	.versionno { 
		color:#674380; 
		font-family:Helvetica,Arial,sans-serif; 
		font-size:9px; 
		text-transform:uppercase; 
		font-variant:normal; 
		letter-spacing:0.5em; 
		margin-top:4px; 
		margin-bottom:0px; 
		text-align:center 
	}
	.spinner { 
		font-family:Helvetica,Arial,sans-serif; 
		letter-spacing:normal 
	}
	.spinner:after { 
		color:#999; 
		font-family:webyepfontregular; 
		margin-left:8px; 
		margin-right:8px; 
		content:"\e801"; 
		-moz-animation:spin 2s infinite linear;
		-o-animation: spin 2s infinite linear;
		-webkit-animation: spin 2s infinite linear;
		animation: spin 2s infinite linear;
		display: inline-block;
	}
	
	@-moz-keyframes spin {
	0% {
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	-webkit-transform: rotate(0deg);
	transform: rotate(0deg);
	}

	100% {
	-moz-transform: rotate(359deg);
	-o-transform: rotate(359deg);
	-webkit-transform: rotate(359deg);
	transform: rotate(359deg);
	}
	}
	@-webkit-keyframes spin {
	0% {
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	-webkit-transform: rotate(0deg);
	transform: rotate(0deg);
	}

	100% {
	-moz-transform: rotate(359deg);
	-o-transform: rotate(359deg);
	-webkit-transform: rotate(359deg);
	transform: rotate(359deg);
	}
	}
	@-o-keyframes spin {
	0% {
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	-webkit-transform: rotate(0deg);
	transform: rotate(0deg);
	}

	100% {
	-moz-transform: rotate(359deg);
	-o-transform: rotate(359deg);
	-webkit-transform: rotate(359deg);
	transform: rotate(359deg);
	}
	}
	@-ms-keyframes spin {
	0% {
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	-webkit-transform: rotate(0deg);
	transform: rotate(0deg);
	}

	100% {
	-moz-transform: rotate(359deg);
	-o-transform: rotate(359deg);
	-webkit-transform: rotate(359deg);
	transform: rotate(359deg);
	}
	}
	@keyframes spin {
	0% {
	-moz-transform: rotate(0deg);
	-o-transform: rotate(0deg);
	-webkit-transform: rotate(0deg);
	transform: rotate(0deg);
	}

	100% {
	-moz-transform: rotate(359deg);
	-o-transform: rotate(359deg);
	-webkit-transform: rotate(359deg);
	transform: rotate(359deg);}
	}
	
	.response {
		font-size:14px;
		text-align:center;
		padding-top:20px;
	}
	.response:before { 
		font-size:18px;
		font-family:webyepfontregular; 
		margin-left:0px; 
		margin-right:8px; 
		content:"\e811";
	}
	
	.truncate {
		width: 265px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	
	-->
	</style>

	<!--[if lt IE 9]>
		<script src="javascript/html5shiv.js"></script>
		<![endif]-->
		<?php echo $goApp->sCharsetMetatag(); ?>

	<script src="javascript/jquery-1.11.0.min.js"></script>

	<script type='text/javascript'>
	$(function(){
				$("#infor").delay(2000).fadeOut("fast");
	});
	</script>

	<script src="javascript/modernizr.custom.13897.js"></script>
	<script src="javascript/Placeholder.js"></script>



</head>

<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div id="PageDiv">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp truncate"><?php echo $webyep_sProductName?>: <span class="grey"><?php echo WYTSD("WebYepLogon", true);?></span></h1>
				<div id="WebYeplogo">
					<img src="images/webyep-logo.png" alt="WebYeplogo" style="float:left; width:auto">
				</div>
				<div id="WY-simple-modal-header"></div>
				<?php if (!$bDoLogon) { ?>

					<div id="wy-simple-modal-footer" class="WYcenteralign">
					<p class="f-fp f-lp">
						<input name="CACHE_KILLER" type="hidden" id="CACHE_KILLER" value="<?php echo mt_rand(1000, 9999); ?>">
						<?php echo $oHFPageURL->sDisplay(); ?>
						<input id="logon" type=submit name="Logon" class="WYmainbuttons r3 t2" value="<?php WYTSD("LogonButtonTitle", true); ?>">
						<input name="CACHE_KILLER" type="hidden" id="CACHE_KILLER" value="<?php echo mt_rand(1000, 9999); ?>">
						<?php echo $oHFPageURL->sDisplay(); ?>
						<input name="<?php echo WY_QK_ACTION; ?>" type="hidden" value="<?php echo WY_QV_LOGON; ?>">
					</p>
					<div class="WYhelp">
						<p class="WYhelpstyle"><?php echo $goApp->sHelpLink("access-denied.php"); ?></p>
					</div>
				</div>
				<div id="WY-Debug-Message" class="WYwarning">
					<?php if ($webyep_bDebug) echo '<p>WebYep Debug Mode<em>!</em></p>'; ?>
				</div>
				<div class="WYobd-link">
					<p><a href="<?php echo $webyep_sCompanyLink?>" target="_blank"> <?php echo $webyep_sCompanyName?> </a>
					</p>
				</div>
				<div id="url-alt-container">
					<table style="width:100%; margin:auto; border-spacing:0px">
						<tr>
							<td style="width:143px; vertical-align:top">
								<p class="f-fp f-lp">
									<?php echo $oTFUsername->sDisplay(); ?>
								</p>
							</td>
							<td style="width:20px; width:11px; vertical-align:middle">
								<p class="WYcenteralign f-fp f-lp"><span class="lightgrey">|</span>
								</p>
							</td>
							<td style="width:146px; vertical-align:top">
								<p class="f-fp f-lp">
									<?php echo $oTFPassword->sDisplay(); ?>
								</p>
							</td>
						</tr>
					</table>
				</div>
			
				<?php } else { ?>
					<div id="url-alt-container"> 
						<?php if ($bSuccess) {
							$_SESSION[WY_SV_IS_AUTH] = true; // WebYepIsAuthorized
							echo "<p class='response'>" . WYTS("LogonSucceded") . "</p>";
							if ($oPageURL) {
				if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous'){ //if model window enabled then close login window 
					echo "<script type='text/javascript'>\n";
					echo "   window.parent.location = '" . $oPageURL->sURL() . "'\n";
					echo "   window.parent.focus();\n";
					echo "   window.setTimeout('parent.wySM.hide();', 1500);\n";
					echo "</script>";
				}else{
					echo "<script type='text/javascript'>\n";
					echo "   window.opener.location = '" . $oPageURL->sURL() . "'\n";
					echo "   window.opener.focus();\n";
					echo "   window.setTimeout('window.close();', 1500);\n";
					echo "</script>";
				}
			} else {
				echo WYEditor::sPostSaveScript();
			}
		} else {
			$_SESSION[WY_SV_IS_AUTH] = false; // WebYepIsAuthorized
			echo "<div class='WYwarning'><p class='response'>" . WYTS("LogonFailed") . "</p></div>";
			if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous'){ // if model window extra another js code needed to close model window
			// echo "<p class='textButton'>&lt;<a href='javascript:parent.wySM.hide();'>" . WYTS("CloseWindow") . "</a>&gt;</p>";
			}else{
				// echo "<p class='textButton'>&lt;<a href='javascript:window.close();'>" . WYTS("CloseWindow") . "</a>&gt;</p>";
			}	
		}?>
	</div>

	<?php }?>

	</div>
			<div id="infor"><p class="loading"><span class="spinner">L</span>ading</p>
				<p class="versionno">version <?php echo "$webyep_iMajorVersion.$webyep_iMinorVersion.$webyep_iSubVersion $webyep_sVersionPostfix"?></p>
			</div>
		</div>
	</form>
	
	<script>
	Modernizr.load({
		test: Modernizr.input.placeholder,
		nope: ['Placeholder.js'],
		complete: function(){Placeholders.init();}
	});
	</script>
</body>

</html>
