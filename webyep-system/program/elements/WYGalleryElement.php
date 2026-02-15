<?php //session_start();
/**
 * WebYep
 * @copyright Objective Development Software GmbH
 * @link http://www.obdev.at
 */

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYLink.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPopupWindowLink.php");

define("WY_GALLERY_VERSION", 1);
define("WY_DK_GALLERY_ID_ARRAY", "CONTENT");
define("WY_DK_GALLERY_FILENAME", "FILENAME");
define("WY_DK_GALLERY_TEXT", "TEXT");
define("WY_QK_GALLERY_ADD", "GALLERY_ADD");
define("WY_QV_GALLERY_REMOVE", "GALLERY_REMOVE");
define("WY_QV_GALLERY_UP", "GALLERY_UP");
define("WY_QV_GALLERY_DOWN", "GALLERY_DOWN");
define("WY_QK_GALLERY_IMAGE_ID", "GALLERY_IMAGE_ID");
define("WY_QK_GALLERY_FILENAME", "FILENAME");
define("WY_GALLERY_CSS_CONTAINER", "WebYepGalleryContainer");
define("WY_GALLERY_CSS_ROW", "WebYepGalleryRow");
define("WY_GALLERY_CSS_FIRSTROW", "WebYepGalleryFirstRow");
define("WY_GALLERY_CSS_CELL", "WebYepGalleryCell");
define("WY_GALLERY_CSS_FIRSTCOLUMN", "WebYepGalleryFirstColumn");
define("WY_GALLERY_CSS_IMAGE", "WebYepGalleryImage");
define("WY_GALLERY_CSS_TEXT", "WebYepGalleryText");

function webyep_gallery($sFieldName, $bGlobal, $iMaxTNWidth, $iMaxTNHeight, $iCols = 3, $iMaxImageWidth = 0, $iMaxImageHeight = 0, $iCellWidth = 0, $mwEditorWidth=430, $mwEditorHeight=400)
{   
    global $goApp;
    /* modify code */

    global $webyep_oCurrentLoop; 
    //print_r($webyep_oCurrentLoop);
    static $j=0;$k=0;
    if($webyep_oCurrentLoop){
        $webyep_oCurrentLoop->iLoopID=$_SESSION["loopid"]?? null;    
        $k++;
    } 

    $o = new WYGalleryElement($sFieldName, $bGlobal, $iMaxTNWidth, $iMaxTNHeight, $iCols, $iMaxImageWidth, $iMaxImageHeight, $iCellWidth, $mwEditorWidth, $mwEditorHeight);
    $s = $o->sDisplay();
    if ($goApp->bEditMode) {
        //echo $o->sEditButtonHTML("edit-button-image.png", "", $goApp->bIsiPhone ? $o->oIPhoneEditURL():od_nil);
        if (!$s) $s = $o->sName;
    }
    echo $s;
    $j++;
}

class WYGalleryElement extends WYElement
{
    var $iTNWidth;
    var $iTNHeight;
    var $iCellWidth;
    var $iImageWidth;
    var $iImageHeight;
    var $iCols;

    function __construct($sN, $bG, $iTNw, $iTNh, $iC = 3, $iIw = 0, $iIh = 0, $iCellWidth = 0, $mwEditorWidth=430, $mwEditorHeight=400)
    { 
        global $goApp;
        parent::__construct($sN, $bG);
        $this->iTNWidth = $iTNw;
        $this->iTNHeight = $iTNh;
        $this->iImageWidth = $iIw;
        $this->iImageHeight = $iIh;
        $this->iCellWidth = $iCellWidth == 0 ? (int)round($iTNw * 1.2):$iCellWidth;
        $this->iCols = $iC;
        $this->sEditorPageName = "gallery.php";
        $this->iEditorWidth = ($mwEditorWidth)?$mwEditorWidth:430;
        $this->iEditorHeight = ($mwEditorHeight)?$mwEditorHeight:400;
        $this->setVersion(WY_GALLERY_VERSION);
        $this->iEditedID = false;
        if (!isset($this->dContent[WY_DK_GALLERY_ID_ARRAY])) $this->dContent[WY_DK_LOOPIDARRAY] = array();
        if ($goApp->bEditMode && $this->bUserMayEditThisElement()) $this->dispatchEditAction();
        static $k=0;
        if(!empty($webyep_oCurrentLoop)){
            $loopArr=$webyep_oCurrentLoop->dContent['CONTENT'];
            $loopVal=floor($k/1); 
            $loopid=$loopArr[$loopVal]; 
            $k++;
        } 
    }

    function oIPhoneEditURL()
    {
        return new WYURL("javascript:alert(\"" . WYTS('NoGalleryEditorOnIPhone') . "\")");
    }

    function &_aItems()
    {
        return $this->dContent[WY_DK_GALLERY_ID_ARRAY];
    }

    function sFieldNameForFile()
    {
        $s = parent::sFieldNameForFile();
        $s = "gl-" . $s;
        return $s;
    }

    function deleteContent()
    {
        $aItems =& $this->_aItems();
        $iCount = count($aItems);
        for ($i = 0; $i < $iCount; $i++) {
            $this->_deleteImageFilesForID($i);
        }
        parent::deleteContent();
    }

    function newImageAfter($iID)
    {
        $aItems =& $this->_aItems();
        $dNewItem = array(WY_DK_GALLERY_FILENAME => "", WY_DK_GALLERY_TEXT => "");

        if ($iID < (count($aItems) - 1) && $iID >= 0) webyep_array_insert($aItems, $iID+1, $dNewItem);
        else $aItems[] = $dNewItem;
    }

    function _deleteImageFilesForID($iID)
    {
        global $goApp;
        $oFile = od_nil;
        $aItems =& $this->_aItems();
             
        if (isset($aItems[$iID]) && isset($aItems[$iID][WY_DK_GALLERY_FILENAME]) && $sFN = $aItems[$iID][WY_DK_GALLERY_FILENAME]) {
            $oPath = od_clone($goApp->oDataPath);
            $oPath->addComponent($sFN);
            $oFile = new WYFile($oPath);
            if ($oFile->bExists() && !$oFile->bDelete()) $goApp->log("could not delete image file " . $oPath->sPath);
            if (strtolower($oPath->sExtension()) !== "svg") {
                $oPath = od_clone($goApp->oDataPath);
                $oPath->addComponent($this->_sThumbnailName($sFN));
                $oFile = new WYFile($oPath);
                if ($oFile->bExists() && !$oFile->bDelete()) $goApp->log("could not delete thumbnail file " . $oPath->sPath);
            }
        }
    }

    function _bCreateThumbNailFor($sImgFilename)
    {
        global $goApp;
        $bSuccess = false;
        $rInImage = $rOutImage = false;
        $iW = $iH = 0;
        $iTNW = $iTNH = 0;
        $oImgPath = od_clone($goApp->oDataPath);
        $oImgPath->addComponent($sImgFilename);
        $oTNPath = od_clone($goApp->oDataPath);
        $oTNPath->addComponent($this->_sThumbnailName($sImgFilename));
        $oTNPath->setExtension("jpg");

        if (!function_exists("imagejpeg")) return false;

        if (strtolower($oImgPath->sExtension()) == "jpg") {
            if (!function_exists("imagecreatefromjpeg")) return false;
            else $rInImage = @imagecreatefromjpeg($oImgPath->sPath);
        }

        if (strtolower($oImgPath->sExtension()) == "gif") {
            if (!function_exists("imagecreatefromgif")) return false;
            else $rInImage = @imagecreatefromgif($oImgPath->sPath);
        }

        if (!$rInImage) return false;

        $iW = imagesx($rInImage);
        $iH = imagesy($rInImage);
        $iTNW = $iW;
        $iTNH = $iH;
        WYImage::bLimitSize($iTNW, $iTNH, $this->iTNWidth, $this->iTNHeight);
        if (function_exists("imagecreatetruecolor")) $rOutImage = @imagecreatetruecolor($iTNW, $iTNH);
        else if (function_exists("imagecreate")) $rOutImage = @imagecreate($iTNW, $iTNH);
        if (!$rOutImage) return false;

        if (function_exists("imagecopyresampled")) $bSuccess = @imagecopyresampled($rOutImage, $rInImage, 0, 0, 0, 0, $iTNW, $iTNH, $iW, $iH);
        if (!$bSuccess && function_exists("imagecopyresized")) $bSuccess = @imagecopyresized($rOutImage, $rInImage, 0, 0, 0, 0, $iTNW, $iTNH, $iW, $iH);
        if (!$bSuccess) return false;

        $bSuccess = @imagejpeg($rOutImage, $oTNPath->sPath, 100);
        chmod($oTNPath->sPath, 0644);

        return $bSuccess;
    }

    function useUploadedImageFileForID(&$oFromPath, &$oOrgFilename, $iID)
    {
        global $goApp;
        $sNewFilename = "";
        $sExt = strtolower($oOrgFilename->sExtension());
        $aItems =& $this->_aItems();
        $dItem = array();
        $bSuccess = false;

        if ($oFromPath && isset($aItems[$iID])) {
            $oFromFile = new WYFile($oFromPath);
            $oToPath = od_clone($goApp->oDataPath);
            $sNewFilename = $this->sDataFileName(true) . "-" . mt_rand(1000, 9999) . "." . $sExt;
            $oToPath->addComponent($sNewFilename);

            $bOK = false;
            if ($sExt === "svg") {
                if ($oFromFile->bMoveTo($oToPath)) {
                    $bOK = true;
                    $this->_deleteImageFilesForID($iID);
                    $dItem =& $aItems[$iID];
                    $dItem[WY_DK_GALLERY_FILENAME] = $sNewFilename;
                    chmod($oToPath->sPath, 0644);
                } else {
                    $goApp->log("WYGallery: could not move SVG file: " . $oFromPath->sPath . " to " . $oToPath->sPath);
                }
            } else {
                $a = WYImage::aGetImageSize($oFromPath);
                $iW = $a[0];
                $iH = $a[1];
                if (!WYImage::bLimitSize($iW, $iH, $this->iImageWidth, $this->iImageHeight)) {
                    if ($oFromFile->bMoveTo($oToPath)) $bOK = true;
                    else $goApp->log("WYGallery: could not move image file: " . $oFromPath->sPath . " to " . $oToPath->sPath);
                } else {
                    $oTMPPath = od_clone($goApp->oDataPath);
                    $oTMPPath->addComponent("WYGalleryUpload_" . mt_rand(1000, 9999) . "." . $sExt);
                    if ($oFromFile->bMoveTo($oTMPPath)) {
                        if (WYImage::bResizeImage($oTMPPath, $oToPath, $iW, $iH)) {
                            $bOK = true;
                        } else {
                            $goApp->log("WYGallery: could not resize uploaded image file: " . $oFromPath->sPath);
                        }
                        if (!@unlink($oTMPPath->sPath)) $goApp->log("WYGallery: could not unlink uploaded image file: " . $oTMPPath->sPath);
                    } else $goApp->log("WYGallery: could not move image file: " . $oFromPath->sPath . " to " . $oTMPPath->sPath);
                }

                if ($bOK) {
                    $this->_deleteImageFilesForID($iID);
                    $dItem =& $aItems[$iID];
                    $dItem[WY_DK_GALLERY_FILENAME] = $sNewFilename;
                    chmod($oToPath->sPath, 0644);

                    if (!$this->_bCreateThumbNailFor($sNewFilename)) {
                        $oTNPath = od_clone($oToPath);
                        $oTNPath->removeLastComponent();
                        $oTNPath->addComponent($this->_sThumbnailName($sNewFilename));
                        $oTNPath->setExtension($oToPath->sExtension());
                        $oFile = new WYFile($oToPath);
                        if (!$oFile->bCopyTo($oTNPath)) $goApp->log("could not copy image $sNewFilename to thumbnail");
                        else chmod($oTNPath->sPath, 0644);
                    }
                }
            }
        }
    }

    function sAnchor()
    {
        return "<a name=\"WEBYEP_CURRENT_GALLERY_ITEM\"></a>";
    }

    function _sEditButtons($iID)
    { 
        global $goApp, $webyep_bShowDisabledEditButtons;
        
        $sHTML = "";
        $oURL = od_clone((new WYURL())->oCurrentURL());
        $oLink = od_nil;
        $oImg = od_nil;
        $oImgURL = od_clone($goApp->oImageURL);
        $dEditQuery = (new WYEditor())->dQueryForElement($this);
        $aItems =& $this->_aItems();
        $iCount = count($aItems);

        if ($goApp->bEditMode) {

            if ($this->iEditedID === $iID) $sHTML .= $this->sAnchor();

            $sHTML .= "<div style=\"white-space: nowrap; text-align: center; margin-top: 4px\">";

            if ($this->bUserMayEditThisElement()) {
                $dEditQuery[WY_QK_GALLERY_IMAGE_ID] = $iID;
                $oURL->setQuery(array_merge($oURL->dQuery, $dEditQuery));
                $oURL->sAnchor = "WEBYEP_CURRENT_GALLERY_ITEM";

                $this->dEditorQuery[WY_QK_GALLERY_IMAGE_ID] = $iID;
                $this->dEditorQuery[WY_QK_THUMB_WIDTH] = $this->iTNWidth;
                $this->dEditorQuery[WY_QK_THUMB_HEIGHT] = $this->iTNHeight;
                $this->dEditorQuery[WY_QK_IMAGE_WIDTH] = $this->iImageWidth;
                $this->dEditorQuery[WY_QK_IMAGE_HEIGHT] = $this->iImageHeight;
                $this->dEditorQuery[WY_QK_GALLERY_IMAGE_ID] = $iID;
                $this->dEditorQuery[WY_QK_GALLERY_ADD] = "true";
                
                $goApp->setActionInQuery($dEditQuery, WY_QV_GALLERY_UP);
                $oURL->setQuery($dEditQuery);
                $oLink = new WYLink($iCount > 1 ? $oURL:(new WYURL("javascript:void(0)")), WYTS("GalleryUpButton"));
                $oImgURL->addComponent("gallery-move-left-button.png");
                $oImg = new WYImage($oImgURL);
                $oImg->setAttribute("style", "border: none");
                $oImgURL->removeLastComponent();
                $oLink->setInnerHTML($oImg->sDisplay());
                $oLink->setAttribute("class", "WebYepGalleryUpButton");
                $sHTML .= $oLink->sDisplay();

                $this->sEditButtonCSSClass = "WebYepGalleryAddButton";
                $sHTML .= $this->sEditButtonHTML("gallery-add-button.png", WYTS("GalleryAddButton"), $goApp->bIsiPhone ? $this->oIPhoneEditURL():od_nil);

                $dEditQuery = $oURL->dQuery;
                $goApp->setActionInQuery($dEditQuery, WY_QV_GALLERY_REMOVE);
                $oURL->setQuery($dEditQuery);
                $oLink = new WYLink($iCount > 0 ? $oURL:(new WYURL("javascript:void(0)")), WYTS("GalleryRemoveButton"));
                $oImgURL->addComponent("gallery-remove-button.png");
                $oImg = new WYImage($oImgURL);
                $oImg->setAttribute("style", "border: none");
                $oImgURL->removeLastComponent();
                $oLink->setInnerHTML($oImg->sDisplay());
                $oLink->setAttribute("onclick", "return confirm(\"" . WYTS("GalleryRemoveConfirm") . "\");");
                $oLink->setAttribute("class", "WebYepGalleryRemoveButton");
                $sHTML .= $oLink->sDisplay();
                $oLink->removeAttribute("onclick");

                $goApp->setActionInQuery($dEditQuery, WY_QV_GALLERY_DOWN);
                $oURL->setQuery($dEditQuery);
                $oLink = new WYLink($iCount > 1 ? $oURL:(new WYURL("javascript:void(0)")), WYTS("GalleryDownButton"));
                $oImgURL->addComponent("gallery-move-right-button.png");
                $oImg = new WYImage($oImgURL);
                $oImg->setAttribute("style", "border: none");
                $oImgURL->removeLastComponent();
                $oLink->setInnerHTML($oImg->sDisplay());
                $oLink->setAttribute("class", "WebYepGalleryDownButton");
                $sHTML .= $oLink->sDisplay();

                if ($iCount > 0) {
                    $sHTML .= "<br />";
                    $this->dEditorQuery[WY_QK_GALLERY_ADD] = "false";
                    $this->sEditButtonCSSClass = "WebYepGalleryEditButton";
                    $sHTML .= $this->sEditButtonHTML("gallery-edit-button.png", WYTS("GalleryEditButton"), $goApp->bIsiPhone ? $this->oIPhoneEditURL():od_nil);
                }
            }
            else { // editing not allowed
                if ($webyep_bShowDisabledEditButtons) {
                    $sToolTip = sprintf(WYTS("insufficientPermissions"), $this->sName);
                    $oImgURL = od_clone($goApp->oImageURL);
                    $oImgURL->addComponent("gallery-buttons-disabled.png");
                    $oImg = new WYImage($oImgURL);
                    $oImg->setAttribute("border", 0);
                    $oImg->setAttribute("alt", $sToolTip);
                    $oLink = new WYLink(new WYURL("javascript:void(0);"), $sToolTip);
                    $oLink->setInnerHTML($oImg->sDisplay());
                    $oLink->setAttribute("class", $this->sEditButtonCSSClass);
                    $sHTML .=  $oLink->sDisplay();
                }
            }
            
            $sHTML .= "</div>";

        }   

        if(empty($_SESSION["loopid"])) {
            $_SESSION["loopid"] = '0';

        }

        $sHTML = str_replace("WEBYEP_LOOP_ID=","WEBYEP_LOOP_ID=".$_SESSION["loopid"]."&",$sHTML);
        return $sHTML;
    }

    /**
     * Führt eine angeforderte Editieraktion durch.
     * 
     *  Mögliche Aktionen sind:
     *  - Bild löschen
     *  - Bild nach oben verschieben
     *  - Bild nach unten verschieben
     */
    function dispatchEditAction()
    {
        global $goApp;
        $sAction = $goApp->sCurrentAction();
        $sFieldName = $goApp->sFormFieldValue(WY_QK_EDITOR_FIELDNAME, "");
        $iImageID = (int)$goApp->sFormFieldValue(WY_QK_GALLERY_IMAGE_ID, 0);
        $iLoopID = (int)$goApp->sFormFieldValue(WY_QK_LOOP_ID, 0);
        $aItems =& $this->_aItems();
        $aTempItems = array();
        $dItem = array();
        $iCount = count($aItems);
        $iNewIndex = 0;
        $bChanged = false;

        if ($sFieldName != $this->sName) return;
        if ($iLoopID != $goApp->oDocument->iLoopID()) return;

        if ($sAction == WY_QV_GALLERY_REMOVE) {
            if ($iCount > 0) {
                $this->_deleteImageFilesForID($iImageID);
                array_splice($aItems, $iImageID, 1);
                if (isset($aItems[$iImageID])) $this->iEditedID = $iImageID;
                else if (isset($aItems[$iImageID - 1])) $this->iEditedID = $iImageID - 1;
                $bChanged = true;
            }
        }
        else if ($sAction == WY_QV_GALLERY_UP) {
            if ($iCount > 1 && $iImageID > 0) {
                $aTempItems = array_splice($aItems, $iImageID, 1);
                webyep_array_insert($aItems, $iImageID - 1, $aTempItems[0]);
                $this->iEditedID = $iImageID - 1;
                $bChanged = true;
            }
        }
        else if ($sAction == WY_QV_GALLERY_DOWN) {
            if ($iCount > 1 && $iImageID < ($iCount-1) ) {
                $aTempItems = array_splice($aItems, $iImageID, 1);
                webyep_array_insert($aItems, $iImageID + 1, $aTempItems[0]);
                $this->iEditedID = $iImageID + 1;
                $bChanged = true;
            }
        }
        if ($bChanged) {
            $this->save();
        }
    }

    function _sThumbnailName($sFilename)
    {
        global $goApp;
        $oP = $oF = od_nil;
        $sOrgExt = "";
        $sTN = "";

        $oP = new WYPath($sFilename);
        $sOrgExt = $oP->sExtension();

        if (strtolower($sOrgExt) == "svg") {
            return $sFilename;
        }

        $oP = od_clone($goApp->oDataPath);
        $iPos = strrpos($sFilename, ".");
        $sTN = substr($sFilename, 0, $iPos) . "-tn.jpg";
        $oP->addComponent($sTN);

        $oF = new WYFile($oP);
        if (!$oF->bExists()) {
            $oP->removeDemoSlotID(); // try again without demo slot ID
            unset($oF);
            $oF = new WYFile($oP);
            if (!$oF->bExists()) {
                $oP->setExtension($sOrgExt);
                $sTN = $oP->sBasename();
            }
        }
        return $sTN;
    }

    function &_oTNImage($sFilename)
    {
        global $goApp, $webyep_sLiveDemoSlotID;
        $oImg = od_nil;
        $oURL = od_nil;
        $sTNName = "";
        $fFactor = 0.0;
        $iW = $iH = 0;

        $oURL = od_clone($goApp->oDataURL);
        $sTNName = $this->_sThumbnailName($sFilename);
        $oURL->addComponent($sTNName);
        $oImg = new WYImage($oURL);
        if ($webyep_sLiveDemoSlotID && !$oImg->bExists()) {
            $oURL->removeDemoSlotID();
            unset($oImg);
            $oImg = new WYImage($oURL);
        }
        if (strtolower($oURL->sExtension()) !== "svg") {
            if (isset($oImg->dAttributes["width"]) && isset($oImg->dAttributes["height"])) {
                WYImage::bLimitSize($oImg->dAttributes["width"], $oImg->dAttributes["height"], $this->iTNWidth, $this->iTNHeight);
            } else {
                $goApp->log("could not determine image size of $sTNName");
                $oImg->dAttributes["width"] = $this->iTNWidth;
                unset($oImg->dAttributes["height"]);
            }
        }
        return $oImg;
    }

    function &dItemForID($iID)
    {
        $aItems =& $this->_aItems();
        if (isset($aItems[$iID])) $dItem =& $aItems[$iID];
        $dItem = od_nil;
        return $dItem;
    }

    function setTextForID($iID, $sText)
    {
        $aItems =& $this->_aItems();
        $dItem = od_nil;

        if (isset($aItems[$iID])) $dItem =& $aItems[$iID];
        if ($dItem) $dItem[WY_DK_GALLERY_TEXT] = $sText;
    }

    function sTextForID($iID)
    {
        $aItems =& $this->_aItems();
        $dItem = isset($aItems[$iID]) ? $aItems[$iID]:od_nil;
        if ($dItem) return $dItem[WY_DK_GALLERY_TEXT];
        else return "";
    }

    function sFilenameForID($iID)
    {
        $aItems =& $this->_aItems();
        $dItem = isset($aItems[$iID]) ? $aItems[$iID]:od_nil;
        if ($dItem) return $dItem[WY_DK_GALLERY_FILENAME];
        else return "";
    }

    function sStripFormatting($s)
    {
        $s = preg_replace('|<LINK:[^ ]+ ([^>]+)>|', '\1', $s);
        $s = preg_replace('|<[A-Z0-9]+ ([^>]+)>|', '\1', $s);
        $s = strip_tags($s);
        return $s;
    }

    function sDisplay()
    { 
        global $goApp, $webyep_bUseTablesForGalleries, $webyep_iUseImageBox, $webyep_sLiveDemoSlotID, $webyep_LightboxType;

        $sHTML = "";
        $iCount = count($this->_aItems());
        $i = 0;
        $iCols = $this->iCols;
        $bEditMode = $goApp->bEditMode;
        $sTNName = "";
        $oTN = $oLink = $oDetailURL = od_nil;
        $sText = $sFilename = "";
        $sBoxName = $this->sDataFileName(false);
        $uniqueGalleryID = uniqid("-", true);

        if ($iCount == 0 && !$bEditMode) return "";

        if ($webyep_iUseImageBox == WEBYEP_NOBOX) {
            $oDetailURL = od_clone($goApp->oProgramURL);
            $oDetailURL->addComponent("image-detail.php");
        }
        
        $sHTML .= $webyep_bUseTablesForGalleries ? sprintf("<table class=\"%s\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n", WY_GALLERY_CSS_CONTAINER):sprintf("<div style=\"overflow:hidden\" class=\"%s\">\n", WY_GALLERY_CSS_CONTAINER);
        while ((($i < $iCount) || ($iCount == 0 && $i == 0 && $bEditMode)) || ($i % $iCols)) {
            if (!($i % $iCols)) $sHTML .= $webyep_bUseTablesForGalleries ? sprintf("   <tr%s>\n", $i < $iCols ? (" class=\"" . WY_GALLERY_CSS_FIRSTROW . "\""):""):sprintf("   <div style=\"display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-direction:normal;-moz-box-direction:normal;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:center;-moz-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;-webkit-align-content:flex-start;-ms-flex-line-pack:start;align-content:flex-start;-webkit-box-align:start;-moz-box-align:start;-webkit-align-items:flex-start;-ms-flex-align:start;align-items:flex-start; overflow: hidden; zoom: 1.0\" class=\"%s%s\">\n", WY_GALLERY_CSS_ROW, $i < $iCols ? (" " . WY_GALLERY_CSS_FIRSTROW):"");

            $sHTML .= $webyep_bUseTablesForGalleries ? sprintf("      <td style=\"width: %dpx\"%s>", $this->iCellWidth, ($i % $iCols) == 0 ? (" class=\"" . WY_GALLERY_CSS_FIRSTCOLUMN . "\""):""):sprintf("      <div style=\"width: %dpx\" class=\"%s%s\">", $this->iCellWidth, WY_GALLERY_CSS_CELL, ($i % $iCols) == 0 ? (" " . WY_GALLERY_CSS_FIRSTCOLUMN):"");
            
            if ($i < $iCount) {
                $sHTML .= sprintf("<div class=\"%s\">", WY_GALLERY_CSS_IMAGE);
                $sFilename = $this->sFilenameForID($i);
                $sText = $this->sTextForID($i);
                if ($sFilename) {
                    $oTN =& $this->_oTNImage($sFilename);
                    unset($oLink);

                    if ($webyep_LightboxType == 'mootools' && is_dir(BASE_PATH.'/program/opt/mootool-lightbox')) {
                        unset($oImgURL);
                        $oImgURL = od_clone($goApp->oDataURL);
                        $oImgURL->addComponent($sFilename);
                        if ($webyep_sLiveDemoSlotID) {
                            $oImg = new WYImage($oImgURL);
                            if (!$oImg->bExists()) $oImgURL->removeDemoSlotID();
                        }
                        $oLink = new WYLink($oImgURL, $sText ? $this->sStripFormatting($sText):" ");
                        $oLink->setAttribute("rel", "lightbox-wygallery" . $uniqueGalleryID);
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    } else if ($webyep_LightboxType == 'jquery' && is_dir(BASE_PATH.'/program/opt/jquery-lightbox')) {
                        unset($oImgURL);
                        $oImgURL = od_clone($goApp->oDataURL);
                        $oImgURL->addComponent($sFilename);
                        if ($webyep_sLiveDemoSlotID) {
                            $oImg = new WYImage($oImgURL);
                            if (!$oImg->bExists()) $oImgURL->removeDemoSlotID();
                        }
                        $oLink = new WYLink($oImgURL, $sText ? $this->sStripFormatting($sText):" ");
                        $oLink->setAttribute("data-lightbox", "wygallery" . $uniqueGalleryID);
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    } else if ($webyep_LightboxType == 'scriptaculous' && is_dir(BASE_PATH.'/program/opt/scriptaculous-lightbox')) {
                        unset($oImgURL);
                        $oImgURL = od_clone($goApp->oDataURL);
                        $oImgURL->addComponent($sFilename);
                        if ($webyep_sLiveDemoSlotID) {
                            $oImg = new WYImage($oImgURL);
                            if (!$oImg->bExists()) $oImgURL->removeDemoSlotID();
                        }
                        $oLink = new WYLink($oImgURL, $sText ? $this->sStripFormatting($sText):" ");
                        $oLink->setAttribute("rel", "lightbox[wygallery" . $uniqueGalleryID . "]");
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    } else if ($webyep_iUseImageBox == WEBYEP_LIGHTBOX) {
                        unset($oImgURL);
                        $oImgURL = od_clone($goApp->oDataURL);
                        $oImgURL->addComponent($sFilename);
                        if ($webyep_sLiveDemoSlotID) {
                            $oImg = new WYImage($oImgURL);
                            if (!$oImg->bExists()) $oImgURL->removeDemoSlotID();
                        }
                        $oLink = new WYLink($oImgURL, $sText ? $this->sStripFormatting($sText):" ");
                        $oLink->setAttribute("rel", "lightbox[$sBoxName]");
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    } else if ($webyep_iUseImageBox == WEBYEP_FANCYBOX) {
                        unset($oImgURL);
                        $oImgURL = od_clone($goApp->oDataURL);
                        $oImgURL->addComponent($sFilename);
                        if ($webyep_sLiveDemoSlotID) {
                            $oImg = new WYImage($oImgURL);
                            if (!$oImg->bExists()) $oImgURL->removeDemoSlotID();
                        }
                        $oLink = new WYLink($oImgURL, $sText ? $this->sStripFormatting($sText):" ");
                        $oLink->setAttribute("rel", "fancybox_$sBoxName");
                        $oLink->setAttribute("class", "WYPopUpImage");
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    } else {
                        $oDetailURL->dQuery[WY_QK_IMAGE_DETAIL] = $sFilename;
                        $oDetailURL->dQuery[WY_QK_IMAGE_ALTTEXT] = $this->sStripFormatting($sText);
                        $oDetailURL->dQuery[WY_QK_IMAGE_DEMOCONTENT] = $this->bDemoContent;
                        $oLink = new WYLink(new WYURL("javascript:void(0)"));
                        $oLink->setAttribute("onclick", sprintf("wydw=window.open(\"%s\", \"WYDetail\", \"width=%d,height=%d,status=yes,scrollbars=no,resizable=yes\"); wydw.focus();", $oDetailURL->sEURL(true, true, true), $this->iImageWidth, $this->iImageHeight));
                        $oLink->setToolTip(WYTS("ClickToZoom"));
                        $oLink->sInnerHTML = $oTN->sDisplay();
                        $sHTML .= $oLink->sDisplay();
                    }
                } else if ($bEditMode) {
                    $sHTML .= WYTS("GalleryNoImage");
                }
                $sHTML .= "</div>";
            }

            if ($bEditMode && ( ($i < $iCount) || ($i == 0) ) ) {
                $sHTML .= "\n<div>";
                $sHTML .= $this->_sEditButtons(($i < $iCount) ? $i:-1);
                $sHTML .= "</div>";
            }

            if ($i < $iCount) {
                if ($sText) {
                    $sHTML .= sprintf("<div class=\"%s\">", WY_GALLERY_CSS_TEXT);
                    $sHTML .= WYLongTextElement::_sFormatContent($sText, true);
                    $sHTML .= "</div>";
                }
            }

            $sHTML .= $webyep_bUseTablesForGalleries ? "</td>\n":"</div>\n"; 

            $i++;
            if (!($i % $iCols)) $sHTML .= $webyep_bUseTablesForGalleries ? "   </tr>\n":"   </div>\n"; 
        }
        $sHTML .= $webyep_bUseTablesForGalleries ?  "</table>\n":"</div>\n"; 

        return $sHTML;
    }
}
?>
