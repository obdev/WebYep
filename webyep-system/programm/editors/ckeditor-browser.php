<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	define("FILENAME", "FN");
	define("PATH", "PATH");
	define("URL", "URL");
	define("NUM_COLS", 5);
	define("PADDING", 5);
	define("IMG_SIZE", 100);
	define("ACTION", "ACTION");
	define("ACTION_DELETE", "DELETE");
	define("ACTION_SELECT", "SELECT");

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	if (!$goApp->bEditMode) {
		$goApp->log("Editor " . basename($_SERVER['PHP_SELF']) . " called in non edit mode");
		exit();
	}

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");

	$oHFCKEditorName = new WYHiddenField('CKEditor');
	$sCKEditorName = $oHFCKEditorName->sValue();
	$oHFFunctioNumber = new WYHiddenField('CKEditorFuncNum');
	$sFunctionNumber = $oHFFunctioNumber->sValue();
	$oHFLanguageCode = new WYHiddenField('langCode');
	$sLangCode = $oHFLanguageCode->sValue();

	$oHFAction = new WYHiddenField(ACTION);
	$sAction = $oHFAction->sValue();

//	$sResponse = WYTS("RichTextSaved");
//   $oCKBaseURL = od_clone($goApp->oProgramURL);
//   $oCKBaseURL->addComponent("opt");
//   $oCKBaseURL->addComponent("ckeditor");
//	$oCKJSURL = od_clone($oCKBaseURL);
//	$oCKJSURL->addComponent("ckeditor.js");

	$goApp->outputWarningPanels(); // give App a chance to say something

	if ($sAction == ACTION_DELETE) {
		$oHFFilename = new WYHiddenField(FILENAME);
		$oFullPath = od_clone($goApp->oDataPath);
		$oFilename = new WYPath($oHFFilename->sValue());
		if ($oFilename->bCheck(WYPATH_CHECK_JUSTIMAGE|WYPATH_CHECK_NOPATH)) {
			$oFullPath->addComponent($oFilename->sPath);
			$oFile = new WYFile($oFullPath);
			$oFile->bDelete();
		}
	}

	$aEntries = array();
	$r = opendir($goApp->oDataPath->sPath);
	while (($sEntry = readdir($r)) !== false) {
		if ($sEntry[0] == ".") continue;
		if (substr($sEntry, 0, 5) != "rtimg") continue;
		unset($dEntry);
		$oPath = od_clone($goApp->oDataPath);
		$oPath->addComponent($sEntry);
		$dEntry[PATH] = $oPath->sPath;
		$oURL = od_clone($goApp->oDataURL);
		$oURL->addComponent($sEntry);
		$dEntry[URL] = $oURL->sPath;
		$dEntry[FILENAME] = $sEntry;
		$aEntries[] = $dEntry;
	}
	closedir($r);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("RichTextEditorImageUploadTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function returnURL($sURL)
{
		window.opener.CKEDITOR.tools.callFunction( <?php echo $sFunctionNumber; ?>, $sURL);
		window.close();
}
function confirmDelete()
{
	return confirm("<?php WYTSD("DeleteImageQuestion"); ?>");
}
</script>
</head>

<body>
<div style="margin-left: auto; margin-right: auto; overflow: auto; height: 100%; width: <?php echo NUM_COLS * (IMG_SIZE + 2*PADDING) + 24?>;">
<table border="0" cellpadding="<?php echo PADDING; ?>" cellspacing="0">
<?php
	$iCol = 0;
	$oURL = od_clone($goApp->oImageURL);
	$oURL->addComponent("remove-button.gif");
	$oTrashImg = new WYImage($oURL);
	$oTrashImg->setAttribute("style", "border: 0");
	foreach ($aEntries as $dEntry) {
		if ($iCol == 0) echo "<tr>";
		$sFilename = $dEntry[FILENAME];
		$sDisplayFilename = str_replace("rtimg-", "", $sFilename);
		$sDisplayFilename = preg_replace('|([-_])|', '\1&shy;', $sDisplayFilename);
		$sURL = $dEntry[URL];
		$sPath = $dEntry[PATH];
		$oImg = new WYImage(new WYURL($sURL));
		$iWidth = $oImg->iWidth();
		$iHeight = $oImg->iHeight();
		if ($iWidth != 0 && $iHeight != 0) WYImage::bLimitSize($iWidth, $iHeight, IMG_SIZE, IMG_SIZE);
		else $iWidth = $iHeight = IMG_SIZE;
		$oImg->setAttribute("width", $iWidth);
		$oImg->setAttribute("height", $iHeight);
		$oImg->setAttribute("style", "border: 0");

		unset($oTrashLink);
		unset($oTrashLinkURL);
		$oTrashLinkURL = od_clone(WYURL::oCurrentURL());
		$oTrashLinkURL->dQuery[ACTION] = ACTION_DELETE;
		$oTrashLinkURL->dQuery[FILENAME] = $sFilename;
		$oTrashLink = new WYLink($oTrashLinkURL);
		$oTrashLink->setAttribute("onclick", "return confirmDelete()");
		$oTrashLink->setInnerHTML($oTrashImg->sDisplay());
		$oTrashLink->setToolTip(WYTS("DeleteImageButton"));

		unset($oSelectLink);
		$oSelectLink = new WYLink(new WYURL("javascript:void(0)"));
		$oSelectLink->setAttribute("onclick", "returnURL(\"" . $sURL . "\"); return false;");
		$oSelectLink->setInnerHTML($oImg->sDisplay());
		$oSelectLink->setToolTip($sDisplayFilename);

		echo "<td>";
		echo $oSelectLink->sDisplay();
		echo "<div style=\"margin-bottom: 16px; margin-top: 6px; text-align: center\">";
		echo $oTrashLink->sDisplay();
		echo "</div>";
		echo "</td>";
		$iCol++;
		if ($iCol == NUM_COLS) {
			echo "</tr>\n";
			$iCol = 0;
		}
	}
?>
</table>
</div>
</body>
</html>
