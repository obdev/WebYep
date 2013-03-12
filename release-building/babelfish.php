#!/usr/bin/php
<?
$sVersion = "1.0";
// (C) 2003 Objective Development
// tiefenbrunner@obdev.at
// V1.0 21.11.2003

// configurables  ***************************************************************

define("MARKER", "@@");
define("INT_EXT", "int");
define("INT_REMARK", "###");

// globals  *********************************************************************

$sRootFolder = "";

// foundation stuff  ************************************************************

function odPath_sParent($s)
{
	$i = strrpos($s, "/");
	if ($i !== false) {
		$s = substr($s, 0, $i);		
	}
	else $s = ".";
	return $s;
}

function odPath_sFilename($s)
{
	return basename($s);
}

function odPath_sWithoutExt($s)
{
	$i = strrpos($s, ".");
	if ($i) return substr($s, 0, $i);
	else return $s;
}

function odPath_sExt($s)
{
	$i = strrpos($s, ".");
	if ($i) return substr($s, $i+1);
	else return "";
}

function odPath_sCompact($s)
{
	$sReg = '(/[^/]+/\.\./)|(/\./)|(/\.$)';
	while (eregi($sReg, $s)) $s = eregi_replace($sReg, "/", $s);
	$sReg = '^\./';
	while (eregi($sReg, $s)) $s = eregi_replace($sReg, "", $s);
	$sReg = '^[^/]+/\.\./';
	while (eregi($sReg, $s)) $s = eregi_replace($sReg, "", $s);
	return $s;
}

function odPath_sCombine($s1, $s2)
{
	$s = rtrim($s1, "/");
	if ($s != "" && $s2 != "") $s .= "/$s2";
	else if ($s2 != "") $s = $s2;
	return odPath_sCompact($s);
}

function odPath_createPath($sFolder)
{
	$sMother = "";

	$sFolder = rtrim($sFolder, "/");
	if (!file_exists($sFolder)) {
		$sMother = odPath_sParent($sFolder);
		odPath_createPath($sMother);
		_log("Creating folder $sFolder", 2);
		if (!@mkdir($sFolder)) error("Could not create path $sFolder", true);
	}
}

// functions ********************************************************************

function error($sMsg, $bFatal = false)
{
	fwrite(STDERR, ($bFatal ? "Fatal ":"") . "Error: $sMsg\n");
	if ($bFatal) exit(-1);
}

$iLogLevel = 0;
function _log($sMsg, $iLevel)
{
	global $iLogLevel;
	if ($iLogLevel >= $iLevel) echo $sMsg . "\n";
}

function bBeginsWith($sT, $sW)
{
	return strtolower(substr($sT, 0, strlen($sW))) == strtolower($sW);
}

function bMatchInRegList($aList, $sText)
{
	$bMatch = false;
	$sReg = "";
	foreach ($aList as $sReg) {
		if (ereg($sReg, $sText)) {
			$bMatch = true;
			break;
		}
	}
	return $bMatch;
}

function checkPath($sP)
{
	global $sRootFolder;
	$iRootPathLen = strlen($sRootFolder);
	$bSave = false;
	
	if (substr($sP, 0, 1) != "/") $sP = odPath_sCombine($sRootFolder, $sP);
	else $sP = odPath_sCompact($sP);
	if (strlen($sP) < $iRootPathLen) $bSave = true;
	else {
		if (substr($sP, 0, $iRootPathLen) != $sRootFolder) $bSave = true;
	}
	if (!$bSave) error("Destination path $sP is not safe (must not lie within root folder $sRootFolder", true);
}

define("MODE_NONE", 0);
define("MODE_TRANS", 1);
define("OPTIONS_FORMAT", "FRM");
define("OPTIONS_IGNORE", "IGN");
define("OPTIONS_DESTINATIONS", "DST");
define("OPTIONS_FORMAT_HTML", "HTML");
define("OPTIONS_FORMAT_ASCII", "ASCII");

$dOptions = array();
$dOptions[OPTIONS_FORMAT] = OPTIONS_FORMAT_ASCII;
$dOptions[OPTIONS_IGNORE] = array();
$dOptions[OPTIONS_DESTINATIONS] = array();

function parseIntFile($sFilepath, &$dResult)
// pass dict for result as ref
{
	global $dOptions;
	$f = 0;
	$sLine = "";
	$iLineNr = 0;
	$iMode = MODE_NONE;
	$sKey = "";
	$iLangNr = 0;
	$a = array();
	$s = "";
	
	_log("Parsing settings file $sFilepath", 1);
	$f = @fopen($sFilepath, "r");
	if (!$f) error("Opening $sFilepath failed", true);
	while (!feof($f) || ($iMode == MODE_TRANS)) {
		if (!feof($f)) $sLine = trim(fgets($f));
		else $sLine = "";
		if ($iMode == MODE_NONE) {
			$iLangNr = 0;
			$sKey = "";
		}
		$iLineNr++;
		if (substr($sLine, 0, strlen(INT_REMARK)) == INT_REMARK) continue;
		// include
		if (bBeginsWith($sLine, "include")) {
			if ($iMode == MODE_TRANS) error("Parse error in $sFilepath line $iLineNr: include after item key\n", true);
			$a = split("[,; \t]+", $sLine);
			array_shift($a);
			foreach ($a as $s) {
				parseIntFile(odPath_sCombine(odPath_sParent($sFilepath), $s), $dResult);
			}
			$iMode = MODE_NONE;
		}
		// output-format
		else if (bBeginsWith($sLine, "output-format")) {
			if (eregi("output-format[,; \t]+(" . OPTIONS_FORMAT_HTML .  "|" . OPTIONS_FORMAT_ASCII . ")\$", $sLine, $a)) {
				if (strtolower($a[1]) == strtolower(OPTIONS_FORMAT_HTML)) $dOptions[OPTIONS_FORMAT] = OPTIONS_FORMAT_HTML;
				else $dOptions[OPTIONS_FORMAT] = OPTIONS_FORMAT_ASCII;
			}
			else error("Syntax error in line $iLineNr ($sLine)", true);
			$iMode = MODE_NONE;
		}
		// destinations
		else if (bBeginsWith($sLine, "destinations")) {
			$a = split("[ \t]+", $sLine);
			array_shift($a);
			$dOptions[OPTIONS_DESTINATIONS] = array();
			foreach($a as $s) {
				$dOptions[OPTIONS_DESTINATIONS][] = odPath_sCombine(odPath_sParent($sFilepath), $s);
			}
			$iMode = MODE_NONE;
		}
		// file to ignore
		else if (bBeginsWith($sLine, "ignore")) {
			$a = split("[ \t]+", $sLine);
			array_shift($a);
			// $dOptions[OPTIONS_IGNORE] = array();
			foreach($a as $s) {
				$dOptions[OPTIONS_IGNORE][] = $s;
			}
			$iMode = MODE_NONE;
		}
		// empty line
		else if ($sLine == "") {
			$iMode = MODE_NONE;
		}
		// item (key or content)
		else {
			switch ($iMode) {
				// content
				case MODE_TRANS:
					if ($iLangNr < count($dOptions[OPTIONS_DESTINATIONS])) {
						if ($dOptions[OPTIONS_FORMAT] == OPTIONS_FORMAT_HTML) {
							$sLine = htmlentities($sLine);
							$sLine = str_replace("\\n", "<br>", $sLine);
						}
						$dResult[$sKey][$iLangNr] = $sLine;
					}
					$iLangNr++;
					break;
				// key
				default:
					$sKey = $sLine;
					$iMode = MODE_TRANS;
					$dResult[$sKey] = array();
			}
		}
	}
	fclose($f);
}

function internationalizeFile($sFilepath)
{
	global $dOptions;
	$s = "";
	$sKey = "";
	$sValue = "";
	$sPre = "";
	$sPost = "";
	$sInLine = "";
	$sOutLine = array();
	$iLineNr = 0;
	$iPos = 0;
	$iEndPos = 0;
	$iMarkerLen = strlen(MARKER);
	$sOutFolder = "";
	$sOutFilepath = "";
	$inFile = 0;
	$f = 0;
	$iLang = 0;
	$aOutFiles = array();
	$sIntFilepath = $sFilepath . "." . INT_EXT;
	
	_log("Working on $sFilepath", 1);
   echo "."; flush(); // progress indicator
	if (file_exists($sIntFilepath)) { // internationalze it
		parseIntFile($sIntFilepath, $dTransDict);
		
// print_r($dOptions);
// print_r($dTransDict);
		
		$inFile = @fopen($sFilepath, "r");
		if (!$inFile) error("Could not open $sFilename", true);
		foreach ($dOptions[OPTIONS_DESTINATIONS] as $s) {
			$sOutFolder = odPath_sCombine($s, odPath_sParent($sFilepath));
			odPath_createPath($sOutFolder);
			$sOutFilepath = odPath_sCombine($sOutFolder, odPath_sFilename($sFilepath));
			checkPath($sOutFilepath);
			$f = @fopen($sOutFilepath, "w");
			if (!$f) error("Could not write to $sOutFilepath", true);
			$aOutFiles[] = $f;
		}
		
		while (!feof($inFile)) {
			$sInLine = fgets($inFile);
			$iLineNr++;
			$iLang = 0;
			foreach ($aOutFiles as $f) {
				$sOutLine = $sInLine;
				while (($iPos = strpos($sOutLine, MARKER, $iPos)) !== false) {
					$iEndPos = strpos($sOutLine, MARKER, $iPos + 1);
					if ($iEndPos === false) error("Marker error - no closing marker in $sFilepath at line $iLineNr", true);
					$sKey = substr($sOutLine, $iPos + $iMarkerLen, $iEndPos - $iPos - $iMarkerLen);
					$sPre = substr($sOutLine, 0, $iPos);
					$sPost = substr($sOutLine, $iEndPos + $iMarkerLen);
					$sValue = "Unkown key: $sKey";
					if (!isset($dTransDict[$sKey])) error("Unkown key $sKey in line $iLineNr of $sFilepath", false);
					else if (!isset($dTransDict[$sKey][$iLang])) error("Language count missmatch for key $sKey in line $iLineNr of $sFilepath", false);
					else {
						$sValue = $dTransDict[$sKey][$iLang];
					}
					$sOutLine = $sPre . $sValue . $sPost;
				}
				fwrite($f, $sOutLine);
				$iLang++;
			}
		}
		
		@fclose($inFile);
		foreach ($aOutFiles as $f) @fclose($f);
	}
	else { // just copy it
		foreach ($dOptions[OPTIONS_DESTINATIONS] as $s) {
			$sOutFolder = odPath_sCombine($s, odPath_sParent($sFilepath));
			odPath_createPath($sOutFolder);
			$sOutFilepath = odPath_sCombine($sOutFolder, odPath_sFilename($sFilepath));
			checkPath($sOutFilepath);
			_log("Copying $sFilepath to $sOutFilepath", 1);
			if (!@copy($sFilepath, $sOutFilepath)) error("Copying $sFilepath to $sOutFilepath didn't work");
		}
	}
}

function processFilesIn($sFolder)
{
	global $sRootFolder;
	global $dOptions;
	$sEntry = "";
	$sFileType = "";
	$dIntResult = array();
	$dir = 0;
	$sFullFolderPath = odPath_sCombine($sRootFolder, $sFolder);
	$sRelativeElementPath = "";
	$sFolderOptsFile = "$sFolder/options.int";
	
	if (file_exists($sFolderOptsFile)) parseIntFile($sFolderOptsFile, $dIntResult);
	$dir = opendir($sFullFolderPath);
	if (!$dir) error("Could not open folder $sFullFolderPath", true);
	while (($sEntry = readdir($dir)) !== false) {
		$sRelativeElementPath = odPath_sCombine($sFolder, $sEntry);
		$sFullPath = odPath_sCombine($sFullFolderPath, $sEntry);
		$sFileType = filetype($sFullPath);
		if ($sFileType == "link") {
			$sFileType = filetype($sFullFolderPath . "/" . readlink($sFullPath));
		}
		if ($sFileType == "file" && !bMatchInRegList($dOptions[OPTIONS_IGNORE], $sRelativeElementPath)) {
			internationalizeFile($sRelativeElementPath);
		}
		else if ($sFileType == "dir" && $sEntry != "." && $sEntry != ".." && !bMatchInRegList($dOptions[OPTIONS_IGNORE], $sEntry)) {
			processFilesIn($sRelativeElementPath);
		}
	}
	closedir($dir);
}

// main *************************************************************************

$sScriptName = $argv[0];
$sFilename = "";
$aOtherArgs = array();

// if (count($argv) <= 1) $argv[] = "-h";

foreach ($argv as $sArg)
{
	if (substr($sArg, 0, 1) != "-")	$aOtherArgs[] = $sArg;
	else { // options
		switch ($sArg) {
			case "-v":
			case "--version":
				fwrite(STDERR, "$sScriptName version $sVersion\n");
				exit(0);
				break;
			case "-V":
			case "--verbous":
				$iLogLevel = 1;
				break;
			case "-VV":
			case "--veryverbous":
				$iLogLevel = 2;
				break;
			case "-h":
			case "--help":
			default:
				fwrite(STDERR, "Usage: $sScriptName -V|-verbous -VV|--veryverbous ...\n    or $sScriptName -v|--version\n");
				exit(0);
		}
	}
}
array_shift($aOtherArgs);
$sRootFolder = getcwd();

processFilesIn(".");

// ******************************************************************************

?>