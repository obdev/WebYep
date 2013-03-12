<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYApplication.php');
include_once(@webyep_sConfigValue('webyep_sIncludePath') . '/lib/WYHTMLTag.php');

$webyep_bGD2Installed = '';

// Thanks to Hagan Fox - code copied from php.net:
function webyep_gdVersion($user_ver = 0) {
    if (! extension_loaded('gd')) { return; }
    static $gd_ver = 0;
    // Just accept the specified setting if it's 1.
    if ($user_ver == 1) { $gd_ver = 1; return 1; }
    // Use the static variable if function was called previously.
    if ($user_ver !=2 && $gd_ver > 0 ) { return $gd_ver; }
    // Use the gd_info() function if possible.
    if (function_exists('gd_info')) {
        $ver_info = gd_info();
        preg_match('/\d/', $ver_info['GD Version'], $match);
        $gd_ver = $match[0];
        return $match[0];
    }
    // If phpinfo() is disabled use a specified / fail-safe choice...
    if (preg_match('/phpinfo/', ini_get('disable_functions'))) {
        if ($user_ver == 2) {
            $gd_ver = 2;
            return 2;
        } else {
            $gd_ver = 1;
            return 1;
        }
    }
    // ...otherwise use phpinfo().
    ob_start();
    phpinfo(8);
    $info = ob_get_contents();
    ob_end_clean();
    $info = stristr($info, 'gd version');
    preg_match('/\d/', $info, $match);
    $gd_ver = $match[0];
    return $match[0];
}



class WYImage extends WYHTMLTag {
    // instance variables
    var $oURL;

    // class methods

    function bGD2Installed() {
        global $webyep_bGD2Installed;
        if ($webyep_bGD2Installed === '') {
            $webyep_bGD2Installed = webyep_gdVersion() >= 2;
        }
        return $webyep_bGD2Installed;
    }

    function aGetImageSize($oP) {
        global $goApp;

        $aOut = array(0, 0);
        $a = getimagesize($oP->sPath);
        if ($a !== false) {
            $aOut[0] = $a[0];
            $aOut[1] = $a[1];
        } else {
            $goApp->log('could not determine image size of: ' . $oP->sPath);
        }
        return $aOut;
    }

    function bCanResizeImages() {
        if (function_exists('imagejpeg') && (function_exists('imagecopyresampled') || function_exists('imagecopyresized'))) {
            return true;
        } else {
            return false;
        }
    }

    function _allocateMemoryForImage($oP) {
        global $goApp;
        $aImageInfo = getimagesize($oP->sPath);
        $iMB = 1048576; // number of bytes in 1M
        $iK64 = 65536; // number of bytes in 64K
        $iTweakFactor = 1.8;
        $iMemoryNeeded = (int)round(($aImageInfo[0] * $aImageInfo[1] * $aImageInfo['bits'] / 8 * $aImageInfo['channels'] + $iK64) * $iTweakFactor);
        $iMemoryLimit = $goApp->iMemoryLimit();
        $iCurrentUsage = $goApp->iCurrentMemoryUsage();
        if (!$iCurrentUsage) $iCurrentUsage = 8*$iMB; // assume about 8MB current usage
        if ($iMemoryLimit && $iCurrentUsage + $iMemoryNeeded > $iMemoryLimit) {
            $iNewLimit = $iMemoryNeeded + $iCurrentUsage;
            $goApp->setMemoryLimit($iNewLimit);
        }
    }

    function bResizeImage($oPIn, $oPOut, $iW, $iH) {
        // replace the image with the resized one
        global $goApp;
        $bSuccess = false;

        $rInImage = $rOutImage = false;

        WYImage::_allocateMemoryForImage($oPIn);

        if (!function_exists('imagejpeg')) {
            $goApp->log('bResizeImage: no GD lib with JPEG support installed');
            return false;
        }

        if (strtolower($oPIn->sExtension()) == 'jpg') {
            if (!function_exists('imagecreatefromjpeg')) {
                $goApp->log('bResizeImage: no imagecreatefromjpeg function found');
                return false;
            }
            else $rInImage = @imagecreatefromjpeg($oPIn->sPath);
        }
        else if (strtolower($oPIn->sExtension()) == 'gif') {
            if (!function_exists('imagecreatefromgif')) {
                $goApp->log('bResizeImage: no imagecreatefromgif function found');
                return false;
            }
            else $rInImage = @imagecreatefromgif($oPIn->sPath);
        }
        else if (strtolower($oPIn->sExtension()) == 'png') {
            if (!function_exists('imagecreatefrompng')) {
                $goApp->log('bResizeImage: no imagecreatefrompng function found');
                return false;
            }
            else $rInImage = @imagecreatefrompng($oPIn->sPath);
        }

        if (!$rInImage) {
            $goApp->log('bResizeImage: could not create image from ' . $oPIn->sPath);
            return false;
        }

        if (WYImage::bGD2Installed() && function_exists('imagecreatetruecolor')) $rOutImage = @imagecreatetruecolor($iW, $iH);
        else if (function_exists('imagecreate')) $rOutImage = @imagecreate($iW, $iH);
        if (!$rOutImage) {
            $goApp->log("bResizeImage: could not create output image of size $iW/$iH");
            return false;
        }

        // preserve transparency
        if (strtolower($oPIn->sExtension()) == 'gif' || strtolower($oPIn->sExtension()) == 'png') {
            if (function_exists('imagecolortransparent') && function_exists('imagecolorallocatealpha')
              && function_exists('imagealphablending') && function_exists('imagesavealpha')) {
                @imagecolortransparent($rOutImage, @imagecolorallocatealpha($rOutImage, 0, 0, 0, 127));
                @imagealphablending($rOutImage, false);
                @imagesavealpha($rOutImage, true);
            } else {
                $goApp->log('bResizeImage: unable to create transparent image');
            }
        }

        if (WYImage::bGD2Installed() && function_exists('imagecopyresampled'))
            $bSuccess = @imagecopyresampled($rOutImage, $rInImage, 0, 0, 0, 0, $iW, $iH, imagesx($rInImage), imagesy($rInImage));
        if (!$bSuccess && function_exists('imagecopyresized'))
            $bSuccess = @imagecopyresized($rOutImage, $rInImage, 0, 0, 0, 0, $iW, $iH, imagesx($rInImage), imagesy($rInImage));
        if (!$bSuccess) {
            $goApp->log('bResizeImage: could not use imagecopyresampled or imagecopyresized');
            return false;
        }

        unset($rInImage); // close input file
        switch(strtolower($oPIn->sExtension())) { // save image as the right file type
            case 'gif': $bSuccess = @imagegif($rOutImage, $oPOut->sPath); break;
            case 'png': $bSuccess = @imagepng($rOutImage, $oPOut->sPath, 9); break;
            case 'jpg': $bSuccess = @imagejpeg($rOutImage, $oPOut->sPath, 100); break;
            case 'jpeg': $bSuccess = @imagejpeg($rOutImage, $oPOut->sPath, 100); break;
        }

        chmod($oPIn->sPath, 0644);
        if (!$bSuccess) {
            $goApp->log("bResizeImage: could not create output image");
        }

        return $bSuccess;
    }

    function bLimitSize(&$iW, &$iH, $iMaxW, $iMaxH) {
        if (!$iMaxW) $iMaxW = $iW;
        if (!$iMaxH) $iMaxH = $iH;
        $fFactor = min($iMaxW / $iW, $iMaxH / $iH);
        if ($fFactor < 1.0) {
            $iW = (int)($iW * $fFactor);
            $iH = (int)($iH * $fFactor);
            return true;
        }
        return false;
    }

    // instance methods
    function WYImage($oURL, $sN = '') {
        global $goApp;
        $aDim = array();
        $oP = od_nil;
        $sDocRoot = '';
        $sURL = '';
        $iW = 0;
        $iH = 0;

        parent::WYHTMLTag('img');
        $oURL->makeSiteRelative();
        $this->oURL = $oURL;
        $sURL = $this->oURL->sEURL();
        $this->dAttributes['src'] = $sURL;
        if ($sN) $this->dAttributes['name'] = $sN;

        $oP = $this->oPath();
        if (is_readable($oP->sPath)) {
            $aDim = getimagesize($oP->sPath);
            $iW = $aDim[0];
            $iH = $aDim[1];
        }
        if ($iW && $iH) {
            $this->dAttributes['width'] = $iW;
            $this->dAttributes['height'] = $iH;
        }
        // $this->dAttributes["border"] = 0;
        $this->dAttributes['alt'] = '';
    }

    function oPath() {
        global $goApp;

        $oP = od_clone($goApp->oDocumentRoot());
        $sURL = $this->oURL->sURL();
        if ($oP) {
            $sURL = substr($sURL, 1); // remove leading "/"
            $oP->addComponent($sURL);
        }
        // workaround for webyep if DOCUMENT_ROOT fails
        if ((!$oP || !$oP->bExists()) && strstr($sURL, 'webyep-system/')) {
            $sURL = preg_replace('|^.*webyep-system/|', '', $sURL);
            $oP = od_clone($goApp->oProgramPath);
            $oP->removeLastComponent();
            $oP->addComponent($sURL);
        }
        return $oP;
    }

    function bExists() {
        $oP = $this->oPath();
        return $oP->bExists();
    }

    function iWidth() {
        return isset($this->dAttributes['width']) ? (int)$this->dAttributes['width']:0;
    }

    function iHeight() {
        return isset($this->dAttributes['height']) ? (int)$this->dAttributes['height']:0;
    }

    function sMD5() {
        $oP =& $this->oPath();
        $oF = new WYFile($oP);
        $sC = $oF->sContent();
        return md5($sC);
    }
}
?>