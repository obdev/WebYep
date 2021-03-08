<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYDocument.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPopupWindowLink.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYLink.php");

define("WYAPP_METHOD_GET", "get");
define("WYAPP_METHOD_POST", "post");
define("WY_QK_ACTION", "WEBYEP_ACTION");
define("WY_QK_ACTION_ID", "WEBYEP_ACTION_ID");
define("WY_CK_ACTION_ID", "WEBYEP_ACTION_ID");

define("WY_QK_EDITMODE", "WEBYEP_EDIT");

define("WY_CK_EDITMODE", "WEBYEP_EDIT");
define("WY_CK_USERNAME", "WEBYEP_USERNAME");
define("WY_CK_PASSWORD", "WEBYEP_PASSWORD");

define("WY_QK_LOGON_PAGE_URL", "LOGON_PAGE_URL");
define("WY_SV_IS_AUTH", "WebYepIsAuthorized");

class WYApplication
{
	// public
	var $oDocument; // current document
	var $oProgramPath; // file path to program folder
	var $oDataPath; // file path to data folder
	var $oProgramURL; // URL to program folder
	var $oDataURL; // URL to data folder
	var $oImageURL; // URL to images folder

	var $bEditMode;
	var $bEditPermission;
	var $bDataAccessProblem;
	var $bLiveDemoProblem;

	var $bIsiPhone;
	var $bIsOmniWeb;
	var $bIsSafari;
	var $bIsOpera;
	var $bIsNavigator;
	var $bIsExplorer;
	var $bIsMac;

	var $iActionID;

	// class methods

	function sScriptPath($s)
	{
      $s = str_replace("\\", "/", $s);
		return $s;
	}

   function bIsWindows()
   {
      return strtoupper(substr(PHP_OS, 0, 3)) == "WIN";
   }

	// instance methods

//	function WYApplication()
	function __construct()
	{
		global $webyep_sIncludePath; // set in page init code
		global $goApp, $webyep_bTesting;
		global $webyep_bDocumentPage;
		global $webyep_bLiveDemo, $webyep_sLiveDemoSlotID, $webyep_sCookiePath;
		$oP = od_nil;
		$oF = od_nil;
		$this->iActionID = 0;

      if (!isset($webyep_sCookiePath)) $webyep_sCookiePath = "/";
      else setcookie(WY_CK_ACTION_ID, "", $this->iCookieTTL(), "/"); // make sure there's no action ID in the "/" cookie

		$this->bDataAccessProblem = false;
		$this->bLiveDemoProblem = false;
		$this->oProgramPath = new WYPath(WYApplication::sScriptPath(__FILE__));
		$this->oProgramPath->removeLastComponent();
		$this->oProgramPath->removeLastComponent();
		$this->oProgramURL = new WYURL($webyep_sIncludePath);
		$this->oProgramURL->makeSiteRelative();
		$this->oImageURL = od_clone($this->oProgramURL);
		$this->oImageURL->addComponent("images");
		$this->oDataPath = od_clone($this->oProgramPath);
		$this->oDataPath->normalize();
		$this->oDataPath->removeLastComponent();
		$this->oDataURL = od_clone($this->oProgramURL);
		$this->oDataURL->normalize();
		$this->oDataURL->removeLastComponent();
		if (strstr(WYApplication::sScriptPath(__FILE__), "webyep-system/programm")) {
			$this->oDataPath->addComponent("daten" . ($webyep_bLiveDemo && $webyep_sLiveDemoSlotID ? "_$webyep_sLiveDemoSlotID":"") );
			$this->oDataURL->addComponent("daten" . ($webyep_bLiveDemo && $webyep_sLiveDemoSlotID ? "_$webyep_sLiveDemoSlotID":""));
		}
		else {
			$this->oDataPath->addComponent("data" . ($webyep_bLiveDemo && $webyep_sLiveDemoSlotID ? "_$webyep_sLiveDemoSlotID":""));
			$this->oDataURL->addComponent("data" . ($webyep_bLiveDemo && $webyep_sLiveDemoSlotID ? "_$webyep_sLiveDemoSlotID":""));
		}
		if ($webyep_bLiveDemo && !$this->oDataPath->bExists()) $this->bLiveDemoProblem = true;

		$goApp = $this; // other modules might need the global app object early
		$this->bIsiPhone = false;
		$this->bIsOmniWeb = false;
		$this->bIsSafari = false;
		$this->bIsOpera = false;
		$this->bIsNavigator = false;
		$this->bIsExplorer = false;
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			if ($webyep_bTesting && (stristr($_SERVER['HTTP_USER_AGENT'], "iPhone") || stristr($_SERVER['HTTP_USER_AGENT'], "iPod"))) $this->bIsiPhone = true;
			else if (stristr($_SERVER['HTTP_USER_AGENT'], "Safari")) $this->bIsSafari = true;
			else if (stristr($_SERVER['HTTP_USER_AGENT'], "Opera")) $this->bIsOpera = true;
			else if (stristr($_SERVER['HTTP_USER_AGENT'], "OmniWeb")) $this->bIsOmniWeb = true;
			else if (stristr($_SERVER['HTTP_USER_AGENT'], "MSIE")) $this->bIsExplorer = true;
			else $this->bIsNavigator = true;
		}
		else {
			$this->bIsExplorer = true; // default browser
		}

		if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], "Mac") === false) $this->bIsMac = false;
		else $this->bIsMac = true;

		if (isset($_COOKIE[WY_CK_ACTION_ID])) $this->iActionID = (int)$_COOKIE[WY_CK_ACTION_ID];
		if ($webyep_bDocumentPage) $this->iActionID++;
		if (!headers_sent()) setcookie(WY_CK_ACTION_ID, $this->iActionID, $this->iCookieTTL(), $webyep_sCookiePath);
		else $this->log("can't set cookie " . WY_CK_ACTION_ID . ": headers already sent");

		// check EditMode
        $this->bEditMode = false;
        // cookie is set AND contains "yes"
		if (isset($_COOKIE[WY_CK_EDITMODE]) && $_COOKIE[WY_CK_EDITMODE] == "yes") {
            $this->bEditMode = true;
		} else if (stristr($this->sFormFieldValue(WY_QK_EDITMODE), "yes")) {
			$this->bEditMode = true;
			if (!headers_sent()) {
                setcookie(WY_QK_EDITMODE, "yes", $this->iCookieTTL(), $webyep_sCookiePath);
			} else {
                $this->log("can't set cookie " . WY_QK_EDITMODE . " to yes: headers already sent");
			}
		}
		if (stristr($this->sFormFieldValue(WY_QK_EDITMODE), "no")) {
			$this->bEditMode = false;
			if (isset($_COOKIE[WY_CK_EDITMODE])) {
				if (!headers_sent()) {
                    setcookie(WY_QK_EDITMODE, "no", $this->iCookieTTL(), $webyep_sCookiePath);
                    $_SESSION[WY_SV_IS_AUTH] = false;
                } else {
                    $this->log("can't set cookie " . WY_QK_EDITMODE . " to no: headers already sent");
                }
			}
			if ($this->sFormFieldValue(WY_QK_LOGOUT, "")) {
				if (!headers_sent()) {
					setcookie(WY_CK_USERNAME, "", $this->iCookieTTL(), $webyep_sCookiePath);
					$_COOKIE[WY_CK_USERNAME] = "";
					setcookie(WY_CK_PASSWORD, "", $this->iCookieTTL(), $webyep_sCookiePath);
					$_COOKIE[WY_CK_PASSWORD] = "";
                    $_SESSION[WY_SV_IS_AUTH] = false;
				}
			}
		}
	}

	function oDocumentRoot()
	{
		$sDR = "";
		$sRU = "";
		$sS = "";
		$iL = 0;

		$sS = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME']:"";
		$sRU = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI']:"";
		if (!$sRU) $sRU = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME']:"";
		if (php_sapi_name()=="cgi" && isset($_SERVER["PATH_TRANSLATED"])) $sS = $_SERVER["PATH_TRANSLATED"];
		if ($sS && $sRU) {
			$sS = str_replace("\\", "/", $sS);
			$sRU = str_replace("\\", "/", $sRU);
			$iPos = strpos($sRU, "?");
			if ($iPos !== false) $sRU = substr($sRU, 0, $iPos);
			if (substr($sRU, -1) == "/") $sRU .= "index.php";
			$iLen = strlen($sRU);
			if (substr($sS, -$iLen) == $sRU) $sDR = substr($sS, 0, -$iLen);
		}
		if (!$sDR) $sDR = isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT']:"";
		if ($sDR) return new WYPath($sDR);
		else return od_nil;
	}

   function iCookieTTL()
   {
      if ($this->bIsiPhone) return time() + 60*20;
      else return 0;
   }

   function _bIPInNetArray($sIP, &$aNets)
   {
      $b = false;
      $s = $sNet = $sBinNet = $sBinIP = $sFirstPart = $sFirstIP = "";
      $iNet = $iIP = $iMask = 0;

      foreach ($aNets as $s)
      {
         list($sNet, $iMask) = preg_split("|/|", $s);

         $iNet = ip2long($sNet);
         $iIP = ip2long($sIP);
         $sBinNet = str_pad(decbin($iNet), 32, "0",STR_PAD_LEFT);
         $sFirstPart = substr($sBinNet, 0, $iMask);
         $sBinIP = str_pad(decbin($iIP), 32, "0",STR_PAD_LEFT); 
         $sFirstIP = substr($sBinIP, 0, $iMask);
         if (strcmp($sFirstPart, $sFirstIP) == 0) {
            $b = true;
            break;
         }
      }
      return($b);
   }

   function sClientIP()
   {
      $aPrivateNets = array("10.0.0.0/8", "172.16.0.0/12", "192.168.0.0/16");
      $sIP = $s = "";
      $aIPs = array();

      $s = "";
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != "") {
         $s = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != "") {
         $s .= "," . $_SERVER['REMOTE_ADDR'];
      }
      $aIPs = explode(",", $s);

      foreach ($aIPs as $s)
      {
         if ($s != "" && !$this->_bIPInNetArray($s, $aPrivateNets)) {
            $sIP = $s;
            break;
         }
      }
      return($sIP);
   }

   static function sHTTPHost()
   {
	   $sH = "";
	   if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) $sH = $_SERVER['HTTP_X_FORWARDED_HOST'];
	   else if (isset($_SERVER['HTTP_HOST'])) $sH = $_SERVER['HTTP_HOST'];
	   if (!$sH && isset($_SERVER['SERVER_NAME'])) $sH = $_SERVER['SERVER_NAME'];
	   return $sH;
   }

   function iByteSizeStringToBytes($sVal)
   {
      $sVal = trim($sVal);
      $iVal = (int)$sVal;
      $sModifier = strtolower(substr($sVal, -1, 1));
      switch($sModifier) {
         case 'g':
            $iVal *= 1024;
         case 'm':
            $iVal *= 1024;
         case 'k':
            $iVal *= 1024;
      }
      return $iVal;
   }

   function sFormattedByteSizeString($iVal)
   {
      $sModifier = "";
      $iGig = 1024*1024*1024;
      $iMeg = 1024*1024;
      $iK = 1024;

      if ($iVal >= $iGig) {
         $sModifier = "GB";
         $iVal = round($iVal / $iGig, 1);
      }
      else if ($iVal >= $iMeg) {
         $sModifier = "MB";
         $iVal = round($iVal / $iMeg, 1);
      }
      else if ($iVal >= $iK) {
         $sModifier = "kB";
         $iVal = round($iVal / $iK, 1);
      }
      return $iVal . $sModifier;
   }

   function iMaxUploadBytes()
   {
      $iM = 0;
      $iMU = WYApplication::iByteSizeStringToBytes(ini_get("upload_max_filesize"));
      $iMP = WYApplication::iByteSizeStringToBytes(ini_get("post_max_size"));
      if ($iMU > $iMP && $iMP > 0) $iM = $iMP;
      else $iM = $iMU;
      return $iM;
   }

   function iCurrentMemoryUsage()
   {
	   if (function_exists("memory_get_usage")) return memory_get_usage();
	   else return 0;
   }

   function iMemoryLimit()
   {
	   $iMem = WYApplication::iByteSizeStringToBytes(ini_get("memory_limit"));
	   return $iMem;
   }

   function setMemoryLimit($iMem)
   {
		ini_set("memory_limit", $iMem);
   }

	function sHTMLStandard()
	{
		global $webyep_sHTMLStandard;

		if ($webyep_sHTMLStandard == "auto") {
			if (preg_match('|<!DOCTYPE[^>]+>|', ob_get_contents(), $aMatch)) {
				if (strpos($aMatch[0], "XHTML") !== false) $webyep_sHTMLStandard = "XHTML";
				else $webyep_sHTMLStandard = "HTML";
			}
			else $webyep_sHTMLStandard = "HTML";
		}
		return $webyep_sHTMLStandard;
	}

	function setActionInQuery(&$d, $sA)
	{
		$d[WY_QK_ACTION] = $sA;
		$d[WY_QK_ACTION_ID] = $this->iActionID;
	}

	function sCurrentAction()
	{
		$iActionID = 0;
		$sAction = $this->sFormFieldValue(WY_QK_ACTION, "");

		if ($sAction) {
			if ((int)$this->sFormFieldValue(WY_QK_ACTION_ID, 0) != ($this->iActionID - 1)) {
				unset($_POST[WY_QK_ACTION]);
				unset($_GET[WY_QK_ACTION]);
				$sAction = "";
			}
		}
		return $sAction;
	}

	function sFormFieldValue($sKey, $sDefaultValue = "", $sMethod="")
	{
		$sValue = "";
		$bStrip = true;
		
		if (isset($_GET[$sKey]) && $sMethod != WYAPP_METHOD_POST) $sValue = $_GET[$sKey];
		else if (isset($_POST[$sKey]) && $sMethod != WYAPP_METHOD_GET) $sValue = $_POST[$sKey];
		else {
			$sValue = $sDefaultValue;
			$bStrip = false;
		}
		if ($bStrip && get_magic_quotes_gpc()) $sValue = stripslashes($sValue);
		
		return $sValue;
	}

	function sEncryptedPassword($s)
	{
		$sC = "";

		if (function_exists("crypt")) {
			$sC = @crypt($s, date("d"));
			// on some plattforms (e.g. NetWare) 'crypt()' exists,
			// but returns an empty string !?!?!
		}
		if ($sC == "") {
			$sC = substr(md5(date("d") . $s), 0, 20);
		}
		return $sC;
	}

	function bShouldAvoidCaching()
	{
 		// there's no relyable indicator by now
		// for now we ALWAYS must avoid caching :-(
 		return true;
	}

	function aMultiLoginCredentials()
	// returns array of dicts - for each login: 'un' => username, 'pw' => password
	{
		global $webyep_aMultiLoginName, $webyep_aMultiLoginPassword;
		$aReturn = array();

		foreach (array_keys($webyep_aMultiLoginName) as $i) {
			$aReturn[] = array('un' => $webyep_aMultiLoginName[$i], 'pw' => $webyep_aMultiLoginPassword[$i]);
		}
		return $aReturn;
	}

	function aMultiLoginURLPatterns()
	// returns array of arrays - for each login the URL(s) configured
	{
		global $webyep_aMultiLoginURLPatterns;
		$aReturn = array();

		foreach ($webyep_aMultiLoginURLPatterns as $sURLList) {
			$aURLs = preg_split('/[ \t]/', $sURLList);
			foreach (array_keys($aURLs) as $i) {
				$aURLs[$i] = urldecode($aURLs[$i]);
			}
			$aReturn[] = $aURLs;
		}
		return $aReturn;
	}

	function bIsValidUser($sUN, $sPW, $bEncrypted)
	{
		global $webyep_sAdminName, $webyep_sAdminPassword;

		$bReturn = false;

		if ($sUN == $webyep_sAdminName && $sPW == ($bEncrypted ? $this->sEncryptedPassword($webyep_sAdminPassword):$webyep_sAdminPassword)) $bReturn = true;
		else {
			$aLogins = $this->aMultiLoginCredentials();
			foreach ($aLogins as $dLogin) {
				if ($sUN == $dLogin['un'] && $sPW == ($bEncrypted ? $this->sEncryptedPassword($dLogin['pw']):$dLogin['pw'])) {
					$bReturn = true;
					break;
				}
			}
		}
		return $bReturn;
	}

	function aClaimedCredentials()
	{
		$sUN = $sPW = "";

		if (isset($_COOKIE[WY_CK_USERNAME]) && isset($_COOKIE[WY_CK_PASSWORD])) {
			$sUN = $_COOKIE[WY_CK_USERNAME];
			$sPW = $_COOKIE[WY_CK_PASSWORD];
		}
		else if ($this->sFormFieldValue(WY_CK_USERNAME) != "") {
			$sUN = $this->sFormFieldValue(WY_CK_USERNAME);
			$sPW = $this->sFormFieldValue(WY_CK_PASSWORD);
		}
		return array($sUN, $sPW);
	}

	function bMainUser()
	{
		global $webyep_sAdminName, $webyep_sAdminPassword;

		list($sUN, $sPW) = $this->aClaimedCredentials();
		return $webyep_sAdminName == $sUN && $this->sEncryptedPassword($webyep_sAdminPassword) == $sPW;
	}

	function bAuthenticate($sU, $sP)
	{
		global $webyep_sCookiePath;

		$bReturn = $this->bIsValidUser($sU, $sP, false);

		if ($bReturn) {
			if (!headers_sent()) {
				setcookie(WY_CK_USERNAME, $sU, $this->iCookieTTL(), $webyep_sCookiePath);
				setcookie(WY_CK_PASSWORD, $this->sEncryptedPassword($sP), $this->iCookieTTL(), $webyep_sCookiePath);
                $_SESSION[WY_SV_IS_AUTH] = true;
			}
			else {
				$this->log("could not set username/passwd cookies, headers sent");
			}
		}
		else {
			$this->log("login failed: wrong username/password");
            $_SESSION[WY_SV_IS_AUTH] = false;
		}
		return $bReturn;
	}

	function bAuthCheck($oDocPath = od_nil)
	{
		global $webyep_sAdminName, $webyep_sAdminPassword;

		$bReturn = false;
		list($sUN, $sPW) = $this->aClaimedCredentials();

		if (isset($_COOKIE[WY_CK_USERNAME]) && isset($_COOKIE[WY_CK_PASSWORD])) {
			$sUN = $_COOKIE[WY_CK_USERNAME];
			$sPW = $_COOKIE[WY_CK_PASSWORD];
		}
		else if ($this->sFormFieldValue(WY_CK_USERNAME) != "") {
			$sUN = $this->sFormFieldValue(WY_CK_USERNAME);
			$sPW = $this->sFormFieldValue(WY_CK_PASSWORD);
		}

		$_SESSION[WY_SV_IS_AUTH] = false;
        if ($sUN) {
			if ($sUN == $webyep_sAdminName && $sPW == $this->sEncryptedPassword($webyep_sAdminPassword)) {
                $bReturn = true;
                $_SESSION[WY_SV_IS_AUTH] = true;
			}
			else if ($oDocPath) {
				$sDocPath = $oDocPath->sPath;
				$aCredentials = $this->aMultiLoginCredentials();
				$aURLPatternLists = $this->aMultiLoginURLPatterns();
				$i = 0;
				foreach ($aURLPatternLists as $aList) {
					$dCredentials = $aCredentials[$i++];
					foreach ($aList as $sPattern) {
						$sPattern = str_replace(".", "\\.", $sPattern);
						$sPattern = str_replace("*", "[^/]*", $sPattern);
						if ($sPattern[0] == "/") $sPattern = "^" . $sPattern;
						else $sPattern = "/" . $sPattern;
						$sPattern .= '$';
						if (preg_match("|$sPattern|", $sDocPath)) {
							if ($dCredentials['un'] == $sUN && $this->sEncryptedPassword($dCredentials['pw']) == $sPW) {
                                $bReturn = true;
                                $_SESSION[WY_SV_IS_AUTH] = true;
							}
							break;
						}
					}
				}
			}
		}
		return $bReturn;
	}

	function bValidUser()
	{
		list($sUN, $sPW) = $this->aClaimedCredentials();
		return $this->bIsValidUser($sUN, $sPW, true);
	}

	function sAuthWindowJS()
	{
		$s = "";
		$oURL = od_nil;
		$oPageURL = od_clone(WYURL::oCurrentURL());

		$oURL = od_clone($this->oProgramURL);
		$oURL->addComponent("logon.php");
		$oURL->dQuery[WY_QK_LOGON_PAGE_URL] = $oPageURL->sURL();
		$s .= WYPopupWindowLink::sOpenWindowCode($oURL, "WebYepLogon", 400, 300, WY_POPWIN_TYPE_PLAIN);
		return $s;
	}
	
	function sAuthWindowMW()
	{
		
		$sJS = "";
		$oURL = od_nil;
		$oPageURL = od_clone((new WYURL())->oCurrentURL());

		$oURL = od_clone($this->oProgramURL);
		$oURL->addComponent("logon.php");
		$oURL->dQuery[WY_QK_LOGON_PAGE_URL] = $oPageURL->sURL();
		
		// $sJS .= "javascript:opendModelWindow('WebYepLogon', '".$oURL->sURL()."')"; //
		   $sJS .= "javascript:opendModelWindow(' ', '".$oURL->sURL()."')";
		return  $sJS;
	}
	
	function sLoginUrlMW()
	{
		$sURL = "";
		$oURL = od_nil;
		$oPageURL = od_clone(WYURL::oCurrentURL());
		$oURL = od_clone($this->oProgramURL);
		$oURL->addComponent("logon.php");
		$oURL->dQuery[WY_QK_LOGON_PAGE_URL] = $oPageURL->sURL();
		return $oURL->sURL();
	}
	
	function sNoticeWindowJS($sTitleKey, $sMsgKey, $sHelpFile = "")
	{
		$s = "";
		$oURL = od_nil;

		if (!strstr($_SERVER['PHP_SELF'], "notice.php")) {
			$s .= "<script type='text/javascript'>\n";
			$oURL = od_clone($this->oProgramURL);
			$oURL->addComponent("notice.php");
			$oURL->setQuery(array("TITLE" => $sTitleKey, "MESSAGE" => $sMsgKey, "HELP" => $sHelpFile));
			$s .= "   newWin = " . WYPopupWindowLink::sOpenWindowCode($oURL, "WebYepNotice", 400, 300, WY_POPWIN_TYPE_PLAIN) . ";\n";
			$s .= "   newWin.focus();";
			$s .= "</script>\n";
		}
		return $s;
	}
	
	function sNoticeWindowMW($sTitleKey, $sMsgKey, $sHelpFile = "")
	{
		global $webyep_sModalWindowType;
		
		$s = "";
		$oURL = od_nil;

		if (!strstr($_SERVER['PHP_SELF'], "notice.php")) {
			$oURL = od_clone($this->oProgramURL);
			$oURL->addComponent("notice.php");
			$oURL->setQuery(array("TITLE" => $sTitleKey, "MESSAGE" => $sMsgKey, "HELP" => $sHelpFile));	
			
			if($webyep_sModalWindowType == 'mootools'){
				$s .= "<script type='text/javascript'>\n";
				$s .= "window.addEvent('domready', function() {\n";
				$s .= 'WYPopupWindowLinkMW("'.$oURL->sURL().'", "WebYepNotice", 400, 300);'."\n";
				$s .= "});\n";
				$s .= "</script>\n";
			}		
			if($webyep_sModalWindowType == 'jquery'){
				$s .= "<script type='text/javascript'>\n";
				$s .= "$(document).ready(function(e) {\n";
				$s .= 'WYPopupWindowLinkMW("'.$oURL->sURL().'", "WebYepNotice", 400, 300);'."\n";
				$s .= "});\n";
				$s .= "</script>\n";
			}
			if($webyep_sModalWindowType == 'scriptaculous'){
				$s .= "<script type='text/javascript'>\n";
				$s .= "document.observe('dom:loaded', function() {\n";
				$s .= 'WYPopupWindowLinkMW("'.$oURL->sURL().'", "WebYepNotice", 400, 300);'."\n";
				$s .= "});\n";
				$s .= "</script>\n";
			}
		}
		return $s;
	}
	
	function sAlertWindowMW($oText)
	{
		global $webyep_sModalWindowType;
		$s = "";
		if($webyep_sModalWindowType == 'mootools'){
			$s .= "<script type='text/javascript'>\n";
			$s .= "window.addEvent('domready', function() {\n";
			$s .= 'WYPopupWindowAlertMW("'.$oText.'", "WebYepalert", 300, 200);'."\n";
			$s .= "});\n";
			$s .= "</script>\n";
		}		
		if($webyep_sModalWindowType == 'jquery'){
			$s .= "<script type='text/javascript'>\n";
			$s .= "$(document).ready(function(e) {\n";
			$s .= 'WYPopupWindowAlertMW("'.$oText.'", "WebYepalert", 300, 200);'."\n";
			$s .= "});\n";
			$s .= "</script>\n";
		}
		if($webyep_sModalWindowType == 'scriptaculous'){
			$s .= "<script type='text/javascript'>\n";
			$s .= "document.observe('dom:loaded', function() {\n";
			$s .= 'WYPopupWindowAlertMW("'.$oText.'", "WebYepalert", 300, 200);'."\n";
			$s .= "});\n";
			$s .= "</script>\n";
		}	
		
		
		return $s;
	}

	function setDataAccessProblem($b)
	{
		$this->bDataAccessProblem = $b;
	}

	function outputWarningPanels()
	{
		if ($this->bDataAccessProblem) {
			echo $this->sNoticeWindowJS("DataAccessProblemTitle", "DataAccessProblemText", "activate.php");
		}
		if ($this->bLiveDemoProblem) {
			echo $this->sNoticeWindowJS("LiveDemoProblemTitle", "LiveDemoProblemText", "activate.php");
		}
	}

	function sHelpLink($sHelpFile)
	{
		$s = "";

		$oPageURL = od_clone($this->oProgramURL);
		$oPageURL->addComponent(WYTS("HelpFolder"));
		$oPageURL->addComponent($sHelpFile);
		$oImgURL = od_clone($this->oImageURL);
		//$oImgURL->addComponent("help.gif");//
		$oImgURL->addComponent("help.png");
		$oImg = new WYImage($oImgURL);
		$oImg->setAttribute("border", 0);
		$oImg->setAttribute("align", "absmiddle");
		$oLink = new WYLink($oPageURL);
		$oLink->setAttribute("target", "WebYepHelp");
		$oLink->setInnerHTML($oImg->sDisplay() . "&nbsp;" . WYTS("HelpButton"));
		$s = "<span class='helpLink'>" . $oLink->sDisplay() . "</span>";
		return $s;
	}

	function sCharsetMetatag()
	{
		global $webyep_sCharset, $webyep_sHTMLStandard;
		$s = "";
		if ($webyep_sCharset) {
			$sEndSlash = $webyep_sHTMLStandard == 'XHTML' ? ' /' : '';
			$s = "<meta http-equiv='Content-Type' content='text/html; charset=$webyep_sCharset'$sEndSlash>\n";
		}
		return $s;
	}

	function oSpacerImg($iW, $iH)
	{
		$oImgURL = od_clone($this->oImageURL);
		$oImgURL->addComponent("nix.gif");
		$oImg = new WYImage($oImgURL);
		$oImg->setAttribute("width", $iW);
		$oImg->setAttribute("height", $iH);
		return $oImg;
	}

   function move_uploaded_file(&$oFromPath, &$oToPath)
   {
      $bReturn = move_uploaded_file($oFromPath->sPath, $oToPath->sPath);
      if (!$bReturn) $bReturn = copy($oFromPath->sPath, $oToPath->sPath);
      return $bReturn;
   }

	function logDebug($sM)
	{
		global $webyep_bDebug;
		if ($webyep_bDebug) $this->log($sM);
	}

	function log($sM)
	{
		$sNL = "";
		// using the file class would be a bit of an overkill here...
		$sFilename = "webyep-log.txt";
		$f = @fopen($this->oDataPath->sPath . "/webyep-log.txt", "ab");
		if ($f) {
			if (stristr(PHP_OS, "win") && !stristr(PHP_OS, "darwin")) $sNL = "\r\n";
			else $sNL = "\n";
			$sM = date("d.m.Y") . " (" . date("H:i:s") . "): " . $sM . "\n";
			fwrite($f, $sM);
			fclose($f);
		}
	}

	function fatalError($sM)
	{
		print("fatal error: $sM<br>");
	}

	function &oSharedInstance()
	{
		global $goApp;

		return $goApp;
	}
}
if (!isset($webyep_bDocumentPage)) $webyep_bDocumentPage = true;
$goApp = new WYApplication();
(new WYLanguage)->setup();

// check for file managers and start session only if one is present
if (webyep_bHasFilemanager() && webyep_bHasEditPermissions()) {
	session_start();
}

// caution: WYDocument's constructor needs $goApp!
$goApp->oDocument = new WYDocument((new WYURL())->oCurrentURL());
$goApp->bEditPermission = $goApp->bEditMode;
if ($goApp->bEditPermission && !$goApp->bAuthCheck($webyep_bDocumentPage ? $goApp->oDocument->oDocPath:(new WYEditor())->oEditedPagesPath())) {
	$goApp->bEditPermission = false;
    $_SESSION[WY_SV_IS_AUTH] = false;
}
if ($webyep_bLiveDemo && !$webyep_sLiveDemoSlotID && $webyep_bLiveDemoLockTemplate) {
    $goApp->bEditPermission = false;
    $_SESSION[WY_SV_IS_AUTH] = false;
}

?>
