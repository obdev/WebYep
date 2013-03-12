<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");

class WYURL extends WYPath
{
	// public
	var $sProtocol;
	var $sHost;
	var $dQuery;
	var $sAnchor;

	// class methods
	
	function &oCurrentURL()
	{
		$sURL = $_SERVER['PHP_SELF'];
		
		if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING']) $sURL .= "?" . $_SERVER['QUERY_STRING'];

		$oURL = new WYURL($sURL);
		return $oURL;
	}

	function bIsAbsolute($s)
	{
		return strpos($s, ":") != false;
	}
	
	function bIsSiteRelative($s)
	{
		return substr($s, 0, 1) == "/";
	}
	
	// instance methods

	function WYURL($s)
	// important: can't handle port's by now!
	{
        global $goApp;
		$sQuery = "";
		$iPos = 0;
		$aQueryPairs = array();
		$sPair = "";
		$aKeyValue = array();
        $iMaxProtocolIdentLen = 5; // https

		$iPos = strpos($s, ":");
		if ($iPos !== false && $iPos <= $iMaxProtocolIdentLen) {
			$this->sProtocol = strtolower(substr($s, 0, $iPos));
            $s = substr($s, $iPos + 1);
		}
		else $this->sProtocol = "http";

		if (substr($s, 0, 2) == "//") {
			$iPos = strpos($s, "/", 2);
			if ($iPos !== false) {
				$this->sHost = substr($s, 2, $iPos-2);
				$s = substr($s, $iPos);
            if (!$s) $s = "/";
			}
			else {
				$this->sHost = substr($s, 2);
				$s = "/";
			}
		}
		else $this->sHost = WYApplication::sHTTPHost();

		$iPos = strpos($s, "#");
		if ($iPos !== false) {
			$this->sAnchor = substr($s, $iPos + 1);
			$s = substr($s, 0, $iPos);
		}
		else $this->sAnchor = "";

		$this->dQuery = array();
		$iPos = strpos($s, "?");
		if ($iPos !== false) {
			$sQuery = substr($s, $iPos + 1);
			$aQueryPairs = explode("&", $sQuery);
			foreach($aQueryPairs as $sPair) {
				$aKeyValue = explode("=", $sPair);
				$this->dQuery[$aKeyValue[0]] = isset($aKeyValue[1]) ? urldecode($aKeyValue[1]):"";
			}
			$s = substr($s, 0, $iPos);
		}
		parent::WYPath($s);
	}
	
	function setQuery($d)
	{
		$this->dQuery = $d;
	}

	function makeSiteRelative()
	{
		if (substr($this->sPath, 0, 1) != "/") $this->sPath = WYURL::_sSiteRelativeURL($this->sPath);
	}
	
	function sURL($bWithQuery = true, $bWithAnchor = true, $bAbsolute = false)
	{
		$s = "";
		$sKey = "";
		$sValue = "";
		$sC = "?";

		if ($bAbsolute) {
			$this->makeSiteRelative();
			$s = $this->sProtocol . "://" . $this->sHost;
		}
		$s .= $this->sPath;
		if ($bWithQuery && count($this->dQuery)) {
			foreach ($this->dQuery as $sKey => $sValue) {
				$s .= $sC . $sKey . "=" . urlencode($sValue);
				$sC = "&";
			}
		}
		if ($bWithAnchor && $this->sAnchor) $s .= "#" . $this->sAnchor;
		return $s;
	}

	function sEURL($bWithQuery = true, $bWithAnchor = true, $bAbsolute = false)
	{
		return str_replace("&", "&amp;", $this->sURL($bWithQuery, $bWithAnchor, $bAbsolute));
	}

	function _sSiteRelativeURL($sURL)
	{
		$sCurrentURL = "";
		$aFolders = array();
		$i = 0;

		if ($sURL == ".") $sURL = "";
		$sCurrentURL = $_SERVER['PHP_SELF'];
		$aFolders = explode("/", $sCurrentURL);
		if (!$aFolders[0]) array_splice($aFolders, 0, 1); // remove empty leading element
		array_splice($aFolders, count($aFolders) - 1, 1); // remove trailing element = filename
		while (true) {
			if (substr($sURL, 0, 2) == "./") {
				$sURL = substr($sURL, 2);
			}
			else if (substr($sURL, 0, 3) == "../") {
				if (count($aFolders)) array_splice($aFolders, count($aFolders) - 1, 1);
				$sURL = substr($sURL, 3);
			}
			else break;
		}
		if (count($aFolders)) {
			for ($i = count($aFolders) - 1; $i >= 0; $i--) {
				$sURL = $aFolders[$i] . "/" . $sURL;
			}
		}
		$sURL = "/" . $sURL;
		return $sURL;
	}
}
?>