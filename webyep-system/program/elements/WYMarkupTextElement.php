<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_MARKUPTEXT_VERSION", 1);
define("WY_QK_MARKUP_TEXT_CSS", "CSS_URL");

// public API

function webyep_sMarkupTextContent($sFieldName, $bGlobal)
{
	$o = new WYMarkupTextElement($sFieldName, $bGlobal, false);
	return $o->sText();
}
/**
* @param $mwEditorWidth
* @param $mwEditorHeight
*/
function webyep_markupText($sFieldName, $bGlobal, $sCSSURL = "", $bObfuscate = true, $mwEditorWidth=850, $mwEditorHeight=550) {
	global $webyep_oCurrentLoop; static $j=0;
		$loopArr=$webyep_oCurrentLoop->dContent['CONTENT'];
		$loopVal=floor($j/1); 
		$loopid=$loopArr[$loopVal];
	 if(!empty($webyep_oCurrentLoop)){
	 $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
	}
	(new WYMarkupTextElement())->webyep_markupText($sFieldName, $bGlobal, $sCSSURL, $bObfuscate, $mwEditorWidth, $mwEditorHeight);
$j++;
}

// ----------------------------------------------

class WYMarkupTextElement extends WYElement
{
	// instance variables
   var $oCSSURL;
   var $bObfuscate;

   function webyep_markupText($sFieldName, $bGlobal, $sCSSURL = "", $bObfuscate = true, $mwEditorWidth, $mwEditorHeight)
   {
      global $goApp;

      $o = new WYMarkupTextElement($sFieldName, $bGlobal, $sCSSURL, $bObfuscate, $mwEditorWidth, $mwEditorHeight);
      $s = $o->sDisplay();
      if ($goApp->bEditMode) {
         echo $o->sEditButtonHTML("edit-button-markup-text.png");
         if (!$s) $s = $o->sName;
      }
      echo $s;
   }

	//function WYMarkupTextElement($sN, $bG, $sCSSURL="", $bObfuscate=true, $mwEditorWidth=850, $mwEditorHeight=550)
	function __construct($sN='', $bG='', $sCSSURL="", $bObfuscate=true, $mwEditorWidth=850, $mwEditorHeight=550)
	{
		parent::__construct($sN, $bG);
		$this->sEditorPageName = "markup-text.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:850;
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:550;
		$this->sEditButtonCSSClass = "WebYepMarkupTextEditButton";
		if ($sCSSURL) {
			$this->oCSSURL = new WYURL($sCSSURL);
			$this->oCSSURL->makeSiteRelative();
		}
		else $this->oCSSURL = od_nil;
		$this->bObfuscate = $bObfuscate;
		$this->setVersion(WY_MARKUPTEXT_VERSION);
		if (!isset($this->dContent[WY_DK_CONTENT])) {
			// check whether a Long Text Element with same field name left some data...
			$oLT = new WYLongTextElement($sN, $bG, false);
			if ($oLT->sText() != "") $this->dContent[WY_DK_CONTENT] = $oLT->sDisplay();
			else $this->dContent[WY_DK_CONTENT] = "";
		}
	}
	
	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "rt-" . $s;
		return $s;
	}
	
   function sEditButtonHTML($sButtonImage = "edit-button.gif", $sToolTip = "", $oCustomEditURL = false)
   {
      $this->dEditorQuery = array();
      if ($this->oCSSURL) $this->dEditorQuery[WY_QK_MARKUP_TEXT_CSS] = $this->oCSSURL->sURL();
      else $this->dEditorQuery[WY_QK_MARKUP_TEXT_CSS] = "";
	   return parent::sEditButtonHTML($sButtonImage, $sToolTip);
   }

	function sText()
	{
		return $this->dContent[WY_DK_CONTENT];
	}
	
	function setText($s)
	{
		$this->dContent[WY_DK_CONTENT] = $s;
	}

   function _sObfuscateEMailAddresses($sText)
   {
	   $sText =  preg_replace('|<a[^>]+href=[\'"]mailto:([^\'"@]+)@([^\'"]+)[\'"][^>]*>([^<@]+)</a>|U', "<script type=\"text/javascript\">\n/* <![CDATA[ */\ndocument.write('<a href=\"Mailto:\\1'+String.fromCharCode(64)+'\\2\" title=\"\\1'+String.fromCharCode(64)+'\\2\">\\3</a>');\n/* ]]> */\n</script><noscript><div style=\"display:inline\">\\1(_AT_)\\2</div></noscript>", $sText);
	   $sText =  preg_replace('|<a[^>]+href=[\'"]mailto:([^\'"@]+)@([^\'"]+)[\'"][^>]*>([^@]+)@(.+)</a>|U', "<script type=\"text/javascript\">\n/* <![CDATA[ */\ndocument.write('<a href=\"mailto:\\1'+String.fromCharCode(64)+'\\2\">\\3'+String.fromCharCode(64)+'\\4</a>');\n/* ]]> */\n</script><noscript><div style=\"display:inline\">\\1(_AT_)\\2</div></noscript>", $sText);
	   return $sText;
   }

	function sDisplay()
	{
		$sContent = "";
		$sContent = $this->dContent[WY_DK_CONTENT];
      if ($this->bObfuscate) $sContent = $this->_sObfuscateEMailAddresses($sContent);
      return $sContent;
	}
}
?>
