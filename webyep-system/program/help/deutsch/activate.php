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
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Hilfe: <?php echo $webyep_sProductName?> ist nicht eingerichtet</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p><?php echo $webyep_sProductName?> kann keine Daten in Ihre Website speichern, weil die n&ouml;tigen 
   <b>Zugriffsrechte</b> nicht vergeben wurden.</p>
<p>Bitte wenden Sie sich an die <b>WebdesignerInnen</b>, die Ihre Website 
   gestaltet haben.</p>
<p>Oder schlagen Sie in der <b>Dokumentation</b> f&uuml;r 
   WebdesignerInnen unter &quot;<b>Installation auf dem Webserver / Einrichten</b>&quot; 
   nach, um die n&ouml;tigen Zugriffsrechte zu vergeben.</p>
<p class="remark"><b>Technischer Hinweis:</b> Es sind die Rechte: Schreiben/Lesen/Ausf&uuml;hren 
   f&uuml;r &quot;alle&quot; (chmod 0777) zu vergeben und zwar f&uuml;r den Ordner 
   &quot;daten&quot; der sich im Ordner &quot;webyep-system&quot; Ihrer Website 
   befindet.</p>
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
