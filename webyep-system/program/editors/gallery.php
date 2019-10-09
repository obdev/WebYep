<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = '..';
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/elements/WYGalleryElement.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYFileUpload.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYHiddenField.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYTextArea.php');
	include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYEditor.php');
	
	$sMaxUpload = $goApp->sFormattedByteSizeString($goApp->iMaxUploadBytes());	
    $bOK = false;
	$sHelpFile = 'gallery-element.php';

	$oEditor = new WYEditor();
	$oHFImageID = new WYHiddenField(WY_QK_GALLERY_IMAGE_ID);
	$iImageID = (int)$oHFImageID->sValue();
	$oHFTNWidth = new WYHiddenField(WY_QK_THUMB_WIDTH);
	$iTNWidth = (int)$oHFTNWidth->sValue();
	$oHFTNHeight = new WYHiddenField(WY_QK_THUMB_HEIGHT);
	$iTNHeight = (int)$oHFTNHeight->sValue();
	$oHFImageWidth = new WYHiddenField(WY_QK_IMAGE_WIDTH);
	$iImageWidth = (int)$oHFImageWidth->sValue();
	$oHFImageHeight = new WYHiddenField(WY_QK_IMAGE_HEIGHT);
	$iImageHeight = (int)$oHFImageHeight->sValue();
	$oElement = new WYGalleryElement($oEditor->sFieldName, $oEditor->bGlobal, $iTNWidth, $iTNHeight, 0, $iImageWidth, $iImageHeight);
	$oHFNewImage = new WYHiddenField(WY_QK_GALLERY_ADD, 'false');
	$bNewImage = $oHFNewImage->sValue() == 'true';
	$oTA = new WYTextArea('TEXT', $bNewImage ? '':$oElement->sTextForID($iImageID));
	$oTA->setWidth(30);
	$oTA->setHeight(7);
	$oTA->setAttribute('class', 'WYtextfield WYinput r3 WYtextfield');
	$oTA->setAttribute('placeholder', '...');
	$oTA->setAttribute("id", "mytext");
	
	$oFU = new WYFileUpload('IMAGE_FILE', $bNewImage);
	$oFU->setAttribute('class', 'WYchoose r3 t1');
	$oFU->setAttribute('id', 'choose');
	$oFP = od_nil;
	$oOFP ='';
	$sResponse = '';
	$iNrOfErrors = 0;
	
	/*if ((int)$oHFImageID->sValue()== 1) {
		//echo $iImageID;
		$oElement->deleteFile(); // implicit save
		$sResponse = WYTS("FileDeleted");
		$sOnLoadScript = 'window.parent.location.reload(true)';
		//$bOK = true;
	}*/

 if (isset($_REQUEST['WEBYEP_ACTION'])) { // if about to save, ...
		if ($bNewImage) { // ...and there is at least one new image, ...
			for($j = 0; $j < $oFU->iNrOfFiles; $j++) { // ...save ALL files, ...
				$bHasError = false;
				$iImageID++;

				if ($oFU->bFileUploaded($j) && !$oFU->bUploadOK($j)) {
					$sResponse .= $oFU->sErrorMessage(true, $j);
					$iNrOfErrors++;
					$iImageID--;
					$bHasError = true;
				} else { // ...which DONT have errors
					if ($oFU->bFileUploaded($j)) {
						@$oFP =& $oFU->oFilePath($j);
						@$oOFP =& $oFU->oOriginalFilename($j);
						if ($oOFP->bCheck(WYPATH_CHECK_JUSTIMAGE|WYPATH_CHECK_NOPATH)) {
							$oElement->newImageAfter($iImageID - 1); // insert new slot, only if upload happened AND is ok
							$oElement->useUploadedImageFileForID($oFP, $oOFP, $iImageID);
						} else {
							$goApp->log('Illegal file/type on image upload: ' . $oOFP->sPath);
							$sResponse .= '<span style="color:red">' . WYTS('FileUploadErrorUnknown')
							            . ' &quot;' . $oOFP->sPath . "&quot;</span><br />\n";
							$iNrOfErrors++;
							$iImageID--;
							$bHasError = true;
						}
						$oFU->deleteTmpFile($j);
					}
					if (!$bHasError) { // if no errors
						$oElement->setTextForID($iImageID, $oTA->sText);
						$oElement->save();
						//$sResponse .= WYTS('ImageSaved') . ' ('.$oOFP->sPath.")<br />";
						
						
						echo '<b>'.$sResponse.'</b>';
						$sOnLoadScript=' setTimeout(function(){ window.parent.location.reload(true); }, 1000);'; 
					}
				}
			}
		} else { // ...and there is no new image (edit of caption and/or image)
			if ($oFU->bFileUploaded(0) && !$oFU->bUploadOK(0)) {
				$sResponse .= $oFU->sErrorMessage(true, 0);
				$iNrOfErrors++;
				$bHasError = true;
			} else {
				if ($oFU->bFileUploaded(0)) {
					@$oFP =& $oFU->oFilePath(0);
					@$oOFP =& $oFU->oOriginalFilename(0);
					if ($oOFP->bCheck(WYPATH_CHECK_JUSTIMAGE|WYPATH_CHECK_NOPATH)) {
						$oElement->useUploadedImageFileForID($oFP, $oOFP, $iImageID);
					} else {
						$goApp->log('Illegal file/type on image upload: ' . $oOFP->sPath);
						$sResponse = '<span style="color:red">' . WYTS('FileUploadErrorUnknown')
								   . ' &quot;' . $oOFP->sPath . "&quot;</span><br />\n";
						$iNrOfErrors++;
						$bHasError = true;
					}
					$oFU->deleteTmpFile();
				}
				$oElement->setTextForID($iImageID, $oTA->sText);
				$oElement->save();
				$sResponse = $sResponse ? $sResponse : WYTS('ImageSaved') . "<br />\n";
				echo "<b>$sResponse </b>";
			}
		}
		$bOK = ($iNrOfErrors) ? false : true;
		if($bOK){
		
		//$sOnLoadScript=' setTimeout(function(){ window.parent.location.reload(true); }, 1000);'; 
        
		if($webyep_sModalWindowType == "none"){
        $sOnLoadScript = 'setTimeout(function(){ window.opener.location.reload(true);window.close() }, 1000);';
        }
		else
		{
            $sOnLoadScript='setTimeout(function(){ window.parent.location.reload(true); }, 1000);'; 
        }
		
		
		}
	} else {
		if ($bNewImage) {
			if ($goApp->bIsSafari || $goApp->bIsNavigator) {
				$sFormat = WYTS('MultiFileUploadNoteTemplate');
				$sMultiUploadNote = sprintf($sFormat, $goApp->bIsMac ? 'Cmd':'Ctrl');
			} else {
				$sMultiUploadNote = WYTS('MultiFileUploadNoteNoGo');
			}
		} else {
			$sMultiUploadNote = ''; // no remark if we only change a picture
		}
	}

	$goApp->outputWarningPanels(); // give App a chance to say something
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("GalleryEditorTitle", true); ?></title>
	<meta name="viewport" content="width = 600, minimum-scale = 0.25, maximum-scale = 1.60">
	<meta name="generator" content="Freeway Pro 6.1.2">
	<link rel="stylesheet" href="../css/themes/lightblue/pace-theme-minimal.css" />
	<script src="../javascript/pace.js"></script>
	<link rel=stylesheet href="css/CSS-mini-reset.css">
	<link rel=stylesheet href="css/wyfontstylesheet.css">
	<style type="text/css">
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
	body.nomargin {
		margin: 0
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
		height: 100% !important;
		min-width: 100% !important;
		min-height: 100% !important;
		position: relative;
		margin: auto
	}
	#choose {
		width: auto;
		max-width: 225px;
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
	.WYinput {
		width: 100%;
		height: 100%;
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
		color: #b8d0d3; /* Firefox 18- */
	}
	::-moz-placeholder {
		color: #b8d0d3; /* Firefox 19+ */
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
	.blue {
		color: #4aa5ef
	}
	.midgrey {
		color: #969696
	}
	.formFieldTitle {
		font-weight: bold
	}
	.lightgrey {
		color: #cecece
	}
	.s12 {
		font-size: 12px
	}
	.s11 {
		font-size: 11px
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
		border: solid #eee 1px
	}
	#choose {
		position: relative
	}
	#tooltip {
		position: absolute;
		width: auto;
		right: 0;
		bottom: -21px;
		z-index: 1;
	}
	#formcontainerouter2{
		position: absolute;
		left: 0px;
		top: 194px;
		width: 100%;
		bottom: 79px;
		min-height: 110px;
		z-index: 7;
		padding-left: 18px;
		padding-right: 18px
	}
	#textarea {
		position: absolute;
		left: 18px;
		top: 11px;
		width: 100%;
		height: auto;
		z-index: 1
	}
	#instruction {
		position: absolute;
		left: 18px;
		top: 170px;
		right: 18px;
		z-index: 8
	}
	#activate {
		position: relative;
		float: right;
		z-index: 0
	}
	#arrowright {
		position: relative
	}
	#arrowdown {
		position: relative
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
	.arrowrightafter:after {
	     color: #a9aaa9;
	     content:"\e805";
	     font-family: webyepfontregular,arial;
	     font-size: 13px;
	     margin: 0 0 0 1px;
	}	
	@media screen and (max-width: 490px) {
		#choose {
			max-width: 180px
		}
	}
	@media screen and (max-width: 320px) {
		#choose {
			max-width: 100px
		}
		#tooltip {
			top: 57px;
			bottom: auto;
			line-height: 11px
		}
		#instruction {
			top: 172px
		}
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
	label.css-label { 
		opacity:0.85; 
	}
	label.css-label:hover { 
		outline: #7177BF solid 1px;
		opacity:1; 
	}
	</style>
	<!--[if lt IE 9]>
	<script src="javascript/html5shiv.js"></script>
	<![endif]-->
	<link rel=stylesheet href="css/extra-css.css">
	<?php include("remember-editor-size.js.php"); ?>
    <!-- Beginning of hoverbar code  -->
    <link rel="stylesheet" type="text/css" href="../opt/minibar-files/css/mini-bar.css"/>
    <script>window.jQuery || document.write('<script src="../javascript/jquery-1.11.0.min.js"><\/script>');</script>
    <script type="text/javascript" src="../opt/minibar-files/scripts/caret.js"></script>
    <script type="text/javascript" src="../opt/minibar-files/scripts/jquery-buttons.js"></script>
    <!-- End of hoverbar code  -->
</head>
<?php if (!isset($bOK)) $bOK = false; if ($oEditor->bSave) $bDidSave = true; else if (!isset($bDidSave)) $bDidSave = false; ?>
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();" class="nomargin">
<?php if (!$bDidSave) { ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<div id="PageDiv">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp"><?php if (!$bNewImage) echo WYTS("GalleryEditorTitle") . " Nr.:</span> " . ($iImageID + 1); else echo WYTS("GalleryNewFotos"); ?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
				<div id="WebYeplogo">
					<img src="../images/webyep-logo.png" alt="WebYeplogo" style="float:left; width:auto">
				</div>
				<div id="WY-simple-modal-header"></div>
				<div id="wy-simple-modal-footer" class="WYcenteralign">
					<p class="f-fp f-lp">
                    	<input type="submit" class="WYmainbuttons r3 t2" id="save" value="<?php WYTSD("SaveButton", true); ?>">
                        
						<?php if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous'){?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                <?php }elseif($webyep_sModalWindowType == 'jquery'){?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">
				<?php }
				else{?>
				<input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
				<?php }?>
                        <?php if (!WYImage::bCanResizeImages()) {  ?>
                           <div class="warning remark" style="padding-top: 8px"><?php echo WYTS("ImageCannotResize")?></div>
						<?php } ?>
						
					  <?php
                            echo WYEditor::sHiddenFieldsForElement($oElement);
                            echo $oHFImageID->sDisplay();
                            echo $oHFTNWidth->sDisplay();
                            echo $oHFTNHeight->sDisplay();
                            echo $oHFImageWidth->sDisplay();
                            echo $oHFImageHeight->sDisplay();
                            echo $oHFNewImage->sDisplay();
                        ?>
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
							<span class="formFieldTitle"><?php WYTSD("GalleryFile", true); ?>:</span>  
							<span class="lightgrey s12">
								  <em><?php echo "(max. $sMaxUpload)"; ?></em>
                        	<?php echo $oFU->sDisplay(); ?></span>
						</p>
						<div id="tooltip" class="remark">
							<p class="f-fp f-lp blue s11">
								<em><?php echo (isset($sMultiUploadNote))?$sMultiUploadNote:''; ?></em>
							</p>
						</div>
					</div>
				</div>
				<div id="formcontainerouter2" class="borderboxsizing">
                	<?php echo $oTA->sDisplay(); ?>
				</div>
				<div id="instruction">
					<div id="activate">
						<p class="f-fp f-lp"><?php WYTSD("GalleryTextInlineMenu", true); ?> <span class="arrowrightafter"></span>
							<!-- <img id="arrowright" src="../../../../images/arrow-right.png" alt=""> -->
							<input id="inlinemenu" type=checkbox class="css-checkbox">
							<label for="inlinemenu" class="css-label"></label>
						</p>
					</div>
					<p class="f-fp f-lp arrowdownafter"><?php WYTSD("GalleryText", true); ?>
						<!-- <img id="arrowdown" src="../images/arrow-down.png" alt=""> -->
					</p>
				</div>
			</div>
		</div>
	</form>
    <?php } else { /* else for 'if(!$bDidSave)' */
      echo "<div class='formFieldTitle'>";
		echo "<div class='response' style='font-size:12px'>$sResponse</div>";
		if ($bOK)
			echo WYEditor::sPostSaveScript();
      else {
			echo WYEditor::sPostSaveScript(true); // new parameter for static method, meaning: keep editor window (defaults to false)
			echo "<p class='textButton'>$iNrOfErrors Fehler!</p>";
			echo "<div style='width:100%'><div style='width:auto;margin:10px auto'>";
			if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous' || $webyep_sModalWindowType == 'none'){
            	echo '<input name="Button" type="button" class="formButton" value="'.WYTSD("CancelButton", true).'" onclick="parent.wySMLink.hide();">';
             }else{
             echo '<input name="Button" type="button" class="formButton" value="'.WYTSD("CloseWindow", true).'" onClick="window.close();">';
			 }
			 
			echo "</div></div>"; //  no backlink, because of problems keeping track of internal state!
		}
		echo "</div>";
	}?>
    <div id="menu"><?php include("../opt/minibar-files/php/mini-bar-buttons.php"); ?></div>
</body>
</html>
