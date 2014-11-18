#!/usr/bin/php
<?php

define('COLOR_RED',   "\033[0;31m");
define('COLOR_GREEN', "\033[0;32m");
define('COLOR_END',   "\033[0m");

error_reporting(E_ALL);

function fatal($iLine)
{
   echo COLOR_RED . "\nfatal error in line $iLine - aborting\n\n" . COLOR_END;
   exit(-1);
}

function waitForReturn()
{
   $f = fopen("php://stdin", "rb");
   fread($f, 1);
   fclose($f);
}

//function file_put_contents($sFN, $sC)
//{
//   $f = fopen($sFN, "w");
//   fwrite($f, $sC);
//   fclose($f);
//}

function sMXILinesForFolder($sDir)
{
   $s = "";
   $d = opendir($sDir);

    while ($sEntry = readdir($d)) {
        if ($sEntry == ".." || $sEntry == ".") continue;
        $sFullPath = $sDir == "." ? $sEntry:"$sDir/$sEntry";
        if (is_dir($sFullPath)) $s .= sMXILinesForFolder($sFullPath);
        else if (is_file($sFullPath)) {
            $s .= "<file name=\"$sFullPath\" destination=\"\$dreamweaver/Configuration/$sDir\" />\n";
        }
    }
    closedir($d);
    return $s;
}

function createMXI()
{
    $s = sMXILinesForFolder(".");
    $sMXI = file_get_contents("webyep.mxi");
    $sMXI = str_replace("##files##", $s, $sMXI);
    file_put_contents("webyep.mxi", $sMXI);
}

function replaceTextInFile($sFilepath, $dPairs)
{
    $s = file_get_contents($sFilepath);
    if (!$s) {
        echo "Could not read file $sFilepath";
        fatal(__LINE__);
    }
    foreach ($dPairs as $sFrom => $sTo) {
      $s = str_replace($sFrom, $sTo, $s);
    }
    file_put_contents($sFilepath, $s);
}

function usage()
{
   echo "\nusage: make_release -r ReleaseName [-v] [-omitDW] [-omitRW]\n";
   echo "       ReleaseName: e.g. 1.7.2\n";
   echo "       -v: be verbose (will produce LOTS of spam)\n";
   echo "       -omitDW: do not create Dreamweaver extension\n";
   echo "       -omitRW: do not create RapidWeaver extension\n";
   echo "\n";
   exit;
}

$sRelease = '';
$bOmitDWX = false;
$bOmitRWP = false;
$bVerbose = false;

if ($argc < 3) usage();
for ($i = 1; $i < $argc; $i++) {
    switch ($argv[$i]) {
        case "-r":
            $sRelease = $argv[++$i];
        break;
        case "-omitDW":
            $bOmitDWX = true;
        break;
        case "-omitRW":
            $bOmitRWP = true;
        break;
        case "-v":
            $bVerbose = true;
        break;
        default: usage();
    }
}

if (!$sRelease) usage();

// setup
// ==========================================================================
$originalCWD = getcwd();
// make sure that we are in project root (otherwise the following command will fail)
chdir(preg_replace('|/release-building.*$|', '', __DIR__)) or fatal(__LINE__);
$sourceRootDir = getcwd();

if (!file_exists("external-dependencies/RWPluginUtilities.framework")) {
    echo COLOR_RED . "External dependency RWPluginUtilities framework not found!\nDisabling RapidWeaver Plugin." . COLOR_END;
    $bOmitRWP = true;
}

$sExtensionManagerPath = "$sourceRootDir/external-dependencies/Adobe Extension Manager CS5.app/Contents/MacOS/Adobe Extension Manager CS5";
if (!file_exists($sExtensionManagerPath)) {
    echo COLOR_RED . "External dependency Adobe Extension Manager CS5 application not found!\nDisabling Dreamweaver Plugin." . COLOR_END;
    $bOmitDWX = true;
}


$sZIP = "zip";
$V = $bVerbose ? 'v' : 'q'; // zip option verbose/quiet

$sHdiutil = "hdiutil";
$Q = $bVerbose ? '' : ' -quiet'; // make hdiutil shut up

$sBabelfish = "$sourceRootDir/release-building/babelfish.php";
if (!file_exists($sBabelfish)) fatal(__LINE__);

echo "----------------------------------------------------------\n";
echo "Creating release $sRelease:\n";
echo "----------------------------------------------------------\n";
$sDestination = sprintf("/tmp/WebYep-Release-%d", getmypid());
mkdir($sDestination);
mkdir("$sDestination/en");
mkdir("$sDestination/de");

if (!$bOmitDWX) {
    // dreamweaver extension
    // ==========================================================================

    if (!file_exists($sExtensionManagerPath)) fatal(__LINE__);

    system("cp -Rp webyep-dwx \"$sDestination/\"");
    chdir("$sDestination/webyep-dwx") or fatal(__LINE__);
    echo "Running babelfish";
    passthru("'$sBabelfish'", $iRet); if ($iRet != 0) fatal(__LINE__);
    echo COLOR_GREEN . "\nBabelfish proved that God doesn't exist.\n" . COLOR_END;
    echo "Removing unneeded languages from documentation...";
    chdir("$sDestination/en/webyep-dwx/Shared/WebYep/Help") or fatal(__LINE__);
    system("rm -rf deutsch", $iRet); if ($iRet != 0) fatal(__LINE__);
    chdir("$sDestination/de/webyep-dwx/Shared/WebYep/Help") or fatal(__LINE__);
    system("rm -rf english", $iRet); if ($iRet != 0) fatal(__LINE__);
    echo COLOR_GREEN . " done.\n" . COLOR_END;

    echo "----------------------------------------------------------\n";
    echo "Building english dreamweaver extension:\n";
    chdir("$sDestination/en/webyep-dwx") or fatal(__LINE__);
    echo "* creating mxi file...";
    createMXI();
    echo COLOR_GREEN . " done.\n" . COLOR_END;
    echo "* calling extension manager...";
    system("\"$sExtensionManagerPath\" -suppress -package mxi=webyep.mxi mxp=webyep.mxp >/dev/null 2>/dev/null");
    echo COLOR_GREEN . " done.\n" . COLOR_END;

    echo "----------------------------------------------------------\n";
    echo "Building german dreamweaver extension:\n";
    chdir("$sDestination/de/webyep-dwx") or fatal(__LINE__);
    echo "* creating mxi file...";
    createMXI();
    echo COLOR_GREEN . " done.\n" . COLOR_END;
    echo "* calling extension manager...";
    system("\"$sExtensionManagerPath\" -suppress -package mxi=webyep.mxi mxp=webyep.mxp  >/dev/null 2>/dev/null");
    echo COLOR_GREEN . " done.\n" . COLOR_END;

} // if (!$bOmitDWX)


// webyep-system folder
// ==========================================================================
chdir($sourceRootDir);
system("cp -Rp webyep-system \"$sDestination/\"");
chdir("$sDestination") or fatal(__LINE__);

echo "----------------------------------------------------------\n";
echo "Creating \"opt\" folder...";
mkdir("webyep-system/programm/opt");
echo COLOR_GREEN . " done.\n" . COLOR_END;

echo "Copying german version...";
system("cp -R -p webyep-system de/", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;
echo "Copying english version...";
system("cp -R -p webyep-system en/", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;
chdir("$sDestination/en/webyep-system") or fatal(__LINE__);
echo "Setting up english version...";
rename("programm", "program") or fatal(__LINE__);
rename("daten", "data") or fatal(__LINE__);
rename("konfiguration.php", "config-inc.php") or fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;

// Dreamweaver packages
// ==========================================================================
if (!$bOmitDWX) {
    echo "----------------------------------------------------------\n";
    echo "Creating german Dreamweaver package...";
    chdir("$sDestination/de") or fatal(__LINE__);
    $sRelFolder = "WebYep_Dreamweaver_Edition_$sRelease";
    mkdir($sRelFolder) or fatal(__LINE__);
    copy("$sourceRootDir/release-building/LiesMich_DW.html", "$sRelFolder/LiesMich.html") or fatal(__LINE__);
    copy("$sourceRootDir/release-building/WebYep Lizenzbedingungen.html", "$sRelFolder/WebYep Lizenzbedingungen.html") or fatal(__LINE__);
    system("cp -R -p webyep-system $sRelFolder/webyep-system", $iRet); if ($iRet != 0) fatal(__LINE__);
    rename("webyep-dwx/webyep.mxp", "$sRelFolder/webyep.mxp") or fatal(__LINE__);
    passthru("$sZIP -r$V {$sRelFolder}_de.zip $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("rm -r -f $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
    echo COLOR_GREEN . " done.\n" . COLOR_END;

    echo "----------------------------------------------------------\n";
    echo "Creating english Dreamweaver package...";
    chdir("$sDestination/en") or fatal(__LINE__);
    $sRelFolder = "WebYep_Dreamweaver_Edition_$sRelease";
    mkdir($sRelFolder) or fatal(__LINE__);
    copy("$sourceRootDir/release-building/ReadMe_DW.html", "$sRelFolder/ReadMe.html") or fatal(__LINE__);
    copy("$sourceRootDir/release-building/WebYep License Agreement.html", "$sRelFolder/WebYep License Agreement.html") or fatal(__LINE__);
    system("cp -R -p webyep-system $sRelFolder/webyep-system", $iRet); if ($iRet != 0) fatal(__LINE__);
    rename("webyep-dwx/webyep.mxp", "$sRelFolder/webyep.mxp") or fatal(__LINE__);
    passthru("$sZIP -r$V {$sRelFolder}_en.zip $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("rm -r -f $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
    echo COLOR_GREEN . " done.\n" . COLOR_END;

}

// RapidWeaver packages
// ==========================================================================
if (!$bOmitRWP) {
    $sWorkDMG = "rw_work.dmg";
    $sReleaseDMG = "WebYep_RapidWeaver_Edition_{$sRelease}_en.dmg";
    $sVolume = "/Volumes/WebYep RapidWeaver Edition";
    $sRWPluginBuildSubPath = "Builds/Release/WebYep.rwplugin";

    echo "==========================================================\n";
    echo "Updating RapidWeaver plugin source:\n";
    chdir("$sourceRootDir/webyep-rwx") or fatal(__LINE__);
    echo "* cleaning RapidWeaver plugin...";
    $sRet = shell_exec("xcodebuild -configuration Release clean");
    if (strpos($sRet, "** CLEAN SUCCEEDED **") === false) {
        echo $sRet;
        fatal(__LINE__);
    }
    echo COLOR_GREEN . " done.\n" . COLOR_END;
    echo "* building RapidWeaver plugin...";
    $sRet = shell_exec("xcodebuild -configuration Release build");
    if (strpos($sRet, "** BUILD SUCCEEDED **") === false) {
        echo $sRet;
        fatal(__LINE__);
    }
    echo COLOR_GREEN . " done.\n" . COLOR_END;


    @system("$sHdiutil detach '$sVolume' >/dev/null 2>/dev/null"); // just for sure...

    echo "----------------------------------------------------------\n";
    echo "Creating english RapidWeaver package" . ($bVerbose ? ":\n" : '...');
    chdir("$sDestination/en") or fatal(__LINE__);
    system("gzip -dc '$sourceRootDir/release-building/RapidWeaver_Template_en.dmg' > '$sWorkDMG'");
    system("$sHdiutil attach $sWorkDMG$Q", $iRet); if ($iRet != 0) fatal(__LINE__);

    system("cp -p '$sourceRootDir/release-building/ReadMe_RW.html' '$sVolume/ReadMe.html'", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("cp -R -p '$sourceRootDir/webyep-rwx/$sRWPluginBuildSubPath' '$sVolume'", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("cp -R -p webyep-system '$sVolume'", $iRet); if ($iRet != 0) fatal(__LINE__);
    replaceTextInFile("$sVolume/webyep-system/config-inc.php", array('$webyep_sCharset = "";' => '$webyep_sCharset = "utf-8";'));
    // copy the webloc file with system since it is a resource fork!
    system("cp -p '$sourceRootDir/release-building/WebYep Documentation.html' '$sVolume/WebYep Documentation.html'", $iRet); if ($iRet != 0) fatal(__LINE__);
    copy("$sourceRootDir/release-building/WebYep License Agreement.html", "$sVolume/WebYep License Agreement.html") or fatal(__LINE__);

    system("$sHdiutil detach '$sVolume'$Q", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("$sHdiutil convert $sWorkDMG$Q -format UDZO -o '$sReleaseDMG' ", $iRet); if ($iRet != 0) fatal(__LINE__);
    unlink($sWorkDMG);
    system("rm -rf '$sourceRootDir/webyep-rwx/Build'");
    echo ($bVerbose) ? '' : COLOR_GREEN . " done\n" . COLOR_END;


    $sReleaseDMG = "WebYep_RapidWeaver_Edition_{$sRelease}_de.dmg";

    echo "----------------------------------------------------------\n";
    echo "Creating german RapidWeaver package" . ($bVerbose ? ":\n" : '...');
    chdir("$sDestination/de") or fatal(__LINE__);
    system("gzip -dc '$sourceRootDir/release-building/RapidWeaver_Template_de.dmg' > '$sWorkDMG'");
    system("$sHdiutil attach $sWorkDMG$Q", $iRet); if ($iRet != 0) fatal(__LINE__);

    system("cp -p '$sourceRootDir/release-building/LiesMich_RW.html' '$sVolume/LiesMich.html'", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("cp -R -p '$sourceRootDir/webyep-rwx/$sRWPluginBuildSubPath' '$sVolume'", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("cp -R -p webyep-system '$sVolume'", $iRet); if ($iRet != 0) fatal(__LINE__);
    replaceTextInFile("$sVolume/webyep-system/konfiguration.php", array('$webyep_sCharset = "";' => '$webyep_sCharset = "utf-8";'));
    // copy the webloc file with system since it is a resource fork!
    system("cp -p '$sourceRootDir/release-building/WebYep Dokumentation.html' '$sVolume/WebYep Dokumentation.html'", $iRet); if ($iRet != 0) fatal(__LINE__);
    copy("$sourceRootDir/release-building/WebYep Lizenzbedingungen.html", "$sVolume/WebYep Lizenzbedingungen.html") or fatal(__LINE__);

    system("$sHdiutil detach '$sVolume'$Q", $iRet); if ($iRet != 0) fatal(__LINE__);
    system("$sHdiutil convert $sWorkDMG$Q -format UDZO -o '$sReleaseDMG' ", $iRet); if ($iRet != 0) fatal(__LINE__);
    unlink($sWorkDMG);
    echo ($bVerbose) ? '' : COLOR_GREEN . " done\n" . COLOR_END;
}

// Documentation packages
// ==========================================================================
echo "==========================================================\n";
echo "Creating documentation packages:\n";
echo "* english...";
chdir("$sDestination/en") or fatal(__LINE__);
$sDocuFolder = "WebYep_Documentation_$sRelease";
system("cp -R -p ../webyep-dwx/Shared/WebYep/Help/english $sDocuFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
passthru("$sZIP -r$V {$sDocuFolder}_en.zip $sDocuFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;

echo "* german...";
chdir("$sDestination/de") or fatal(__LINE__);
$sDocuFolder = "WebYep_Dokumentation_$sRelease";
system("cp -R -p ../webyep-dwx/Shared/WebYep/Help/deutsch $sDocuFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
passthru("$sZIP -r$V {$sDocuFolder}_de.zip $sDocuFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;

// Plain packages
// ==========================================================================
echo "==========================================================\n";
echo "Creating german Plain package...";
chdir("$sDestination/de") or fatal(__LINE__);
$sRelFolder = "WebYep_$sRelease";
mkdir($sRelFolder) or fatal(__LINE__);
copy("$sourceRootDir/release-building/LiesMich_Plain.html", "$sRelFolder/LiesMich.html") or fatal(__LINE__);
copy("$sourceRootDir/release-building/WebYep Lizenzbedingungen.html", "$sRelFolder/WebYep Lizenzbedingungen.html") or fatal(__LINE__);
system("cp -R -p webyep-system $sRelFolder/webyep-system", $iRet); if ($iRet != 0) fatal(__LINE__);
system("cp -R -p WebYep_Dokumentation_$sRelease $sRelFolder/WebYep_Dokumentation_$sRelease", $iRet); if ($iRet != 0) fatal(__LINE__);
passthru("$sZIP -r$V WebYep_Plain_{$sRelease}_de.zip $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
system("rm -r -f $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;

echo "Creating english Plain package...";
chdir("$sDestination/en") or fatal(__LINE__);
$sRelFolder = "WebYep_$sRelease";
mkdir($sRelFolder) or fatal(__LINE__);
copy("$sourceRootDir/release-building/ReadMe_Plain.html", "$sRelFolder/ReadMe.html") or fatal(__LINE__);
copy("$sourceRootDir/release-building/WebYep License Agreement.html", "$sRelFolder/WebYep License Agreement.html") or fatal(__LINE__);
system("cp -R -p webyep-system $sRelFolder/webyep-system", $iRet); if ($iRet != 0) fatal(__LINE__);
system("cp -R -p WebYep_Documentation_$sRelease $sRelFolder/WebYep_Documentation_$sRelease", $iRet); if ($iRet != 0) fatal(__LINE__);
passthru("$sZIP -r$V WebYep_Plain_{$sRelease}_en.zip $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
system("rm -r -f $sRelFolder", $iRet); if ($iRet != 0) fatal(__LINE__);
echo COLOR_GREEN . " done.\n" . COLOR_END;
echo "----------------------------------------------------------\n";
echo COLOR_GREEN . "Finished.\n\n" . COLOR_END;

echo "Cleaning up...";
chdir("$sDestination");
system ("rm -rf webyep-system webyep-dwx */webyep-system */webyep-dwx */WebYep_Dokumentation_$sRelease */WebYep_Documentation_$sRelease");
echo COLOR_GREEN . " done.\n" . COLOR_END;

system("open '$sDestination'");

?>