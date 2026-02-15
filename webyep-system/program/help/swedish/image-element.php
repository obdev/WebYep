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
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:30px 24px 24px }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Hjälp: Bild</h1>
	<p>I fönstret Redigera bild kan du lägga till/ta bort fotografier och grafik.</p>
	<ul>
		<li>Viktigt: bilden måste först sparas i ett standardformat för webben dvs:</li>
		<li>Bilden bör inte vara större än 100-150 kBytes och bör även ha små dimensioner (bredd och höjd bör inte överskrida 200-300 bildpixlar).</li>
		<li>Filformatet måste fungera med de vanligaste webbläsarna (GIF eller JPEG är lämpliga format).</li>
	</ul>
	<h3>Beskrivning</h3>
	<p><strong>Lägga upp en bild:<br></strong>Klicka knappen &quot;Browse...&quot; för att bläddra fram till den bild du vill använda. Klicka OK när du valt bild. Klicka sedan Spara så laddas bilden upp till webbsidan.</p>
	<p><strong>Anmärkning: </strong><br>Att flytta bilden från din dator till webbservern (där din webbsida ligger) tar olika lång tid beroende av datorns bandbredd för internettrafik.</p>
	<p><strong>Radera en bild: </strong><br>Klicka knappen Radera bild för att ta bort bilden från webbsidan samt från webbservern.</p>
	<p>Efter att knappen Spara eller Radera bild har klickats så stängs redigeringsfönstret och den ändrade webbsidan visas.<br>I vissa enstaka fall kan webbsidan behöva uppdateras manuellt innan ändringen syns. </p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">stäng fönster</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
