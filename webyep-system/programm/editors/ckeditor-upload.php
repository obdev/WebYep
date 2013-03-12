<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	define("ACTION", "ACTION");
	define("ACTION_UPLOAD", "UPLOAD");

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	if (!$goApp->bEditMode) {
		$goApp->log("Editor " . basename($_SERVER['PHP_SELF']) . " called in non edit mode");
		exit();
	}

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFileUpload.php");

	$oHFFunctioNumber = new WYHiddenField('CKEditorFuncNum');
	$iFunctionNumber = (int)$oHFFunctioNumber->sValue();

	$oFU = new WYFileUpload("upload");
	$bOK = false;
	$sResponse = "";
	$sURL = "";

	if (isset($_REQUEST['CKEditor'])) {
		if ($oFU->bUploadOK()) {
			$oOriginalName = od_clone($oFU->oOriginalFilename());
			if ($oOriginalName->bCheck(WYPATH_CHECK_NOSCRIPT|WYPATH_CHECK_NOPATH|WYPATH_CHECK_JUSTIMAGE)) {
				$sFilename = $oOriginalName->sPath;
				$sExtension = $oOriginalName->sExtension();
				$sFilename = str_replace(".$sExtension", "", $sFilename);
				$sFilename = WYPath::sMakeFilename($sFilename);
				$oDestPath = od_clone($goApp->oDataPath);
				$sDestFilename = "rtimg-$sFilename.$sExtension";
				$oDestPath->addComponent($sDestFilename);
				$oFile = new WYFile($oFU->oFilePath());
				if (!$oFile->bCopyTo($oDestPath)) {
					$goApp->log("Could not copy uploaded image file");
					$sResponse = WYTS("FileUploadErrorUnknown", false);
				}
				else {
					$sResponse = "";
					$bOK = true;
					$oURL = od_clone($goApp->oDataURL);
					$oURL->addComponent($sDestFilename);
					$sURL = $oURL->sURL(false, false, true);
				}
			}
			else {
				$goApp->log("Illegal file/type on attachment upload: " . $oOFP->sPath);
				$sResponse = WYTS("FileUploadErrorUnknown", false);
			}
			$oFU->deleteTmpFile();
		}
		else $sResponse = $oFU->sErrorMessage(false);
	}
	else if (isset($_GET[WY_QK_POST_MAX_CHECK])) {
		$sResponse = WYTS("FileUploadErrorSize", false);
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script type="text/javascript">
  window.parent.CKEDITOR.tools.callFunction(<?php echo $iFunctionNumber; ?>, "<?php echo $sURL; ?>", "<?php echo $sResponse; ?>");
</script>
</head>
<body>
</body>
</html>
