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
{
	$o = new WYShortTextElement($sFieldName, $bGlobal);
	return $o->sText();
}

function webyep_shortText($sFieldName, $bGlobal) {
    WYShortTextElement::webyep_shortText($sFieldName, $bGlobal);
}

// ----------------------------------------------

class WYShortTextElement extends WYElement
{
   function webyep_shortText($sFieldName, $bGlobal)
   {
      global $goApp, $webyep_sCharset;

      $o = new WYShortTextElement($sFieldName, $bGlobal);
      $s = $o->sDisplay();
      if ($goApp->bEditMode) {
         echo $o->sEditButtonHTML("edit-button-short-text.gif");
         if (!$s) $s = $o->sName;
      }
      echo $s;
   }

	function WYShortTextElement($sN, $bG)
	{
		parent::WYElement($sN, $bG);
		$this->sEditorPageName = "short-text.php";
		$this->iEditorWidth = 450;
		$this->iEditorHeight = 250;
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