<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

$webyep_bDocumentPage = false;
$webyep_sIncludePath = ".";
include_once("$webyep_sIncludePath/webyep.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAudioElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");

$oFilename = new WYPath($_GET[WY_QK_AUDIO_FILENAME]);

if (!$oFilename->bCheck(WYPATH_CHECK_JUSTAUDIO|WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
   $goApp->log("missuse of mp3 player script, path: " . $oFilename->sPath);
   exit(0);
}

$oURL = od_clone($goApp->oDataURL);
$oURL->addComponent($oFilename->sPath);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title> <?php WYTSD("MP3PlayerWindowTitle", true); ?> </title>
<meta name="viewport" content="width = 600, minimum-scale = 0.25, maximum-scale = 1.60">
<meta name="generator" content="Freeway Pro b1">
<link rel=stylesheet href="css/CSS-mini-reset.css">
<style type="text/css">
<!--
html { height: 100% }
body {
    color: #404040;
    font-size: 13px;
    margin: 0px;
    background-color: #fff;
    height: 100%;
}
form { margin: 0px }
body > form { height: 100% }
img {
    margin: 0px;
    border-style: none;
}
button {
    margin: 0px;
    border-style: none;
    padding: 0px;
    background-color: transparent;
    vertical-align: top;
}
table { empty-cells: hide }
td { padding: 0px }
.f-sp {
    font-size: 1px;
    visibility: hidden;
}
.f-lp { margin-bottom: 0px }
.f-fp { margin-top: 0px }
#logon, #save, #cancel {
    font-family: Helvetica,Arial,sans-serif;
    font-size: 13px;
    text-align: center;
    color: #FFFFFF;
    font-weight: normal;
    height: auto;
    width: 96px;
    padding: 6px;
    border-radius: 2px;
    -moz-border-radius: 2px;
    -khtml-border-radius: 2px;
    -webkit-border-radius: 2px;
}
/* CSS3 attribute-equals selector */
#logon, #save, .resetButtonClass-Name {
    color: #fff;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    background-color: #9C9C9C;
}
#cancel {
    color: #444;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    background-color: #F5F5F5;
}
input[type=submit]:hover, #logon:hover, #save:hover, .resetButtonClass-Name:hover { background-color: #444 }
input[type=submit]:hover, #canel:hover {
    color: #444;
    background-color: #F5F5F5;
}
input[type=submit]:active, #logon:active, #save:active, .resetButtonClass-Name:active { background-color: #444 }
input[type=submit]:hover, #canel:active {
    color: #BC1434;
    background-color: #F5F5F5;
}
input[type=submit]:focus, #logon:focus, #save:focus, .resetButtonClass-Name:focus {
    background-color: #444; /* the reset button when focussed by keyboard-navigation */
}
input[type=submit]:hover, #cancel:focus {
    color: #BC1434;
    background-color: #F5F5F5;
    : ;
    font-weight: normal;
}
.WYhelp {
    color: #b1b1b1;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 11px;
    line-height: 11px;
    margin-top: 0px;
    margin-bottom: 0.1px;
    text-decoration: none;
}
.WYhelp a {
    color: #b1b1b1;
    text-decoration: none;
    transition: color 0.25s ease-in-out;
    -webkit-transition: color 0.25s ease-in-out;
    -moz-transition: color 0.25s ease-in-out;
}
.WYhelp a:hover {
    color: #9b9b9b;
    text-decoration: none;
}
.WYhelp img { float: left }
.WYobd-link {
    color: #dcdcdc;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 11px;
    line-height: 11px;
    margin-top: 0px;
    margin-bottom: 0.1px;
}
.WYobd-link a {
    color: #dcdcdc;
    text-decoration: none;
    transition: color 0.25s ease-in-out;
    -webkit-transition: color 0.25s ease-in-out;
    -moz-transition: color 0.25s ease-in-out;
}
.WYobd-link a:hover {
    color: #c3c3c3;
    text-decoration: none;
}
.WYtextfield input {
    font: 12px Helvetica,Arial,sans-serif;
    text-align: left;
    color: #404040;
    background-color: #FFF;
    border: 1px solid #6AC7FD;
    height: 26px;
    width: 148px;
    max-height: 26px;
    max-width: 148px;
    min-height: 26px;
    min-width: 148px;
    resize: none;
    padding: 0 8px 0px 8px;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    box-shadow: 0 0 4px rgba(81,203,238,0);
    -webkit-box-shadow: 0 0 4px rgba(81,203,238,0);
    -moz-box-shadow: 0 0 4px rgba(81,203,238,);
}
.WYtextfield input:focus {
    box-shadow: 0 0 4px rgba(81, 203, 238, 1);
    -webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
    -moz-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
    border-color: #58bbf4;
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
    color: #bd1434;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 11px;
    line-height: 11px;
    margin-top: 0px;
    margin-bottom: 0.1px;
}
body {
    color: #404040;
    font-size: 13px;
}
em { font-style: italic }
h1 {
    font-weight: bold;
    font-size: 18px;
}
h1:first-child { margin-top: 0px }
h2 {
    font-weight: bold;
    font-size: 16px;
}
h2:first-child { margin-top: 0px }
h3 {
    font-weight: bold;
    font-size: 14px;
}
h3:first-child { margin-top: 0px }
p.WYwarning {
    color: #bd1434;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 11px;
    line-height: 11px;
    margin-top: 0px;
    margin-bottom: 0.1px;
}
strong { font-weight: bold }
.WYsimplemodal {
    font-family: 'Helvetica Neue',Helvetica, Arial, sans-serif;
    font-size: 13px;
    background-color: #fff;
    line-height: 18px;
}
h1.simplemodal {
    color: #404040;
    font-weight: bold;
    font-size: 18px;
    line-height: 24px;
    margin-top: 0px;
    padding-top: 3px;
}
h1:first-child { margin-top: 0px }
.grey { color: #9b9b9b }
.instructionlable {
    font-size: 13px;
    line-height: 13px;
    margin-top: 0px;
    margin-bottom: 0.1px;
}
.WYcenteralign { text-align: center }
.WYhelpstyle {
    color: #b1b1b1;
    font-family: Helvetica,Arial,sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    line-height: 11px;
    margin-top: 0px;
    margin-bottom: 0.1px;
}
#PageDiv {
    position: relative;
    max-width: 600px;
    min-height: 100%;
    margin: auto;
}
#simplemodal {
    position: absolute;
    left: 0px;
    top: 0px;
    width: 564px;
    min-height: 198px;
    z-index: 1;
    padding: 11px 18px 16px;
    overflow: visible;
}
#WYlogo {
    position: absolute;
    top: 11px;
    right: 43px;
    z-index: 1;
}
#WY-simple-modal-header {
    position: absolute;
    left: 0px;
    top: 0px;
    width: 100%;
    min-height: 48px;
    z-index: 2;
    border-bottom: solid #eee 1px;
}
#WYobd-link {
    position: absolute;
    top: 55px;
    right: 18px;
    z-index: 3;
    overflow: visible;
}
#formcontainerouter {
    position: absolute;
    left: 0px;
    top: 80px;
    width: 600px;
    min-height: 60px;
    z-index: 4;
    overflow: visible;
}
#formcontainerinner {
    position: relative;
    width: 564px;
    min-height: 25px;
    z-index: 0;
    margin: auto;
    overflow: visible;
}
#arrowdown { position: relative }
#WTTfield {
    position: relative;
    float: left;
    width: auto;
    min-height: 22px;
    z-index: 0;
    margin-top: 8px;
}
#wy-simple-modal-footer {
    position: relative;
    left: 0px;
    top: 166px;
    width: 100%;
    min-height: 44px;
    z-index: 5;
    padding-top: 14px;
    background-color: #f5f5f5;
    border-top: solid #eee 1px;
    overflow: visible;
    -webkit-box-shadow: inset 0 1px 0 #FFF;
    -moz-box-shadow: inset 0 1px 0 #FFF;
    box-shadow: inset 0 1px 0 #FFF;
}
#save {
    position: relative;
    border: none;
    cursor: pointer;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
    letter-spacing: 1px;
}
#cancel {
    position: relative;
    border: none;
    cursor: pointer;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
    letter-spacing: 1px;
}
#WYhelp {
    position: absolute;
    right: 18px;
    bottom: 24px;
    min-height: 8px;
    z-index: 1;
    overflow: visible;
}
#WY-Debug-Message {
    position: absolute;
    left: 18px;
    top: 55px;
    min-height: 11px;
    z-index: 2;
}
.r_5 {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.r_0-0-5-5 {
    -webkit-border-radius: 0px 0px 5px 5px;
    -moz-border-radius: 0px 0px 5px 5px;
    border-radius: 0px 0px 5px 5px;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.WYobd-link {
    position: absolute;
    top: 55px;
    right: 18px;
    z-index: 3;
    overflow: visible;
}
.WYhelp {
    position: absolute;
    right: 18px;
    bottom: 24px;
    min-height: 8px;
    z-index: 1;
    overflow: visible;
}

-->
</style>
<!--[if lt IE 9]>
<script src="resources/html5shiv.js"></script>
<![endif]-->
</head>

<body>
<div id="PageDiv">
<?php
if ($goApp->bIsMac) {
   $sURL = $oURL->sEURL();
   $iWidth = 200;
   $iHeight = 16;
   echo "<object classid=\"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B\" width=\"$iWidth\" height=\"$iHeight\" codebase=\"http://www.apple.com/qtactivex/qtplugin.cab\">\n";
   echo "   <param name=\"SRC\" value=\"$sURL\">\n";
   echo "   <param name=\"AUTOPLAY\" value=\"true\">\n";
   echo "   <param name=\"CONTROLLER\" value=\"true\">\n";
   echo "   <embed src=\"$sURL\" width=\"$iWidth\" height=\"$iHeight\" autoplay=\"true\" controller=\"true\" pluginspage=\"http://www.apple.com/quicktime/download/\"></embed>\n";
   echo "</object>";
}
else {
   $oWaxURL = od_clone($goApp->oProgramURL);
   $oWaxURL->addComponent("wax.php");
   $oWaxURL->dQuery["URL"] = $oURL->sURL();
   $oWaxURL->dQuery["IE"] = ".wax";
   $sURL = $oWaxURL->sEURL();
   $iWidth = 300;
   $iHeight = 72;

	// http://www.mioplanet.com/rsc/embed_mediaplayer.htm
   echo "<object classid=\"CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6\" width=\"$iWidth\" height=\"$iHeight\" type=\"application/x-oleobject\">\n";
   echo "   <param name=\"filename\" value=\"$sURL\">\n";
   echo "   <param name=\"URL\" value=\"$sURL\">\n";
   echo "   <param name=\"uiMode\" value=\"mini\">\n";
   echo "   <param name=\"autostart\" value=\"true\">\n";
   echo "   <param name=\"showcontrols\" value=\"true\">\n";
   echo "   <param name=\"showstatusbar\" value=\"true\">\n";
   echo "   <param name=\"showdisplay\" value=\"false\">\n";
   echo "   <param name=\"autosize\" value=\"false\">\n";
   echo "   <param name=\"autorewind\" value=\"true\">\n";
   echo "   <embed type=\"application/x-mplayer2\" src=\"$sURL\" width=\"$iWidth\" height=\"$iHeight\" autostart=\"true\" showcontrols=\"true\" showstatusbar=\"true\" showdisplay=\"false\" autosize=\"false\" autorewind=\"true\" pluginspage=\"http://www.microsoft.com/windows/windowsmedia/intl/download/default.asp?DispLang=de\"></embed>\n";
   echo "</object>\n";
}
?>
</div>
</body>
</html>