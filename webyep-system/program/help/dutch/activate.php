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
<title><?php echo $webyep_sProductName?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">sluit venster</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: <?php echo $webyep_sProductName?>
      is niet geactiveerd</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p><?php echo $webyep_sProductName?> kan geen data wegschrijven omdat de bestandsbevoegdheden niet juist zijn ingesteld.</p>
<p>Neem contact op met de webdesigner die uw website heeft ontwikkeld om <?php echo $webyep_sProductName?> te activeren.</p>
<p>Of raadpleeg de documentatie (&quot;Installatie op de webserver / Activatie&quot;)
  om te zien hoe u <?php echo $webyep_sProductName?> kunt activeren.</p>
<p class="remark"><strong>Technische opmerking:</strong> De bestandsbevoegdheden zijn &quot;lezen/schrijven/uitvoeren&quot; voor
  &quot;alle&quot; onderdelen (unix mode 0777) voor de map &quot;data&quot; in de webyep-systeemmap.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">sluit venster</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
