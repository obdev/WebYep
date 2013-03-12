<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYLink extends WYHTMLTag
{
	// instance variables
	// private
	
	// class methods
	
	// instance methods
	function WYLink($oURL, $sTT = "", $bAbsolute = false)
	{
		global $goApp;

		parent::WYHTMLTag("a");
		$this->bSingular = false;

		$this->dAttributes["href"] = $oURL->sEURL(true, true, $bAbsolute);
		if ($sTT) $this->setToolTip($sTT);
	}	
	
	function setToolTip($s)
	{
		$this->setAttribute("title", $s);
	}
}
?>