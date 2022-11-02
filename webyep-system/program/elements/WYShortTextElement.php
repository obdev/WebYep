<?php
/**
 * WebYep
 * @copyright Objective Development Software GmbH
 * @link http://www.obdev.at
 */

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_SHORTTEXT_VERSION", 1);

/**
 * public API
 *
 * @param string $sFieldName Feldname des Elements
 * @param boolen $bGlobal    Inhalt für alle Elemente mit diesem Namen gleich
 * @return string            Inhalt des Elements ($this->dContent[WY_DK_CONTENT])
 */
function webyep_sShortTextContent($sFieldName, $bGlobal)
{     global $webyep_oCurrentLoop; 
	 if(!empty($webyep_oCurrentLoop)){
	$webyep_oCurrentLoop->iLoopID = $_SESSION["loopid"];
        }
	$o = new WYShortTextElement($sFieldName, $bGlobal);
//echo $sFieldName;
	return $o->sText();
}

function webyep_shortText($sFieldName, $bGlobal, $mwEditorWidth=500, $mwEditorHeight=250) {
   global $webyep_oCurrentLoop; 
	 if(!empty($webyep_oCurrentLoop)){
	$webyep_oCurrentLoop->iLoopID = $_SESSION["loopid"] ?? null;

	}
//echo "hello";
//echo $sFieldName;
	(new WYShortTextElement())->webyep_shortText($sFieldName, $bGlobal, $mwEditorWidth, $mwEditorHeight);
}

// ----------------------------------------------

class WYShortTextElement extends WYElement
{
   function webyep_shortText($sFieldName, $bGlobal, $mwEditorWidth, $mwEditorHeight)
   {
	  
      global $goApp, $webyep_sCharset;global $webyep_oCurrentLoop; 
	
      $o = new WYShortTextElement($sFieldName, $bGlobal, $mwEditorWidth, $mwEditorHeight);
      //print_r($webyep_oCurrentLoop);
//echo $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
      $s = $o->sDisplay();
      if ($goApp->bEditMode) {
         echo $o->sEditButtonHTML("edit-button-short-text.png");
         if (!$s) $s = $o->sName;
      }
      echo $s;
}

	//function WYShortTextElement($sN, $bG, $mwEditorWidth=500, $mwEditorHeight=250)
	function __construct($sN='', $bG='', $mwEditorWidth='500', $mwEditorHeight='250')
	{
		parent::__construct($sN, $bG);
		$this->sEditorPageName = "short-text.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:500;
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:250;
		$this->sEditButtonCSSClass = "WebYepShortTextEditButton";
		$this->setVersion(WY_SHORTTEXT_VERSION);
		if (!isset($this->dContent[WY_DK_CONTENT])) $this->dContent[WY_DK_CONTENT] = "";
	}
	
	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "st-" . $s;
		return $s;
	}
	
	function sText()
	{
		return $this->dContent[WY_DK_CONTENT];
	}
	
	function setText($s)
	{
		$this->dContent[WY_DK_CONTENT] = $s;
	}

	function sDisplay()
	{
		$s = "";
		
		if (isset($this->dContent[WY_DK_CONTENT])) {
			$s = webyep_sHTMLEntities($this->dContent[WY_DK_CONTENT]);
		}
		return $s;
	}
}
?>
