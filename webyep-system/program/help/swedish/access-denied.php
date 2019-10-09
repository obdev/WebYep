<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<html>
<!-- DW6 -->
<head>
<!--
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
-->

<title><?php echo $webyep_sProductName?>
</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?>
  : inloggning</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>

<p>Innan du kan b&ouml;rja redigera dina sidor m&aring;ste du logga in p&aring; <?php echo $webyep_sProductName?> WCM-system med ditt <strong> anv&auml;ndarnamn och  l&ouml;senord</strong>.</p>
<p>V&auml;nligen v&auml;nd er till er webbmaster som kan dela ut anv&auml;ndarnamn och l&ouml;senord.</p>
<p>Eller l&auml;s i dokumentationen i avsnittet Installation p&aring;
  webbserver/Konfiguration d&auml;r det anges hur man skapar anv&auml;ndarnamn och l&ouml;senord.</p>
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
