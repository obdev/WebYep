<?php // WebYep init WebYepV1
/* ><table><tr><td bgcolor=white><h2>WebYep message: Error, PHP inactive</h2>
<font color=red>The PHP code in this page can not be executed!<ul>
<li>Are you launching this page directly form your harddisc (e.g. via Dreamweavers
"Preview in Browser" instead of accessing it via a webserver?</li>
<li>Has this file the correct file extension for PHP scripts?
WebYep pages must have the ".php" extension and <b>not</b> ".html" or ".htm"!</li>
</ul></font></td></tr></table><!--
*/
$webyep_sIncludePath = "./";
$iDepth = 0;
while (!file_exists($webyep_sIncludePath . "webyep-system")) {
	$iDepth++;
	if ($iDepth > 10) {
		error_log("webyep-system folder not found!", 0);
		echo "<html><head><title>WebYep</title></head><body><b>WebYep:</b> This page can not be displayed <br>Problem: The webyep-system folder was not found!</body></html>";
		exit;
	}
	$webyep_sIncludePath = ($webyep_sIncludePath == "./") ? ("../"):("$webyep_sIncludePath../");
}
if (file_exists("${webyep_sIncludePath}webyep-system/programm")) $webyep_sIncludePath .= "webyep-system/programm";
else $webyep_sIncludePath .= "webyep-system/program";
include("$webyep_sIncludePath/webyep.php");
// -->?>
<?php

function sLS($sDE, $sEN)
{
    global $gsLang;
	return $gsLang == "de" ? $sDE:$sEN;
}

function sWYLS($sDE, $sEN)
{
    global $webyep_iLanguageID;
	return $webyep_iLanguageID == WYLANG_ENGLISH ? $sEN:$sDE;
}

function sIMG($sIMG, $sAtt = "")
{
    global $gsLang;

	$sIMG = $gsLang == "de" ? $sIMG:str_replace("-de", "-en", $sIMG);
    if ($sIMG[0] == "/") $sIMG = ".." . $sIMG;
    if ($sAtt) $sAtt = " " . $sAtt;
    $sHTML = "<img src=\"$sIMG\"$sAtt />";
    return $sHTML;
}

function sCurrentPage()
{
    return basename($_SERVER['PHP_SELF']);
}

function sCurrentSection()
{
    $sCurrentSection = "";
    $sCurrentPage = sCurrentPage();

    switch ($sCurrentPage) {
	    case "index.php":
            $sCurrentSection = "home";
        break;
	    case "about.php":
	    case "about_philosophy.php":
	    case "about_team.php":
	    case "about_team_member.php":
            $sCurrentSection = "about";
        break;
	    case "counseling.php":
            $sCurrentSection = "counseling";
        break;
	    case "therapies.php":
            $sCurrentSection = "therapies";
        break;
	    case "events.php":
	    case "events_category.php":
	    case "events_gallery.php":
            $sCurrentSection = "events";
        break;
	    case "partners.php":
            $sCurrentSection = "partners";
        break;
	    case "contact.php":
            $sCurrentSection = "contact";
        break;
	    case "legal_notice.php":
            $sCurrentSection = "legal_notice";
        break;
    }
    return $sCurrentSection;
}

function sCurrentSubNavPath()
{
    $sCurrentSection = sCurrentSection();
    return "${sCurrentSection}.subnav.php";
}

function sMenuButton($sName)
{
    global $gsLang;

    $sImg = "$sName-$gsLang.gif";
    $sURL = "$sName.php";
    if ($sName == "home") $sURL = "index.php";
    if ($sName == "events") $sURL = "events_category.php?WEBYEP_DI=1";

    $sCurrentSection = sCurrentSection();
    if ($sName == $sCurrentSection) $sImg = str_replace(".gif", "-o.gif", $sImg);
    $sHTML = "<a href=\"$sURL\"><img src=\"../images/$sImg\" border=\"0\" /></a>";
    return $sHTML;
}

function sSubMenuItem($sText, $sURL)
{
	$sHTML = "";
    $bSelected = strpos($_SERVER['PHP_SELF'], str_replace(".php", "", basename($sURL))) !== false;
    $sHTML = sprintf('<div class="subMenuItem%s"><a href="%s">%s</a></div>%s', $bSelected ? " selected":"", $sURL, $sText, "\n");
    return $sHTML;
}

//error_reporting(E_ALL ^ E_NOTICE);
//ini_set("display_errors", 1);

error_reporting(0);
ini_set("display_errors", 0);


$gsLang = "en";

if (strpos($_SERVER['PHP_SELF'], "/de/") !== false) $gsLang = "de";

?>