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
.numbered-list { line-height:1.25 }
.remark { font-size:10px }
.textButton { text-transform:capitalize; font-variant:normal }
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:24px }
#menuguide { width:48.9%; float:right; padding:5px; margin-left:20px; margin-bottom:20px; border:solid #a5a5a5 1px }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Hilfe: Menu</h1>
	<h3><img id="menuguide" src="../resources/menu-guide.png" alt="menuguide">Beschreibung</h3>
	<p>Im &quot;Menü Bearbeiten&quot;-Fenster können Sie die Einträge eines Menüs Ihrer Website verändern. Es können Menüpunkte hinzugefügt, geändert oder gelöscht werden und die Reihenfolge der Menüpunkte (auch im Nachhinein) verändert werden. Der Editor unterstützt 'drag and drop', d.h. Sie können die Maus benutzen um die Menüeinträge anzuordnen, bzw. zu strukturieren.</p>
	<p>Bitte beachten Sie, daß die hier vorgenommenen Änderungen <strong>nach dem Klick auf &quot;Speichern&quot;  </strong>unmittelbar wirksam werden und <strong>nicht rückgängig gemacht</strong> werden können!</p>
	<h3>Kurzbeschreibung der Bedienelemente:</h3>
	<ol class="numbered-list">
		<li>Feldname (Bezeichnung) für dieses Menü</li>
		<li>Hauptanzeigebereich: hier wird das komplette Menü hierarchisch dargestellt</li>
		<li>Eingabefeld 'Menütitel': was hier steht, wird dem Benutzer auch auf der Webseite angezeigt</li>
		<li>Optionales Eingabefeld 'Link': hier kann ein Verweis auf eine andere Seite angegeben werden</li>
		<li>Kontrollkästchen für die Sichtbarkeit des Menüeintrags (und aller seiner Unterpunkte)</li>
		<li>Pfeil-Knöpfe zum Verschieben eines Eintrags</li>
		<li>Neuen Menüpunkt hinzufügen (selbe Ebene wie aktueller Eintrag)</li>
		<li>Neuen Unterpunkt hinzufügen (Unterpunkt des aktuellen Eintrags)</li>
		<li>Ausgewählten Menüpunkt und alle Unterpunkte löschen</li>
		<li>Hilfe für RedakteurInnen (diese Seite)</li>
		<li>Abbrechen-Knopf: verwirft alle Ihre Änderungen und schließt den Editor</li>
		<li>Speichern-Knopf: speichert alle vorgenommenen Änderungen und schließt den Editor</li>
		<li>Checkbox to a create a standard url by adding a page instance of &quot;0&quot;</li>
	</ol>
	<h3>Vorgehensweise</h3>
	<p>Wenn Sie im Hauptanzeigebereich [2] auf einen Eintrag klicken, so werden die Details zu diesem Eintrag in den Eingabefeldern [3,4,5] rechts angezeigt. Der aktuelle Eintrag wird im Hauptanzeigebereich [2] gelb hinterlegt und alle Aktionen beziehen sich auf ihn.</p>
	<h3>Menüpunkt hinzufügen</h3>
	<p>Klicken Sie auf &quot;Neuen Menüpunkt hinzufügen&quot; [7], bzw auf &quot;Neuen Unterpunkt hinzufügen&quot; [8]. Ein neuer Menüpunkt wird eingefügt und gleich selektiert. Sie können den Eintrag nun bearbeiten.</p>
	<h3>Menüpunkt ändern</h3>
	<p>Selektieren Sie den zu ändernden Menüpunkt in der Liste [2] und tragen Sie die neue Bezeichnung in das Texteingabefeld &quot;Menütitel&quot; [3] ein.</p>
	<h3>Menüpunkt löschen</h3>
	<p>Selektieren Sie den zu löschenden Menüpunkt in der Liste [2] und klicken Sie auf &quot;löschen&quot; [9]. Es erscheint eine Sicherheitsabfrage (&quot;Wirklich löschen...?&quot;), die mit &quot;Ja&quot; zu bestätigen ist - aber keine Sorge: Der Menüpunkt und die zugehörigen Inhalte werden erst tatsächlich gelöscht, wenn Sie das &quot;Menü Bearbeiten&quot;-Fenster mit dem Klick auf &quot;Speichern&quot; [12] verlassen.</p>
	<h3>Menüpunkte sortieren</h3>
	<p>Die einfachste Möglichkeit, einen Menüpunkt zu verschieben, ist, ihn mit der Maus an die gewünschte Stelle zu ziehen.</p>
	<p>Falls Sie einen sehr alten Browser verwenden, funktioniert das evtl. nicht wie vorgesehen. Selektieren Sie in diesem Fall den Menüpunkt und benutzen Sie die Pfeiltasten [6] um ihn zu verschieben.</p>
	<h3>Menüpunkt ausblenden</h3>
	<p>Standardmäßig sind alle Menüeinträge sichtbar. Falls Sie einen oder mehrere ausblenden wollen, ohne sie (und damit auch die verknüpften Seiteninhalte) zu löschen, können Sie dazu das Häkchen bei 'Sichtbar' [5] entfernen. Falls der ausgeblendete Eintrag Unterpunkte hat, werden auch diese ausgeblendet, auch wenn bei diesen nicht explizit das Häkchen bei 'Sichtbar' [5] entfernt wurde. Ausgeblendete Einträge sind nach wie vor im Hauptanzeigebereich [2]; vorhanden, werden aber mit grauer Schrift und kursiv dargestellt und auf der Webseite auch nicht mehr angezeigt.</p>
	<p>Sie können umfangreiche Untermenüs auch nur im Editor einklappen, indem Sie auf das Minus-Symbol neben dem Menütitel klicken. So bleibt der Anzeigebereich übersichtlich, auch wenn sie viele verschachtelte Untermenüs auf Ihrer Seite haben. An der Darstellung auf der Webseite ändert sich dadurch nichts.</p>
	<h3>Menüpunkt einrücken bzw. Untermenüpunkt erzeugen</h3>
	<p>Sie können eingerückte Menüpunkte (Untermenüpunkte) auf mehrere Arten erzeugen:</p>
	<ol>
		<li>durch Einrücken eines vorhandenen Menüpunktes mit den Pfeil-Knöpfen [6]</li>
		<li>durch Einrücken eines vorhandenen Menüpunktes mit der Maus (drag and drop)</li>
		<li>durch Hinzufügen eines neuen Untermenüpunktes [8]</li>
	</ol>
	<h3>Speichern</h3>
	<p>Nachdem Sie die gewünschten Änderungen an dem Menü vorgenommen haben, klicken Sie auf &quot;Speichern&quot; [12]. Nach dem Speichern schließt sich das Eingabefenster und Ihre geänderte Webseite erscheint.<br><span class="remark">(In seltenen Fällen müssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchführen)</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Hilfe schließen</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
