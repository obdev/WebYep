<?php
	$iLeftPhotoPadding = ##LeftPhotoPadding##;
	$iRightPhotoPadding = ##RightPhotoPadding##;
	$iLeftPhotoWidth = ##UseLeftPhotoWidth## ? ##LeftPhotoWidth##:0;
	$iRightPhotoWidth = ##UseRightPhotoWidth## ? ##RightPhotoWidth##:0;
	$iCenterPhotoPadding = ##CenterPhotoPadding##;
	$iCenterPhotoWidth = ##UseCenterPhotoWidth## ? ##CenterPhotoWidth##:0;
	$iBlockPadding = ##BlockPadding##;

    if (!isset($iPageID)) $iPageID = 0;

    if (!function_exists("webyep_bCheckImage")) {
        function webyep_bCheckImage($sN, $iFixedW, &$sWCSS)
        {
            $bRet = false;

            $sWCSS = "";
            $oElement = new WYImageElement($sN, false, $iFixedW ? "width=\"$iFixedW\"":"", "", "");
            $sContent = $oElement->sDisplay();
            if ($sContent) {
                if ($iFixedW) $iW = $iFixedW;
                else {
                    $oImg = $oElement->oImage();
                    $iW = $oImg ? $oImg->iWidth():0;
                }
                $sWCSS = $iW ? (" width: " . $iW . "px;"):"";
                $bRet = true;
            }
            return $bRet;
        }
    }

    if ($iPageID) $sFieldPostfix = "_$iPageID";
    else $sFieldPostfix = "";
    $iPageID++;
	$sWidthCSS = "";
?>
