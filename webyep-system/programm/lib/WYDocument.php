<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFile.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYLoopElement.php");

define("WY_QK_DI", "DOC_INST"); // query key for document instance
define("WY_QK_OLD_DI", "WEBYEP_DI"); // old (pre 1.4.6) query key for document instance
define("WYDOC_DOCFILE", "documents");

$webyep_iLoopID = 0;
if (!isset($webyep_iDILIOffset)) $webyep_iDILIOffset = 0;

class WYDocument
{
	// public
	var $oDocPath;
	// private
	var $iPageID;
	var $iDocumentInstance;

	function WYDocument($oU)
	{
		global $goApp, $webyep_sLiveDemoSlotID;

		$oU->makeSiteRelative();
		$this->oDocPath = new WYPath($oU->sURL(false, false, false));
		if ($webyep_sLiveDemoSlotID) $this->oDocPath->removeDemoSlotID();
		$this->iPageID = 0;
		$iDI = (int)$goApp->sFormFieldValue(WY_QK_DI);
		if (!$iDI) $iDI = (int)$goApp->sFormFieldValue(WY_QK_OLD_DI);
		$this->iDocumentInstance = $iDI;
	}

	function oPathForDocumentWithID($iID)
	{
		$oReturn = od_nil;
		$oP = WYDocument::oDocumentsFilePath();
		$oF = new WYFile($oP);
		if ($oF->bExists()) {
			$aLines = $oF->aContentLines();
		}
		foreach ($aLines as $sLine) {
			$dEntry = WYDocument::dParseDocumentsFileLine($sLine);
			if ($dEntry['id'] == $iID) {
				$oReturn = new WYPath($dEntry['path']);
			}
		}
		return $oReturn;
	}

	function setPageID($i)
	{
		$this->iPageID = $i;
	}
	
	function setDocumentInstance($i)
	{
		$this->iDocumentInstance = $i;
	}

	function setLoopID($i)
	{
		WYLoopElement::setCurrentLoopID($i);
	}

	function dParseDocumentsFileLine($sLine)
	{
		$dReturn = array('path' => "", 'id' => 0);
		$sLine = trim($sLine);
		if ($sLine) {
			$iPos = strlen($sLine) - 1;
			while ($iPos && $sLine[$iPos] != "\t" && $sLine[$iPos] != " ") $iPos--;
			if ($iPos == 0) continue;
			$dReturn['path'] = substr($sLine, 0, $iPos);
			$dReturn['id'] = (int)substr($sLine, $iPos+1);
		}
		return $dReturn;
	}

	function oDocumentsFilePath()
	{
		global $goApp, $webyep_sLiveDemoSlotID;

		$oP = od_clone($goApp->oDataPath);
		if ($webyep_sLiveDemoSlotID) $oP->removeDemoSlotID();
		$oP->addComponent(WYDOC_DOCFILE);
		return $oP;
	}

	function iPageIDForDocumentPath($oP, &$iMaxID)
	{
		$aLines = array();
		$sFileContent = "";
		$sDocPath = "";
		$iDocID = 0;
		$iPos = 0;
		$sLine = "";
		$iID = 0;
		$oDocFilePath = od_clone($this->oDocumentsFilePath());
		$oF = new WYFile($oDocFilePath);

		$iMaxID = 0;

		if ($oF->bExists()) {
			$aLines = $oF->aContentLines();
		}
		foreach ($aLines as $sLine) {
			$dEntry = $this->dParseDocumentsFileLine($sLine);
			if ($dEntry['id']) {
				$sDocPath = $dEntry['path'];
				$iDocID = $dEntry['id'];
				$iMaxID = max($iMaxID, $iDocID);
				if ($sDocPath == $oP->sPath) {
					$iID = $iDocID;
					break;
				}
			}
		}
		return $iID;
	}

	function iAddPageIDForDocumentPath($oP, $iNewID)
	{
		global $goApp;

		$oF = new WYFile($this->oDocumentsFilePath());
		$sFileContent = "\r\n" . $oP->sPath . "\t" . $iNewID;
		if (!$oF->bAppend($sFileContent)) {
			$sFileContent = $oF->sContent() . $sFileContent;
			$oF->setContent($sFileContent);
			if (!$oF->bWrite()) {
				$goApp->log("could not store new page iD " . $iNewID);
				$iNewID = 0;
			}
		}
		@$oF->chmod(0644);
		return $iNewID;
	}

	function iPageID($bCreate)
	{
		global $goApp, $webyep_bDocumentPage;

		if (!$this->iPageID && $webyep_bDocumentPage) {
			$iMaxID = 0;
			$oP = $this->oDocPath;
			$this->iPageID = $this->iPageIDForDocumentPath($oP, $iMaxID); // gets also $iMaxID
			if (!$this->iPageID && $bCreate) {
				$this->iPageID = $this->iAddPageIDForDocumentPath($oP, $iMaxID + 1);
			}
		}
		return $this->iPageID;
	}
	
	function iDocumentInstance()
	{
		return $this->iDocumentInstance;
	}
	
	function iLoopID()
	{
		return WYLoopElement::iCurrentLoopID();
	}

   function iDocumentInstanceForLoopID($iLoopID)
   {
      global $webyep_iDILIOffset;

      if (!$webyep_iDILIOffset) $webyep_iDILIOffset = $this->iDocumentInstance() * 100;
      return $iLoopID + $webyep_iDILIOffset;
   }

}
?>