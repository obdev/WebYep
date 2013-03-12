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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Aide : Galerie</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p> Avec la fenêtre &quot;Galerie&quot; vous pouvez éditer et modifier vos images de la Galerie.</p>
<p><b>Important :</b> Les images à insérer doivent avoir un format qui est accepté par les &quot;navigateurs internet&quot; :</p>
<ul>
<li>Elles ne doivent pas être trop grande (largeur et hauteur) et attention au poids du fichier ! <br>
  Une hauteur et une largeur de maximum 600 pixels ainsi qu'un poids maximum de 300Ko devrait être une règle.<br>
  <br>
</li>
   <li>Elles doivent avoir un format accepté comme par exemple .<strong>GIF</strong> ou .<strong>JPG</strong> (JPEG) ou .<strong>PNG</strong>. Les navigateurs sont de plus en plus capable de lire aussi d'autres formats images - veuillez contacter votre Webmaster si nécessaire.</li>
</ul>
<p>Le système calcule automatiquement une prévisualisation de l'image en miniature (Thumbnail),
  si la grandeur (largeur et hauteur) à été dépassée. Sur certains serveurs, la miniaturisation de l'image automatique n'est pas acceptée (s'il n'y a pas de programme installé à cet effet) dans ce cas vous recevrez une alerte dans la fenêtre d'édition.</p>
<h3>A procéder comme suit :</h3>
<p><b>Modifier une image/ajouter :</b></p>
<p>Allez sur &quot;Recherche...&quot; et choisissez un fichier image sur votre PC/Mac (cliquer sur le fichier image et ensuite sur
   &quot;Choisir&quot; et &quot;OK&quot;).</p>
<p>Entrez un texte pour l'image - petite description (Titre sous l'image). Ce texte est aussi visible quand vos visiteurs passent avec la souris au dessus de l'image.</p>
<p>Allez ensuite sous le bouton &quot;Enregistrer&quot; pour insérer l'image choisie sur votre page web.</p>
<p><i>Avis :</i> La durée du transfert dépend de votre connexion internet.</p>
<p>La fenêtre se ferme après l'enregistrement et votre page web modifiée apparaît.<br>
  <span class="remark">(Dans de rares cas vous devez actualiser votre navigateur pour voir les modifications)</span></p>
<p>Modification du texte image</p>
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
