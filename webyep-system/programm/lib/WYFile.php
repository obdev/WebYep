<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYApplication.php");

define("WYFILE_WRITE_NORMAL", 0);
define("WYFILE_WRITE_ATOMIC", 1);

class WYFile {
	// public
	var $oPath;
	// private
	var $sContent;
	var $iWriteMode;

	function WYFile(&$oP) {
        global $goApp;

		$this->oPath = od_clone($oP);
        // we only act on files inside a webyep-system folder:
        if (strpos($this->oPath->sPath, "webyep-system") === false) {
            $goApp->log("WYFile abuse - trying to access path " . $this->oPath->sPath);
            $this->oPath = od_nil;
        }
		$this->sContent = false;
		$this->iWriteMode = WYFILE_WRITE_ATOMIC;
	}
	
	function setContent($s)	{
		$this->sContent = $s;
	}
	
	function sContent()	{
		if(!$this->sContent) $this->bRead();
		return $this->sContent;
	}
	
	function aContentLines() {
		return preg_split("/(\r\n)|\r|\n/", $this->sContent());
	}
	
	function bExists() {
		return file_exists($this->oPath->sPath);
	}
	
	function bIsReadable() {
		return is_readable($this->oPath->sPath);
	}
	
	function bRead() {
		global $goApp;
		$f = 0;
		$bSuccess = false;

		$f = @fopen($this->oPath->sPath, "rb");
		if ($f) {
			$this->sContent = fread($f, filesize($this->oPath->sPath));
			fclose($f);
			$bSuccess = true;
		} else {
			$goApp->log("could not read file " . basename($this->oPath->sPath));
			$bSuccess = false;
		}
		return $bSuccess;
	}
	
	function bWrite() {
		global $goApp;
		$f = 0;
		$bSuccess = false;

		if ($this->iWriteMode == WYFILE_WRITE_ATOMIC && file_exists($this->oPath->sPath)) {
			if (!@unlink($this->oPath->sPath)) $goApp->log("could not remove file " . $this->oPath->sPath);
		}
		$f = @fopen($this->oPath->sPath, "wb");
		if ($f) {
			fwrite($f, $this->sContent);
			fclose($f);
			$bSuccess = true;
		} else {
			$goApp->log("could not write to file " . $this->oPath->sPath);
			$bSuccess = false;
		}
		return $bSuccess;
	}

	function bAppend($sContent) {
        global $goApp;

		$bSuccess = false;
		$f = @fopen($this->oPath->sPath, "ab");
		if ($f) {
			fwrite($f, $sContent);
			fclose($f);
			$this->sContent .= $sContent;
			$bSuccess = true;
		} else {
			$goApp->log("could not append to file " . $this->oPath->sPath);
			$bSuccess = false;
		}
		return $bSuccess;
	}
	
	function bDelete() {
		return unlink($this->oPath->sPath);
	}
	
	function chmod($iMode) {
		chmod($this->oPath->sPath, $iMode);
	}
	
	function bCopyTo(&$oToPath) {
		return @copy($this->oPath->sPath, $oToPath->sPath);
	}

	function bMoveTo(&$oToPath) {
		$bSuccess = @rename($this->oPath->sPath, $oToPath->sPath);
		if ($bSuccess) $this->sPath = $oToPath->sPath;
		return $bSuccess;
	}
}
?>