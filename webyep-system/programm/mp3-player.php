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
<html>
<head>
<title><?php echo WYTS("MP3PlayerWindowTitle")?></title>
<style type="text/css">
body {
	background-color: black;
}
</style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr><td align="center" valign="middle">
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
?></td></tr></table>
</body>
</html>