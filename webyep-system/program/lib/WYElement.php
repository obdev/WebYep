<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYLanguage.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFile.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYImage.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPopupWindowLink.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

define("WY_DK_VERSION", "VERSION");
define("WY_DK_CONTENT", "CONTENT");

global $WYElement_sFieldNameCallback;
$WYElement_sFieldNameCallback = "";

global $WYElement_aDataFileListCache;
$WYElement_aDataFileListCache = false;

class WYElement
{
	// public
	var $sName;
	var $bGlobal;
	var $dContent;
	// private
	var $sEditorPageName;
	var $iEditorWidth;
	var $iEditorHeight;
	var $dEditorQuery; // additional infos passed to editor
	var $bDemoContent;
	var $sEditButtonCSSClass;

	// class methods

	function aDataFileNames()
	{
		global $goApp;
		global $WYElement_aDataFileListCache;

		if (!$WYElement_aDataFileListCache) {
			$WYElement_aDataFileListCache = array();

			$oDP = $goApp->oDataPath;
			$r = opendir($oDP->sPath);
			while ($r && ($sFN = readdir($r)) !== false) {
				if (is_dir($oDP->sPath . "/$sFN")) continue;
				if (preg_match('|^[0-9]+-|', $sFN) || preg_match('|^[a-z]{2}-|', $sFN)) $WYElement_aDataFileListCache[] = $sFN;
			}
			closedir($r);
		}
		return $WYElement_aDataFileListCache;
	}

	function removeDataFileWithName($sFN)
	{
		global $goApp;
		$oP = od_clone($goApp->oDataPath);
		$oP->addComponent($sFN);
		$oF = new WYFile($oP);
		if (!$oF->bDelete()) $goApp->log("Could not remove data file " . $oP->sPath);
	}

	function sDataFileNamePrefix($iDocID, $iDocInstance, $iLoopID)
	{
		$s = $iDocID;
		if ($iDocInstance) $s .= "-$iDocInstance";
		if ($iLoopID) $s .= "-$iLoopID";
		return $s;
	}

	// instance methods

	//function WYElement($sN, $bG)
	function __construct($sN='', $bG='')
	{
		$this->bDemoContent = false;
		$this->sName = $sN;
		$this->bGlobal = $bG;
		$this->sEditorPageName = "";
		$this->iEditorWidth = 100;
		$this->iEditorHeight = 100;
		$this->dEditorQuery = array();
		$this->dContent = array();
		$this->sEditButtonCSSClass = "WebYepEditButton";
		$this->setVersion(1);
		$this->_loadContent();
		// supclasses should call parents initializer first
		// then check version and if nec. convert contents
		// then set new version number


	}

   function setFieldNameCallback($sF)
   {
	   global $WYElement_sFieldNameCallback;

	   $WYElement_sFieldNameCallback = $sF;
   }

	function setVersion($i)
	{
		$this->dContent[WY_DK_VERSION] = $i;
	}
	
	function iVersion()
	{
		return $this->dContent[WY_DK_VERSION];
	}

	function bUseDocumentInstance()
	{
		return true;
	}

	function bUseLoopID()
	{
		return true;
	}

	function sFieldNameForFile() {
        global $WYElement_sFieldNameCallback;
        if ($WYElement_sFieldNameCallback) {
            $sName = $WYElement_sFieldNameCallback($this->sName);
        } else {
            $sName = $this->sName;
        }
		return (new WYPath())->sMakeFilename($sName);
	}

	function sDataFileName($bCreate) {
		global $goApp;
		$sFilename = "";
		$sPrefix = "";
		$iPageID = 0;
		$i = 0;

		$sFilename = $this->sFieldNameForFile();
		if (!$this->bGlobal) {
            $iPageID = $goApp->oDocument->iPageID($bCreate);
            if ($iPageID) {
                if ($this->bUseDocumentInstance())
                    $iDocInstance = $goApp->oDocument->iDocumentInstance();
                else
                    $iDocInstance = 0;


                if ($this->bUseLoopID())
                    $iLoopID = $goApp->oDocument->iLoopID();


                else
                    $iLoopID = 0;


                $sPrefix = WYElement::sDataFileNamePrefix($iPageID, $iDocInstance, $iLoopID);
                $sFilename = $sPrefix . "-" . $sFilename;
            } else {
                $sFilename = "";
            }
		}

        if ($sFilename) {
            $oP = new WYPath($sFilename);
            if (!$oP->bCheck(WYPATH_CHECK_NOPATH)) $sFilename = "";
        }
		return $sFilename;
	}

	function &oDataFilePath($bCreate, $bLiveDemoFallback) {
		global $goApp, $webyep_sLiveDemoSlotID;
		$sFilename = $this->sDataFileName($bCreate);
		$oP = od_nil;

        if ($sFilename) {
            $oP = od_clone($goApp->oDataPath);
			$oP->addComponent($sFilename);
        }
        if ($bLiveDemoFallback && $oP && $webyep_sLiveDemoSlotID && !$oP->bExists()) {
            $oP->removeDemoSlotID();
            $this->bDemoContent = true;
        }
		return $oP;
	}

    function deleteContent() {
        $this->dContent = array();
    }

	function _loadContent() {
        global $goApp, $webyep_oCurrentLoop, $webyep_sLiveDemoSlotID;
		$oP = od_nil;
		$oF = od_nil;
        $iDelLoopID = 0;
//print_r($webyep_oCurrentLoop);
        if ($this->bUseLoopID() && $webyep_oCurrentLoop != od_nil && ($iDelLoopID = $webyep_oCurrentLoop->iDeletedLoopInstance()) != 0) {
            $iCurrentLoopID = $goApp->oDocument->iLoopID();
            $goApp->oDocument->setLoopID($iDelLoopID);
            $oP =& $this->oDataFilePath($goApp->bEditMode, false);
            if ($oP && $oP->bExists()) {
                $oF = new WYFile($oP);
                $this->dContent = unserialize($oF->sContent());
                $this->deleteContent();
                // $this->save();
                $oF->bDelete();
            }
            $goApp->oDocument->setLoopID($iCurrentLoopID);
        }

		$oP =& $this->oDataFilePath($goApp->bEditMode, true);
		if ($oP && $oP->bExists()) {
			$oF = new WYFile($oP);
            $this->dContent = unserialize($oF->sContent());
		} else {
            $this->dContent = array();
        }
	}
	
	function save()	{
		global $goApp;

		$oP =& $this->oDataFilePath(true, false);
		$oF = new WYFile($oP);
		$oF->setContent(serialize($this->dContent));
		if (!$oF->bWrite()) {
			$goApp->log("could not write element data to " . $oP->sPath);
			$goApp->setDataAccessProblem(true);
		}
		@$oF->chmod(0644);
	}
	
    function getSizeCookieNames(&$sW, &$sH) {
        return (new WYEditor())->getSizeCookieNames($this->sEditorPageName, $sW, $sH);
    }
   
	function bUserMayEditThisElement() {
		global $goApp, $webyep_bOtherLoginsMayEditGlobalData;
		return $goApp->bEditPermission && (!$this->bGlobal || $webyep_bOtherLoginsMayEditGlobalData || $goApp->bMainUser());
	}

	function sEditButtonHTML($sButtonImage = "edit-button.gif", $sToolTip = "", $oCustomEditURL = false) {
		global $goApp, $webyep_bShowDisabledEditButtons, $webyep_bOtherLoginsMayEditGlobalData;
		$oImgURL = od_nil;
		$oImg = od_nil;
		$oEditorURL = od_nil;
		$oNeedJSURL = od_nil;
		$dQuery = array();
        $iEW = $iEH = 0;
        $sWCookie = $sHCookie = "";
        $bUsesCustomURL = false;

		if ($this->bUserMayEditThisElement()) {
            if (!$sToolTip) $sToolTip = sprintf(WYTS("editTheField"), $this->sName);
			$oImgURL = od_clone($goApp->oImageURL);
			$oImgURL->addComponent($sButtonImage);
			$oImg = new WYImage($oImgURL);
			$oImg->setAttribute("border", 0);
			$oImg->setAttribute("alt", $sToolTip);
			if ($oCustomEditURL === false || $oCustomEditURL === od_nil) {
				$oEditorURL = od_clone($goApp->oProgramURL);
				$oEditorURL->addComponent("editors/" . $this->sEditorPageName);
				$dQuery = array_merge( (new WYEditor())->dQueryForElement($this), $this->dEditorQuery);
				$oEditorURL->setQuery($dQuery);
			} else {
				$oEditorURL = $oCustomEditURL;
				$bUsesCustomURL = true;
			}
            $this->getSizeCookieNames($sWCookie, $sHCookie);
            if (isset($_COOKIE[$sWCookie])) {
                $iEW = (int)$_COOKIE[$sWCookie];
                $iEH = (int)$_COOKIE[$sHCookie];
                WYEditor::tranformSizeForOperation($iEW, $iEH, WY_EDITOR_OPEN);
            } else {
                $iEW = $this->iEditorWidth;
                $iEH = $this->iEditorHeight;
            }
            if ($bUsesCustomURL) {
				$oLink = new WYLink($oEditorURL, $sToolTip);
				$oLink->setInnerHTML($oImg->sDisplay());
				$oLink->setAttribute("class", $this->sEditButtonCSSClass);
				return $oLink->sDisplay();
            } else {
				$oWin = new WYPopupWindowLink($oEditorURL, "WebYepEditor" . mt_rand(1000, 9999), $iEW, $iEH, WY_POPWIN_TYPE_PLAIN);
				$oNeedJSURL = od_clone($goApp->oProgramURL);
				$oNeedJSURL->addComponent(WYTS("LogonURL"));
				$oWin->setAttribute("href", $oNeedJSURL->sEURL()); // special href: JS warning
				$oWin->setInnerHTML($oImg->sDisplay());
				$oWin->setToolTip($sToolTip);
				$oWin->setAttribute("class", $this->sEditButtonCSSClass);
				return $oWin->sDisplay();
			}
        } else {
			if ($webyep_bShowDisabledEditButtons) {
                $sToolTip = sprintf(WYTS("insufficientPermissions"), $this->sName);
				$oImgURL = od_clone($goApp->oImageURL);
				$oImgURL->addComponent("edit-button-disabled.gif");
				$oImg = new WYImage($oImgURL);
				$oImg->setAttribute("border", 0);
				$oImg->setAttribute("alt", $sToolTip);
				$oLink = new WYLink(new WYURL("javascript:void(0);"), $sToolTip);
				$oLink->setInnerHTML($oImg->sDisplay());
				$oLink->setAttribute("class", $this->sEditButtonCSSClass);
				return $oLink->sDisplay();
            }
			else return "";
        }
	}
	
	function sDisplay() {
		return "";
	}
}
?>
