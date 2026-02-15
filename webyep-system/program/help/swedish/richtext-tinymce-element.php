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
<title><?=$webyep_sProductName?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?=$webyep_sProductName?>
   : formaterad text (rich
    text) med TinyMCE</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p>Anv&auml;nd<strong> TinyMCE</strong> WYSIWYG HTML-redigering tillsammans med
  <?=$webyep_sProductName?>
Rich Text-f&auml;ltet och du kan formatera texten  utan att beh&ouml;va skriva HTML-kod f&ouml;r hand. </p>
<p>Funktionerna i<strong> TinyMCE</strong> kan variera beroende p&aring; den  webbl&auml;sare du anv&auml;nder. </p>
<p>Observera att kopiera/klistra in fr&aring;n ett ordbehandlingsprogram kan ge ov&auml;ntat resultat d&aring; den typen av konverteringen inte st&ouml;ds fullt ut.</p>
<h3>G&ouml;r s&aring; h&auml;r</h3>
<p>Skriv in din text och anv&auml;nd knapparna i <strong>TinyMCE</strong> f&ouml;r att formatera texten. Klicka sen Spara.</p>
<p>Redigeringsf&ouml;nstret st&auml;ngs och texten visas p&aring; webbsidan<br>
    <span class="remark">I enstaka fall kan du beh&ouml;va ladda om sidan manuellt innan &auml;ndringen syns.</span></p>
<p><span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span></p>
<hr>
<span class="remark"><?=$webyep_sCopyrightLine?></span>
</body>
</html>
