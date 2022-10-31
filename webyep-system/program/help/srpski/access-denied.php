<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<html>
<head>
<!--
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
-->
<!-- #BeginEditable "doctitle" -->
<title><?php echo $webyep_sProductName?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1> 
        <?php echo $webyep_sProductName?>
        Pomoc: Prijavljivanje</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<!-- #BeginEditable "content" --> 
<p>Za obradu sadrzaja ove web stranice morate se sa svojim <strong>korisnickim 
  imenom i lozinkom</strong> prijaviti na 
  <?php echo $webyep_sProductName?>
  Content Management System.</p>
<p>Za pristupne podatke se obratite <strong>web dizajneru</strong> koji Vam je 
  napravio web sajt.</p>
<p>Ili podesiite svoje pristupne podatke u <strong>dokumentaciji</strong> za web 
  dizajnere, pod <strong>&quot;Instalacija na web serveru / Konfiguracija&quot;</strong>.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span> 
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
