<?php
/**
 * WebYep
 * @copyright Objective Development Software GmbH
 * @link http://www.obdev.at
 */

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_READMORE_VERSION", 1);

// --- public API --------------------------------

function webyep_readMore($sFieldName, $sLinkText, $sTargetPage, $sTargetFrame, $mwEditorWidth=450, $mwEditorHeight=250) {

    global $goApp, $webyep_sCharset;

	global $webyep_oCurrentLoop; 
	 if(!empty($webyep_oCurrentLoop)){
	 $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
	}

    $o = new WYReadMoreElement($sFieldName, $sLinkText, $sTargetPage, $sTargetFrame, $mwEditorWidth, $mwEditorHeight);
   
    $s = $o->sDisplay();
    echo $s;

}

// ----------------------------------------------

class WYReadMoreElement extends WYElement {
    var $sLinkText;
    var $sTargetPage;
    var $sTargetFrame;

	//function WYReadMoreElement($sN, $sL = "", $sTP = "", $sTF = "", $mwEditorWidth=450, $mwEditorHeight=250)
	function __construct($sN, $sL = "", $sTP = "", $sTF = "", $mwEditorWidth=450, $mwEditorHeight=250) {
		
		parent::__construct($sN, false);
		$this->sEditorPageName = "read-more.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:450;
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:250;
		$this->sEditButtonCSSClass = "WebYepReadMoreEditButton";
		$this->setVersion(WY_READMORE_VERSION);
        $this->sLinkText = $sL == '' ? $sN : $sL;
        $this->sTargetPage = $sTP;
        $this->sTargetFrame = $sTF;
		if (!isset($this->dContent[WY_DK_CONTENT])) $this->dContent[WY_DK_CONTENT] = "";
	}
	
	function sFieldNameForFile() {
		$s = parent::sFieldNameForFile();
		$s = "rm-" . $s;
		return $s;
	}
	
	function sText() {
		return $this->dContent[WY_DK_CONTENT];
	}
	
	function setText($s) {
		$this->dContent[WY_DK_CONTENT] = $s;
	}

	function sDisplay() {
		global $goApp;
        $s = "<!-- BEGINN WebYepReadMore -->";
        $DI = $goApp->oDocument->iDocumentInstanceForLoopID($goApp->oDocument->iLoopID());
        $DOC_INST = $DI ? '?DOC_INST=' . $DI : '';
        $TARGET = ($this->sTargetFrame ? ' target="'.$this->sTargetFrame.'"' : '');
		
        if ($goApp->bEditMode) {
            $s .= $this->sEditButtonHTML("edit-button-read-more.png");
        }
        $s .= '<a href="' . $this->sTargetPage . $DOC_INST . '" class="WebYepReadMoreLink"' . $TARGET . '>';
		if (isset($this->dContent[WY_DK_CONTENT]) && $this->dContent[WY_DK_CONTENT]) {
			$s .= webyep_sHTMLEntities($this->dContent[WY_DK_CONTENT]);
		} else {
            $s .= $this->sLinkText;
        }
        $s .= '</a>';
        $s .= "<!-- END WebYepReadMore -->\n";
		return $s;
	}
}
?>
