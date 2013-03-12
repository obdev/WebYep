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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Hilfe: Bildergalerie</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Beschreibung</h3>
<p>Mit dem &quot;Galeriebild&quot;-Bearbeiten-Fenster k&ouml;nnen Sie Bilder in eine
Bildergalerie Ihrer Webseite &auml;ndern.</p>
<p><b>Wichtig:</b> Das einzuf&uuml;gende Bild hat in einem &quot;internet-tauglichen&quot; Format vorzuliegen. Das hei&szlig;t:</p>
<ul>
<li>Es sollte <b>nicht zu gro&szlig;</b> bzgl. seiner <b>Abmessungen</b> (also
  Breite und H&ouml;he) <b>und</b> bzgl.
  der <b>Dateigr&ouml;&szlig;e</b> sein. Eine H&ouml;he bzw. Breite von max.
  600 Pixel sowie eine Dateigr&ouml;&szlig;e von max. 300kB (Kilobyte)
   sollten als Obergrenze angesehen werden.</li>
   <li>Es sollte in einem von Webbrowsern verarbeitbaren <b>Dateiformat</b> vorliegen 
      wie zB. <b>GIF</b> oder <b>JPG</b> (bzw. JPEG). Da sich die F&auml;higkeiten 
      der Web-Browser st&auml;ndig erweitern, sind aber auch durchaus andere Dateiformate 
      denkbar - bitte kl&auml;ren Sie dies mit den WebdesignerInnen Ihrer Website.</li>
</ul>
<p>Das System berechnet automatisch eine Voransichts-Version des Fotos (Thumbnail),
  die in der &Uuml;bersicht dargestellt wird und verkleinert das Foto, wenn es eine durch den/die WebdesignerIn vorgegebene H&ouml;he oder Breite &uuml;berschreitet. </p>
<p>Auf manchen Webservern ist das verkleinern von Fotos nicht m&ouml;glich (wenn keine GD-Erweiterung f&uuml;r PHP installiert ist)- in diesem Fall wird im Galeriebild-Bearbeiten-Fenster ein Warnhinweis angezeigt.</p>
<h3>Vorgehensweise</h3>
<p><b>Foto &auml;ndern/hinzuf&uuml;gen:</b></p>
<p>Klicken Sie auf &quot;Durchsuchen...&quot; und w&auml;hlen Sie die gew&uuml;nschte 
   Bilddatei auf Ihrem PC bzw. Mac aus (indem Sie die Datei anklicken und dann 
   &quot;Ausw&auml;hlen&quot; bzw. &quot;OK&quot; w&auml;hlen).</p>
<p>Geben Sie einen Bildtext ein - eine kurze Beschreibung des Bildes (Bilduntertitel) der in der Seite unterhalb des Bildes angezeigt wird. Er wird auch eingeblendet, wenn BesucherInnen den Mauszeiger &uuml;ber dem Bild schweben lassen.</p>
<p>Klicken Sie danach 
   auf den &quot;Speichern&quot;-Knopf um das ausgew&auml;hlte Bild in Ihre Website 
   zu &uuml;bertragen.</p>
<p><i>Hinweis:</i> Das &Uuml;bertragen des Bildes kann (je nach Internet-Verbindung) 
  einige Zeit in Anspruch nehmen.</p>
<p>Nach der &Uuml;bertragung schlie&szlig;t sich das Eingabefenster und  Ihre ge&auml;nderte Webseite erscheint.<br>
<span class="remark">(In seltenen F&auml;llen m&uuml;ssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchf&uuml;hren)</span></p>
<p>&Auml;nderung des Bildtextes</p>
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
