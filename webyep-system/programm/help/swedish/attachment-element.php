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
  : Bifoga fil
    </h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>

<p>Dialogrutan Bifoga fil g&ouml;r det m&ouml;jligt att l&auml;gga upp (och ta bort) datafiler (dokument) p&aring; webbsidan. </p>
<h3>Beskrivning</h3>
<p><b>Byta ut eller l&auml;gga upp en ny fil:</b></p>
<p>Klicka &quot;Browse...&quot; f&ouml;r att v&auml;lja filen du vill ladda upp p&aring; webbsidan. Klicka OK n&auml;r du valt fil och klicka sedan knappen Skicka fil f&ouml;r att b&ouml;rja ladda upp filen.</p>
<p><i>Anm&auml;rkning: </i>att flytta filen fr&aring;n din dator till webbservern (d&auml;r din webbsida ligger) tar olika l&aring;ng tid beroende av datorns bandbredd f&ouml;r internettrafik.</p>
<p><b>Radera en fil:</b></p>
<p>Klicka knappen Radera fil f&ouml;r att ta bort filen fr&aring;n webbsidan samt fr&aring;n webbservern.</p>
<p>Efter att knappen Skicka fil eller Radera fil har klickats s&aring; st&auml;ngs redigeringsf&ouml;nstret och den &auml;ndrade webbsidan visas.<br>
  <span class="remark">I vissa enstaka fall kan webbsidan beh&ouml;va uppdateras manuellt innan &auml;ndringen syns.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
