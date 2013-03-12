<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHTMLTag.php");

class WYFileUpload extends WYHTMLTag
{
	// instance variables
	// private
	var $dFileInfos;
	var $iNrOfFiles;
	
	// instance methods
	function WYFileUpload($sN, $multiple = false)
	{
		global $goApp;

		parent::WYHTMLTag("input");
		$this->dAttributes["type"] = "file";
		if ($multiple) {
			$this->dAttributes["name"] = $sN . '[]';
			$this->dAttributes["multiple"] = "multiple";
		} else {
			$this->dAttributes["name"] = $sN;
		}
		$this->dFileInfos = od_nil;
		if (isset($_FILES[$sN])) {
         $this->dFileInfos = $_FILES[$sN];
         // how many files?
			if (is_array($this->dFileInfos["name"])) {
				$this->iNrOfFiles = count($this->dFileInfos["name"]);
			}
			else {
				$this->iNrOfFiles = 1;
				$tmpFI = array("name"     => array($this->dFileInfos["name"])
								  ,"type"     => array($this->dFileInfos["type"])
								  ,"tmp_name" => array($this->dFileInfos["tmp_name"])
								  ,"error"    => array($this->dFileInfos["error"])
								  ,"size"     => array($this->dFileInfos["size"])
								  );
				$this->dFileInfos = $tmpFI;
				$tmpFI = NULL;
			}
			for ($i = 0; $i < $this->iNrOfFiles; $i++) {
				// security check
				$sOFN = isset($this->dFileInfos["name"][$i]) ? $this->dFileInfos["name"][$i]:"";
				$oOFN = new WYPath($sOFN);
				if (!$oOFN->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH)) {
					$goApp->log("error on file upload: illegal file type/name <$sOFN>");
					@unlink($this->dFileInfos["tmp_name"][$j]); // delete evil uploaded file
				}
				else if ($this->bFileUploaded($i) && $this->bUploadOK($i)) {
					$oTmpPath = new WYPath($this->dFileInfos["tmp_name"][$i]);
					$oToPath = od_clone($goApp->oDataPath);
					$oToPath->addComponent($oTmpPath->sBasename());
					if (!$goApp->move_uploaded_file($oTmpPath, $oToPath)) {
						$goApp->log("WYFileUpload: Could not move uploaded file " . $oTmpPath->sPath . " to " . $oToPath->sPath);
					}
					else {
						$this->dFileInfos["tmp_name"][$i] = $oToPath->sPath;
					}
				}
				else {
					$goApp->log("error on file upload: " . $this->iErrorCode() . ": " . $this->sErrorMessage());
				}
			}
		}
	}

	function deleteTmpFile($iIndex = 0)
	{
		$sTmpPath = $this->dFileInfos["tmp_name"][$iIndex];
		if ($sTmpPath) {
			$oFile = new WYFile(new WYPath($sTmpPath));
			if ($oFile->bExists()) $oFile->bDelete();
		}
	}
	
   function iErrorCode($iIndex = 0)
   {
		if (isset($this->dFileInfos["error"][$iIndex]))
			return $this->dFileInfos["error"][$iIndex];
      else
			return 0;
   }
   
   function bUploadOK($iIndex = 0)
   {
      $i = $this->iErrorCode($iIndex); // UPLOAD_ERR_NO_FILE is STILL OK, because it could have been a change to the description only
      return $i == UPLOAD_ERR_OK || $i == UPLOAD_ERR_NO_FILE;
   }
   
   function bFileUploaded($iIndex = 0)
   {
      $i = $this->iErrorCode($iIndex);
      return $i !== UPLOAD_ERR_NO_FILE && $this->dFileInfos['name'][$iIndex];
   }
   
   function sErrorMessage($bAsHTML = true, $iIndex = 0)
   {
      $s = "";
      switch($this->iErrorCode($iIndex)) {
         case UPLOAD_ERR_INI_SIZE:
         case UPLOAD_ERR_FORM_SIZE:
            $s = WYTS("FileUploadErrorSize", $bAsHTML);
         break;
         case UPLOAD_ERR_PARTIAL:
            $s = WYTS("FileUploadErrorInterrupted", $bAsHTML);
         break;
         case UPLOAD_ERR_NO_FILE:
            $s = WYTS("FileUploadErrorNoFile", $bAsHTML);
         break;
         default:
            $s = WYTS("FileUploadErrorUnknown", $bAsHTML);
         break;
      }
      return $s;
   }

	function setWidth($i)
	{
		$this->dAttributes["size"] = $i;
	}
	
	function oFilePath($iIndex = 0)
	{
		$oP = od_nil;
		
		if ($this->bUploadOK($iIndex)) {
			$oP = new WYPath($this->dFileInfos["tmp_name"][$iIndex]);
		}
		return $oP;	
	}
	
	function oOriginalFilename($iIndex = 0)
	{
		$oP = od_nil;
		
		if ($this->bUploadOK($iIndex)) {
			$oP = new WYPath($this->dFileInfos["name"][$iIndex]);
		}
		return $oP;	
	}
}
?>