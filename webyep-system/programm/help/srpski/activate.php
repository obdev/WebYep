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
        Pomoc:  
        <?php echo $webyep_sProductName?>
        nije aktiviran</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<!-- #BeginEditable "content" --> 
<p> 
  <?php echo $webyep_sProductName?>
  nije u mogucnosti da sacuva podatke na vasem web sajtu jer potrebna <strong>ovlascenja 
  za promenu podataka </strong> nisu odgovarajuce dodeljena.</p>
<p>Obratite se web dizajneru koji Vam je napravio web sajt.</p>
<p>Ili pogledajte u <strong>dokumentaciji</strong> za web dizajnere, pod <strong>&quot;Instalacija 
  na web serveru / Aktiviranje&quot;</strong>, kako da ovlascenja za promenu podataka 
  odgovarajuce podesite.</p>
<p class="remark"><strong>Tehnicko pojasnjenje:</strong> Radi se o ovlascenjima 
  pisanje/citanje/izvodjenje za sve (read/write/execute; chmod 0777) koji su potrebni 
  za direktorijum &quot;podaci&quot;, koji se nalazi u direktorijumu &quot;webyep-system&quot;, 
  na Vasem web sajtu.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span> 
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
