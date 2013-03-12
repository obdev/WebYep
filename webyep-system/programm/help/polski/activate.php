<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<html><!-- #BeginTemplate "/Templates/help-1.1-en.dwt" --><!-- DW6 -->
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
<span class="textButton">&lt;<a href="javascript:window.close();">Zamknij okno</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Pomoc: <?php echo $webyep_sProductName?>
      nie jest aktywywany</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<!-- #BeginEditable "content" -->
<p><?php echo $webyep_sProductName?> nie mo¿e zapisaæ danych pomiewa¿ dostêp do plików jest nieprawid³owo ustawiony.</p>
<p>Prosimy o kontakt z administratorem aby &quot;aktywowaæ&quot;
  <?php echo $webyep_sProductName?>.</p>
<p>Je¶li jeste¶ twórc± sprawd¼ w dokumentacji (&quot;Instalacja na serwerze / Aktywacja&quot;)
  jak aktywowaæ <?php echo $webyep_sProductName?>.</p>
<p class="remark"><strong>Nota techniczna:</strong> Prawa dostêpu powinny byæ &quot; odczyt/zapis/wykonanie &quot; dla
  &quot;wszystkich&quot; folderów (unix 0777), dla foderu &quot;data&quot; wewn±trz folderu webyep-system.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">Zamknij okno</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
