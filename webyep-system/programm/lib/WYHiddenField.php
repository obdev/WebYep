<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYHiddenField extends WYHTMLTag
{
	// instance variables
	// private
	
	// instance methods
	function WYHiddenField($sN, $sDefault = "")
	{
		global $goApp;
		$sV = "";

		parent::WYHTMLTag("input");
		$this->dAttributes["type"] = "hidden";
		$this->dAttributes["name"] = $sN;
		$sV = $goApp->sFormFieldValue($sN, $sDefault);
		$this->setValue($sV);
	}
	
	function setValue($s)
	{
		$this->dAttributes["value"] = $s;
	}
	
	function sValue()
	{
		return $this->dAttributes["value"];
	}
}
?>