<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYDocument.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYLoopElement.php");

define("WY_QK_EDITOR_SAVE", "WEBYEP_EDIT_SAVE");
define("WY_QK_PAGEID", "WEBYEP_PAGEID");
define("WY_QK_EDITOR_FIELDNAME", "WEBYEP_FIELDNAME");
define("WY_QK_EDITOR_GLOBAL", "WEBYEP_GLOBAL");
define("WY_EDITOR_RESIZE", 1);
define("WY_EDITOR_OPEN", 2);

class WYEditor
{
	// public
	var $sFieldName;
	var $bGlobal;
	var $bSave;
	// private

	// class methods

	static function dQueryForElement(&$oElement)
	{
		global $goApp;
		$d = array();

		$d[WY_QK_EDITOR_FIELDNAME] = $oElement->sName;
		$d[WY_QK_EDITOR_GLOBAL] = (int)$oElement->bGlobal;
		$d[WY_QK_PAGEID] = $goApp->oDocument->iPageID(true);
		$d[WY_QK_DI] = $goApp->oDocument->iDocumentInstance();
		$d[WY_QK_LOOP_ID] = $goApp->oDocument->iLoopID();

		//echo "<pre>";
		//print_r($d);
		return $d;
	}

	static function sHiddenFieldsForElement(&$oElement)
	{
		// key: "WEBYEP_FIELDNAME" with value "Activity Photo's" results in:
        // <input type='hidden' name='WEBYEP_FIELDNAME' value='Activity Photo' s'="">
        $s = "";
		$d = (new WYEditor())->dQueryForElement($oElement);
		//echo $_SESSION["loopid"]; echo "AA";
		//$d["WEBYEP_LOOP_ID"]=2;
		//print_r($d);
		foreach ($d as $sKey => $sValue) {
			$s .= '<input type="hidden" name="'.$sKey.'" value="'.$sValue.'">';
		}
		$s .= "<input type='hidden' name='" . WY_QK_ACTION . "' value='" . WY_QK_EDITOR_SAVE . "'>";
		return $s;
	}

	static function sPostSaveScript($bKeepEditor = false)
	{

		global $webyep_bDebug, $goApp, $webyep_sModalWindowType;
		$s = "";

		if ($goApp->bIsiPhone) {
			$s .= "<script>\n";
			$s .= "   window.opener.location.reload(true);\n";
			if(!$bKeepEditor) {
				$s .= "   window.close();\n";
			}
			$s .= "</script>";
		}else {
			$s .= "<script>\n";

			if(!$bKeepEditor) {
				if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous'){
					$s .= "   window.parent.location.reload(true);\n";
					$s .= "   window.setTimeout('window.wySMLink.hide();', 1000);\n";
				}else{
					$s .= "   window.opener.location.reload(true);\n";
					$s .= "   window.opener.focus();\n";
					$s .= "   window.setTimeout('window.close();', 1000);\n";
				}
			}
			else {
				$s .= "   window.opener.location.reload(true);\n";
				$s .= "   window.focus();\n";
			}
			$s .= "</script>";
		}
		return $webyep_bDebug ? "":$s;
	}

   function getSizeCookieNames($sIdent, &$sW, &$sH)
   {
      $sIdent = str_replace(".", "_", $sIdent);
      $sIdent = str_replace("-", "_", $sIdent);
      $sW = $sIdent . "_w";
      $sH = $sIdent . "_h";
   }

   // these stupid browser use different sizes for:
   // window.open
   // window.resizerTo and
   // window.outWidth/document.body.clientWidth
  static function tranformSizeForOperation(&$iW, &$iH, $iOP)
   {
      global $goApp;

      if ($goApp->bIsExplorer) {
         if ($iOP == WY_EDITOR_OPEN) {
            $iW -= 12;
            $iH -= 61;
         }
      }
      else if ($goApp->bIsSafari) {
         if ($iOP == WY_EDITOR_OPEN) {
            $iH -= 22;
         }
      }
      else {
         if ($iOP == WY_EDITOR_OPEN) {
            $iH -= 15;
         }
      }
   }

	function oEditedPagesPath()
	{
		global $goApp, $webyep_bOtherLoginsMayEditGlobalData;
		$oPath = od_nil;

		if ((int)$goApp->sFormFieldValue(WY_QK_EDITOR_GLOBAL) == 0 || $webyep_bOtherLoginsMayEditGlobalData || $goApp->bMainUser()) {
			$iPageID = (int)$goApp->sFormFieldValue(WY_QK_PAGEID);
			if ($iPageID) $oPath = (new WYDocument())->oPathForDocumentWithID($iPageID);
		}
		return od_clone($oPath);
	}

	// instance methods
	function __construct()
	//function __construct()
	{
		global $goApp;

		if (!$goApp->bEditMode) {
			$goApp->log("Editor " . basename($_SERVER['PHP_SELF']) . " called in non edit mode");
			exit();
		}
		if (!$goApp->bEditPermission) {
			$goApp->log("Editor " . $_SERVER['PHP_SELF'] . " called without edit permission");
			include("permissions-error.php"); // assuming that this gets executed in an editor page
			exit();
		}
		$this->sFieldName = $goApp->sFormFieldValue(WY_QK_EDITOR_FIELDNAME);
		$this->bGlobal = !((int)$goApp->sFormFieldValue(WY_QK_EDITOR_GLOBAL) == 0);
		$this->bSave = false;

		if ($goApp->sFormFieldValue(WY_QK_ACTION,false,'post') == WY_QK_EDITOR_SAVE) $this->bSave = true;
		// set info in Document object so othes see the right values
		$goApp->oDocument->setPageID((int)$goApp->sFormFieldValue(WY_QK_PAGEID));
		$iDI = (int)$goApp->sFormFieldValue(WY_QK_DI);
		if (!$iDI) $iDI = (int)$goApp->sFormFieldValue(WY_QK_OLD_DI);
		$goApp->oDocument->setDocumentInstance($iDI);
		$goApp->oDocument->setLoopID((int)$goApp->sFormFieldValue(WY_QK_LOOP_ID));
	}



}
?>
