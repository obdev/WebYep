<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = ".";
	include_once("$webyep_sIncludePath/webyep.php");

	header("Content-Type: audio/x-ms-wax");

	$sAuthor = "";
   $sTitle = "";
	
	$sURL = $_GET['URL'];
	if (strpos($sURL, ":") !== false || strpos($sURL, "\\") !== false) exit(0);

	$sURL = "http://" . WYApplication::sHTTPHost()   . "/" . $sURL;

	echo "<ASX version = \"3.0\">\n";
	echo "  <Entry>\n";
	echo "    <Ref href=\"$sURL\" />\n";
	if ($sAuthor) echo "    <Author>$sAuthor</Author>\n";
	if ($sTitle) echo "    <Title>$sTitle</Title>\n";
	echo "  </Entry>\n";
	echo "</ASX>\n";
?>