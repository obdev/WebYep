<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = ".";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYImage.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYPath.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYImageElement.php");

	$oImage = $oURL = od_nil;
	$sFilename = "";

	if (isset($_GET[WY_QK_IMAGE_DETAIL])) {
		$sFilename = $_GET[WY_QK_IMAGE_DETAIL];
		$sAltText = $_GET[WY_QK_IMAGE_ALTTEXT];
		$bDemoContent = $_GET[WY_QK_IMAGE_DEMOCONTENT];
		$oP = new WYPath($sFilename);
		if (!$oP->bCheck(WYPATH_CHECK_NOPATH|WYPATH_CHECK_JUSTIMAGE)) {
	        $goApp->log("illegal filename in image-detail: <$sFilename>");
	        exit(-1);
		}
		$oURL = od_clone($goApp->oDataURL);
		if ($bDemoContent) $oURL->removeDemoSlotID();
		$oURL->addComponent($sFilename);
		$oImage = new WYImage($oURL);
		if ($sAltText) $oImage->setAttribute("alt", $sAltText);
		$iW = $oImage->iWidth();
		$iH = $oImage->iHeight();
		if (!$sAltText) $sAltText = WYTS("GalleryCloseWindow");
	}
	else exit(-1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php WYTSD("GalleryDetailTitle", true); ?></title>
<?php echo $goApp->sCharsetMetatag() ?>
<script type="text/javascript">
	function setupWindow()
	{
		var iW = <?php echo $iW?>;
		var iH = <?php echo $iH?>;
		var _iH, _iW, iSW = 0, iSH = 0;

		if (iW && iH) {
			if (screen) {
				if (screen.availWidth != undefined) {
					iSW = screen.availWidth;
					iSH = screen.availHeight;
				}
				else {
					iSW = screen.width;
					iSH = screen.height;
				}
				if (iSW && iSH) {
					_iSW = iSW * 0.8;
					_iSH = iSH * 0.8;
					if (iW > _iSW | iH > _iSH) {
						if (iW >= _iSW) iW = _iSW;
						if (iH >= _iSH) iH = _iSH;
						document.body.style.overflow = "auto";
<?php if ($goApp->bIsExplorer) { ?>
						_iH = document.body.clientHeight;
						_iW = document.body.clientWidth;
						window.resizeTo(_iW, _iH);
						_iH = iH + _iH - document.body.clientHeight;
						_iW = iW + _iW - document.body.clientWidth;
						window.resizeTo(_iW, _iH);
						window.moveTo((iSW - _iW) / 2.0, (iSH - _iH) / 2.0);
<?php } else { ?>
						_iH = iH + window.outerHeight - window.innerHeight;
						_iW = iW + window.outerWidth - window.innerWidth;
						window.resizeTo(_iW, _iH);
						window.moveTo((iSW - _iW) / 2.0, (iSH - _iH) / 2.0);
<?php } ?>
					}
					else {
						document.body.style.overflow = "hidden";
<?php if ($goApp->bIsExplorer) { ?>
						_iH = document.body.clientHeight;
						_iW = document.body.clientWidth;
						window.resizeTo(_iW, _iH);
						_iH = iH + _iH - document.body.clientHeight;
						_iW = iW + _iW - document.body.clientWidth;
						window.resizeTo(_iW, _iH);
						window.moveTo((iSW - _iW) / 2.0, (iSH - _iH) / 2.0);
<?php } else { ?>
						_iH = iH + window.outerHeight - window.innerHeight;
						_iW = iW + window.outerWidth - window.innerWidth;
						window.resizeTo(_iW, _iH);
						window.moveTo((iSW - _iW) / 2.0, (iSH - _iH) / 2.0);
<?php } ?>
					}
				}
			}
		}
	}
</script>
<style type="text/css">
img { border-style: none; }
html, body { margin: 0; }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="setupWindow()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle"><?php
		if ($oImage) {
			echo "<a href='javascript:window.close();' title='$sAltText'>";
			echo $oImage->sDisplay();
			echo "</a>";
		}
	?></td>
  </tr>
</table>
</body>
</html>
