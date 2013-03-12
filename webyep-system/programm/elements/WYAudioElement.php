<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPopupWindowLink.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYAttachmentElement.php");

define("WY_AUDIO_VERSION", 1);
define("WY_DK_AUDIO_FILENAME", WY_DK_ATTACHMENT_FILENAME);
define("WY_QK_AUDIO_FILENAME", "FILENAME");
define("WY_QK_AUDIO_ORG_FILENAME", "ORG_FILENAME");

function webyep_audio($sFieldName, $sLinkContent)
{
	global $goApp;

	$o = new WYAudioElement($sFieldName, $sLinkContent);
	$s = $o->sDisplay();
	if ($goApp->bEditMode) {
		echo $o->sEditButtonHTML();
		if (!$s) $s = $o->sName;
	}
	echo $s;
}

class WYAudioElement extends WYAttachmentElement
{
	// instance variables
   var $sLinkContent;

	function WYAudioElement($sN, $sL)
	{
      global $goApp;

		parent::WYAttachmentElement($sN);
		$this->sEditorPageName = "audio.php";
		$this->iEditorWidth = 650;
		$this->iEditorHeight = 250;
		$this->sEditButtonCSSClass = "WebYepAudioEditButton";
		$this->setVersion(WY_AUDIO_VERSION);
      $this->sLinkContent = $sL;
      
      if ($this->sOriginalFilename()) {
	      $oP = new WYPath($this->sOriginalFilename());
	      if (!$oP->bCheck(WYPATH_CHECK_JUSTAUDIO|WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
		      $goApp->log("missuse of audio element, filename: " . $oP->sPath);
		      exit(0);
	      }
	      unset($oP);
	      $oP = new WYPath($this->sDownloadFileName());
	      if (!$oP->bCheck(WYPATH_CHECK_JUSTAUDIO|WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
		      $goApp->log("missuse of audio element, filename: " . $oP->sPath);
		      exit(0);
	      }
      }
	}
	
	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "au-" . $s;
		return $s;
	}
	
	function sDisplay()
	{
		global $goApp;
		$sHTML = "";
      $sFN = $this->sDownloadFileName();
      $oURL = $oLink = od_nil;

      if ($sFN) {
         $oURL = od_clone($goApp->oProgramURL);
         $oURL->addComponent("mp3-player.php");
         $oURL->dQuery[WY_QK_AUDIO_FILENAME] = $sFN;
         $oURL->dQuery[WY_QK_AUDIO_ORG_FILENAME] = $this->sOriginalFilename();
         $oLink = new WYPopupWindowLink($oURL, "WebYepAudioPlayer", 380, 150, WY_POPWIN_TYPE_PLAIN);
         $oLink->setToolTip(WYTS("AudioPlayHint"));
         $oDownloadURL = od_clone($goApp->oProgramURL);
         $oDownloadURL->addComponent("download.php");
         $oDownloadURL->dQuery[WY_QK_DOWNLOAD_FILENAME] = $sFN;
         $oDownloadURL->dQuery[WY_QK_ORIGINAL_FILENAME] = $this->sOriginalFilename();
         $oLink->setAttribute("href", $oDownloadURL->sEURL());
         $sL = $this->sLinkContent;
         if ($sL == "") $sL = webyep_sHTMLEntities($this->sOriginalFilename());
         $oLink->setInnerHTML($sL);
         $sHTML .= $oLink->sDisplay();
      }

		return $sHTML;
	}
}
?>