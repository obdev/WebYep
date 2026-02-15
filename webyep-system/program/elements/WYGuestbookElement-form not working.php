<?php
// Include the necessary WebYep library
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

// Define the constants for the Guestbook
define("WY_GUESTBOOK_VERSION", 1);
define("WY_DK_GB_ENTRIES", "ENTRIES");
define("WY_DK_GB_BLOCKED_IPS", "BLOCKED_IPS");
define("WY_DK_GB_ID", "ID");
define("WY_DK_GB_TIME", "TIME");
define("WY_DK_GB_NAME", "NAME");
define("WY_DK_GB_EMAIL", "EMAIL");
define("WY_DK_GB_MESSAGE", "MESSAGE");
define("WY_DK_GB_IP", "CLIENT_IP");
define("WY_QK_GB_ID", "WEBYEP_GB_ID");
define("WY_QK_GB_NAME", "WEBYEP_GB_NAME");
define("WY_QK_GB_EMAIL", "WEBYEP_GB_EMAIL");
define("WY_QK_GB_MESSAGE", "WEBYEP_GB_MESSAGE");
define("WY_QK_GB_MAGIC", "WEBYEP_GB_MAGIC");
define("WY_QK_GB_IP", "CLIENT_IP");
define("WY_QV_GB_REMOVE", "GB_REMOVE");
define("WY_QV_GB_BLOCK", "GB_BLOCK");
define("WY_QV_GB_UNBLOCK", "GB_UNBLOCK");
define("WY_QV_GB_MAGIC", "4711");
define("WY_GB_CSS_ALL", "WebYepGBEntry");
define("WY_GB_CSS_NAME", "WebYepGBName");
define("WY_GB_CSS_DATETIME", "WebYepGBDateTime");
define("WY_GB_CSS_EMAIL", "WebYepGBEMail");
define("WY_GB_CSS_MESSAGE", "WebYepGBMessage");

// Check if the function is already declared to prevent re-declaration
if (!function_exists('webyep_guestbook')) {
    // Define the function for displaying the guestbook
    function webyep_guestbook($sFieldName, $iMaxEntries, $sOwnerEMail = "", $bHide = false)
    {
        global $goApp;

        $o = new WYGuestbookElement($sFieldName, $iMaxEntries, $sOwnerEMail, $bHide);
        $s = $o->sDisplay();
        echo $s;
    }
}

// Define the WYGuestbookElement class
class WYGuestbookElement extends WYElement
{
    var $sEMail;
    var $iMaxEntries;
    var $bHideEMailAddresses;

    // Constructor method
    public function __construct($sN, $iMax, $sEMail, $bHide)
    {
        parent::__construct($sN, false);
        $this->iMaxEntries = $iMax;
        $this->sEMail = $sEMail;
        $this->bHideEMailAddresses = $bHide;
        $this->sEditorPageName = "#"; // no editor
        $this->setVersion(WY_GUESTBOOK_VERSION);
        if (!isset($this->dContent[WY_DK_GB_ENTRIES])) $this->dContent[WY_DK_GB_ENTRIES] = [];
        if (!isset($this->dContent[WY_DK_GB_BLOCKED_IPS])) $this->dContent[WY_DK_GB_BLOCKED_IPS] = [];
    }
    
    public function sFieldNameForFile()
    {
        $s = parent::sFieldNameForFile();
        $s = "gb-" . $s;
        return $s;
    }
    
    private function _sEMailLink($sE)
    {
        $WYLongTextElement = new WYLongTextElement(); 
        if ($this->bHideEMailAddresses) return $WYLongTextElement->_sFormatEMailLinks($sE);
        else return "<a href='mailto:$sE'>" . webyep_sHTMLEntities($sE) . "</a>";
    }

    private function bIDUsed($iID)
    {
        $b = false;
        foreach ($this->dContent[WY_DK_GB_ENTRIES] as $d) {
            if ($d[WY_DK_GB_ID] == $iID) {
                $b = true;
                break;
            }
        }
        return $b;
    }

    private function sCleanupUserInput($s)
    {
        $s = strip_tags($s);
        $s = str_replace("<", "", $s);
        $s = str_replace(">", "", $s);
        $s = str_replace("\0", "", $s);
        return $s;
    }

    public function bAddEntry($sName, $sEMail, $sMessage)
    {
        global $goApp;
        $b = true;
        $dEntry = [];
        $iID = 0;
        $iTime = time();
        $aEntries = &$this->dContent[WY_DK_GB_ENTRIES];
        $aBlockedIPs = &$this->dContent[WY_DK_GB_BLOCKED_IPS];
        $sIP = $goApp->sClientIP();

        if ($sIP && in_array($sIP, $aBlockedIPs, true)) {
            return false;
        }

        while ($this->bIDUsed($iID = mt_rand(1, 100000))) ;

        $sName = $this->sCleanupUserInput($sName);
        $sEMail = $this->sCleanupUserInput($sEMail);
        $sMessage = $this->sCleanupUserInput($sMessage);

        $dEntry = [
            WY_DK_GB_ID => $iID,
            WY_DK_GB_TIME => $iTime,
            WY_DK_GB_NAME => $sName,
            WY_DK_GB_EMAIL => $sEMail,
            WY_DK_GB_MESSAGE => $sMessage,
            WY_DK_GB_IP => $sIP
        ];

        array_unshift($aEntries, $dEntry);
        while (count($aEntries) && (count($aEntries) > $this->iMaxEntries)) array_pop($aEntries);
        $this->save();
        
        if ($this->sEMail) {
            $sFrom = $this->sEMail;
            $sSubject = sprintf(WYTS("GuestbookMailSubject"), WYApplication::sHTTPHost());
            $oPageURL = od_clone(WYURL::oCurrentURL());
            $oPageURL->dQuery[WY_QK_EDITMODE] = "yes" . mt_rand(1000, 9999);
            $sText  = "********************************************************\n";
            $sText .= "* $sSubject\n";
            $sText .= "********************************************************\n\n";
            $sText .= WYTS("AtDate") . " " . sWYTDate($iTime) . " " . WYTS("AtTime") . " " . sWYTTime($iTime) . "\n\n";
            $sText .= str_replace("\\n", "\n", sprintf(WYTS("GuestbookMailText"), $sName, $sEMail, $sMessage));
            $sText .= "\n\n";
            $sText .= $oPageURL->sURL(true, true, true) . "\n\n";
            $sText .= "********************************************************\n\n";
            @mail($this->sEMail, $sSubject, $sText, "From: $sFrom");
        }
        return $b;
    }
    
    public function removeEntry($iID)
    {
        $i = 0;
        foreach ($this->dContent[WY_DK_GB_ENTRIES] as $d) {
            if ($d[WY_DK_GB_ID] == $iID) {
                array_splice($this->dContent[WY_DK_GB_ENTRIES], $i, 1);
                break;
            }
            $i++;
        }
        $this->save();
    }

    public function blockIP($s)
    {
        $a = &$this->dContent[WY_DK_GB_BLOCKED_IPS];
        
        if (!in_array($s, $a, true)) {
            $a[] = $s;
            $this->save();
        }
    }
    
    public function unblockIP($s)
    {
        $a = &$this->dContent[WY_DK_GB_BLOCKED_IPS];
        if (in_array($s, $a, true)) {
            $iPos = array_search($s, $a, true);
            array_splice($a, $iPos, 1);
            $this->save();
        }
    }

    public function sDisplay()
    {
        global $goApp, $webyep_sModalWindowType;
        
        $s = "";
        $aEntries = &$this->dContent[WY_DK_GB_ENTRIES];
        $dEntry = [];
        $sName = $sEMail = $sMessage = $sClientIP = "";
        $iTime = $iID = 0;
        
        if ($goApp->sFormFieldValue(WY_QK_GB_MAGIC, "") === WY_QV_GB_MAGIC && ($sMessage = $goApp->sFormFieldValue(WY_QK_GB_MESSAGE, ""))) {
            $sName = $goApp->sFormFieldValue(WY_QK_GB_NAME, "");
            $sEMail = $goApp->sFormFieldValue(WY_QK_GB_EMAIL, "");
            if (!$this->bAddEntry($sName, $sEMail, $sMessage)) {
                if ($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'jquery' || $webyep_sModalWindowType == 'scriptaculous') {
                    $s .= sprintf('<script type="text/javascript">'.$goApp->sAlertWindowMW('"'.WYTS("IPIsBlocked").'"').'</script>');    
                } else {
                    $s .= sprintf("<script type=\"text/javascript\"> alert(\"%s\"); </script>", WYTS("IPIsBlocked"));
                }
            }
        }

        if ($goApp->bEditMode) {
            if ($goApp->sCurrentAction() === WY_QV_GB_REMOVE) {
                $iID = $goApp->sFormFieldValue(WY_QK_GB_ID, 0);
                $this->removeEntry($iID);
            }
            if ($goApp->sCurrentAction() === WY_QV_GB_BLOCK) {
                $sIP = $goApp->sFormFieldValue(WY_QK_GB_IP, 0);
                $this->blockIP($sIP);
            }
            if ($goApp->sCurrentAction() === WY_QV_GB_UNBLOCK) {
                $sIP = $goApp->sFormFieldValue(WY_QK_GB_IP, 0);
                $this->unblockIP($sIP);
            }
        }
        
        foreach ($aEntries as $dEntry) {
            $sName = $dEntry[WY_DK_GB_NAME] ?? '';
            $sEMail = $dEntry[WY_DK_GB_EMAIL] ?? '';
            $sMessage = $dEntry[WY_DK_GB_MESSAGE] ?? '';
            $sClientIP = $dEntry[WY_DK_GB_IP] ?? '';
            $iTime = $dEntry[WY_DK_GB_TIME] ?? 0;
            $iID = $dEntry[WY_DK_GB_ID] ?? 0;
            $s .= "<div class='" . WY_GB_CSS_ALL . "'>";

            if ($goApp->bEditMode) {
                $oCurrentURL = new WYURL(); 
                $oURL = od_clone($oCurrentURL->oCurrentURL());
                $oImgURL = od_clone($goApp->oImageURL);
                $dEditorQuery = $this->dEditorQuery;
                $dEditorQuery[WY_QK_GB_ID] = $iID;
                $goApp->setActionInQuery($dEditorQuery, WY_QV_GB_REMOVE);
                $oURL->setQuery(array_merge($oURL->dQuery, $dEditorQuery));
                $oLink = new WYLink($oURL, WYTS("GuestbookRemoveButton"));
                $oImgURL->addComponent("remove-button.png");
                $oImg = new WYImage($oImgURL);
                $oLink->setInnerHTML($oImg->sDisplay());
                $oLink->setAttribute("onclick", "return confirm(\"" . WYTS("GuestbookRemoveConfirm") . "\");");
                $s .= $oLink->sDisplay();
            }

            $s .= "<div>";
            if ($sName) $s .= "<span class='" . WY_GB_CSS_NAME . "'>" . webyep_sHTMLEntities($sName) . "</span>";
            if ($sEMail) $s .= ($sName ? " ":"") . "<span class='" . WY_GB_CSS_EMAIL . "'>(" . $this->_sEMailLink($sEMail) . ")</span>";
            if ($sName || $sEMail) $s .= ", ";
            $s .= "<span class='" . WY_GB_CSS_DATETIME . "'>" . WYTS("AtDate") . " " . sWYTDate($iTime) . " " . WYTS("AtTime") . " " . sWYTTime($iTime) . "</span>:</div>\n";
            if ($goApp->bEditMode) {
                $s .= "<div class='" . WY_GB_CSS_MESSAGE . "'>";
                $s .= WYTS("ClientIP") . ": ";
                $bIsBlocked = in_array($sClientIP, $this->dContent[WY_DK_GB_BLOCKED_IPS], true);
                if ($sClientIP) {
                    if (!$bIsBlocked) {
                        $oURL = od_clone(WYURL::oCurrentURL());
                        $oImgURL = od_clone($goApp->oImageURL);
                        $dEditorQuery = $this->dEditorQuery;
                        $dEditorQuery[WY_QK_GB_IP] = $sClientIP;
                        $goApp->setActionInQuery($dEditorQuery, WY_QV_GB_BLOCK);
                        $oURL->setQuery($dEditorQuery);
                        $oLink = new WYLink($oURL, WYTS("GuestbookBlockButton"));
                        $oImgURL->addComponent("block-button.png");
                        $oImg = new WYImage($oImgURL);
                        $oImg->setAttribute("style", "vertical-align: middle");
                        $oLink->setInnerHTML($oImg->sDisplay());
                        $oLink->setAttribute("onclick", "return confirm(\"" . WYTS("GuestbookBlockConfirm") . "\");");
                    }
                    $s .= $sClientIP;
                    if (!$bIsBlocked) {
                        $s .= "&nbsp;" . $oLink->sDisplay();
                    }
                } else {
                    $s .= WYTS("unknown");
                }
                $s .= "</div>\n";
            }
            $WYLongTextElement = new WYLongTextElement(); 
            $sMessage = str_replace("<", "", $sMessage);
            $sMessage = str_replace(">", "", $sMessage);
            $s .= "<div class='" . WY_GB_CSS_MESSAGE . "'>" . $WYLongTextElement->_sFormatContent($sMessage, $this->bHideEMailAddresses) . "</div>";
            $s .= "</div>\n";
        }
        
        if ($goApp->bEditMode && count($this->dContent[WY_DK_GB_BLOCKED_IPS])) {
            unset($a);
            $a = &$this->dContent[WY_DK_GB_BLOCKED_IPS];

            $s .= "<div class='" . WY_GB_CSS_ALL . "'>";
            $s .= "<strong>" . WYTS("BlockedIPs") . ":</strong><br />\n";

            $oURL = od_clone(WYURL::oCurrentURL());
            $dEditorQuery = $this->dEditorQuery;
            $goApp->setActionInQuery($dEditorQuery, WY_QV_GB_UNBLOCK);
            $oURL->setQuery($dEditorQuery);
            $oImgURL = od_clone($goApp->oImageURL);
            $oImgURL->addComponent("unblock-button.png");
            $oImg = new WYImage($oImgURL);
            $oImg->setAttribute("style", "vertical-align: middle");
            
            foreach ($a as $sIP) {
                $oURL->dQuery[WY_QK_GB_IP] = $sIP;
                $oLink = new WYLink($oURL, WYTS("GuestbookUnBlockButton"));
                $oLink->setInnerHTML($oImg->sDisplay());
                $oLink->setAttribute("onclick", "return confirm(\"" . WYTS("GuestbookUnBlockConfirm") . "\");");
                $s .= $sIP . "&nbsp;" . $oLink->sDisplay() . "<br />\n";
            }
            $s .= "</div>";
        }

        return $s;
    }
}
?>
