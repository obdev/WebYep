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
	$oFU->setAttribute('class', 'WYchoose r3 t1');
	$oFU->setAttribute('id', 'choose');
	$oElement = new WYAudioElement($oEditor->sFieldName, "");
	$oFP = od_nil;
   $sMaxUpload = ini_get("upload_max_filesize");
   $sMaxUpload = str_replace("M", "MB", $sMaxUpload);
   $bOK = false;


	if ((int)$oHFDelete->sValue() == 1) {
		$oElement->deleteFile(); // implicit save
		$sResponse = WYTS("FileDeleted");
		$sOnLoadScript = 'window.parent.location.reload(true)';
     // $bOK = true;
  
	} else if (isset($_REQUEST['WEBYEP_ACTION'])) {
		if ($oFU->bUploadOK()) {
        @$oFP =& $oFU->oFilePath();
         $oOFP =& $oFU->oOriginalFilename();
         if ($oOFP->bCheck(WYPATH_CHECK_JUSTAUDIO|WYPATH_CHECK_NOPATH)) {
	        // $oElement->useUploadedFile($oFP, $oFU->oOriginalFilename());
	        $oElement->useUploadedFile($oFP, $oOFP);
				$oElement->save();
				$sResponse = WYTS("FileSaved");
	         $bOK = true;
	         $bDidSave = true;
	$sOnLoadScript=' setTimeout(function(){ window.parent.location.reload(true); }, 1000);'; 
         }
         else {
            $goApp->log("Illegal file/type on audio upload: " . $oOFP->sPath);
            @unlink($oFP->sPath);
            $sResponse = WYTS("FileUploadErrorUnknown");
         }
		$oFU->deleteTmpFile();
		}
		else $sResponse = $oFU->sErrorMessage();
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("AudioEditorTitle", true); ?></title>
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
		;
		/* Firefox 18- */
	}
	::-moz-placeholder {
		color: #b8d0d3;
		;
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
	.lightgrey {
		color: #cecece
	}
	.borderboxsizing {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box
	}
	#PageDiv {
		position: relative;
		max-width: 100% !important;
		min-width:100% !important;
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
		z-index: 1
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
		left: 18px;
		top: 87px;
		right: 18px;
		min-height: 56px;
		z-index: 6
	}
	#formcontainerinner {
		position: relative;
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
		position: relative
	}
	#delete {
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
	-->
	</style>
	<!--[if lt IE 9]>
	<script src="javascript/html5shiv.js"></script>
	<![endif]-->

<?php include("remember-editor-size.js.php"); ?>
</head>
<?php
if (!isset($bOK)) $bOK = false; if ($oEditor->bSave) $bDidSave = true; else if (!isset($bDidSave)) $bDidSave = false;
?>
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<?php if (!$bDidSave) { ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
<script type="text/javascript">
function confirmDelete()
{
	if (confirm("<?php WYTSD('DeleteFileQuestion'); ?>")) {
		document.forms[0].<?php echo $oHFDelete->dAttributes["name"]; ?>.value = 1;
		document.forms[0].submit();
	}
}
</script>
		<div id="PageDiv">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp"><?php echo WYTS("AudioEditorTitle")?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
				<div id="WebYeplogo">
					<img src="../resources/WebYep-logo.png" width=59 height=31 alt="WebYeplogo" style="float:left">
				</div>
				<div id="WY-simple-modal-header"></div>
				<div id="wy-simple-modal-footer" class="WYcenteralign">
					<p class="f-fp f-lp">
                    	<input type="submit" class="WYmainbuttons r3 t2" id="save" value="<?php WYTSD("SaveButton", true); ?>">
					   <?php
                            echo WYEditor::sHiddenFieldsForElement($oElement);
							echo $oHFDelete->sDisplay();
                        ?>
						<?php if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous'){?>
                            <input type="button" class="WYmainbuttons r3 t2" id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                        <?php }elseif($webyep_sModalWindowType == 'jquery'){?>
                            <input type="button" class="WYmainbuttons r3 t2" id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">    
                        <?php }else{?>
                            <input type="button" class="WYmainbuttons r3 t2"  id="cancel" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
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
				<div id="formcontainerouter">
					<div id="formcontainerinner" class="borderboxsizing r2 vcenter">
						<p class="WYcenteralign f-fp f-lp"><strong><?php WYTSD("AttachmentFile", true); ?>:</strong>  <span class="midgrey"><?php echo "(max. $sMaxUpload)&nbsp;"; ?></span> 
							<?php echo $oFU->sDisplay(); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>
    <?php } else { echo "<blockquote>"; echo "<div class='response'>$sResponse</div>"; if ($bOK) echo WYEditor::sPostSaveScript(); else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>"; echo "</blockquote>"; } ?>

</body>

</html>
