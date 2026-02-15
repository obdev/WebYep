<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");

if (!defined('WY_ATTACHMENT_VERSION')) {
    define("WY_ATTACHMENT_VERSION", 1);
}
if (!defined('WY_DK_ATTACHMENT_FILENAME')) {
    define("WY_DK_ATTACHMENT_FILENAME", "FILENAME");
}
if (!defined('WY_QK_DOWNLOAD_FILENAME')) {
    define("WY_QK_DOWNLOAD_FILENAME", "FILENAME");
}
if (!defined('WY_QK_ORIGINAL_FILENAME')) {
    define("WY_QK_ORIGINAL_FILENAME", "ORG_FILENAME");
}
if (!defined('WY_ATTACHMENT_CSS_ICON')) {
    define("WY_ATTACHMENT_CSS_ICON", "WebYepAudioIcon");
}


function webyep_audio($sFieldName, $bGlobal = false, $sCustomIcon = "", $mwEditorWidth=650, $mwEditorHeight=250)
{
	global $goApp;

	global $webyep_oCurrentLoop; 
	 if(!empty($webyep_oCurrentLoop)){
	 $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
	}

	$o = new WYAudioElement($sFieldName, $bGlobal, $sCustomIcon, $mwEditorWidth, $mwEditorHeight);
	$s = $o->sDisplay();
	if ($goApp->bEditMode) {
		echo $o->sEditButtonHTML("edit-button-audio.png", "", $goApp->bIsiPhone ? $o->oIPhoneEditURL():od_nil);
		if (!$s) $s = $o->sName;
	}
	echo $s;

}

class WYAudioElement extends WYElement
{
	// instance variables
	var $sCustomIcon;

	//function WYAudioElement($sN, $bG = false, $sCustomIcon = "", $mwEditorWidth=650, $mwEditorHeight=250)
	function __construct($sN='', $bG = 'false', $sCustomIcon = "", $mwEditorWidth='650', $mwEditorHeight='250')
	{
		parent::__construct($sN, $bG);
		$this->sEditorPageName = "audio.php";
		$this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:650;
		$this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:250;
		$this->sCustomIcon = $sCustomIcon;
		$this->sEditButtonCSSClass = "WebYepAudioEditButton";
		$this->setVersion(WY_ATTACHMENT_VERSION);
		if (!isset($this->dContent[WY_DK_ATTACHMENT_FILENAME])) $this->dContent[WY_DK_ATTACHMENT_FILENAME] = "";
	}

	function oIPhoneEditURL()
	{
		return new WYURL("javascript:alert(\"" . WYTS('NoAudioEditorOnIPhone') . "\")");
	}
	
   function sDownloadFileName()
   {
      $sFN = "";
      $sOrg = $this->sOriginalFilename();
      if ($sOrg) {
         $oOrg = new WYPath($sOrg);
         $sExt = $oOrg->sExtension();
         $sFN = $this->sDataFileName(false) . ($sExt !== "" ? ".$sExt":".dat");
      }
      return $sFN;
   }
   
   function sOriginalFilename()
   {
      $sOrg = $this->dContent[WY_DK_ATTACHMENT_FILENAME];
      return $sOrg;
   }

   function setOriginalFilename($s)
   {
      $s = str_replace(" ", "_", $s);
      $this->dContent[WY_DK_ATTACHMENT_FILENAME] = $s;
   }

	function oFile()
	{
		global $goApp;
		$oFile = od_nil;
		$oURL = od_nil;
		$sFN = $this->sDownloadFileName();

      $oURL = od_clone($goApp->oDataURL);
      $oURL->addComponent($sFN);
      $oFile = new WYFile($oURL);
		return $oFile;
	}
	
	function deleteFile()
	{
		global $goApp;
		$oFile = od_nil;
		$sFN = $this->sDownloadFileName();

      if ($sFN) {
         $oPath = od_clone($goApp->oDataPath);
         $oPath->addComponent($sFN);
         $oFile = new WYFile($oPath);
         if ($oFile->bExists() && !$oFile->bDelete()) $goApp->log("could not delete audio file " . $oPath->sPath);
         $this->setOriginalFilename("");
         $this->save();
      }
	}

   function deleteContent()
   {
      $this->deleteFile();
	   parent::deleteContent();
   }
   
	function sFieldNameForFile()
	{
		$s = parent::sFieldNameForFile();
		$s = "at-" . $s;
		return $s;
	}
	
	function useUploadedFile(&$oFromPath, &$oOrgFilename)
	{
		global $goApp;
		$sFN = "";

		if ($oFromPath) {
			$oFromFile = new WYFile($oFromPath);
         $this->deleteFile();
         $this->setOriginalFilename($oOrgFilename->sPath);
         $sFN = $this->sDownloadFileName();
			$oToPath = od_clone($goApp->oDataPath);
			
         $oToPath->addComponent($sFN);
			if (!$oFromFile->bMoveTo($oToPath)) {
				$goApp->log("could not move audio file: " . $oFromPath->sPath . " to " . $oToPath->sPath);
            $this->deleteFile();
            $this->setOriginalFilename("");
			}
         else {
				chmod($oToPath->sPath, 0644);
         }
		}
	}

	function sDisplay($mwPlayerWidth="Null", $mwPlayerHeight="Null")
	{
	    global $goApp;
	    $sHTML = "";
	    $sFN = $this->sDownloadFileName();
	    $oURL = $oLink = od_nil;

	    if ($sFN) {
	        $oURL = od_clone($goApp->oProgramURL);
	        $oURL->addComponent("download.php");
	        $oURL->dQuery[WY_QK_DOWNLOAD_FILENAME] = $sFN;
	        $oURL->dQuery[WY_QK_ORIGINAL_FILENAME] = $this->sOriginalFilename();
	        $oLink = new WYLink($oURL, WYTS("DownloadHint"));
	        if ($this->sCustomIcon) {
	            $oImg = new WYImage(new WYURL($this->sCustomIcon));
	            $oImg->setAttribute("class", WY_ATTACHMENT_CSS_ICON);
	            $oLink->setInnerHTML($this->sOriginalFilename() . "&nbsp;" . $oImg->sDisplay());
				// $oLink->setInnerHTML("<span style='font-size: 11px;'>" . $this->sOriginalFilename() . "</span>" . "&nbsp;" . $oImg->sDisplay());
	        }
	        else {
				 $oLink->setInnerHTML("<span class='WebYepAudioFile'>" . $this->sOriginalFilename() . "</span><br/>");
	        }
	        // $sHTML .= $oLink->sDisplay();
			// Conditionally display the download link only in edit mode
	        if ($goApp->bEditMode) {
	            $sHTML .= $oLink->sDisplay();
	        }
        
	        // Add the HTML5 audio tag to the output
	        $sAudioFileURL = htmlspecialchars($goApp->oDataURL->sPath . "/" . $sFN); // Adjust this line to get the correct URL for your audio file
	        $sHTML .= "<audio controls>";
	        $sHTML .= "<source src=\"" . $sAudioFileURL . "\" type=\"audio/mpeg\">";
	        $sHTML .= "Your browser does not support the audio element.";
	        $sHTML .= "</audio>";
	    }

	    return $sHTML;
	}
}
?>
