<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFile.php");

define("WYLANG_ENGLISH", 0);
define("WYLANG_GERMAN", 1);
define("WYLANG_SRPSKI", 2);
define("WYLANG_POLISH", 3);
define("WYLANG_PORTUGUESE", 4);
define("WYLANG_SWEDISH", 5);
define("WYLANG_DUTCH", 6);
// define("WYLANG_HUNGARIAN", 7);
define("WYLANG_FRENCH", 7);
// when adding languages here, also add them to sTinyMCELang() in editors/rich-text-tinymce.php

$webyep_iLanguageID = WYLANG_ENGLISH;
$webyep_dLanguageStrings = array();

function WYTS($s, $bOutputAsHTML = true)
{
	$s = WYLanguage::sTranslatedString($s, $bOutputAsHTML);
	return $s;
}

function WYTSD($s, $bOutputAsHTML = true)
// for performance reasons we DON'T use WYTS here
{
	$s = WYLanguage::sTranslatedString($s, $bOutputAsHTML);
	echo $s;
}

function sWYTDate($i)
{
   global $webyep_iLanguageID;

   return $webyep_iLanguageID == WYLANG_GERMAN ? date("j.n.Y", $i):date("Y-m-d", $i);
}

function sWYTTime($i)
{
   global $webyep_iLanguageID;

   return $webyep_iLanguageID == WYLANG_GERMAN ? date("H:i:s", $i):date("h:i:s a", $i);
}

class WYLanguage
{
	function setup()
	{
		global $webyep_iLanguageID, $webyep_dLanguageStrings, $webyep_sLang, $goApp;
		$oLangFile = od_nil;
		$aLines = array();
		$iLineCount = 0;
		$sLine = "";
		$sKey = "";
		$oP = od_clone($goApp->oProgramPath);

		$oP->addComponent("lstrings.dat");
		$oLangFile = new WYFile($oP);
		$aLines = $oLangFile->aContentLines();
		$iLineCount = count($aLines);
		for ($i = 0; $i < $iLineCount; $i++)
		{
			$sLine = $aLines[$i];
         if (substr(trim($sLine), 0, 2) == "/*") continue;
			if (!$sKey && $sLine) {
				$sKey = $sLine;
			}
			else if ($sLine) $webyep_dLanguageStrings[$sKey][] = $sLine;
			else $sKey = "";
		}

      $webyep_sLang = strtolower($webyep_sLang);
      if ($webyep_sLang == "" || $webyep_sLang == "auto") {
         // tetermine language: for now by looking at the spelling of the program folder
         if (strstr(WYApplication::sScriptPath(__FILE__), "/programm/lib/WYLanguage")) $webyep_iLanguageID = WYLANG_GERMAN;
         else if (strstr(WYApplication::sScriptPath(__FILE__), "/program/lib/WYLanguage")) $webyep_iLanguageID = WYLANG_ENGLISH;
         else $goApp->fatalError("Could not tetermine language");
      }
      else if ($webyep_sLang == "srpski") {
         $webyep_iLanguageID = WYLANG_SRPSKI;
      }
      else if ($webyep_sLang == "polski") {
         $webyep_iLanguageID = WYLANG_POLISH;
      }
      else if ($webyep_sLang == "swedish") {
         $webyep_iLanguageID = WYLANG_SWEDISH;
      }
      else if ($webyep_sLang == "portuguese") {
         $webyep_iLanguageID = WYLANG_PORTUGUESE;
      }
      else if ($webyep_sLang == "swedish") {
         $webyep_iLanguageID = WYLANG_SWEDISH;
      }
      else if ($webyep_sLang == "dutch") {
         $webyep_iLanguageID = WYLANG_DUTCH;
      }
//      else if ($webyep_sLang == "hungarian") {
//         $webyep_iLanguageID = WYLANG_HUNGARIAN;
//      }
      else if ($webyep_sLang == "french") {
         $webyep_iLanguageID = WYLANG_FRENCH;
      }

		if (isset($GLOBALS["webyep_iForcedLanguageID"])) {
			$webyep_iLanguageID = $GLOBALS["webyep_iForcedLanguageID"];
			$goApp->log("forced language ID to: $webyep_iLanguageID");
		}
	}

   function sUtf8ToNumericUnicodeEntity($sUtf8)
   {
      $sEncoded = "";
      $iLen = strlen($sUtf8);
      $iRemaining = 0;
      $iUnicode = 0;
      for ($i = 0; $i < $iLen; $i++) {
         $iC = ord($sUtf8[$i]);
         if ($iC < 0x80) { // single byte char
            $sEncoded .= chr($iC);
         }
         else if ($iC < 0xC0) { // continuation byte
            $iUnicode <<= 6;
            $iUnicode |= $iC & 0x3F;
            if (--$iRemaining == 0) {
               $sEncoded .= sprintf("&#x%04X;", $iUnicode);
               $iUnicode = 0;
            }
         }
         else if ($iC < 0xE0) { // start of 2 byte char
            $iRemaining = 1;
            $iUnicode = $iC & 0x1F;
         }
         else { // start of 3 byte char
            $iRemaining = 2;
            $iUnicode = $iC & 0x1F;
         }
      }
      return $sEncoded;
   }

   function sUtf8ToOctalUnicodeEscape($sUtf8)
   {
      $sEncoded = "";
      $iLen = strlen($sUtf8);
      $iRemaining = 0;
      $iUnicode = 0;
      for ($i = 0; $i < $iLen; $i++) {
         $iC = ord($sUtf8[$i]);
         if ($iC < 0x80) { // single byte char
            $sEncoded .= chr($iC);
         }
         else if ($iC < 0xC0) { // continuation byte
            $iUnicode <<= 6;
            $iUnicode |= $iC & 0x3F;
            if (--$iRemaining == 0) {
               $sEncoded .= sprintf("\\%d", decoct($iUnicode));
               $iUnicode = 0;
            }
         }
         else if ($iC < 0xE0) { // start of 2 byte char
            $iRemaining = 1;
            $iUnicode = $iC & 0x1F;
         }
         else { // start of 3 byte char
            $iRemaining = 2;
            $iUnicode = $iC & 0x1F;
         }
      }
      return $sEncoded;
   }

	function sTranslatedString($s, $bOutputAsHTML = true)
	{
		global $webyep_iLanguageID, $webyep_dLanguageStrings, $goApp;

		if (isset($webyep_dLanguageStrings[$s]) && isset($webyep_dLanguageStrings[$s][$webyep_iLanguageID]))
			$sT = $webyep_dLanguageStrings[$s][$webyep_iLanguageID];
		else {
			$goApp->log("no translation for: $s");
			$sT = $s;
		}
		return $bOutputAsHTML ? (WYLanguage::sUtf8ToNumericUnicodeEntity($sT)):(WYLanguage::sUtf8ToOctalUnicodeEscape($sT));
	}	

   function sDayName($i) // 0 = sunday
   {
      global $webyep_iLanguageID;

      $s = "";
      switch ($i) {
         case 0: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Sonntag":"Sunday"; break;
         case 1: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Montag":"Monday"; break;
         case 2: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Dienstag":"Tuesday"; break;
         case 3: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Mittwoch":"Wednesday"; break;
         case 4: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Donnerstag":"Thursday"; break;
         case 5: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Freitag":"Friday"; break;
         case 6: $s = $webyep_iLanguageID == WYLANG_GERMAN ? "Samstag":"Saturday"; break;
      }
      return $s;
   }
}

?>