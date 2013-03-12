<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYSelectMenu extends WYHTMLTag
{
	// instance variables
	var $sSelectedKey;
	// private
	
	// instance methods
	function WYSelectMenu($sN, $dItems, $sSelKeyApp = "", $bUseEntities = true)
	{
		global $goApp;
		$sSelKeyForm = $goApp->sFormFieldValue($sN);
		$sKey = "";
		$sValue = "";

		parent::WYHTMLTag("select");
		$this->bSingular = false;
		$this->dAttributes["name"] = $sN;
		$this->sSelectedKey = $sSelKeyForm ? $sSelKeyForm:$sSelKeyApp;
		$this->aItems = array();
		$o = new WYHTMLTag("option");
		$o->setSingular(false);
		foreach ($dItems as $sKey => $sValue) {
			$o->setAttribute("value", $sKey);
			if ($sKey == $this->sSelectedKey) $o->setAttribute("selected", "");
			else $o->removeAttribute("selected");
			$o->setInnerHTML($bUseEntities ? webyep_sHTMLEntities($sValue):$sValue);
			$this->sInnerHTML .= $o->sDisplay();
		}
	}
	
	function setLines($i)
	{
		$this->setAttribute("size", $i);
	}

	function setAllowsMultiple($b)
	{
		if ($b) $this->setAttribute("multiple", "");
		else $this->removeAttribute("multiple");
	}
}
?>