<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");


define("WY_RICHTEXT_VERSION", 1);
define("WY_QK_RICH_TEXT_CSS", "CSS_URL");

// public API

function webyep_sRichTextContent($sFieldName, $bGlobal)
{

	$o = new WYRichTextElement($sFieldName, $bGlobal, false); print_r($o);
	return $o->sText();
}
/**
* @param $mwEditorWidth
* @param $mwEditorHeight
*/
function webyep_richText($sFieldName, $bGlobal, $mwEditorWidth=850, $mwEditorHeight=620, $sCSSURL = "", $bObfuscate = true) {
	global $webyep_oCurrentLoop; 
	 if(!empty($webyep_oCurrentLoop)){
	$webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"]?? null;

	}
	(new WYRichTextElement())->webyep_richText($sFieldName, $bGlobal, $sCSSURL, $bObfuscate, $mwEditorWidth, $mwEditorHeight);

}

// ----------------------------------------------

class WYRichTextElement extends WYElement
{
   // instance variables
   var $oCSSURL;
   var $bObfuscate;

   function webyep_richText($sFieldName, $bGlobal, $mwEditorWidth, $mwEditorHeight, $sCSSURL, $bObfuscate = true)
   {
      global $goApp; //print_r($goApp);
      $o = new WYRichTextElement($sFieldName, $bGlobal, $sCSSURL, $bObfuscate, $mwEditorWidth, $mwEditorHeight);
//print_r($o);
      $s = $o->sDisplay();
      if ($goApp->bEditMode) {
         echo $o->sEditButtonHTML("edit-button-rich-text.png"); 
         if (!$s) $s = $o->sName;
      }
      echo $s;
   }

	//function WYRichTextElement($sN, $bG, $sCSSURL="", $bObfuscate=true, $mwEditorWidth=800, $mwEditorHeight=600)
	function __construct($sN='', $bG='', $sCSSURL='', $bObfuscate='true', $mwEditorWidth='800', $mwEditorHeight='600')
	{

		parent::__construct($sN, $bG);
		$this->sEditorPageName = "rich-text.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:800;
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:600;
		$this->sEditButtonCSSClass = "WebYepRichTextEditButton";
		if($sCSSURL) {
			$this->oCSSURL = new WYURL(); 
			$this->oCSSURL->makeSiteRelative();
		}else{ $this->oCSSURL = od_nil;}
			
		 $this->bObfuscate = $bObfuscate;
		$this->setVersion(WY_RICHTEXT_VERSION);
		if (!isset($this->dContent[WY_DK_CONTENT])) { 
			// check whether a Long Text Element with same field name left some data...
			$oLT = new WYLongTextElement($sN, $bG, false);// print_r($oLT);
			if ($oLT->sText() != "")  $this->dContent[WY_DK_CONTENT] = $oLT->sDisplay();
			else  $this->dContent[WY_DK_CONTENT] = "";
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
      if(isset($_SESSION['iLoopID'])){
      $this->dEditorQuery[WY_QK_LOOP_ID]=$_SESSION['iLoopID'];
      }
      if ($this->oCSSURL) +$this->dEditorQuery[WY_QK_RICH_TEXT_CSS] = $this->oCSSURL->sURL();
      else $this->dEditorQuery[WY_QK_RICH_TEXT_CSS] = "";
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
