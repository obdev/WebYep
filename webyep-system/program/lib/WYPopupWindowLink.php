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
	
	function iCurrentLoopID()
	{
		global $webyep_oCurrentLoop;
	
		if ($webyep_oCurrentLoop != od_nil && $webyep_oCurrentLoop->iElementsLeft > 0) return $_SESSION["loopid"];
		else return 0;
	}

	// instance methods
	//function WYPopupWindowLink($oURL, $sName, $iW, $iH, $iType) 

	function __construct($oURL='', $sName='', $iW='', $iH='', $iType='')
	{
		global $goApp;
		static $i = 0; 
		global $webyep_sModalWindowType;
		$sJS = "";
		parent::__construct("a");
		$this->bSingular = false;

		$this->dAttributes["href"] = $oURL->sEURL();

		//if(!empty($webyep_oCurrentLoop)){ echo "yes";
		$loopid= $_SESSION["loopid"];
		//}else { $loopid=0; print_r($webyep_oCurrentLoop);}

		$url=$oURL->sURL();$WEBYEP_LOOP_ID="0";
		//$WEBYEP_LOOP_ID=$loopid;
		if(isset($_REQUEST["WEBYEP_LOOP_ID"])){ $WEBYEP_LOOP_ID=$_REQUEST["WEBYEP_LOOP_ID"]; }
		$url=str_replace('WEBYEP_LOOP_ID='.$WEBYEP_LOOP_ID,'WEBYEP_LOOP_ID='.$loopid,$url); 

		if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous'){

			$sJS = "javascript:WYPopupWindowLinkMW('".$url."', '".$sName."', '".$iW."', '".$iH."')"; 
			
		}else{
			$oURL->dQuery['WEBYEP_LOOP_ID']=$loopid;
			$sJS = WYPopupWindowLink::sOpenWindowCode($oURL, $sName, $iW, $iH, $iType);  
		}	
		
		
		$sJS .= "; return false;";
		$this->dAttributes["onclick"] = webyep_sHTMLEntities($sJS);
$i++;

	}	
	
	function setToolTip($s)
	{
		$this->setAttribute("title", $s);
	}
}
?>
