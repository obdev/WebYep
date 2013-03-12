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
        Pomoc: Kratki tekst</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<!-- #BeginEditable "content" --> 
<h3>Opis</h3>
<p>Pod kratkim tekstom se podrazumevaju kraci delovi teksta kao sto su naslovi, 
  oznake za proizvode ili cene. Kratki tekstovi su obicno jednoredni. Kod kratkog 
  teksta nije moguce formatiranje, kao kod uobicajenog teksta.</p>
<h3>Postupak</h3>
<p>Upisite zeljeni tekst u za ot predvidjeno polje i kliknite na &quot;sacuvaj&quot;.</p>
<p><span class="remark">Posle klika na &quot;sacuvaj&quot; se prozor za upisivanje 
  zatvara i mozete da vidite svoj web sajt sa promenjenim tekstom.<br>
  (u retkim slucajevima morate u Browser-u da aktuelizujete svoj sajt).</span></p>
 <span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span> 
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
