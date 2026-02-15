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
.remark { font-size:10px }
.textButton { text-transform:capitalize; font-variant:normal }
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
	<h1> <?php echo $webyep_sProductName?> Hilfe: Short Text</h1>
	<h3>Beschreibung</h3>
	<p>Mit dem &quot;Galeriebild&quot;-Bearbeiten-Fenster können Sie Bilder in eine Bildergalerie Ihrer Webseite ändern.</p>
	<p><strong>Wichtig:<br></strong>Das einzufügende Bild hat in einem &quot;internet-tauglichen&quot; Format vorzuliegen. Das heißt:</p>
	<ul>
		<li>Es sollte nicht zu groß bzgl. seiner Abmessungen (also Breite und Höhe) und bzgl. der Dateigröße sein. Eine Höhe bzw. Breite von max. 600 Pixel sowie eine Dateigröße von max. 300kB (Kilobyte) sollten als Obergrenze angesehen werden.</li>
		<li>Es sollte in einem von Webbrowsern verarbeitbaren Dateiformat vorliegen wie zB. GIF oder JPG (bzw. JPEG). Da sich die Fähigkeiten der Web-Browser ständig erweitern, sind aber auch durchaus andere Dateiformate denkbar - bitte klären Sie dies mit den WebdesignerInnen Ihrer Website.</li>
	</ul>
	<p>Das System berechnet automatisch eine Voransichts-Version des Fotos (Thumbnail), die in der Übersicht dargestellt wird und verkleinert das Foto, wenn es eine durch den/die WebdesignerIn vorgegebene Höhe oder Breite überschreitet. </p>
	<p>Auf manchen Webservern ist das verkleinern von Fotos nicht möglich (wenn keine GD-Erweiterung für PHP installiert ist)- in diesem Fall wird im Galeriebild-Bearbeiten-Fenster ein Warnhinweis angezeigt.</p>
	<h3>Vorgehensweise</h3>
	<p><strong>Foto ändern/hinzufügen:<br></strong>Klicken Sie auf &quot;Durchsuchen...&quot; und wählen Sie die gewünschte Bilddatei auf Ihrem PC bzw. Mac aus (indem Sie die Datei anklicken und dann &quot;Auswählen&quot; bzw. &quot;OK&quot; wählen).</p>
	<p>Geben Sie einen Bildtext ein - eine kurze Beschreibung des Bildes (Bilduntertitel) der in der Seite unterhalb des Bildes angezeigt wird. Er wird auch eingeblendet, wenn BesucherInnen den Mauszeiger über dem Bild schweben lassen.</p>
	<p>Klicken Sie danach auf den &quot;Speichern&quot;-Knopf um das ausgewählte Bild in Ihre Website zu übertragen.</p>
	<p><strong>Hinweis: </strong><br>Das Übertragen des Bildes kann (je nach Internet-Verbindung) einige Zeit in Anspruch nehmen.</p>
	<p>Nach dem Speichern schließt sich das Eingabefenster und Ihr geänderter Text erscheint in der Webseite.<br><span class="remark">(In seltenen Fällen müssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchführen)</span></p>
	<p>Änderung des Bildtextes</p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Hilfe schließen</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
