<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

define("WY_POPWIN_TYPE_FULL", 0);
define("WY_POPWIN_TYPE_PLAIN", 1);

class WYPopupWindowLink extends WYHTMLTag
{
	// instance variables
	// private
	
	// class methods
	
	function sOpenWindowCode($oURL, $sName, $iW, $iH, $iType)
	// with double quotes and no trailing ";"
	{
		$sAtts = "";
		$sJS = "";

		switch ($iType) {
			case WY_POPWIN_TYPE_PLAIN:
				$sAtts = "toolbar=no,location=no,status=yes,menubar=no,scrollbars=yes,resizable=yes";
			break;
			default:
				$sAtts = "toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes";
		}
		$sAtts .= ",width=$iW,height=$iH";
		$sJS = 'window.open("' . $oURL->sURL() . '", "' . $sName . '", "' . $sAtts . '")';
		return $sJS;
	}

	
	// instance methods
	function WYPopupWindowLink($oURL, $sName, $iW, $iH, $iType)
	{
		global $goApp;
		$sJS = "";

		parent::WYHTMLTag("a");
		$this->bSingular = false;

		$this->dAttributes["href"] = $oURL->sEURL();
		$sJS = WYPopupWindowLink::sOpenWindowCode($oURL, $sName, $iW, $iH, $iType);
		$sJS .= "; return false;";
		$this->dAttributes["onclick"] = webyep_sHTMLEntities($sJS);
	}	
	
	function setToolTip($s)
	{
		$this->setAttribute("title", $s);
	}
}
?>