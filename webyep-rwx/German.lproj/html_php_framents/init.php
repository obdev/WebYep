<?php // ><!--
$webyep_sIncludePath = "./";
$iDepth = 0;
while (!file_exists($webyep_sIncludePath . "webyep-system")) {
	$iDepth++;
	if ($iDepth > 10) {
		error_log("webyep-system Ordner nicht gefunden.", 0);
      break;
	}
	$webyep_sIncludePath = ($webyep_sIncludePath == "./") ? ("../"):("$webyep_sIncludePath../");
}
if (file_exists("$webyep_sIncludePath/webyep-system/programm")) $webyep_sIncludePath .= "webyep-system/programm";
else $webyep_sIncludePath .= "webyep-system/program";
$sMain = "$webyep_sIncludePath/webyep.php";
if (file_exists($sMain)) include($sMain);
// --> <dummy ?>