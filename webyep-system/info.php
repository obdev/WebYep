<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

$webyep_bDocumentPage = false;
if (file_exists("programm")) $webyep_sIncludePath = "programm";
else $webyep_sIncludePath = "program";
include_once("$webyep_sIncludePath/webyep.php");

include_once(webyep_sConfigValue("webyep_sIncludePath") . "/" . WYTS("info.php"));

?>