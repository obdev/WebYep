<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYTextField extends WYHTMLTag
{
	// instance variables
	// private
	
	// instance methods
	function WYTextField($sN)
	{
		global $goApp;

		parent::WYHTMLTag("input");
      $this->sQuote = '"';
		$this->dAttributes["type"] = "text";
		$this->dAttributes["name"] = $sN;
		$this->setValue($goApp->sFormFieldValue($sN));
	}
	
	function setValue($s)
	{
		$this->dAttributes["value"] = $s;
	}
	
	function sValue()
	{
		return $this->dAttributes["value"];
	}
	
	function setWidth($i)
	{
		global $goApp;
		$f = 0.0;

		if ($goApp->bIsMac) $f = $goApp->bIsNavigator ? ($i * 1.15) : ($i * 1.2);
		else $f = $goApp->bIsNavigator ? ($i * 0.9) : ($i * 1.0);
		$i = round($f);
		$this->dAttributes["size"] = $i;
	}
	
	function makePasswordField()
	{
		$this->dAttributes["type"] = "password";
	}
}
?>