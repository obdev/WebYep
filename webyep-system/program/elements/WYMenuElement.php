<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");

define("WY_MENU_VERSION", 2); // current version of WYMenu data
define("WY_DK_MAXID", "LIID");
define("WY_DK_ITEMSARRAY", "CONTENT");
define("WY_DK_ITEMID", "ID");
define("WY_DK_ITEMTEXT", "TEXT");
define("WY_QK_MENU_URL", "WEBYEP_MENU_URL");
define("WY_CK_MENU_OPENTREES", "WEBYEP_OPENTREES");

define("WEBYEP_MENU_INDENT", "&nbsp;");
// CSS
define("WEBYEP_MENU_CSS", "WebYepMenu");
define("WEBYEP_MENU_CSS_ITEM", "WebYepMenuItem");
define("WEBYEP_MENU_CSS_CURRENT_ITEM", "WebYepMenuCurrentItem");
define("WEBYEP_MENU_CSS_CURRENT_PATH", "WebYepMenuCurrentPath");
define("WEBYEP_MENU_CSS_FIRST_ITEM", "WebYepMenuFirstItem");
define("WEBYEP_MENU_CSS_TITLE", "WebYepMenuTitle");
define("WEBYEP_MENU_CSS_EXPANDED", "WebYepMenuTitleExpanded");
// Backwards compat. with pre 1.2.2 (menu with divs or tables):
define("WEBYEP_MENU_CSS_SELECTED", "WebYepMenuSelected");
define("WEBYEP_MENU_CSS_SEPERATOR", "WebYepMenuSeperator");

global $webyep_iMenuID;
$webyep_iMenuID = 0;
global $webyep_bMenuJSInserted;
$webyep_bMenuJSInserted = false;

function webyep_menu($sFieldName, $bGlobal, $sURL, $sTarget = "", $sDeprecatedA = "", $sBulletImg = "", $mwEditorWidth=800, $mwEditorHeight=500){
	// $sDeprecatedA: was $sSelectedItemStyle, now non configurable WEBYEP_MENU_CSS_SELECTED
    // $sBulletImg: deprecated as of 1.7.0
    global $goApp;
    $oURL = od_nil;
    $oBulletImg = od_nil;
	global $webyep_oCurrentLoop; 
	if(!empty($webyep_oCurrentLoop)){
	 $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"];
	}
    $oURL = new WYURL($sURL);
    //if ($sBulletImg) $oBulletImg = new WYImage(new WYURL($sBulletImg));
    $o = new WYMenuElement($sFieldName, $bGlobal, $oURL, $sTarget, $oBulletImg, $mwEditorWidth, $mwEditorHeight);
    $sHTML = $o->sDisplay();

    // this should be removed in future versions
    if ($sDeprecatedA) {
        $s = str_replace(WEBYEP_MENU_CSS_SELECTED, $sDeprecatedA, $s);
    }

    if ($goApp->bEditMode) {
        if (!$sHTML) $sHTML = "<div>" . $o->sName . "</div>";
        $sHTML = $o->sEditButtonHTML("edit-button-menu.png", "", od_nil) . $sHTML;
    }
    echo $sHTML;
}


class WYMenuElement extends WYElement
{
    // instance variables
    var $oURL;
    var $sTarget;
    var $sListType;
    var $aCurrentPath;
    var $iLastTitleID;

    // var $oBulletImg; // deprecated as of 1.7.0

    //function WYMenuElement($sN, $bG, $oURL, $sT, $oB, $mwEditorWidth=800, $mwEditorHeight=500)
    function __construct($sN='', $bG='', $oURL='', $sT='', $oB='', $mwEditorWidth='800', $mwEditorHeight='500')
    // don't pass object by ref here: can be od_nil!
    {
        //global $webyep_bUseTablesForMenus;
        parent::__construct($sN, $bG);
        $this->sEditorPageName = "menu.php";
        $this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:800;
        $this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:500;
        $this->sEditButtonCSSClass = "WebYepMenuEditButton";
        $this->aCurrentPath = array();
        $this->aOpenTrees = array();
        $this->aCloseTrees = array();
        $this->iLastTitleID = 0;
        // check for old version
        $this->dConvertData();
        $this->setVersion(WY_MENU_VERSION);
        if (!isset($this->dContent[WY_DK_ITEMSARRAY])) $this->dContent[WY_DK_ITEMSARRAY] = array();
        if (!isset($this->dContent[WY_DK_MAXID])) $this->dContent[WY_DK_MAXID] = 0;
        $this->oURL =& $oURL;
        $this->sTarget = $sT;
        $this->sListType = 'ul';
        $this->getActiveItems($this->dContent[WY_DK_ITEMSARRAY]);
    }

    function bUseDocumentInstance()
    {
        return false;
    }

    function sFieldNameForFile()
    {
        $s = parent::sFieldNameForFile();
        $s = "mu-" . $s;
        return $s;
    }

    function sEditButtonHTML($sButtonImage = "edit-button.png", $sToolTip = "", $oCustomURL = false)
    {
        $this->dEditorQuery = array();
        $this->dEditorQuery[WY_QK_MENU_URL] = $this->oURL ? $this->oURL->sURL(false, false, false):"";
        return parent::sEditButtonHTML($sButtonImage, $sToolTip, $oCustomURL);
    }

    function removeDataForDocIDAndDocInstance($iTargetDocID, $iID)
    {
        $aDataFileNames = WYElement::aDataFileNames();
        $sRegEx = sprintf("|^%d-%d-|", $iTargetDocID, $iID);
        foreach ($aDataFileNames as $sDataFileName) {
            if (preg_match($sRegEx, $sDataFileName)) {
                WYElement::removeDataFileWithName($sDataFileName);
            }
        }
    }

    function removeDataForItem($iID, $sText)
    {
        global $goApp;
        $sURL = "";

        if (!$this->bTitleHasURL($sText, $sURL) || $sURL == "") $sURL = $this->oURL->sURL(false, false, false);
        if (strcasecmp(substr($sURL, 0, 4), "http") == 0 || strcasecmp(substr($sURL, 0, 3), "ftp") == 0) return;
        if (false !== $iQueryPos = strpos($sURL, "?")) $sURL = substr($sURL, 0, $iQueryPos);
        if (false !== $iAnchorPos = strpos($sURL, "#")) $sURL = substr($sURL, 0, $iAnchorPos);
        if ($sURL[0] != "/") { // not an absolute path
            $oDocPath = $goApp->oDocument->oPathForDocumentWithID($goApp->oDocument->iPageID);
            $oDocPath->removeLastComponent();
            $oDocPath->addComponent($sURL);
            $oDocPath->normalize();
            $sFullPath = $oDocPath->sPath;
        }
        else $sFullPath = $sURL;
        $iTargetDocID = $goApp->oDocument->iPageIDForDocumentPath(new WYPath($sFullPath), $iMaxID);
        if ($iTargetDocID) $this->removeDataForDocIDAndDocInstance($iTargetDocID, $iID);
    }

    function setItems($dNewItems)
    // format of new items and current items differs
    // current items: array, values are dicts with two elements: item ID and text
    // new items: dict, key is item ID, value is text
    {
        $sKey = "";
        $sValue = "";
        $dOneItem = array();
        $iMaxID = 0;

        // find out diffs - find deleted items
        $dOldItems = $this->dContent[WY_DK_ITEMSARRAY];
        foreach ($dOldItems as $dEntry) {
            $iID = $dEntry[WY_DK_ITEMID];
            if (!isset($dNewItems[$iID])) { // items was deleted
                $this->removeDataForItem($iID, $dEntry[WY_DK_ITEMTEXT]);
            }
        }

        $this->dContent[WY_DK_ITEMSARRAY] = array();
        foreach ($dNewItems as $sKey => $sValue) {
            // replace leading spaces or underscores by undescores
            // spaces would get lost on next save due to JavaScript's <options> handling
            if (preg_match("|^([ _]+)|", $sValue, $aRes)) {
                $sValue = str_repeat("_", strlen($aRes[1])) . ltrim($sValue, " _");
            }
            $dOneItem[WY_DK_ITEMID] = $sKey;
            $iMaxID = max((int)$sKey, $iMaxID);
            $dOneItem[WY_DK_ITEMTEXT] = $sValue;
            $this->dContent[WY_DK_ITEMSARRAY][] =$dOneItem;
        }
        $this->dContent[WY_DK_MAXID] = $iMaxID;
    }

    function dItems()
    {
        $d = array();
        $dOneItem = array();

        foreach ($this->dContent[WY_DK_ITEMSARRAY] as $dOneItem) {
            $d[$dOneItem[WY_DK_ITEMID]] = $dOneItem[WY_DK_ITEMTEXT];
        }
        return $d;
    }

    function iLastItemID()
    {
        return $this->dContent[WY_DK_MAXID];
    }

    function outputJS()
    {
        global $webyep_bAutoCloseMenus, $webyep_bRememberOpenMenus;
?>
<script type="text/javascript">
/* <![CDATA[ */
var webyep_dOpenMenuTrees;

function webyep_sGetCSSClass(o) {
    var sClass = "";
    sClass = o.getAttribute("class");
    if (sClass == undefined) sClass = o.getAttribute("className");
    if (sClass == undefined) sClass = "";
    return sClass;
}

function webyep_setCSSClass(o, sClass) {
    o.setAttribute("class", sClass);
    o.setAttribute("className", sClass);
}

function webyep_bHasCSSClass(o, sClass) {
    return webyep_sGetCSSClass(o).indexOf(sClass) != -1;
}

function webyep_addCSSClass(o, sClass) {
    var sCurrentClass = webyep_sGetCSSClass(o);
    webyep_setCSSClass(o, sCurrentClass + " " + sClass);
}

function webyep_removeCSSClass(o, sClass) {
    var sCurrentClass = webyep_sGetCSSClass(o);
    var iPos = sCurrentClass.indexOf(sClass);
    if (iPos > 0) {
        var r = new RegExp(sClass);
        sCurrentClass = sCurrentClass.replace(r, "");
        sCurrentClass = sCurrentClass.replace(/  +/, " "); // remove double spaces
        webyep_setCSSClass(o, sCurrentClass);
    }
}

function webyep_getElementsByClassName(sClassName, sTag) {
    var aElements, i, iC, iR = 0, aResult = [];
    aElements = document.getElementsByTagName(sTag);
    iC = aElements.length;
    for (i = 0; i < iC; i++) {
        oElement = aElements[i];
        if (webyep_sGetCSSClass(oElement).indexOf(sClassName) != -1) aResult[iR++] = oElement;
    }
    return aResult;
}

function webyep_oParent(oChild) {
    var o = oChild.parentElement;
    if (o == undefined) o = oChild.parentNode;
    return o;
}

function webyep_bIsParent(oParent, oChild) {
    var oElementsParent = webyep_oParent(oChild);
    var oParentsParent;
    while (oElementsParent && oElementsParent != oParent && (oParentsParent = webyep_oParent(oElementsParent))) {
        oElementsParent = oParentsParent;
    }
    return (oElementsParent == oParent);
}

function webyep_showHideMenuTree(iMenuID, iItemID) {
    var aElements, i, oElement, sClass, oTitleItem, oTitleLink, oTreeElement;
    var sExpandedClass = "<?php echo WEBYEP_MENU_CSS_EXPANDED; ?>";
    var bAutoClose = <?php echo $webyep_bAutoCloseMenus ? "true":"false"; ?>;
    var bDidOpen = false;

    oTitleItem = document.getElementById("WYMUTITLE" + iMenuID + iItemID);
    oTitleLink = oTitleItem.getElementsByTagName("a")[0];
    oTreeElement = document.getElementById("WYMUTREE_" + iMenuID + "_" + iItemID);
    if (webyep_bHasCSSClass(oTitleItem, sExpandedClass)) {
        webyep_removeCSSClass(oTitleItem, sExpandedClass);
        webyep_removeCSSClass(oTitleLink, sExpandedClass);
        oTreeElement.style.display = "none";
    } else {
        if (bAutoClose) {
            aElements = webyep_getElementsByClassName("WYMUTREE_", "ul");
            for (i = 0; i < aElements.length; i++) {
                if (!webyep_bIsParent(aElements[i], oTitleItem)) aElements[i].style.display = "none";
            }
            aElements = webyep_getElementsByClassName(sExpandedClass, "li");
            for (i = 0; i < aElements.length; i++) {
                if (!webyep_bIsParent(aElements[i], oTitleItem)) webyep_removeCSSClass(aElements[i], sExpandedClass);
            }
            aElements = webyep_getElementsByClassName(sExpandedClass, "a");
            for (i = 0; i < aElements.length; i++) {
                if (!webyep_bIsParent(webyep_oParent(aElements[i]), oTitleItem)) webyep_removeCSSClass(aElements[i], sExpandedClass);
            }
        }

        webyep_addCSSClass(oTitleItem, sExpandedClass);
        webyep_addCSSClass(oTitleLink, sExpandedClass);
        oTreeElement.style.display = "block";

        bDidOpen = true;
    }

    return bDidOpen;
}

function webyep_menuItemClick(iMenuID, sURL, sTarget) {
    var aElements, i, sClass, oElement, oTarget;
<?php if ($webyep_bRememberOpenMenus) { ?>
    var aElements, oElement, rExp;
    aElements = document.all||document.getElementsByTagName("ul");
    rExp = /WYMUTREE_([0-9]+)/;
    dCookieValues = new Object();
    for (i = 0; i < aElements.length; i++) {
        oElement = aElements[i];
        aMatches = rExp.exec(webyep_sGetCSSClass(oElement));
        if (aMatches != null) {
            iThisMenuID = aMatches[1];
            sCookieName = "<?php echo WY_CK_MENU_OPENTREES; ?>" + "_" + iThisMenuID;
            if (dCookieValues[sCookieName] == undefined) dCookieValues[sCookieName] = "";
            if (oElement.style.display != undefined && oElement.style.display!= "none") {
                dCookieValues[sCookieName] += oElement.id + "|";
            }
        }
    }
    for (sCookieName in dCookieValues) {
        document.cookie = sCookieName + "=" + dCookieValues[sCookieName];
    }
<?php } ?>
    if (sTarget == undefined || sTarget == "" || sTarget == "_self") {
        document.location = sURL;
    } else {
        if ((oTarget = frames[sTarget]) != undefined && oTarget.document != undefined) oTarget.document.location = sURL;
        else if ((oTarget = document.getElementById(sTarget)) != undefined && oTarget.document != undefined) oTarget.document.location = sURL;
        else if (parent.frames != undefined && parent.frames[sTarget] != undefined) parent.frames[sTarget].document.location = sURL;
        else {
            var oW = window.open(sURL, sTarget, "");
            oW.focus();
        }
    }
}
/* ]]> */
</script>
<?php
    }

    function sDisplay()
    {
        global $webyep_iMenuID;

        $sHTML = $this->sDisplayAsList();
        $webyep_iMenuID++;
        return $sHTML;
    }

    function _bIsCurrentEntry($iDI, $sExplicitURL = "") {
        // remove DOC_INST=0 from URL and set DI=0
        if (preg_match('|DOC_INST=0|', $sExplicitURL)) {
            $sExplicitURL = preg_replace('|DOC_INST=0|', '', $sExplicitURL);
            $sExplicitURL = preg_replace('|[\?&]$|', '', $sExplicitURL);
            $sExplicitURL = preg_replace('|&&|', '', $sExplicitURL);
            $sExplicitURL = preg_replace('|\?&|', '?', $sExplicitURL);
            $iDI = 0;
        }

        global $goApp;

$oCurrentURL = new WYURL(); 

        $bIsCurrent = false;
     $oCurrentURL = $oCurrentURL->oCurrentURL();
 //$oCurrentURL = $this;
        $sCurrentURL = $oCurrentURL->sURL(true, true, true);
        if ($sExplicitURL) {
            $bIsTargetPage = strpos($sCurrentURL, $sExplicitURL) !== false;
            $bIsCurrent = $bIsTargetPage && $iDI == $goApp->oDocument->iDocumentInstance();
        } else {
            $oFullTargetURL = od_clone($this->oURL); // target page of menu element
            $oFullTargetURL->makeSiteRelative();     //
            $oFullTargetURL->dQuery = array();       // remove query params from target page (just to be sure)
            $oCurrentURL->dQuery = array();          // remove query params from this request
            $bIsTargetPage = $oFullTargetURL->sURL() == $oCurrentURL->sURL();
            $bIsCurrent = $bIsTargetPage && $iDI == $goApp->oDocument->iDocumentInstance();
        }
        /*
        $goApp->log("_bIsCurrentEntry($iDI,'$sExplicitURL') ... sCurrentURL:".($oCurrentURL->sURL())
                    ." ... bIsTargetPage:".($bIsTargetPage ? 'true' : 'false')
                    ." ... DI:".($goApp->oDocument->iDocumentInstance())." (this:$iDI)"
                    ." ... oFullTargetURL:".(isset($oFullTargetURL) ? $oFullTargetURL->sURL() : '')
                    ." ... return:".($bIsCurrent ? 'true' : 'false')
                   );
        */
        return $bIsCurrent;
    }

    function bTitleHasURL(&$sText, &$sURL)
    {
        if (substr($sText, 0, 1) == "#") $sText = substr($sText, 1);
        if (($iHashPos = strpos($sText, "#")) !== false) {
            $sURL = substr($sText, $iHashPos + 1);
            $sText = substr($sText, 0, $iHashPos);
            $bHasURL = true;
        }
        else {
            $bHasURL = false;
            $sExplicitURL = "";
        }
        return $bHasURL;
    }

    function sDisplayAsList()
    {
        global $goApp, $webyep_iMenuID, $webyep_bUseJavaScriptMenus, $webyep_bMenuJSInserted, $webyep_bAutoCloseMenus, $webyep_bOpenFullURLsInNewWindow;
        $sHTML = "";
        $aEntries = $this->dContent[WY_DK_ITEMSARRAY];
        $sListType = "ul";
        $bFirstTitle = true;
        $sCookieName = WY_CK_MENU_OPENTREES . "_" . $webyep_iMenuID;
        if (isset($_COOKIE[$sCookieName])) {
            $this->aOpenTrees = explode("|", $_COOKIE[$sCookieName]);
        } else {
            $this->aOpenTrees = array();
        }
        if (count($aEntries)) {
            if (!$webyep_bMenuJSInserted && $webyep_bUseJavaScriptMenus) {
                $this->outputJS();
                $webyep_bMenuJSInserted = true;
            }
            $sHTML .= $this->buildHtmlTree($aEntries) . "\n";
            // script to close non-active trees
            if ($webyep_bUseJavaScriptMenus) {
                $sHTML .= "<script type=\"text/javascript\">/*<![CDATA[*/\n";
                foreach ($this->aCloseTrees as $iID) {
                    $sHTML .= "webyep_showHideMenuTree($webyep_iMenuID, $iID);\n";
                }
                $sHTML .= "/*]]>*/</script>\n";
            }
        }
        return $sHTML;
    }

    /**
     * Recursive function to determine all parent items of the current entry.
     * Also useful for displaying a breadcrumb trail.
     *
     * @param  mixed   $subtree The (nested) dictionary, containing the menu data
     * @return boolean          Did we find the current item?
     */
    function getActiveItems($subtree) {
        $found = false;
        $iLevel = count($this->aCurrentPath);
        foreach ($subtree as $dEntry) {
            if ($found) return true;
            if ($dEntry['VISIBLE']) {
                $this->aCurrentPath[$iLevel] = $dEntry['ID'];
                if ($this->_bIsCurrentEntry($dEntry[WY_DK_ITEMID], $dEntry['URL'])) {
					//echo '<pre>';
					//print_r($this);
                    $found = true;
                }
                if (count($dEntry['SUBITEMS']) && !$found) {
                    $found = $this->getActiveItems($dEntry['SUBITEMS']);
                }
            }
        }
        if (!$found) unset($this->aCurrentPath[$iLevel]);
        return $found;
    }

    /**
     * Recursive function to build an HTML tree from a nested dictionary (v2)
     *
     * @param  mixed  $subtree The (nested) dictionary, containing the menu data
     * @return string          Nested list (HTML)
     */
    function buildHtmlTree($subtree) {
        global $goApp, $webyep_iMenuID, $webyep_bUseJavaScriptMenus, $webyep_bMenuJSInserted,
               $webyep_bAutoCloseMenus, $webyep_bOpenFullURLsInNewWindow, $webyep_bTitleAlwaysOpensPage;
        $sElementID = "WYMUTREE_${webyep_iMenuID}_" . $this->iLastTitleID;

        if ($this->iLastTitleID != 0 && !in_array($this->iLastTitleID, $this->aCurrentPath) && !in_array($sElementID, $this->aOpenTrees)) {
            $this->aCloseTrees[] = $this->iLastTitleID;
        }

        if ($this->iLastTitleID == 0) { // first ul doesn't get an ID
            $sHTML = "\n<" . $this->sListType . ' class="' . WEBYEP_MENU_CSS . "\">\n";
        } else {
            $sHTML = "\n<" . $this->sListType . ' class="' . WEBYEP_MENU_CSS . " WYMUTREE_$webyep_iMenuID\" id=\"$sElementID\">\n";
        }
        $iEntryNr = 0;
        foreach ($subtree as $dEntry) {
            $iEntryNr++;
            $aClass = array(WEBYEP_MENU_CSS_ITEM);
            $bIsTitle = count($dEntry['SUBITEMS']) ? true : false;
            $bUseTitleAsItem = false;
            $bIsCurrentEntry = false;
            if ($dEntry['VISIBLE']) {
                if ($dEntry['URL']) {
                    $oURL = new WYURL($dEntry['URL']);
                    $bOpenInNewWindow = $webyep_bOpenFullURLsInNewWindow && WYURL::bIsAbsolute($dEntry['URL']);
                    $bUseTitleAsItem = true;
                } else {
                    $oURL = od_clone($this->oURL);
                }
                // new feature: suppress DI, if user specifies somepage.php?DOC_INST=0 in URL field
                if (!isset($oURL->dQuery[WY_QK_DI]) || $oURL->dQuery[WY_QK_DI] > 0) {
                    $oURL->dQuery[WY_QK_DI] = $dEntry[WY_DK_ITEMID]; // overwrite existing DI, otherwise we could not delete those contents!
                    if ($webyep_bTitleAlwaysOpensPage) $bUseTitleAsItem = true;
                } else {
                    unset($oURL->dQuery[WY_QK_DI]); // really dispose
                }
                $sURL = $oURL->sEURL(true, true, $dEntry['URL'] != "");
                // is this entry expanded?
                if (!$webyep_bUseJavaScriptMenus || in_array($dEntry[WY_DK_ITEMID], $this->aCurrentPath) || in_array($sElementID, $this->aOpenTrees)) {
                    $bIsExpanded = true;
                }
                // CSS
                $bIsCurrentEntry = $this->_bIsCurrentEntry($dEntry[WY_DK_ITEMID], $dEntry['URL']);
                if (!$bIsCurrentEntry && in_array($dEntry[WY_DK_ITEMID], $this->aCurrentPath)) $aClass[] = WEBYEP_MENU_CSS_CURRENT_PATH;
                if ($bIsCurrentEntry) $aClass[] = WEBYEP_MENU_CSS_CURRENT_ITEM;
                if ($iEntryNr == 1) $aClass[] = WEBYEP_MENU_CSS_FIRST_ITEM;
                if ($bIsTitle) {
                    unset($aClass[0]); // no WEBYEP_MENU_CSS_ITEM for titles
                    $aClass[] = WEBYEP_MENU_CSS_TITLE;
                    $aClass[] = WEBYEP_MENU_CSS_EXPANDED;
                }
                $sClass = implode(' ', $aClass);
                // assemble HTML
                $sText = str_replace("\\", "<br />", webyep_sHTMLEntities($dEntry['TITLE']));
                $sID = $bIsTitle ? ' id="WYMUTITLE' .$webyep_iMenuID.$dEntry[WY_DK_ITEMID]. '"' : '';
                $sHTML .= '<li class="' . $sClass . '"' . $sID . '>';
               @$sHTML .= $this->buildLink($bIsTitle, $bUseTitleAsItem, $bIsExpanded, $sClass, $dEntry[WY_DK_ITEMID], $sText, $sURL);
                if ($bIsTitle) {
                    $this->iLastTitleID = $dEntry[WY_DK_ITEMID];
                    $sHTML .= $this->buildHtmlTree($dEntry['SUBITEMS']);
                }
                $sHTML .= "</li>\n";
            }
        }
        $sHTML .= '</' . $this->sListType . ">\n";
        return $sHTML;
    }

    /**
     * Build the clickable part of every menu item
     *
     * @param  boolean $bIsTitle
     * @param  boolean $bUseTitleAsItem
     * @param  boolean $bIsExpanded
     * @param  string  $sClass
     * @param  integer $iItemID
     * @param  string  $sText
     * @param  string  $sURL
     * @return string  HTML anchor with bells and whistles
     */
    function buildLink($bIsTitle, $bUseTitleAsItem, $bIsExpanded, $sClass, $iItemID, $sText, $sURL) {
        global $webyep_bUseJavaScriptMenus, $webyep_bAutoCloseMenus, $webyep_bTitleAlwaysOpensPage, $webyep_iMenuID;
        $sLink = "MISSING LINK";
        $sTargetAtt = $this->sTarget ? (" target='" . $this->sTarget . "'"):"";
        if ($bIsTitle) {
		
            if ($bUseTitleAsItem) { // this is a title and it also has a URL
			
                if (!$bIsExpanded || !$webyep_bAutoCloseMenus) {
                    $sTitleJS = "if (webyep_showHideMenuTree($webyep_iMenuID, $iItemID)) {webyep_menuItemClick($webyep_iMenuID, \"$sURL\", \"" . $this->sTarget ."\") } return false;";
                
                print_r( $sTitleJS);
                
                } else {
                    $sTitleJS = "webyep_menuItemClick($webyep_iMenuID, \"$sURL\", \"" . $this->sTarget ."\"); return false;";
                }
            } else { // title without a URL
                $sTitleJS = "webyep_showHideMenuTree($webyep_iMenuID, $iItemID); return false;";
            }

            if ($webyep_bUseJavaScriptMenus) {
                $sLink = "<a class=\"$sClass\" href=\"javascript:void(0)\" onclick='$sTitleJS'>$sText</a>";
            } else {
                // if title is also a link and JS is off, create href
                $sHref = $webyep_bTitleAlwaysOpensPage ? $sURL : 'javascript:void(0)';
                $sLink = "<a class=\"$sClass\" href=\"$sHref\"$sTargetAtt>$sText</a>"; // this will never expand
            }
        } else {
            if ($webyep_bUseJavaScriptMenus) {
                $sLink = "<a class=\"$sClass\" href=\"$sURL\" onclick=\"webyep_menuItemClick($webyep_iMenuID, '$sURL', '" . $this->sTarget ."'); return false;\">$sText</a>";
            } else {
                $sLink = "<a class=\"$sClass\" href=\"$sURL\"$sTargetAtt>$sText</a>";
            }
        }
        return $sLink;
    }

    /**
     * Convert old data format to current version
     *
     * @param  mixed $data The unserialized DataFile
     */
    function dConvertData() {
        global $goApp;
        if ($this->iVersion() < WY_MENU_VERSION) {
            $data = $this->dContent;
            if ($this->iVersion() == 1) { // convert to v2
                $goApp->log('WYMenuElement: converting from v1 to v2');
                $tmpData = array(WY_DK_MAXID => $data['LIID'], WY_DK_ITEMSARRAY => array());
                $lastLevel  = 0;
                $lastParentNode = array();
                $tmpData[WY_DK_ITEMSARRAY] =& $lastParentNode[0];
                $reOldEntry = '/^(%)?(?:#)?(_*)?([^#]+)(?:#)?(.*)?$/';

                foreach ($data['CONTENT'] as $oldEntry) {
                    preg_match($reOldEntry, $oldEntry['TEXT'], $matches);
                    $newEntry = array('ID'       => $oldEntry['ID']
                                     ,'TITLE'    => $matches[3]
                                     ,'URL'      => $matches[4]
                                     ,'VISIBLE'  => $matches[1] == '%' ? 0 : 1
                                     ,'SUBITEMS' => array()
                                     );
                    $currentLevel = strlen($matches[2]);
                    if ($currentLevel > $lastLevel) {
                        unset ($lastParentNode[$currentLevel]);
                        $lastParentNode[$lastLevel][count($lastParentNode[$lastLevel])-1]['SUBITEMS'] =& $lastParentNode[$currentLevel];
                        $lastLevel = $currentLevel;
                    }
                    $lastLevel = $currentLevel;
                    $lastParentNode[$currentLevel][] = $newEntry;
                }
                $data = $tmpData;
            }
            $this->dContent = $data;
        }
    }
}
?>
