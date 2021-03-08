<?php if ($webyep_bLiveDemo) exit(0); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>WebYep informacje o systemie</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
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
?>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td class="pageTitle" align="left" valign="middle">WebYep informacje o systemie</td>
    <td align="right" valign="top"><a href="http://www.obdev.at/webyep/" target="_blank"><img src="program/images/logo.gif" align="top" border="0" alt="WebYep WebSite"></a></td>
  </tr>
</table>
<hr size="1" noshade>
<h2>Zainstalowana wersja WebYep</h2>
<p><b>Wersja <?php echo "$webyep_iMajorVersion.$webyep_iMinorVersion.$webyep_iSubVersion $webyep_sVersionPostfix"?></b></p>
<?php if (!$bPermOK) { ?>
<h2><font color="#990000">B&#322;&#261;d zapisu!</font></h2>
<p>WebYep nie jest  &quot;<b>aktywowany</b>&quot; i nie mo&#380;e zapisywa&#263; &#380;adnych danych!</p>
<p>--&gt; <a href="program/help/polski/activate.php" target="help" onClick="MM_openBrWindow('program/help/polski/activate.php','help','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=700,height=450'); return false">Jak aktywowa&#263; WebYep?</a></p>
<?php } else { ?>
<h2>Sprawdzenie praw dost&#281;pu do plik&oacute;w</h2>
<p>WebYep jest aktywowany prawid&#322;owo i posiada prawa zapisu.</p>
<?php } ?>
<h2>Image support</h2>
<?php if (WYImage::bCanResizeImages()) { ?>
PHP can resize uploaded images on this server (GD lib with JPG support installed).
<?php } else { ?>
PHP <font color="#990000"><b>cannot</b></font> resize images on this server (no GD lib with JPG support installed)!
<?php } ?>
<?php webyep_showSystemInfos() ?>
</body>
</html>
