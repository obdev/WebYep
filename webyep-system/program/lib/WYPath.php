<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

define("WYPATH_CHECK_NOPATH", 1);
define("WYPATH_CHECK_NOSCRIPT", 2);
define("WYPATH_CHECK_JUSTIMAGE", 4);
define("WYPATH_CHECK_JUSTAUDIO", 8);

class WYPath {
    // class methods
    function sMakeFilename($s) {
        $sOut = "";
        global $webyep_sCharset;
        global $WYPath_dISOToFilename, $WYPath_dUTF8ToFilename;
  
        if (!isset($WYPath_dISOToFilename))
            $WYPath_dISOToFilename = array("�" => "Ae", "�" => "Oe", "�" => "Ue", "�" => "ae", "�" => "oe", "�" => "ue", "�" => "ss",
                                           " " => "_",  "'" => "_",  "/" => "_",  "\\" => "_", "." => "_",  ":" => "_");
        if (!isset($WYPath_dUTF8ToFilename))
            $WYPath_dUTF8ToFilename = array(utf8_encode("�") => "Ae", utf8_encode("�") => "Oe", utf8_encode("�") => "Ue", utf8_encode("�") => "ae",
                                            utf8_encode("�") => "oe", utf8_encode("�") => "ue", utf8_encode("�") => "ss", " " => "_", "'" => "_",
                                            "/" => "_", "\\" => "_", "." => "_", ":" => "_");
  
        if ($webyep_sCharset == "" || strtolower($webyep_sCharset) == "iso-8859-1" || strtolower($webyep_sCharset) == "iso-8859-2") {
            $s = strtr($s, $WYPath_dISOToFilename);
        }
        else if (strtolower($webyep_sCharset) == "utf-8") {
            $s = strtr($s, $WYPath_dUTF8ToFilename);
        }
        $iLen = strlen($s);
        for ($i = 0; $i < $iLen; $i++) {
            $c = $s[$i];
            if (ord($c) > 127)
                $sOut .= "_" . ord($c) . "_";
            else
                $sOut .= $c;
        }
        return $sOut;
    }

    // instance variables
    // public
    var $sPath;

    // instance methods

   // function WYPath($s){
function __construct($s=''){
       $this->sPath = $s;
        $this->sPath = str_replace("\\", "/", $this->sPath);
        
        // $this->sPath = str_replace(":", "/", $this->sPath);
        // must not remove ":" - windows pathes need it!
        $this->sPath = str_replace("\0", "", $this->sPath);
    }

   function bCheck($iCheckMask) {
        $bOK = true;
        $sF = $this->sPath;
        if (strpos($this->sPath, "\0") !== false) return false; // no null bytes
        if ($iCheckMask & WYPATH_CHECK_NOPATH) {
            if (strpos($this->sPath, "..") !== false ||
                strpos($this->sPath, "/")  !== false ||
                strpos($this->sPath, "\\") !== false ) return false;
        }
        if ($iCheckMask & WYPATH_CHECK_JUSTIMAGE) {
            $sExt = strtolower($this->sExtension());
            $aImageExtensions = array("gif", "jpg", "jpeg", "png", "webp", "svg"); // add "webp" and "svg" to the array
            if ($sExt == "" || !in_array($sExt, $aImageExtensions, true)) return false;
        }
        if ($iCheckMask & WYPATH_CHECK_JUSTAUDIO) {
            $sExt = strtolower($this->sExtension());
            $aAudioExtensions = array("mp3");
            if ($sExt == "" || !in_array($sExt, $aAudioExtensions, true)) return false;
        }
        if ($iCheckMask & WYPATH_CHECK_NOSCRIPT) {
            $sExt = strtolower($this->sExtension());
            $aScriptExtensions = array("js", "php", "php4", "php5", "phtml", "shtml", "asp", "jsp", "sh");
            if ($sExt != "" && in_array($sExt, $aScriptExtensions, false)) return false;
        }
        return $bOK;
    }

    function removeLastComponent() {
        $iPos = 0;

        if ($this->sPath && $this->sPath != "/") {
            if (substr($this->sPath, -1) == "/") $this->sPath = substr($this->sPath, 0, strlen($this->sPath) - 1);
            $iPos = strrpos($this->sPath, "/");
            if ($iPos !== false) {
                if ($iPos == 0) $this->sPath = "/";
                else $this->sPath = substr($this->sPath, 0, $iPos);
            }
            else {
                $this->sPath = "";
            }
        }
    }

    function addComponent($s) {
        if (substr($this->sPath, -1) != "/") $this->sPath .= "/";
        $this->sPath .= $s;
    }

    function normalize() {
        $sPath = $this->sPath;
        if ($sPath[0] != "/") return; // can only normalize absolute pathes
        if (substr($sPath, -2) == "..") $sPath .= "/";
        $iPos = 0;
        while($iPos < strlen($sPath)) {
            if (substr($sPath, $iPos, 4) == "/../") {
                $iBackPos = webyep_strpos_backwards($sPath, "/", $iPos-1);
                $sPath = substr($sPath, 0, $iBackPos) . "/" . substr($sPath, $iPos+4);
                $iPos = $iBackPos;
            }
            else $iPos++;
        }
        $this->sPath = $sPath;
    }

    function sExtension() {
        $sExt = "";

        $iDotPos = strrpos($this->sPath, ".");
        $iSlashPos = strrpos($this->sPath, "/");
        if ($iDotPos) {
            if ($iSlashPos === false || $iSlashPos < $iDotPos) {
                $sExt = substr($this->sPath, $iDotPos + 1);
            }
        }
        return $sExt;
    }

    function sBasename() {
        return basename($this->sPath);
    }

    function setExtension($sExt) {
        $this->removeExtension();
        $this->sPath .= ".$sExt";
    }

    function removeExtension() {
        $iDotPos = strrpos($this->sPath, ".");
        $iSlashPos = strrpos($this->sPath, "/");
        if ($iDotPos) {
            if ($iSlashPos === false || $iSlashPos < $iDotPos) {
                $this->sPath = substr($this->sPath, 0, $iDotPos);
            }
        }
    }

    function bExists() {
        return file_exists($this->sPath);
    }

    function removeDemoSlotID() {
        global $webyep_sLiveDemoSlotID;
        $this->sPath = preg_replace('|/' . WEBYEP_DEMOSLOT_PREFIX . '([end]{2})([0-9]+)/|', "/", $this->sPath);
        if ($webyep_sLiveDemoSlotID != "") $this->sPath = str_replace("_$webyep_sLiveDemoSlotID", "", $this->sPath);
    }
}
?>
