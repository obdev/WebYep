<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_LOGONBUTTON_VERSION", 1);

function webyep_logonButton($bVisible)
{
	global $goApp;
	$s = "";

	$o = new WYLogonButtonElement($bVisible);
	$s = $o->sDisplay();
	echo $s;
}

class WYLogonButtonElement extends WYElement
{
	var $bVisible;

	//function WYLogonButtonElement($bV)
	function __construct($bV='')
	{
		parent::__construct("logon-button", true);
		$this->sEditorPageName = "";
		$this->setVersion(WY_LOGONBUTTON_VERSION);
		$this->bVisible = $bV;
	}
	
	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "lb-" . $s;
		return $s;
	}
	
	function sDisplay()
	{
		
		global $goApp, $webyep_sProductName, $webyep_sModalWindowType, $webyep_sHeadHTML;
		
		$s = "";
		$oImg = od_nil;
		$oLink = od_nil;
		$oImgURL = od_clone($goApp->oImageURL);
		$oPageURL = od_clone((new WYURL())->oCurrentURL());
		$oNoticeURL = od_clone($goApp->oProgramURL);
		unset($oPageURL->dQuery[WY_QK_LOGOUT]);
		
		$oNoticeURL->addComponent(WYTS("LogonURL")); 
		if (!$goApp->bEditMode) {
			if ($this->bVisible) {
				$oImgURL->addComponent("logon-button.png");
				$oImg = new WYImage($oImgURL);
			}
			else {
				$oImgURL->addComponent("nix.gif");
				$oImg = new WYImage($oImgURL);
				$oImg->setAttribute("width", 16);
				$oImg->setAttribute("height", 16);
			}
			$oImg->setAttribute("style", "border: none; width:12px; height:16px");
			$oImg->setAttribute("alt", WYTS("WebYepLogon"));
			$oLink = new WYLink($oNoticeURL);
			if ($goApp->bValidUser()) {
				$oPageURL->dQuery[WY_QK_EDITMODE] = "yes" . mt_rand(1000, 9999);
				$oLink->setAttribute("onclick", "document.location=\"" . $oPageURL->sEURL() . "\"; return false;");
			}
			else {
				if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous'){
					$oLink->setAttribute("id", "WebYepLogon");
					$oLink->setAttribute("onclick", webyep_sHTMLEntities($goApp->sAuthWindowMW()) . "; return false;");
				}else{
					$oLink->setAttribute("onclick", webyep_sHTMLEntities($goApp->sAuthWindowJS()) . "; return false;");
				}
			}
			$oLink->setInnerHTML($oImg->sDisplay());
         	$sToolTip = WYTS("LogonButton");
         	$sToolTip = str_replace("WebYep", $webyep_sProductName, $sToolTip);
			$oLink->setToolTip($sToolTip);
			$s = $oLink->sDisplay();
		}
		else {
			$oImgURL->addComponent("logoff-button.png");
			$oImg = new WYImage($oImgURL);
			$oImg->setAttribute("style", "border: none; width:18px; height:16px");
			$oImg->setAttribute("alt", WYTS("LogoffButton"));
			$oPageURL->dQuery[WY_QK_EDITMODE] = "no" . mt_rand(1000, 9999);
			$oLink = new WYLink($oPageURL);
			$oLink->setAttribute("id", "WebYepLogon");
			$oLink->setInnerHTML($oImg->sDisplay());
			$oLink->setToolTip(WYTS("LogoffButton"));

			$oLink->setAttribute("onclick", "if (event.shiftKey || event.altKey) this.href += \"&" . WY_QK_LOGOUT . "=1\"; return true;");

			$s = $oLink->sDisplay();
		}
		return $s;
	}
}
?>
