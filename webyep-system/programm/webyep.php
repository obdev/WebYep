<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

// setup php
if (get_magic_quotes_runtime() && function_exists("set_magic_quotes_runtime")) @set_magic_quotes_runtime(false);
error_reporting(0);
ini_set("display_errors", "Off");

define("WEBYEP_DEMOSLOT_PREFIX", "demoslot_");
define("WY_QK_LOGOUT", "WEBYEP_LOGOUT");
define('WEBYEP_NOBOX', 0);
define('WEBYEP_LIGHTBOX', 1);
define('WEBYEP_FANCYBOX', 2);

$webyep_bDebug = false;
$webyep_bWL = false;
$webyep_bLiveDemo = false;
$webyep_sHeadHTML = "";
$webyep_sBodyHTML = "";

function webyep_sConfigValue($sVN)
{
    return $GLOBALS[$sVN];
}

function webyep_outputFilter($sIn)
{
    global $webyep_sHeadHTML, $webyep_sBodyHTML;

    $sIn = $webyep_sHeadHTML ? str_replace("</head>", "$webyep_sHeadHTML</head>", $sIn):$sIn;
    $sIn = $webyep_sBodyHTML ? str_replace("</body>", "$webyep_sBodyHTML</body>", $sIn):$sIn;

    return $sIn;
}

function webyep_showSystemInfos() {
    global $goApp;
    $bMay = false;
    if ($goApp->bEditPermission) $bMay = true;
    if ($bMay) {
        echo "<h2>PHP System Infos</h2>\n";
        eval(phpinfo());
    }
}

function webyep_sHTMLEntities($s, $bAll = true) {
    global $webyep_sCharset;

    if ($webyep_sCharset == "") {
        if (!$bAll) {
            $dTable = get_html_translation_table(HTML_ENTITIES);
            $dTable["<"] = "<";
            $dTable[">"] = ">";
            $dTable[chr(183)] = chr(183); // leave middot allone - needed for lists
            $s = strtr($s, $dTable);
        } else {
            $s = htmlentities($s);
        }
    } else {
        $s = str_replace("&", "&amp;", $s);
        $s = str_replace("\"", "&quot;", $s);
        $s = str_replace("'", "&#039;", $s);
        if ($bAll) {
            $s = str_replace(">", "&gt;", $s);
            $s = str_replace("<", "&lt;", $s);
        }
        $s = str_replace("\\>", "&gt;", $s);
        $s = str_replace("\\<", "&lt;", $s);
    }
    return $s;
}

function webyep_showSecWarning() {
    $sText = WYTS("SecWarning");
    echo "<script type=\"text/javascript\">alert(\"$sText\")</script>";
}

function webyep_checkDataFolderIntegrity() {
    global $goApp, $webyep_dMD5s;

    $oDP = od_clone($goApp->oDataPath);
    $r = opendir($oDP->sPath);
    while ($r && ($sFN = readdir($r)) !== false) {
        if (preg_match('/\.php$/', $sFN) || preg_match('/\.htm$/', $sFN) || (preg_match('/\.html$/', $sFN) && $sFN != "readme.html" && $sFN != "liesmich.html") || preg_match('/\.js$/', $sFN)) {
            webyep_showSecWarning();
            return;
        }
    }
    closedir($r);
}

// in case config can't be found
$webyep_sAdminName = (string)mt_rand(10000, 99999);
$webyep_sAdminPassword = (string)mt_rand(10000, 99999);
$webyep_sBaseURL = "";
$webyep_bUseTablesForMenus = false; // deprecated
$webyep_bUseJavaScriptMenus = false;
$webyep_bUseTablesForGalleries = true;
$webyep_bAutoCloseMenus = false;
$webyep_bRememberOpenMenus = true;
$webyep_bTitleAlwaysOpensPage = false;
$webyep_bShowDisabledEditButtons = true;
$webyep_bOtherLoginsMayEditGlobalData = false;
$webyep_sHTMLStandard = "auto";
$webyep_bLiveDemoLockTemplate = false;
$webyep_iUseImageBox = WEBYEP_NOBOX; // check, if subfolder is present in /opt and set $webyep_iUseImageBox accordingly (see below)
$webyep_bDoNotIncludejQuery = false; // jQuery will be included, if required (see below)
$webyep_bDoNotIncludePrototype = false; // Prototype will be included, if required (see below)
$webyep_bDoNotIncludeScriptaculous = false; // Scriptaculous will be included, if required (see below)
$webyep_aMultiLoginName = array();
$webyep_aMultiLoginPassword = array();
$webyep_aMultiLoginURLPatterns = array();

$webyep_iMajorVersion = 1;
$webyep_iMinorVersion = 8;
$webyep_iSubVersion = 0;
$webyep_sCopyrightLine = "&copy; 2013, <a href='http://www.obdev.at/' target='_blank'>Objective Development Software GmbH</a>";

if (isset($_GET['webyep_sIncludePath']) || isset($_POST['webyep_sIncludePath']) || isset($_COOKIE['webyep_sIncludePath']) || isset($_SESSION['webyep_sIncludePath'])) exit(-1);
if (strpos($webyep_sIncludePath, ":") !== false) exit(-1);
if (!file_exists(webyep_sConfigValue("webyep_sIncludePath"))) exit(-1);
include_once(webyep_sConfigValue("webyep_sIncludePath") . "/lib/foundation.php");

$webyep_bTesting = isset($_SERVER['HTTP_HOST']) && (webyep_str_murks($_SERVER['HTTP_HOST'])=="jrolrc.ubzr" || webyep_str_murks($_SERVER['HTTP_HOST'])=="gevyyvna.ybpny");
// if ($webyep_bTesting) $webyep_bDebug = true;

// for CKFinder: We need to be able to include webyep.php from within a function
global $webyep_sAdminName;
global $webyep_sAdminPassword;

$sConfigFilePath = webyep_sConfigValue("webyep_sIncludePath") . "/../config-inc.php";
if (!@include_once($sConfigFilePath)) {
    $sConfigFilePath = webyep_sConfigValue("webyep_sIncludePath") . "/../konfiguration.php";
    if (!@include_once($sConfigFilePath))
        $goApp->log("could not find config file");
}

// backward compatibility with pre 1.2.2 config
if (!isset($webyep_sMenuType)) $webyep_sMenuType = "div";

if ($webyep_sMenuType == "list") {
   $webyep_bUseListsForMenus = true;
   $webyep_bUseJavaScriptMenus = false;
}
else if ($webyep_sMenuType == "listJS") {
   $webyep_bUseListsForMenus = true;
   $webyep_bUseJavaScriptMenus = true;
}
else {
   $webyep_bUseListsForMenus = false;
   $webyep_bUseJavaScriptMenus = false;
}

// if ($webyep_bTesting) $webyep_sCharset = "iso-8859-2";
// if ($webyep_bTesting) $webyep_iForcedLanguageID = 0;

if ($webyep_bDebug) {
    if (defined('E_DEPRECATED')) {
       error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); // PHP 5.3+
    } else {
        error_reporting(E_ALL & ~E_NOTICE);                 // old PHP version
    }
   ini_set("display_errors", "On");
}

if ($webyep_bLiveDemo) {
   if (isset($_SERVER["REDIRECT_URL"])) {
      $sRedirectURL = $_SERVER["REDIRECT_URL"];
      if (substr($sRedirectURL, -1) == "/") $sRedirectURL .= "index.php";
      $_SERVER["PHP_SELF"] = $sRedirectURL;
      $_SERVER["SCRIPT_NAME"] = $sRedirectURL;
   }
   else if (isset($_SERVER["REQUEST_URI"])) {
      $iQueryPos = strpos($_SERVER["REQUEST_URI"], "?");
      $sWithoutQuery = substr($_SERVER["REQUEST_URI"], 0, $iQueryPos ? $iQueryPos:strlen($_SERVER["REQUEST_URI"]));
      if (substr($sWithoutQuery, -1) == "/") $sWithoutQuery .= "index.php";
      $_SERVER["PHP_SELF"] = $sWithoutQuery;
      $_SERVER["SCRIPT_NAME"] = $sWithoutQuery;
   }
    // get live demo slot ID
    $sURI = $_SERVER['REQUEST_URI'];
    if (preg_match('|.*/' . WEBYEP_DEMOSLOT_PREFIX . '([end]{2})([0-9]+)/.*|', $sURI, $aReg)) {
        $webyep_sLiveDemoSlotID = $aReg[2];
        if ($aReg[1] == "en") $webyep_iForcedLanguageID = 0;
        if ($aReg[1] == "de") $webyep_iForcedLanguageID = 1;
    }
    else $webyep_sLiveDemoSlotID = "";
}

include_once(webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYLanguage.php");

// backward compatibility with 1.0.x
if ( isset($webyep_sAdminPasswort) && !isset($webyep_sAdminPassword) ) {
    $webyep_sAdminPassword = $webyep_sAdminPasswort;
}

// backward compatibility with pre 1.2.2 config
if (!isset($webyep_bOpenFullURLsInNewWindow)) $webyep_bOpenFullURLsInNewWindow = false;
// backward compatibility with early pre releases of 1.2.2
if (isset($webyep_bOpenLongTextFullURLsInNewWindow)) $webyep_bOpenFullURLsInNewWindow = $webyep_bOpenLongTextFullURLsInNewWindow;

$webyep_sVersionPostfix = '';

$_wy_sIncludePath = webyep_sConfigValue("webyep_sIncludePath");
include_once("$_wy_sIncludePath/elements/WYShortTextElement.php");
include_once("$_wy_sIncludePath/elements/WYLongTextElement.php");
include_once("$_wy_sIncludePath/elements/WYImageElement.php");
include_once("$_wy_sIncludePath/elements/WYMenuElement.php");
include_once("$_wy_sIncludePath/elements/WYLoopElement.php");
include_once("$_wy_sIncludePath/elements/WYLogonButtonElement.php");
include_once("$_wy_sIncludePath/elements/WYAttachmentElement.php");
include_once("$_wy_sIncludePath/elements/WYReadMoreElement.php");

if (file_exists("$_wy_sIncludePath/elements/WYRichTextElement.php")) include_once("$_wy_sIncludePath/elements/WYRichTextElement.php");
if (file_exists("$_wy_sIncludePath/elements/WYGalleryElement.php")) include_once("$_wy_sIncludePath/elements/WYGalleryElement.php");
if (file_exists("$_wy_sIncludePath/elements/WYAudioElement.php")) include_once("$_wy_sIncludePath/elements/WYAudioElement.php");
if (file_exists("$_wy_sIncludePath/elements/WYGuestbookElement.php")) include_once("$_wy_sIncludePath/elements/WYGuestbookElement.php");

if ($webyep_sBaseURL) {
    $goApp->oProgramURL->sPath = "$webyep_sBaseURL/" . (strpos($goApp->oProgramURL->sPath, "webyep-system/programm") !== false ? "programm":"program");
    $goApp->oDataURL->sPath = "$webyep_sBaseURL/" . (strpos($goApp->oDataURL->sPath, "webyep-system/daten") !== false ? "daten":"data");
    $goApp->oImageURL = od_clone($this->oProgramURL);
    $goApp->oImageURL->addComponent("images");
}

// public API

function webyep_bIsEditMode()
{
    global $goApp;

    return $goApp->bEditMode;
}

function webyep_bHasEditPermissions()
{
    global $goApp;

    return $goApp->bEditPermission;
}

// ----------
// Not happy with this function here, but can't think of a better place right now...
function webyep_sGetFancyBoxVersion ($sPath) {
    $aFiles = webyep_aScanDirectory ($sPath, "jquery\.fancybox-.+\.pack.js");
    return preg_replace("|jquery\.fancybox-(.+)\.pack.js|", "$1", $aFiles[0]);
}
// ----------

if (!function_exists("version_compare") || version_compare(PHP_VERSION, "4.2.0") < 0) {
    list($fUSec, $fSec) = explode(' ', microtime());
    mt_srand($fSec + ((float)$fUSec * 100000));
}

if (!headers_sent()) {
    if ($goApp->bShouldAvoidCaching()) {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }
    else {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", filemtime($goApp->oDataPath->sPath)) . " GMT");
    }
}

// headers should not be sent at this point
if (headers_sent() && $webyep_bDocumentPage && !preg_match("|webyep-system/.*/notice.php|", $_SERVER['PHP_SELF']) && !preg_match("|webyep-system/.*/logon.php|", $_SERVER['PHP_SELF'])) {
    echo $goApp->sNoticeWindowJS("HeaderProblemTitle", "HeaderProblemMessage");
}
$goApp->outputWarningPanels();
if ($goApp->bEditMode && !$goApp->bValidUser() && !preg_match("|webyep-system/.*/logon.php|", $_SERVER['PHP_SELF']) && !preg_match("|webyep-system/.*/notice.php|", $_SERVER['PHP_SELF'])) {
    if ($webyep_bDocumentPage) {
        echo "<script type='text/javascript'>\n";
        echo "   " . $goApp->sAuthWindowJS();
        echo "</script>\n";
    }
}

if ($webyep_bDocumentPage) {
    ob_start("webyep_outputFilter");

    WYLoopElement::setupHead();

    if ($webyep_iUseImageBox == WEBYEP_NOBOX) { // only include js/css, if $webyep_iUseImageBox has default value
        // LightBox ---------------------------
        $sLightBoxSub = "opt/lightbox";
        $oLightBoxPath = od_clone($goApp->oProgramPath);
        $oLightBoxPath->addComponent($sLightBoxSub);
        if ($oLightBoxPath->bExists()) {
            if ($webyep_bDoNotIncludeScriptaculous) $webyep_bDoNotIncludePrototype = true; // scriptaculous requires prototype
            $webyep_iUseImageBox = WEBYEP_LIGHTBOX;
            $oLightBoxURL = od_clone($goApp->oProgramURL);
            $oLightBoxURL->addComponent($sLightBoxSub);
            $sLightBoxURL = $oLightBoxURL->sEURL();
            $webyep_sHeadHTML .= "<script type='text/javascript'>\n";
            $webyep_sHeadHTML .= "   window.WebYep_LightBoxPath = '$sLightBoxURL';\n";
            $webyep_sHeadHTML .= sprintf("   window.WebYep_LightBoxLang = '%s';\n", $webyep_iLanguageID == WYLANG_ENGLISH ? "en":"de");
            $webyep_sHeadHTML .= "</script>\n";
            if ($webyep_bDoNotIncludePrototype === false) { // undocumented Option from config.php - if set, user must include Prototype manually in HTML!
                $webyep_sHeadHTML .= "<script type='text/javascript' src='$sLightBoxURL/js/prototype.js'></script>\n";
            }
            if ($webyep_bDoNotIncludeScriptaculous === false) { // undocumented Option from config.php - if set, user must include Scriptaculous manually in HTML!
                $webyep_sHeadHTML .= "<script type='text/javascript' src='$sLightBoxURL/js/scriptaculous.js?load=effects,builder'></script>\n";
            }
            $webyep_sHeadHTML .= "<script type='text/javascript' src='$sLightBoxURL/js/lightbox.js'></script>\n";
            $webyep_sHeadHTML .= "<link rel='stylesheet' href='$sLightBoxURL/css/lightbox.css' type='text/css' media='screen' />\n";
        }
        // FancyBox ---------------------------
        $sFancyBoxSub = "opt/fancybox";
        $oFancyBoxPath = od_clone($goApp->oProgramPath);
        $oFancyBoxPath->addComponent($sFancyBoxSub);
        if ($oFancyBoxPath->bExists() && !($webyep_iUseImageBox == WEBYEP_LIGHTBOX)) {
            $oOptURL = od_clone($goApp->oProgramURL);
            $oOptURL->addComponent("opt");
            $sOptURL = $oOptURL->sEURL();
            // Add jQuery
            if ($webyep_bDoNotIncludejQuery === false) { // undocumented Option from config.php - if set, user must include jQuery manually in HTML!
                $oOptPath = od_clone($goApp->oProgramPath);
                $oOptPath->addComponent("opt");
                $aResult = webyep_aScanDirectory($oOptPath->sPath, "^jquery-([0-9]+\.)+(min\.)?js$");
                if (count($aResult) == 1) { // if we have something that looks like jQuery in /opt, use it
                    $sJQueryLibrary = $aResult[0];
                    $webyep_sHeadHTML .= "<script type='text/javascript' src='" . $sOptURL . "/" . $sJQueryLibrary . "'></script>\n";
                } else {  // use newest jQuery v1.x from ajax.googleapis.com
                    $webyep_sHeadHTML .= "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>\n";
                }
            }
            $webyep_iUseImageBox = WEBYEP_FANCYBOX;
            $sFancyBoxVersion = webyep_sGetFancyBoxVersion($oFancyBoxPath->sPath); // TODO: check if VersionNr is valid
            $oFancyBoxURL = od_clone($goApp->oProgramURL);
            $oFancyBoxURL->addComponent($sFancyBoxSub);
            $sFancyBoxURL = $oFancyBoxURL->sEURL();
            $webyep_sHeadHTML .= "<link rel='stylesheet' href='$sFancyBoxURL/jquery.fancybox-" . $sFancyBoxVersion . ".css' type='text/css' media='screen' />\n";
            $webyep_sHeadHTML .= "<script type='text/javascript' src='$sFancyBoxURL/jquery.fancybox-" . $sFancyBoxVersion . ".pack.js'></script>\n";
            // onload function to initialize the images:
            $oFBOptionsPath = od_clone($goApp->oProgramPath);
            $oFBOptionsPath->addComponent("opt/fancybox_params.js");
            if ($oFBOptionsPath->bExists()) {
                // include params from option file
                $webyep_sHeadHTML .= "<script type='text/javascript'>/*<![CDATA[*/\$(document).ready(function(){\$('a.WYPopUpImage').fancybox({";
                $webyep_sHeadHTML .= preg_replace("|,[ ]*$|", "", preg_replace("|\"|", "'", preg_replace("|[\n\r\t]|", "", file_get_contents($oFBOptionsPath->sPath))));
                $webyep_sHeadHTML .= "});});/*]]>*/</script>\n";
            } else {
                // use hardcoded defaults
                $webyep_sHeadHTML .= "<script type='text/javascript'>/*<![CDATA[*/\$(document).ready(function(){\$('a.WYPopUpImage').fancybox({'transitionIn':'elastic','transitionOut':'elastic','speedIn':600,'speedOut':200,'overlayShow':false});});/*]]>*/</script>\n";
            }
        }
    } else {
        $webyep_sHeadHTML .= "\n<!-- designer must put js/css here manually -->\n";
    }
}

$oExtPath = od_clone($goApp->oProgramPath);
$oExtPath->removeLastComponent();
$oExtPath->removeLastComponent();
$oExtPath->addComponent("webyep-system-extensions.inc.php");
if ($oExtPath->bExists()) include_once($oExtPath->sPath);

?>