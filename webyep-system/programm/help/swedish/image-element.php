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
  : Bild</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>

<p>I f&ouml;nstret Redigera bild kan du l&auml;gga till/ta bort fotografier och grafik.</p>
<p><b>Viktigt:</b> bilden m&aring;ste f&ouml;rst sparas i ett standardformat f&ouml;r webben dvs:</p>
<ul>
  <li>Bilden b&ouml;r inte vara st&ouml;rre &auml;n  100-150 kBytes och b&ouml;r &auml;ven ha sm&aring; dimensioner  (bredd och h&ouml;jd b&ouml;r inte &ouml;verskrida 200-300 bildpixlar).</li>
  <li>Filformatet m&aring;ste fungera med de vanligaste webbl&auml;sarna  (GIF
    eller JPEG &auml;r l&auml;mpliga format).</li>
</ul>
<h3>Beskrivning</h3>
<p><b>L&auml;gga upp en bild</b></p>
<p>Klicka knappen <i>&quot;Browse...&quot;</i> f&ouml;r att bl&auml;ddra fram till den bild du vill anv&auml;nda. Klicka OK n&auml;r du valt bild. Klicka sedan Spara s&aring; laddas bilden upp till webbsidan.</p>
<p><i>Anm&auml;rkning:</i> att flytta bilden fr&aring;n din dator till webbservern (d&auml;r din webbsida ligger) tar olika l&aring;ng tid beroende av datorns bandbredd f&ouml;r internettrafik. </p>
<p><b>Radera en bild:</b></p>
<p>Klicka knappen Radera bild f&ouml;r att ta bort bilden fr&aring;n webbsidan samt fr&aring;n webbservern.</p>
<p>Efter att knappen Spara eller Radera bild har klickats s&aring; st&auml;ngs redigeringsf&ouml;nstret och den &auml;ndrade webbsidan visas.<br>
<span class="remark">I vissa enstaka fall kan webbsidan beh&ouml;va uppdateras manuellt innan &auml;ndringen syns. </span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
