<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
error_reporting(E_ALL);
ini_set('display_errors',true);
$webyep_bDocumentPage = false;
$webyep_sIncludePath = ".";
include_once("$webyep_sIncludePath/webyep.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAttachmentElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFile.php");

$aMimeTypes['pdf'] = "application/pdf";
$aMimeTypes['htm'] = "text/html"; 
$aMimeTypes['html'] = "text/html"; 
$aMimeTypes['php'] = "application/binary"; 
$aMimeTypes['txt'] = "text/plain"; 
$aMimeTypes['gif'] = "image/gif"; 
$aMimeTypes['jpg'] = "image/jpeg";
$aMimeTypes['png'] = "image/png";
$aMimeTypes['webp'] = "image/webp";
$aMimeTypes['svg'] = "image/svg";


$oFilename = new WYPath($_GET[WY_QK_DOWNLOAD_FILENAME]);
$oOrgFilename = new WYPath($_GET[WY_QK_ORIGINAL_FILENAME]);
$sClientIP = $goApp->sClientIP();
if (!$oFilename->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
   $goApp->log("missuse of download script from $sClientIP, path: " . $oFilename->sPath);
   exit(0);
}
if (!$oOrgFilename->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
   $goApp->log("missuse of download script from $sClientIP, org file path: " . $oOrgFilename->sPath);
   exit(0);
}
$sOrgFilename = str_replace(" ", "_", $oOrgFilename->sPath);

$oPath = od_clone($goApp->oDataPath);
$oPath->addComponent($oFilename->sPath);
$filepath=$oPath->sPath;
if (strpos($oPath->sPath, "webyep-system") === false) {
   // goApp's log won't work when data path was modified! -> echo
   echo "missuse of download script from $sClientIP, mangled data path: " . $oPath->sPath;
   exit(0);
}
$sExtenstion = $oPath->sExtension();

$oF = new WYFile($oPath);
if (!$oF->bExists()) {
   $oPath->removeDemoSlotID();
   $oF = new WYFile($oPath);
}
if (!$oF->bExists()) {
   $goApp->log("download file not found: " . $oPath->sPath);
   exit(0);
}

if (isset($aMimeTypes[$sExtenstion])) {
  $sMimeType = $aMimeTypes[$sExtenstion];
}
else {
   $sMimeType = "application/binary";
}

header("Content-Type: $sMimeType");
header("Content-Disposition: attachment; filename={$sOrgFilename}");
// work around strange IE/Win bug:
// when clicking "open" in the download dialog
// app can't open the downloaded doc
header("Pragma: public");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Length: " . filesize($filepath));
readfile($filepath);

