<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
//session_start(); 

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYLink.php");

define("WY_LOOP_VERSION", 1);
define("WY_DK_LOOPIDARRAY", "CONTENT");
define("WY_DK_DISABLEDLOOPIDARRAY", "DISABLED_IDs");
define("WY_QV_LOOP_ADD", "LOOP_ADD");
define("WY_QV_LOOP_REMOVE", "LOOP_REMOVE");
define("WY_QV_LOOP_UP", "LOOP_UP");
define("WY_QV_LOOP_DOWN", "LOOP_DOWN");
define("WY_QV_LOOP_ENABLE", "LOOP_ENABLE");
define("WY_QV_LOOP_DISABLE", "LOOP_DISABLE");
define("WY_QK_LOOP_ID", "WEBYEP_LOOP_ID");
define("WY_QK_LOOP_ADD_ABOVE", "WEBYEP_LOOP_ADD_ABOVE");

$webyep_oCurrentLoop = od_nil;

class WYLoopElement extends WYElement
{
	var $iLoopID;
	var $iElementsLeft;
	var $iLoopIDJustDeleted;
	var $iEditedID;
	// class functions
	function aLoopIDs($sN)
	{
		global $webyep_oCurrentLoop;

		$webyep_oCurrentLoop = new WYLoopElement($sN);
		//print_r($webyep_oCurrentLoop->_aLoopIDs());
		//die("test");
		return $webyep_oCurrentLoop->_aLoopIDs();
		
	}

	function iCurrentLoopID()
	{
          global $webyep_oCurrentLoop;
         //
           if(!empty($webyep_oCurrentLoop)){
         $a=$webyep_oCurrentLoop->iLoopID;
      	}
         //print_r($a);
         //echo 'hello'; 
          //$webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
         //unset($_SESSION["loopid"]);
	   if ( $webyep_oCurrentLoop != od_nil &&  $webyep_oCurrentLoop->iElementsLeft > 0) return $webyep_oCurrentLoop->iLoopID;
	   else return 0;
	}

	function setCurrentLoopID($i)
	// used by WYDocument to 'simulate" loop ID for editors
	{

		global $webyep_oCurrentLoop;

		// as we store the loopID in an instance, we need an instance...
		if (!$webyep_oCurrentLoop) $webyep_oCurrentLoop = new WYLoopElement("");
		$webyep_oCurrentLoop->iLoopID = $i;
	}

	function setupHead()
	{
		global $webyep_sHeadHTML, $goApp;

		if ($goApp->bEditMode) {
			$sHTML = <<<EOT
<script type="text/javascript">
	function webyep_loopAddBlockAboveBelow(oLink)
	{
		if (event.shiftKey || event.altKey) {
			var sHref = oLink.href;
		   var iPos = sHref.lastIndexOf("#");
		   if (iPos == -1) iPos = sHref.length;
			oLink.href = sHref.substr(0, iPos) + "&XXX=1" + sHref.substr(iPos);
		}
	}
</script>
EOT;
			$sHTML = str_replace("XXX", WY_QK_LOOP_ADD_ABOVE, $sHTML);
			$webyep_sHeadHTML .= $sHTML;
		}
	}

	// instance functions
	//function WYLoopElement($sN)
	function __construct($sN='')
	{
		global $goApp;
		 
		parent::__construct($sN, false);
		$this->sEditorPageName = "";
		$this->setVersion(WY_LOOP_VERSION);
		if (!isset($this->dContent[WY_DK_LOOPIDARRAY])) $this->dContent[WY_DK_LOOPIDARRAY] = array(1);
		else if (!count($this->dContent[WY_DK_LOOPIDARRAY])) $this->dContent[WY_DK_LOOPIDARRAY] = array(1);
		if (!isset($this->dContent[WY_DK_DISABLEDLOOPIDARRAY])) $this->dContent[WY_DK_DISABLEDLOOPIDARRAY] = array();
		$this->iLoopID = 0;
		$this->iEditedID = false;
		$this->iLoopIDJustDeleted = 0;
		
		if ($goApp->bEditMode && $this->bUserMayEditThisElement()) $this->dispatchEditAction();
		$this->iElementsLeft = count($this->_aLoopIDs());
	}

	function bUseLoopID()
	{
		return false;
	}

	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "lo-" . $s;
		return $s;
	}

   function _aLoopIDs()
	{
		global $goApp;

		if ($goApp->bEditMode){
		 return $this->dContent[WY_DK_LOOPIDARRAY];
		}else {
			$a = $this->dContent[WY_DK_LOOPIDARRAY];
			$aDis = $this->_aDisabledLoopIDs();
			return array_diff($a, $aDis);
		}
	}

	function _setLoopIDs($a)
	{
		$this->dContent[WY_DK_LOOPIDARRAY] = $a;
	}

	function _aDisabledLoopIDs()
	{
		return $this->dContent[WY_DK_DISABLEDLOOPIDARRAY];
	}

	function _setDisabledLoopIDs($a)
	{
		$this->dContent[WY_DK_DISABLEDLOOPIDARRAY] = $a;
	}

	/*function loopStart($bShowControls = true,$ids)
	{
		
		global $goApp;

		if ($bShowControls) 

			$this->iLoopID=$ids;
		$this->showEditButtons($ids);
		$goApp->outputWarningPanels(); // give App a chance to say something
	}*/
	
	function loopStart($bShowControls = true,$ids=null)
	{
		global $goApp;
		
		if ($bShowControls){$this->iLoopID=$ids; $this->showEditButtons($ids);} 
		$goApp->outputWarningPanels(); // give App a chance to say something
	}

   function iDeletedLoopInstance()
   {
      return $this->iLoopIDJustDeleted;
   }

	function bIDIsDisabled($iID)
	{
		$a = $this->_aDisabledLoopIDs();
		return in_array($iID, $a);
	}

	function disableLoopID($iID)
	{
		$a = $this->_aDisabledLoopIDs();
		if (!in_array($iID, $a)) $a[] = $iID;
		$this->_setDisabledLoopIDs($a);
	}

	function enableLoopID($iID)
	{
		$a = $this->_aDisabledLoopIDs();
		if (in_array($iID, $a)) array_splice($a , array_search($iID, $a), 1);
		$this->_setDisabledLoopIDs($a);
	}

   function showAnchor()
   {
	   echo "<a name=\"WEBYEP_CURRENT_LOOP_ITEM\"></a>";
   }

	function showEditButtons($id)
	{
		global $goApp, $webyep_bShowDisabledEditButtons, $webyep_bOtherLoginsMayEditGlobalData;
		//echo $this->iCurrentLoopID();
		if ($goApp->bEditMode) {
			//print_r($this);
			if ($this->iEditedID == $this->iLoopID) $this->showAnchor();

			if ($this->bUserMayEditThisElement()) {
				$oURL = od_clone(WYURL::oCurrentURL());
				unset($oURL->dQuery[WY_QK_LOOP_ADD_ABOVE]);
				$oLink = od_nil;
				$oImg = od_nil;
				$oImgURL = od_clone($goApp->oImageURL);
				$dEditQuery = WYEditor::dQueryForElement($this);
				$aLoopIDs = $this->_aLoopIDs();
				$iCount = count($aLoopIDs);

				$dEditQuery[WY_QK_LOOP_ID] = $this->iCurrentLoopID();
				$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_ADD);
				$oURL->setQuery(array_merge($oURL->dQuery, $dEditQuery));
				$oURL->sAnchor = "WEBYEP_CURRENT_LOOP_ITEM";
				$oLink = new WYLink($oURL, WYTS("LoopAddButton"));
				$oImgURL->addComponent("add-button.png");
				$oImg = new WYImage($oImgURL);
				$oImg->setAttribute("style", "border: none");
				$oImg->setAttribute("alt", WYTS("LoopAddButton"));
				$oLink->setInnerHTML($oImg->sDisplay());
				$oLink->setAttribute("class", "WebYepLoopAddButton");
				$oLink->setAttribute("onclick", "webyep_loopAddBlockAboveBelow(this); return true;");
				echo $oLink->sDisplay();
				if ($iCount > 1) {
					$dEditQuery = $oURL->dQuery;

					$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_REMOVE);
					$oURL->setQuery($dEditQuery);
					$oLink = new WYLink($oURL, WYTS("LoopRemoveButton"));
					$oImgURL->removeLastComponent();
					$oImgURL->addComponent("loop-remove-button.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("style", "border: none");
					$oImg->setAttribute("alt", WYTS("LoopRemoveButton"));
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("onclick", "return confirm(\"" . WYTS("LoopRemoveConfirm") . "\");");
					$oLink->setAttribute("class", "WebYepLoopRemoveButton");
					echo $oLink->sDisplay();

					$oLink->removeAttribute("onclick");

					$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_UP);
					$oURL->setQuery($dEditQuery);
					$oLink = new WYLink($oURL, WYTS("LoopUpButton"));
					$oImgURL->removeLastComponent();
					$oImgURL->addComponent("up-button.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("style", "border: none");
					$oImg->setAttribute("alt", WYTS("LoopUpButton"));
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("class", "WebYepLoopUpButton");
					echo $oLink->sDisplay();

					$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_DOWN);
					$oURL->setQuery($dEditQuery);
					$oLink = new WYLink($oURL, WYTS("LoopDownButton"));
					$oImgURL->removeLastComponent();
					$oImgURL->addComponent("down-button.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("style", "border: none");
					$oImg->setAttribute("alt", WYTS("LoopDownButton"));
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("class", "WebYepLoopDownButton");
					echo $oLink->sDisplay();
				}

				if ($this->bIDIsDisabled($this->iCurrentLoopID())) {
					$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_ENABLE);
					$oURL->setQuery($dEditQuery);
					$oLink = new WYLink($oURL, WYTS("LoopEnableButton"));
					$oImgURL->removeLastComponent();
					$oImgURL->addComponent("enable-button.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("style", "border: none");
					$oImg->setAttribute("alt", WYTS("LoopEnableButton"));
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("class", "WebYepLoopEnabledButton");
					echo $oLink->sDisplay();
				}
				else {
					$goApp->setActionInQuery($dEditQuery, WY_QV_LOOP_DISABLE);
					$oURL->setQuery($dEditQuery);
					$oLink = new WYLink($oURL, WYTS("LoopDisableButton"));
					$oImgURL->removeLastComponent();
					$oImgURL->addComponent("disable-button.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("style", "border: none");
					$oImg->setAttribute("alt", WYTS("LoopDisableButton"));
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("class", "WebYepLoopEnabledButton");
					echo $oLink->sDisplay();
				}
			}
			else { // editing now allowed
				if ($webyep_bShowDisabledEditButtons) {
					$sToolTip = sprintf(WYTS("insufficientPermissions"), $this->sName);
					$oImgURL = od_clone($goApp->oImageURL);
					$oImgURL->addComponent("loop-buttons-disabled.png");
					$oImg = new WYImage($oImgURL);
					$oImg->setAttribute("border", 0);
					$oImg->setAttribute("alt", $sToolTip);
					$oLink = new WYLink(new WYURL("javascript:void(0);"), $sToolTip);
					$oLink->setInnerHTML($oImg->sDisplay());
					$oLink->setAttribute("class", $this->sEditButtonCSSClass);
					echo $oLink->sDisplay();
				}
			}
		}
	}

	function loopEnd()
	{
		global $webyep_oCurrentLoop;

		$this->iElementsLeft--;
		if ($this->iElementsLeft <= 0) $webyep_oCurrentLoop = od_nil;
	}

	function dispatchEditAction()
	{
		global $goApp;
		
		$sAction = $goApp->sCurrentAction();
		$sFieldName = $goApp->sFormFieldValue(WY_QK_EDITOR_FIELDNAME, "");
		$iLoopID = (int)$goApp->sFormFieldValue(WY_QK_LOOP_ID,0);
		$aLoopIDs = $this->_aLoopIDs();
		$iCount = count($aLoopIDs);
		$iNewID = 0;
		$iPos = 0;
		$bChanged = false;

		if ($sFieldName != $this->sName) return;

		if ($sAction == WY_QV_LOOP_ADD) {
			if ($iCount) {
				$iNewID = max($aLoopIDs) + 1;
				$this->iEditedID = $iNewID;
				$this->iEditedID;
				$iPos = array_search($iLoopID, $aLoopIDs);
				if ($iPos !== false) { // should be in there, but who knows...
					$iOffset = $goApp->sFormFieldValue(WY_QK_LOOP_ADD_ABOVE) ? 0:1;
					$iPos += $iOffset;
					if ($iPos < 0) $iPos = 0;
					if ($iPos >= $iCount) $aLoopIDs[] = $iNewID;
					else webyep_array_insert($aLoopIDs, $iPos, $iNewID);
				}
				else $aLoopIDs[] = $iNewID;
			}
			else $aLoopIDs = array(1);
			$this->enableLoopID($iNewID);
			$bChanged = true;
		}
		else if ($sAction == WY_QV_LOOP_REMOVE) {
			
			if ($iCount > 1) {
				$iPos = array_search($iLoopID, $aLoopIDs);
				if ($iPos !== false) {
					array_splice($aLoopIDs, $iPos, 1);
					$this->enableLoopID($iLoopID);
				}
				if (isset($aLoopIDs[$iPos])) $this->iEditedID = $aLoopIDs[$iPos];
				else if (isset($aLoopIDs[$iPos-1])) $this->iEditedID = $aLoopIDs[$iPos-1];
				$bChanged = true;
			}
         $this->iLoopIDJustDeleted = $iLoopID;
		}
		else if ($sAction == WY_QV_LOOP_UP) {
         $this->iEditedID = $iLoopID;
			$iPos = array_search($iLoopID, $aLoopIDs);
			if ($iCount > 1 && $iPos !== false && $iPos > 0) {
				array_splice($aLoopIDs, $iPos, 1);
				webyep_array_insert($aLoopIDs, $iPos - 1, $iLoopID);
				$bChanged = true;
			}
		}
		else if ($sAction == WY_QV_LOOP_DOWN) {
         $this->iEditedID = $iLoopID;
			$iPos = array_search($iLoopID, $aLoopIDs);
			if ($iCount > 1 && $iPos !== false && $iPos < ($iCount - 1)) {
				array_splice($aLoopIDs, $iPos, 1);
				webyep_array_insert($aLoopIDs, $iPos + 1, $iLoopID);
				$bChanged = true;
			}
		}
		else if ($sAction == WY_QV_LOOP_DISABLE) {
         $this->iEditedID = $iLoopID;
			$this->disableLoopID($iLoopID);
			$bChanged = true;
		}
		else if ($sAction == WY_QV_LOOP_ENABLE) {
         $this->iEditedID = $iLoopID;
			$this->enableLoopID($iLoopID);
			$bChanged = true;
		}
		if ($bChanged) {
			$this->_setLoopIDs($aLoopIDs); 
			$this->save();
		}
	}

	function sDisplay()
	{
		return "";
	}
}
?>
