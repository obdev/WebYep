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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?>Aide : <?php echo $webyep_sProductName?>n'est pas installé</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p><?php echo $webyep_sProductName?> ne peut pas écrire/enregistrer les fichiers, veuillez vérifier les <strong>droits</strong> sur le serveur.</p>
<p>Veuillez svp. contacter la personne qui a cr&eacute;&eacute; ce site web.</p>
<p>Ou allez lire la <b>documentation</b> pour WebDesigner sous &quot;<b>Installation sur le serveur/ Préparer </b>&quot;, pour donner les droits nécessaires.</p>
<p class="remark"><b>Avis technique :</b> Ce sont les droits : écrire/lire/exécuter 
   pour &quot;tous&quot; (chmod 0777) à donner pour le dossier
   &quot;data&quot; qui se trouve dans le dossier&quot;webyep-system&quot;sur votre serveur.</p>
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
