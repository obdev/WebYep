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

function webyep_audio($sFieldName, $sLinkContent, $mwEditorWidth=650, $mwEditorHeight = 250, $mwPlayerWidth=380, $mwPlayerHeight = 150)
{
	global $goApp;
	global $webyep_oCurrentLoop; 

	if(!empty($webyep_oCurrentLoop)){
		   $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];	
	} 

	$o = new WYAudioElement($sFieldName, $sLinkContent, $mwEditorWidth, $mwEditorHeight); 
	$s = $o->sDisplay($mwPlayerWidth, $mwPlayerHeight);
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

	//function WYAudioElement($sN, $sL, $mwEditorWidth, $mwEditorHeight)
	function __construct($sN='', $sL='', $mwEditorWidth='', $mwEditorHeight='')
	{
      global $goApp;
	global $webyep_oCurrentLoop; 
	  if(!empty($webyep_oCurrentLoop)){

		  $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];	
	} 

		//parent::WYAttachmentElement($sN);
		
		parent::__construct($sN);
		
		$this->sEditorPageName = "audio.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:650; 
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:250;
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
	
	function sDisplay($mwPlayerWidth="Null", $mwPlayerHeight="Null")
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
		 
		 $mwPlayerWidthf = ($mwPlayerWidth)?$mwPlayerWidth:380;
		 $mwPlayerHeightf = ($mwPlayerHeight)?$mwPlayerHeight:150;		 
         $oLink = new WYPopupWindowLink($oURL, "WebYepAudioPlayer", $mwPlayerWidthf, $mwPlayerHeightf, WY_POPWIN_TYPE_PLAIN);
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
