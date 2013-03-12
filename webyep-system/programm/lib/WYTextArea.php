<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYTextArea extends WYHTMLTag
{
	// instance variables
	// private
	var $sText;
	
	// instance methods
	function WYTextArea($sN, $sDefault = "")
	{
		global $goApp;
		$sV = $goApp->sFormFieldValue($sN, $sDefault);

		parent::WYHTMLTag("textarea");
		$this->bSingular = false;
		$this->dAttributes["wrap"] = "virtual";
		$this->dAttributes["name"] = $sN;
		$this->setText($sV);
	}
	
	function setText($s)
	{
		$this->sText = $s;
		$this->sInnerHTML = $s; // might become different from $this->sText in the future
	}
	
	function sText()
	{
		return $this->sText;
	}
	
	function setWidth($i)
	{
		global $goApp;
		$f = 0.0;

		if ($goApp->bIsMac) $f = $goApp->bIsNavigator ? ($i * 1.0) : ($i * 1.1);
		else $f = $goApp->bIsNavigator ? ($i * 1.0) : ($i * 1.0);
		$i = round($f);
		$this->dAttributes["cols"] = $i;
	}
	
	function setHeight($i)
	{
		global $goApp;
		$f = 0.0;

		if ($goApp->bIsMac) $f = $goApp->bIsNavigator ? ($i * 1.15) : ($i * 1.15);
		else $f = $goApp->bIsNavigator ? ($i * 0.9) : ($i * 1.0);
		$i = round($f);
		$this->dAttributes["rows"] = $i;
	}
}
?>