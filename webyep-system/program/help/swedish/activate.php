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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Hj&auml;lp: 
  <?php echo $webyep_sProductName?>
    &auml;r inte aktiverad</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>

<p><?php echo $webyep_sProductName?> kan inte skriva data f&ouml;r skrivr&auml;ttigheterna &auml;r inte korrekt angivna.</p>
<p>V&auml;nligen kontakta ansvarig webbmaster f&ouml;r att aktivera
  <?php echo $webyep_sProductName?>.</p>
<p>Eller l&auml;s dokumentationens avsnitt Installation p&aring; webbservern/Aktivering
  d&auml;r r&aring;d ges hur man aktiverar <?php echo $webyep_sProductName?>.</p>
<p class="remark"><strong>Teknisk anm&auml;rkning:</strong> De beh&ouml;righeter som kr&auml;vs &auml;r &quot;read/write/execute&quot; f&ouml;r
&quot;alla&quot; (unix mode 0777) p&aring; mappen webyep-system:data</p>
<span class="textButton">&lt;st&auml;ng f&ouml;nstret&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
