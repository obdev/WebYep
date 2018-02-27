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
	//function WYTextField($sN)
    function __construct($sN='')
	{
		global $goApp;

		parent::__construct("input");
      		$this->sQuote = '"';
		$this->dAttributes["type"] = "text";
		$this->dAttributes["name"] = $sN;
		//$this->dAttributes["placeholder"] = "Username...";
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
	
	// added placeholder text within the passoord field
	function makePasswordField()
	{
		$this->dAttributes["placeholder"] = "Password" ; 
		$this->dAttributes["type"] = "password"; 
	}
	
	// WE need to add  placeholder text within the username field which is taken from the diffrent languages document
	// this has been copied directly from the password filed funcion but is not wired inn 
	function makeUsernameField()
	{
		$this->dAttributes["placeholder"] = "Username" ; 
		$this->dAttributes["type"] = "text"; 
	}

}
?>
