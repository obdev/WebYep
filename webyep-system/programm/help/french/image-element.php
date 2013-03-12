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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Aide : image</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>Avec la fenêtre &quot;Image&quot; vous pouvez insérer/supprimer des images de votre page web.</p>
<p><b>Important :</b> Les images à insérer doivent avoir un format qui est accepté par les &quot;navigateurs internet&quot; :</p>
<ul>
  <li>Elles ne doivent pas être trop grandes (largeur-hauteur) et attention au poids du fichier ! <br>
  Une hauteur et une largeur d'environ 200-300 pixel ainsi qu'un poids maximum de 100-150Ko (Kilo octet) devrait être une règle. <br>
  <br>
  </li>
   <li>Elles doivent avoir un format accepté comme par exemple .<strong>GIF</strong> ou .<strong>JPG</strong> (JPEG). Les navigateurs sont de plus en plus capable de lire aussi d'autres formats images - veuillez contacter votre Webmaster si nécessaire.</li>
</ul>
<h3>A procéder comme suit :</h3>
<p><b>Modifier l'image :</b></p>
<p>Allez sur &quot;Recherche...&quot; et choisissez un fichier image sur votre PC/Mac (cliquer sur le fichier image et ensuite sur
&quot;Choisir&quot; et &quot;OK&quot;).</p>
<p><i>Avis :</i> La durée du transfert dépend de votre connexion internet.</p>
<p><b>Supprimer un fichier :</b></p>
<p>Allez sur &quot;Supprimer&quot; pour supprimer l'image qui se trouve sur votre serveur. (Le fichier original qui se trouve sur votre PC/Mac ne sera pas supprimé).</p>
<p>La fenêtre se ferme après l'enregistrement et votre page web modifiée apparaît.<br>
  <span class="remark">(Dans de rares cas vous devez actualiser votre navigateur pour voir les modifications)</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
