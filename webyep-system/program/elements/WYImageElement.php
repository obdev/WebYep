<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYURL.php");

define("WY_IMAGE_VERSION", 2);
define("WY_DK_IMAGEFILENAME", "FILENAME");
define("WY_DK_THUMBNAIL_FILENAME", "THUMBNAIL");
define("WY_DK_URL", "URL");
define("WY_DK_ALTTEXT", "ALTTEXT");
define("WY_QK_IS_THUMB", "IS_THUMB");
define("WY_QK_IMAGE_DETAIL", "DETAIL");
define("WY_QK_IMAGE_ALTTEXT", "ALTTEXT");
define("WY_QK_IMAGE_DEMOCONTENT", "DEMOCONTENT");
// also used by gallery:
define("WY_QK_IMAGE_WIDTH", "IMAGE_WIDTH");
define("WY_QK_IMAGE_HEIGHT", "IMAGE_HEIGHT");
define("WY_QK_THUMB_WIDTH", "THUMB_WIDTH");
define("WY_QK_THUMB_HEIGHT", "THUMB_HEIGHT");

/**
 * public API
 *
 * Diese Funktion wird mittels PHP-PI in der HTML-Seite eingebunden
 * und erzeugt das (im Adminmodus editierbare) Image-Element.
 *
 * @param string    $sFieldName       der Name des Bildes
 * @param boolean   $bGlobal          gibt an, ob der Inhalt dieses Elements für alle Seiten gleich ist
 * @param string    $sAttributes      zusätzliche Attribute für das <img> Element, z.B. 'class="photo" id="p1"'
 * @param string    $sURL             URL zu der das Bild verlinken soll
 * @param string    $sTarget          Ziel-Frame, in dem $sURL aufgerufen werden soll
 * @param int       $iImageWidth      max Breite des Bildes (0 = kein Limit in der Breite)
 * @param int       $iImageHeight     max Höhe des Bildes (0 = kein Limit in der Höhe)
 * @param boolean   $bIsThumb         ist das Bild ein Vorschaubild? (default = false)
 * @param int       $iThumbWidth      max Breite des Vorschaubildes
 * @param int       $iThumbHeight     max Höhe des Vorschaubildes
 * @param int       $mwEditorWidth    Image Editor width
 * @param int       $mwEditorHeight   Image Editor height
 */
function webyep_image($sFieldName, $bGlobal, $sAttributes = "", $sURL = "", $sTarget = "", $iImageWidth = 0, $iImageHeight = 0, $bIsThumb = false, $iThumbWidth = false, $iThumbHeight = false, $mwEditorWidth = 500, $mwEditorHeight = 280)
{
    global $goApp;

    /*   modified code */
    global $webyep_oCurrentLoop; 
    if(!empty($webyep_oCurrentLoop)){
        $webyep_oCurrentLoop->iLoopID = $_SESSION["loopid"] ?? null;
    }
    /*  !  modified code */

    if ($iThumbWidth === false) {
        if ($bIsThumb) {
            $iThumbWidth = $iImageWidth;
            $iImageWidth = 0;
            $iThumbHeight = $iImageHeight;
            $iImageHeight = 0;
        }
        else {
            $iThumbWidth = 0;
            $iThumbHeight = 0;
        }
    }
    $o = new WYImageElement($sFieldName, $bGlobal, $sAttributes, $sURL, $sTarget, $iImageWidth, $iImageHeight, $bIsThumb, $iThumbWidth, $iThumbHeight, $mwEditorWidth, $mwEditorHeight);
    $s = $o->sDisplay();
    if ($goApp->bEditMode) {
        echo $o->sEditButtonHTML("edit-button-image.png", "", $goApp->bIsiPhone ? $o->oIPhoneEditURL():od_nil);
        if (!$s) $s = $o->sName;
    }
    echo $s;
}

/**
 * Erzeugt und verwaltet vom Benutzer editierbare Image-Elemente.
 *
 * Wird verwendet von:
 * - /wy-sys/programm/image-detail.php     (Anzeige der Bilder ohne installierte JS-Bibliothek)
 * - /wy-sys/programm/editors/image.php    (Editor für einzelne Bilder)
 */
class WYImageElement extends WYElement
{
    // instance variables
    var $dAttributes;
    var $sURL;
    var $sTarget;
    var $iImageWidth;
    var $iImageHeight;
    var $bIsThumb;
    var $iThumbWidth;
    var $iThumbHeight;

    /**
     * public API
     *
     * Diese Funktion wird mittels PHP-PI in der HTML-Seite eingebunden
     * und erzeugt das (im Adminmodus editierbare) Image-Element.
     *
     * @param string    $sN               der Name des Bildes
     * @param boolean   $bG               gibt an, ob der Inhalt dieses Elements für alle Seiten gleich ist
     * @param string    $sA               zusätzliche Attribute für das <img> Element, z.B. 'class="photo" id="p1"'
     * @param string    $sU               URL zu der das Bild verlinken soll
     * @param string    $sT               Ziel-Frame, in dem $sURL aufgerufen werden soll
     * @param int       $iW               max Breite des Bildes (0 = kein Limit in der Breite)
     * @param int       $iH               max Höhe des Bildes (0 = kein Limit in der Höhe)
     * @param boolean   $bThumb           ist das Bild ein Vorschaubild? (default = false)
     * @param int       $iTW              max Breite des Vorschaubildes
     * @param int       $iTH              max Höhe des Vorschaubildes
     * @param int       $mwEditorWidth    Image Editor width
     * @param int       $mwEditorHeight   Image Editor height
     */
    function __construct($sN, $bG, $sA, $sU, $sT, $iW = 0, $iH = 0, $bThumb = false, $iTW = 0, $iTH = 0, $mwEditorWidth = 500, $mwEditorHeight = 280)
    {
        $aAtts = array();
        $aKV = array();
        $sPair = "";

        parent::__construct($sN, $bG);
        $this->sEditorPageName = "image.php";
        $this->iEditorWidth = ($mwEditorWidth) ? $mwEditorWidth : 500;
        $this->iEditorHeight = ($mwEditorHeight) ? $mwEditorHeight : 280;
        $this->sEditButtonCSSClass = "WebYepImageEditButton";
        $this->setVersion(WY_IMAGE_VERSION);
        if (!isset($this->dContent[WY_DK_IMAGEFILENAME])) $this->dContent[WY_DK_IMAGEFILENAME] = "";
        if (!isset($this->dContent[WY_DK_THUMBNAIL_FILENAME])) $this->dContent[WY_DK_THUMBNAIL_FILENAME] = "";
        if (!isset($this->dContent[WY_DK_URL])) $this->dContent[WY_DK_URL] = "";
        if (!isset($this->dContent[WY_DK_ALTTEXT])) $this->dContent[WY_DK_ALTTEXT] = "";

        $this->sAttributes = trim($sA);
        $this->iImageWidth = $iW;
        $this->iImageHeight = $iH;
        $this->iThumbWidth = $iTW;
        $this->iThumbHeight = $iTH;
        if (($bThumb && $this->iThumbWidth != 0) || (!$bThumb && $this->iImageWidth != 0)) {
            // remove width and height from attributes string
            $this->sAttributes = preg_replace('/width *= *"?[0-9]+"?/', "", $this->sAttributes);
            $this->sAttributes = preg_replace('/height *= *"?[0-9]+"?/', "", $this->sAttributes);
            $this->sAttributes = preg_replace('/  +/', " ", $this->sAttributes);
        }
        if ($this->dContent[WY_DK_ALTTEXT]) $this->sAttributes = preg_replace('/alt *= *"[^"]*"/', "", $this->sAttributes);

        $this->bIsThumb = $bThumb;
        $this->sURL = $sU;
        $this->sTarget = $sT;
    }

    /**
     * @deprecated I mean it!
     */
    function oIPhoneEditURL()
    {
        return new WYURL("javascript:alert(\"" . WYTS('NoImageEditorOnIPhone') . "\")");
    }

    /**
     * Link zum Anzeigefenster des Originalbildes (ohne JS-Bibliothek)
     *
     * @return object ein WYURL-Objekt für das Detailfenster
     */
    function oDetailWindowURL()
    {
        global $goApp;
        $oURL = od_clone($goApp->oProgramURL);
        $oURL->addComponent("image-detail.php");
        return $oURL;
    }

    /**
     * Liefert ein WYImage-Objekt für das (Vorschau)Bild
     *
     * @return object ein WYImage-Objekt, oder od_nil
     */
    function oImage()
    {
        global $goApp, $webyep_sLiveDemoSlotID;
        $oImg = od_nil;
        $oURL = od_nil;
        $sFN = $this->dContent[WY_DK_IMAGEFILENAME];
        $sTNFN = $this->dContent[WY_DK_THUMBNAIL_FILENAME];

        $oURL = od_clone($goApp->oDataURL);
        if ($this->bDemoContent) $oURL->removeDemoSlotID();

        if ($this->bIsThumb && $sTNFN) {
            $oURL->addComponent($sTNFN);
        }
        else if ($sFN) {
            $oURL->addComponent($sFN);
        }
        else $oURL = od_nil;
        if ($oURL) {
            $oImg = new WYImage($oURL);
            if ($webyep_sLiveDemoSlotID && !$oImg->bExists()) {
                $oURL->removeDemoSlotID();
                $oImg = new WYImage($oURL);
            }
        }

        return $oImg;
    }

    /**
     * Liefert ein WYImage-Objekt für das Bild.
     *
     * @return object ein WYImage-Objekt für das Bild
     */
    function oDetailImage()
    {
        global $goApp, $webyep_sLiveDemoSlotID;
        $oImg = od_nil;
        $oURL = od_nil;
        $sFN = $this->dContent[WY_DK_IMAGEFILENAME];

        $oURL = od_clone($goApp->oDataURL);
        if ($this->bDemoContent) $oURL->removeDemoSlotID();
        $oURL->addComponent($sFN);
        $oImg = new WYImage($oURL);
        if ($webyep_sLiveDemoSlotID && !$oImg->bExists()) {
            $oURL->removeDemoSlotID();
            $oImg = new WYImage($oURL);
        }
        return $oImg;
    }

    /**
     * Löscht das Bild
     *
     * implicit save!
     */
    function deleteImage()
    {
        global $goApp;
        $oFile = od_nil;
        $sFN = $this->dContent[WY_DK_IMAGEFILENAME];
        if ($sFN) {
            $oPath = od_clone($goApp->oDataPath);
            $oPath->addComponent($sFN);
            $oFile = new WYFile($oPath);
            if ($oFile->bExists() && !$oFile->bDelete()) $goApp->log("could not delete image file " . $oPath->sPath);
            $this->dContent[WY_DK_IMAGEFILENAME] = "";
        }
        $this->save();
    }

    /**
     * Löscht das Vorschaubild
     *
     * no implicit save!
     */
    function deleteThumbnail()
    {
        global $goApp;
        $oFile = od_nil;
        $sFN = $this->dContent[WY_DK_THUMBNAIL_FILENAME];

        if ($sFN) {
            $oPath = od_clone($goApp->oDataPath);
            $oPath->addComponent($sFN);
            $oFile = new WYFile($oPath);
            if ($oFile->bExists() && !$oFile->bDelete()) $goApp->log("could not delete thumbnail file " . $oPath->sPath);
            $this->dContent[WY_DK_THUMBNAIL_FILENAME] = "";
        }
    }

    /**
     * Löscht den gesamten Inhalt des Elements
     *
     * no implicit save!
     */
    function deleteContent()
    {
        $this->deleteImage();     // implicit save!
        $this->deleteThumbnail(); // no implicit save!
        parent::deleteContent();
    }

    /**
     * Liefert den Feldnamen des Elements zur Verwendung als Dateiname
     *
     * @return string der Dateiname, exkl. DocID und/oder DocInst u. BlockID
     */
    function sFieldNameForFile()
    {
        $s = parent::sFieldNameForFile();
        $s = "im-" . $s;
        return $s;
    }

    /**
     * Liefert ein WYPath-Objekt für das Vorschaubild
     *
     * @param  object $oP      der Pfad zum Bild
     * @return object WYPath   Pfad zum Vorschaubild
     */
    function oThumbnailPathFor($oP)
    {
        $sExt = $oP->sExtension();
        $sPath = str_replace(".$sExt", "-tn.$sExt", $oP->sPath);
        return new WYPath($sPath);
    }

    /**
     * should be named 'aConstrainedSize' ;-)
     *
     * @param string $iWC 
     * @param string $iHC 
     * @param string $bThumb 
     * @return void
     */
    function aContrainedSize($iWC, $iHC, $bThumb)
    // assumes $this->iWidth or $this->iHeight is set
    {
        $fXF = (float)($bThumb ? $this->iThumbWidth : $this->iImageWidth) / (float)$iWC;
        $fYF = (float)($bThumb ? $this->iThumbHeight : $this->iImageHeight) / (float)$iHC;

        if ($fXF == 0) $fF = $fYF;
        else if ($fYF == 0) $fF = $fXF;
        else $fF = min($fXF, $fYF);
        $iW = round($iWC * $fF);
        $iH = round($iHC * $fF);
        return array($iW, $iH);
    }

    function bUseUploadedImageFile(&$oFromPath, &$oOrgFilename)
    {
        global $goApp;
        $sNewFilename = "";
        $sExt = $oOrgFilename->sExtension();

        if ($oFromPath) {
            $oFromFile = new WYFile($oFromPath);
            $oToPath = od_clone($goApp->oDataPath);
            $sNewFilename = $this->sDataFileName(true) . "-" . mt_rand(1000, 9999) . "." . $sExt;
            $oToPath->addComponent($sNewFilename);
            if ($oFromFile->bMoveTo($oToPath)) {
                $this->deleteImage(); // delete old image
                chmod($oToPath->sPath, 0644);

                // Check if the file is an SVG
                if (strtolower($sExt) == 'svg') {
                    // For SVGs, skip resizing
                    $this->dContent[WY_DK_IMAGEFILENAME] = $sNewFilename;
                    if ($this->bIsThumb) {
                        $this->dContent[WY_DK_THUMBNAIL_FILENAME] = $sNewFilename;
                    }
                    return true;
                }

                list($iOW, $iOH) = WYImage::aGetImageSize($oToPath);
                if ($this->iImageWidth != 0 || $this->iImageHeight != 0) { // image dimensions set?
                    list($iCW, $iCH) = $this->aContrainedSize($iOW, $iOH, false); // constrained image size
                    if ($iCW != $iOW || $iCH != $iOH) {
                        $oResizedPath = od_clone($oToPath);
                        if (!WYImage::bResizeImage($oToPath, $oResizedPath, $iCW, $iCH)) {
                            $goApp->log("resizing failed for: " . $oToPath->sPath);
                        }
                    }
                }
                if ($this->bIsThumb) {
                    list($iCW, $iCH) = $this->aContrainedSize($iOW, $iOH, true); // constrained size for thumbnail
                    $this->deleteThumbnail();
                    $oResizedPath = $this->oThumbnailPathFor($oToPath);
                    $this->dContent[WY_DK_THUMBNAIL_FILENAME] = $oResizedPath->sBasename();
                    if (!WYImage::bResizeImage($oToPath, $oResizedPath, $iCW, $iCH)) {
                        $goApp->log("resizing failed for: " . $oToPath->sPath . ", " . $oResizedPath->sPath);
                        $this->deleteThumbnail();
                    }
                }
                $this->dContent[WY_DK_IMAGEFILENAME] = $sNewFilename;
                return true;
            }
            else {
                $goApp->log("could not move image file: " . $oFromPath->sPath . " to " . $oToPath->sPath);
                return false;
            }
        }
    }

    function setLinkURL($sU)
    {
        $this->dContent[WY_DK_URL] = $sU;
    }

    function sLinkURL()
    {
        return $this->dContent[WY_DK_URL];
    }

    function setAltText($sT)
    {
        $this->dContent[WY_DK_ALTTEXT] = $sT;
    }

    function sAltText()
    {
        return $this->dContent[WY_DK_ALTTEXT];
    }

    function sEditButtonHTML($sButtonImage = "edit-button.png", $sToolTip = "", $oCustomURL = false)
    {
        $this->dEditorQuery = array();
        $this->dEditorQuery[WY_QK_IMAGE_WIDTH] = $this->iImageWidth;
        $this->dEditorQuery[WY_QK_IMAGE_HEIGHT] = $this->iImageHeight;
        $this->dEditorQuery[WY_QK_IS_THUMB] = $this->bIsThumb;
        $this->dEditorQuery[WY_QK_THUMB_WIDTH] = $this->iThumbWidth;
        $this->dEditorQuery[WY_QK_THUMB_HEIGHT] = $this->iThumbHeight;
        return parent::sEditButtonHTML($sButtonImage, $sToolTip, $oCustomURL);
    }

    function sDisplay()
    {
        global $goApp, $webyep_bOpenFullURLsInNewWindow, $webyep_LightboxType, $webyep_oCurrentLoop;
        $sHTML = "";
        $oImg = od_clone($this->oImage());
        $sAltText = $this->sAltText();
        $sAtt = "";
        $sAnchor = "";
        $iLoop = 0;
        $oURL = od_nil;

        $iDW = $this->bIsThumb ? $this->iThumbWidth : $this->iImageWidth;
        $iDH = $this->bIsThumb ? $this->iThumbHeight : $this->iImageHeight;

        if ($oImg) {
            if ($iDW != 0 || $iDH != 0) {
                $iW = $oImg->iWidth();
                $iH = $oImg->iHeight();
                if ($iW != 0 && $iH != 0) { // if image size could be determined
                    if ($iW > $iDW || $iH > $iDH) { // image has not the correct size
                        list($iW, $iH) = $this->aContrainedSize($iW, $iH, $this->bIsThumb);
                        $this->sAttributes .= ($this->sAttributes ? " " : "") . "width=\"$iW\" height=\"$iH\"";
                    }
                }
            }
            if ($this->sAttributes) {
                if (stristr($this->sAttributes, "width=") || stristr($this->sAttributes, "height=")) {
                    // width or height can only be set in attributes if $this->iImageWidth/iThumbWidth are _not_ used!
                    $oImg->removeAttribute("width");
                    $oImg->removeAttribute("height");
                }
                if (stristr($this->sAttributes, "alt=")) {
                    $oImg->removeAttribute("alt");
                }
            }
            if ($this->sAttributes) {
                $sAtt = " " . $this->sAttributes;
            }
            if ($sAltText) $oImg->setAttribute("alt", $sAltText);

            $sHTML .= str_replace("<img", "<img$sAtt", $oImg->sDisplay());

            $oLink = od_nil;
            $sURL = $this->dContent[WY_DK_URL] ? $this->dContent[WY_DK_URL] : $this->sURL;
            if ($sURL) {
                $oURL = new WYURL($sURL);
                if (!$this->dContent[WY_DK_URL]) {
                    $iLoop = $_SESSION["loopid"];// $goApp->oDocument->iLoopID();
                    if ($iLoop) {
                        $oURL->dQuery[WY_QK_DI] = $_SESSION["loopid"]; //$goApp->oDocument->iDocumentInstanceForLoopID($iLoop);
                    }
                }
                $oLink = new WYLink($oURL, "", true);
                $Wyurl = new WYURL();
                if ($webyep_bOpenFullURLsInNewWindow && $Wyurl->bIsAbsolute($sURL)) $this->sTarget = "_blank";
                if ($this->sTarget) $oLink->setAttribute("target", $this->sTarget);
            }
            if ($this->bIsThumb && !$oLink) {
                if ($webyep_LightboxType == 'mootools' && is_dir(BASE_PATH.'/program/opt/mootool-lightbox')) {
                    $oImg = $this->oDetailImage();
                    $oURL = $oImg->oURL;
                    if (!$oLink) {
                        $oLink = new WYLink($oURL);
                        if ($webyep_oCurrentLoop != od_nil) {
                            $sGroup = $webyep_oCurrentLoop->sFieldNameForFile();
                        }
                        else $sGroup = "";
                        $oLink->setAttribute("rel", "lightbox" . ($sGroup ? "-$sGroup":""));
                        $oLink->setAttribute("class", "WYPopUpImage");
                    }    
                } else if ($webyep_LightboxType == 'jquery' && is_dir(BASE_PATH.'/program/opt/jquery-lightbox')) {
                    $oImg = $this->oDetailImage();
                    $oURL = $oImg->oURL;
                    if (!$oLink) {
                        $oLink = new WYLink($oURL);
                        if ($webyep_oCurrentLoop != od_nil) {
                            $sGroup = $webyep_oCurrentLoop->sFieldNameForFile();
                        }
                        else $sGroup = "";
                        $oLink->setAttribute(($sGroup ? "data-lightbox" : "rel"), ($sGroup ? "[$sGroup]" : "lightbox"));
                        $oLink->setAttribute("class", "WYPopUpImage");
                    }
                } else if ($webyep_LightboxType == 'scriptaculous' && is_dir(BASE_PATH.'/program/opt/scriptaculous-lightbox')) {
                    $oImg = $this->oDetailImage();
                    $oURL = $oImg->oURL;
                    if (!$oLink) {
                        $oLink = new WYLink($oURL);
                        if ($webyep_oCurrentLoop != od_nil) {
                            $sGroup = $webyep_oCurrentLoop->sFieldNameForFile();
                        }
                        else $sGroup = "";
                        $oLink->setAttribute("rel", "lightbox" . ($sGroup ? "[$sGroup]" : ""));
                        $oLink->setAttribute("class", "WYPopUpImage");
                    }
                } else if ($webyep_iUseImageBox == WEBYEP_LIGHTBOX) {
                    $oImg = $this->oDetailImage();
                    $oURL = $oImg->oURL;
                    if (!$oLink) {
                        $oLink = new WYLink($oURL);
                        if ($webyep_oCurrentLoop != od_nil) {
                            $sGroup = $webyep_oCurrentLoop->sFieldNameForFile();
                        }
                        else $sGroup = "";
                        $oLink->setAttribute("rel", "lightbox" . ($sGroup ? "[$sGroup]" : ""));
                        $oLink->setAttribute("class", "WYPopUpImage");
                    }
                } else if ($webyep_iUseImageBox == WEBYEP_FANCYBOX) { // use jquery.fancybox
                    $oImg = $this->oDetailImage();
                    $oURL = $oImg->oURL;
                    if (!$oLink) {
                        $oLink = new WYLink($oURL);
                        if ($webyep_oCurrentLoop != od_nil) {
                            $sGroup = $webyep_oCurrentLoop->sFieldNameForFile();
                        }
                        else $sGroup = md5($oURL->sEURL()); // 'unique' ID to prevent Fancybox from grouping single pictures
                        $oLink->setAttribute("rel", "fancybox" . ($sGroup ? "_$sGroup" : ""));
                        $oLink->setAttribute("class", "WYPopUpImage");
                    }
                } else {
                    $oURL = $this->oDetailWindowURL();
                    $oImg = $this->oDetailImage();
                    $iW = $oImg->iWidth();
                    $iH = $oImg->iHeight();
                    if ($iW == 0) $iW = 400;
                    if ($iH == 0) $iH = 400;
                    $oURL->dQuery[WY_QK_IMAGE_DETAIL] = $oImg->oURL->sBasename();
                    $oURL->dQuery[WY_QK_IMAGE_ALTTEXT] = $sAltText;
                    $oURL->dQuery[WY_QK_IMAGE_DEMOCONTENT] = $this->bDemoContent;
                    if (!$oLink) $oLink = new WYLink(new WYURL("javascript:void(0)"));
                    $oLink->setAttribute("onclick", sprintf("wydw=window.open(\"%s\", \"WYDetail\", \"width=%d,height=%d,status=yes,scrollbars=yes,resizable=yes\"); wydw.focus();", $oURL->sEURL(true, true, true), $iW, $iH));
                    $oLink->setAttribute("class", "WYPopUpImage");
                    if (!$sAltText) $oLink->setToolTip(WYTS("ClickToZoom"));
                }
            }
            if ($oLink) {
                if ($sAltText) $oLink->setToolTip($sAltText);
                $oLink->setInnerHTML($sHTML);
                $sHTML = $oLink->sDisplay();
            }
        }
        return $sHTML;
    }
}
?>
