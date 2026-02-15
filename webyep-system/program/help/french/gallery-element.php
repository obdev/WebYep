<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $webyep_sProductName?></title>
<meta name="viewport" content="width = 960, minimum-scale = 0.25, maximum-scale = 1.60">
<meta name="generator" content="Freeway Pro 7.1c2">
<style type="text/css">
<!--
body { font-family:Helvetica,Arial,sans-serif; font-size:12px; line-height:1.5; margin:0px; background-color:#fff; height:100% }
html { height:100% }
form { margin:0px }
body > form { height:100% }
img { margin:0px; border-style:none }
button { margin:0px; border-style:none; padding:0px; background-color:transparent; vertical-align:top }
table { empty-cells:hide }
td { padding:0px }
.f-sp { font-size:1px; visibility:hidden }
.f-lp { margin-bottom:0px }
.f-fp { margin-top:0px }
a:link { color:#09c }
a:visited { color:#09c }
a:hover { color:#09c }
.textButton a { -webkit-border-radius:2;    -moz-border-radius: 2;    border-radius: 2px;    color: #ffffff;	    font-size: 13px;    background: #2f9ce0;    padding: 9px 14px 9px 14px;    color: #ffffff;    text-decoration: none;; transition: all 0.2s ease-in-out;-webkit-transition: all 0.2s ease-in-out;-moz-transition: all 0.2s ease-in-out; }
.textButton a:hover { background:#545454;    text-decoration: none; }
.textButton a:visited { color:#ffffff;    text-decoration: none; }
body { font-family:Helvetica,Arial,sans-serif; font-size:12px; line-height:1.5 }
em { font-style:italic }
h1 { color:#09c; font-weight:bold; font-size:24px; line-height:26px; margin-top:0px; margin-bottom:26px }
h1:first-child { margin-top:0px }
h2 { font-weight:bold; font-size:16px; line-height:1; margin-top:8px; margin-bottom:6px }
h2:first-child { margin-top:0px }
h3 { font-weight:bold; font-size:14px; line-height:1; margin-top:20px; margin-bottom:6px }
h3:first-child { margin-top:0px }
hr { color:#a5a5a5; background-color:#a5a5a5; border:0; width:100%; height:1px }
strong { font-weight:bold }
.textButton { text-transform:capitalize; font-variant:normal }
.remark { font-size:10px }
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:24px }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Aide : Galerie</h1>
	<h3>Description</h3>
	<p>Avec la fenêtre &quot;Galerie&quot; vous pouvez éditer et modifier vos images de la Galerie.</p>
	<p><strong>Important:<br></strong>Les images à insérer doivent avoir un format qui est accepté par les &quot;navigateurs internet&quot; :</p>
	<ul>
		<li>Elles ne doivent pas être trop grande (largeur et hauteur) et attention au poids du fichier ! Une hauteur et une largeur de maximum 600 pixels ainsi qu'un poids maximum de 300Ko devrait être une règle.</li>
		<li>Elles doivent avoir un format accepté comme par exemple .GIF ou .JPG (JPEG) ou .PNG. Les navigateurs sont de plus en plus capable de lire aussi d'autres formats images - veuillez contacter votre Webmaster si nécessaire.</li>
	</ul>
	<p>Le système calcule automatiquement une prévisualisation de l'image en miniature (Thumbnail), si la grandeur (largeur et hauteur) à été dépassée. Sur certains serveurs, la miniaturisation de l'image automatique n'est pas acceptée (s'il n'y a pas de programme installé à cet effet) dans ce cas vous recevrez une alerte dans la fenêtre d'édition.</p>
	<h3>A procéder comme suit :</h3>
	<p><strong>Modifier une image/ajouter :<br></strong>Allez sur &quot;Recherche...&quot; et choisissez un fichier image sur votre PC/Mac (cliquer sur le fichier image et ensuite sur &quot;Choisir&quot; et &quot;OK&quot;).</p>
	<p>Entrez un texte pour l'image - petite description (Titre sous l'image). Ce texte est aussi visible quand vos visiteurs passent avec la souris au dessus de l'image.</p>
	<p>Allez ensuite sous le bouton &quot;Enregistrer&quot; pour insérer l'image choisie sur votre page web.</p>
	<p><strong>Avis :</strong> <br>La durée du transfert dépend de votre connexion internet.</p>
	<p>La fenêtre se ferme après l'enregistrement et votre page web modifiée apparaît.<br>(Dans de rares cas vous devez actualiser votre navigateur pour voir les modifications)</p>
	<p>Modification du texte image</p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Fermer l'aide</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
