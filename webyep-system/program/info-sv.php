<?php if ($webyep_bLiveDemo) exit(0); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>WebYep System Infos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php
	$oCSS = od_clone($goApp->oProgramURL);
	$oCSS->addComponent("styles.css");
	echo $oCSS->sEURL();
?>" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  top[winName] = window.open(theURL,winName,features);
  setTimeout("top['" + winName + "'].focus();", 250);
}
//-->
</script>
</head>
<?php
	// WebYep
	// (C) Objective Development Software GmbH
	// http://www.obdev.at
	
	$bPermOK = false;
	$oP = od_nil;
	$oF = od_nil;
	
	srand ((float) microtime() * 1000000);
	$sFilename = "permission-test" . mt_rand(1000, 9999);
	$oP = od_clone($goApp->oDataPath);
	$oP->addComponent($sFilename);
	$oF = new WYFile($oP);
	$oF->setContent("write test");
	$bPermOK = $oF->bWrite();
	@$oF->bDelete();

    $bRegGlob = ini_get("register_globals") != 0;

    $sMaxUpload = $goApp->sFormattedByteSizeString($goApp->iMaxUploadBytes());
?>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="pageTitle" align="left" valign="middle">WebYep systeminfo</td>
    <td align="right" valign="top"><a href="http://www.obdev.at/webyep/" target="_blank"><img src="program/images/logo.gif" align="top" border="0" alt="WebYep webbsajt"></a></td>
  </tr>
</table>
<hr size="1" noshade>
<h2>Installerad WebYep-version</h2>
<p><b>Version <?php echo "$webyep_iMajorVersion.$webyep_iMinorVersion.$webyep_iSubVersion $webyep_sVersionPostfix"?></b></p>
<?php if ($bRegGlob) { ?>
<h2 class="warning">Säkerhetsproblem</h2>
<p>Den här webbservern har en svag säkerhetskonfiguration. Vänligen be administratören att stänga av PHP-inställningen &quot;register_globals&quot;!</p>
<?php } ?>
<?php if (!$bPermOK) { ?>
<h2><font color="#990000">Skrivrättighet medgavs ej!</font></h2>
<p>WebYep är inte &quot;<b>prepared</b>&quot; och kan inte skriva data!</p>
<p>--&gt; <a href="program/help/english/activate.php" target="help" onclick="MM_openBrWindow('program/help/english/activate.php','help','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=700,height=450'); return false">Hur förbereder jag WebYep?</a></p>
<?php } else { ?>
<h2>Kontroll av skrivrättigheter</h2>
<p>WebYep har förberetts på rätt sätt och har skrivrättigheter.</p>
<?php } ?>
<h2>Bilder</h2>
<?php if (WYImage::bCanResizeImages()) { ?>
PHP kan skala om uppladdade bilder på den här servern (GD-bibliotek med JPG-stöd installerat).
<?php } else { ?>
PHP <font color="#990000"><b>kan inte</b></font> skala om bilder på den här servern (inget GD-bibliotek med JPG-stöd installerat)!
<?php } ?>
<p>Maxstorlek för uppladdade filer/bilder: <?php echo $sMaxUpload ?></p>
<?php webyep_showSystemInfos() ?>
</body>
</html>
