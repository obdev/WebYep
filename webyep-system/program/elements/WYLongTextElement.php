<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_LONGTEXT_VERSION", 1);

// public API

function webyep_sLongTextContent($sFieldName, $bGlobal) {
    $o = new WYLongTextElement($sFieldName, $bGlobal, false);
    return $o->sText();
}

function webyep_longText($sFieldName, $bGlobal, $deprecated1 = "", $bHide = false, $mwEditorWidth=520, $mwEditorHeight=450) {
	global $webyep_oCurrentLoop; static $j=0;
		$loopArr=$webyep_oCurrentLoop->dContent['CONTENT'];
		$loopVal=floor($j/1); 
		$loopid=$loopArr[$loopVal];
	if(!empty($webyep_oCurrentLoop)){
	 $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
	}

    (new WYLongTextElement())->webyep_longText($sFieldName, $bGlobal, $deprecated1, $bHide, $mwEditorWidth, $mwEditorHeight);
$j++;
}

// ----------------------------------------------

class WYLongTextElement extends WYElement {
    // instance variables
    var $bHideEMailAddress;

    function webyep_longText($sFieldName, $bGlobal, $deprecated1 = "", $bHide = false, $mwEditorWidth, $mwEditorHeight) {
       
        $o = new WYLongTextElement($sFieldName, $bGlobal, $bHide, $mwEditorWidth, $mwEditorHeight);
	global $goApp;global $webyep_oCurrentLoop; 
		//echo $webyep_oCurrentLoop->iLoopID;
//print_r($o);
        $s = $o->sDisplay();
        if ($goApp->bEditMode) {
            echo $o->sEditButtonHTML("edit-button-long-text.png");
            if (!$s) $s = $o->sName;
        }
        echo $s;

    }

    //function WYLongTextElement($sN, $bG, $bHide, $mwEditorWidth=520, $mwEditorHeight=450)
    function __construct($sN='', $bG='', $bHide='', $mwEditorWidth='520', $mwEditorHeight='450') {
        global $goApp;
        parent::__construct($sN, $bG);
        $this->sEditorPageName = $goApp->bIsiPhone ? "long-text-iphone.php":"long-text.php";
        $this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:520;
        $this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:450;
        $this->sEditButtonCSSClass = "WebYepLongTextEditButton";
        $this->bHideEMailAddress = $bHide;
        $this->setVersion(WY_LONGTEXT_VERSION);
        if (!isset($this->dContent[WY_DK_CONTENT])) $this->dContent[WY_DK_CONTENT] = "";
    }

    function sFieldNameForFile() {
        $s = parent::sFieldNameForFile();
        $s = "lt-" . $s;
        return $s;
    }

    function sText() {
        return $this->dContent[WY_DK_CONTENT];
    }

    function setText($s) {
        $this->dContent[WY_DK_CONTENT] = $s;
    }

    function _sFormatEMailLinks($sLine) {   // also used by guestbook!
        return preg_replace("/([-a-zA-Z0-9_.]+)@([-a-zA-Z0-9_.]+[-a-zA-Z0-9_])/", "<script type='text/javascript'>\n/* <![CDATA[ */\ndocument.write(\"<a href='mailto:\\1\"+String.fromCharCode(64)+\"\\2'>\\1\"+String.fromCharCode(64)+\"\\2<\\/a>\");\n/* ]]> */\n</script><noscript><div style=\"display:inline\">\\1(_AT_)\\2</div></noscript>", $sLine);
    }

    function _aSplitTableCells($sLine) {
        $i = 0;
        $iLastStart = 0;
        $iL = strlen($sLine);
        $aCells = array();
        while ($i < $iL) {
            if ($sLine[$i] == '|' && ($i == 0 || $sLine[$i-1] != '\\')) {
                $iLen = $i - $iLastStart;
                if ($iLen > 0) $aCells[] = substr($sLine, $iLastStart, $iLen);
                else $aCells[] = "";
                $iLastStart = $i + 1;
            }
            $i++;
        }
        $iLen = $i - $iLastStart;
        if ($iLen > 0) $aCells[] = substr($sLine, $iLastStart, $iLen);
        return $aCells;
    }

   static function _sFormatContent($sContent, $bHideEMailAddress) {
       // also used by guestbook as class method - do not use $this->!
        global $goApp, $webyep_sCharset, $webyep_bOpenFullURLsInNewWindow;
        $sHTMLStandard = $goApp->sHTMLStandard();
        $sBR = $sHTMLStandard == "HTML" ? "<br>":"<br />";
        $aOutLines = array();
        $sASCIIBullets = chr(149) . chr(183) . "+";

        if ($sContent) {
            $sContent = str_replace("\r\n", "\n", $sContent);
            $sContent = str_replace("\r", "\n", $sContent);
            $aInLines = explode("\n", $sContent);
        } else {
            $aInLines = array();
        }

        $sOutLine = "";
        $bInLI = false;
        $bInTable = false;
        $bNL = true;
        $sListType = "";
        $iListLevel = 0;
        $iNumLines = count($aInLines);
        $iLine = 0;
        $sTarget = "";
        foreach ($aInLines as $sLine) {
            $bNL = true;
            $sOutLine = "";
            if (preg_match("/^([*$sASCIIBullets]+)[ \t]+/", $sLine, $aReg) && strpos($sLine, "|") == false) { // bullet list item
                if (substr($aReg[1], 0, 1) == "+") $sListType = "ol";
                else $sListType = "ul";
                $iNewListLevel = strlen($aReg[1]);
                $sLine = preg_replace("/^[*$sASCIIBullets]+[ \t]+/", "", $sLine);
                if ($iNewListLevel > $iListLevel) {
                    $sOutLine .= "\n" . "<$sListType>\n";
                } else if ($iNewListLevel < $iListLevel) {
                    $sOutLine .= "</li>\n";
                    while ($iNewListLevel != $iListLevel) {
                        $sOutLine .= "</$sListType>\n";
                        $sOutLine .= "</li>\n";
                        $iListLevel--;
                    }
                } else {
                    $sOutLine .= "</li>\n";
                }

                $iListLevel = $iNewListLevel;
                $sOutLine .= "<li>";
                $bInLI = true;
                $bNL = false;
            }
            else if (trim($sLine) != "" && $iListLevel > 0) { // continued bullet list item
                $sLine = ltrim($sLine); // strip indention
                $sOutLine .= "\n$sBR    ";
                $bNL = false;
            }

            $sLine = webyep_sHTMLEntities($sLine, false);

            $sLine = preg_replace("/<FETT ([^>]*)>/", "<strong>\\1</strong>", $sLine);
            $sLine = preg_replace("/<BOLD ([^>]*)>/", "<strong>\\1</strong>", $sLine);
            $sLine = preg_replace("/<([^>a-z:# ]*) ([^>]*)>/", "<span class='\\1'>\\2</span>", $sLine);

            if ($webyep_bOpenFullURLsInNewWindow) {
                $sTarget = " target='_blank'";
            } else {
                $sTarget = "";
            }
            $sLine = preg_replace("|<LINK: *http(s?)://([^ ]*) ([^>]*)>|", "<a href='HtTp\\1://\\2'$sTarget>\\3</a>", $sLine);
            $sLine = preg_replace("|<LINK: *HTTP(S?)://([^ ]*) ([^>]*)>|", "<a href='HtTp\\1://\\2'$sTarget>\\3</a>", $sLine);

            $sLine = preg_replace("|<LINK: *([^ ]*) ([^>]*)>|", "<a href='\\1'>\\2</a>", $sLine);

            $sLine = preg_replace("{((HTTP)|(http))://([-a-zA-Z0-9_/.~%#?=&;]+[-a-zA-Z0-9_/~%#?=&;])}", "<a href='HtTp://\\4'$sTarget>http://@@\\4</a>", $sLine);
            while (preg_match("|(.*)http://@@([-a-zA-Z0-9_/.~%]+)(.*)|", $sLine, $aReg)) {
                $sLine = $aReg[1] . "http://" . str_replace("/", "/&shy;", $aReg[2]) . $aReg[3];
            }
            $sLine = preg_replace("{((HTTPS)|(https))://([-a-zA-Z0-9_/.~%#?=&;]+[-a-zA-Z0-9_/~%#?=&;])}", "<a href='HtTpS://\\4'$sTarget>https://@@\\4</a>", $sLine);
            while (preg_match("|(.*)https://@@([-a-zA-Z0-9_/.~%]+)(.*)|", $sLine, $aReg)) {
                $sLine = $aReg[1] . "https://" . str_replace("/", "/&shy;", $aReg[2]) . $aReg[3];
            }

            if ($bHideEMailAddress) {
                if (preg_match("|[-a-zA-Z0-9_.]+@[-a-zA-Z0-9_.]+|", $sLine)) {
                    $sLine = WYLongTextElement::_sFormatEMailLinks($sLine);
                }
            } else {
                $sLine = preg_replace('|([-a-zA-Z0-9_.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_])|', "<a href='mailto:\\1'>\\1</a>", $sLine);
            }

            if (preg_match('|^-+$|', $sLine)) {
                $sLine = "<hr style='height:1px; border-right-style:none; border-left-style:none; border-bottom-style:none;'" . ($sHTMLStandard != "HTML" ? " /":"") . ">\n";
                $bNL = false;
            }

            $sOutLine .= $sLine;

            if ($iListLevel > 0 && (trim($sLine) == "" || !preg_match("|[^ \t*$sASCIIBullets]+|", $sLine))) { // end of bullet list
                while ($iListLevel > 0) {
                $sOutLine .= "</li>\n";
                    $sOutLine .= "</$sListType>\n";
                    $iListLevel--;
                    $bInLI = false;
                }
                $bNL = false;
                $bInLI = false;
            }

            if ($iListLevel == 0 && preg_match('/([^\\\\]\|)|(^\|)/', $sOutLine)) {
                $aCells = WYLongTextElement::_aSplitTableCells($sOutLine);
                $sOutLine = "<tr>\n";
                foreach ($aCells as $sCell) {
                   $sCell = trim($sCell);
                        if ($sCell == "") $sCell = "&nbsp;";
                   $sOutLine .= "   <td>$sCell</td>\n";
                }
                $sOutLine .= "</tr>\n";
                if (!$bInTable) {
                   $sOutLine = "<table border='0' cellpadding='0' cellspacing='0'>\n" . $sOutLine;
                   $bInTable = true;
                }
                $bNL = false;
            } else if ($bInTable && !preg_match('/([^\\\\]\|)|(^\|)/', $sOutLine)) {
                $sOutLine = "</table>$sOutLine\n";
                $bInTable = false;
                $bNL = false;
            }

            $sOutLine = preg_replace('/\\\\\|/', '|', $sOutLine);
            $iLine++;
            if ($iLine >= $iNumLines) $bNL = false;
            $aOutLines[] = $sOutLine . ($bNL ? "$sBR\n":"");
        }

        // close everything left open:
        //if ($bInLI) $aOutLines[] = "</li>\n";
        if ($bInLI) $aOutLines[] = "\n";
        while ($iListLevel) {
            $aOutLines[] .= "</$sListType>\n";
            $iListLevel--;
        }
        if ($bInTable) $aOutLines[] = "</table>\n";

        $sContent = join("", $aOutLines);
        $sContent = str_replace("$sBR\n.$sBR", $sHTMLStandard == "HTML" ? "<br clear='all'>":"<br clear='all' />", $sContent);
        $sContent = str_replace("$sBR\n<table>", "\n<table>", $sContent);
        $sContent = str_replace("HtTpS", "https", $sContent);
        $sContent = str_replace("HtTp", "http", $sContent);
        return $sContent;
    }

    function sDisplay() {

        $sContent = "";
        $aInLines = array();
        $aReg = array();
        $sLine = "";
        $iLastLineWasBL = 0;
        $sHTMLBullet = "&bull;";


        $sContent = $this->sText();
        $sContent = $this->_sFormatContent($sContent, $this->bHideEMailAddress);
       return $sContent;

	//$oElement = new WYLongTextElement($oEditor->sFieldName, $oEditor->bGlobal, "");
	//return $oElement->sText();
    }
}
?>
