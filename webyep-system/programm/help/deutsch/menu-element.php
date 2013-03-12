<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<!DOCTYPE html SYSTEM>
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

<body class="onlineHelp">
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8" alt="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Hilfe: Men&uuml;</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0" alt="" /><img src="../../images/nix.gif" width="8" height="8" align="top" alt="" /></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10" alt="" /></div>
<h3>Beschreibung</h3>
<p>Im &quot;Men&uuml; Bearbeiten&quot;-Fenster k&ouml;nnen Sie die Eintr&auml;ge eines Men&uuml;s Ihrer Website ver&auml;ndern. Es k&ouml;nnen Men&uuml;punkte hinzugef&uuml;gt, ge&auml;ndert oder gel&ouml;scht werden und die Reihenfolge der Men&uuml;punkte (auch im Nachhinein) ver&auml;ndert werden. Der Editor unterst&uuml;tzt 'drag and drop', d.h. Sie k&ouml;nnen die Maus benutzen um die Men&uuml;eintr&auml;ge anzuordnen, bzw. zu strukturieren.</p>
<p>Bitte beachten Sie, da&szlig; die hier vorgenommenen &Auml;nderungen <b>nach dem Klick auf &quot;Speichern&quot;</b> [12] unmittelbar wirksam werden und <b>nicht r&uuml;ckg&auml;ngig gemacht</b> werden k&ouml;nnen!</p>
<table border="0" cellspacing="0" cellpadding="0" class="description">
  <tr>
    <td><strong>Kurzbeschreibung der Bedienelemente:</strong>
      <ol>
        <li>Feldname (Bezeichnung) f&uuml;r dieses Men&uuml;</li>
        <li>Hauptanzeigebereich: hier wird das komplette Men&uuml; hierarchisch dargestellt</li>
        <li>Eingabefeld 'Men&uuml;titel': was hier steht, wird dem Benutzer auch auf der Webseite angezeigt</li>
        <li>Optionales Eingabefeld 'Link': hier kann ein Verweis auf eine andere Seite angegeben werden</li>
        <li>Kontrollk&auml;stchen f&uuml;r die Sichtbarkeit des Men&uuml;eintrags (und aller seiner Unterpunkte)</li>
        <li>Pfeil-Kn&ouml;pfe zum Verschieben eines Eintrags</li>
        <li>Neuen Men&uuml;punkt hinzuf&uuml;gen (selbe Ebene wie aktueller Eintrag)</li>
        <li>Neuen Unterpunkt hinzuf&uuml;gen (Unterpunkt des aktuellen Eintrags)</li>
        <li>Ausgew&auml;hlten Men&uuml;punkt und alle Unterpunkte l&ouml;schen</li>
        <li>Hilfe f&uuml;r RedakteurInnen (diese Seite)</li>
        <li>Abbrechen-Knopf: verwirft alle Ihre &Auml;nderungen und schlie&szlig;t den Editor</li>
        <li>Speichern-Knopf: speichert alle vorgenommenen &Auml;nderungen und schlie&szlig;t den Editor</li>
      </ol>
    </td>
    <td>
      <p align="center"><img src="./images/menu-editor-detail.png" width="495" height="434" alt="" /><br>
      <span class="picturetext">Das Men&uuml;-Bearbeiten-Fenster im Detail</span></p>
    </td>
  </tr>
</table>

<h3>Vorgehensweise</h3>
<p>Wenn Sie im Hauptanzeigebereich [2] auf einen Eintrag klicken, so werden die Details zu diesem Eintrag in den Eingabefeldern [3,4,5] rechts angezeigt. Der aktuelle Eintrag wird im Hauptanzeigebereich [2] gelb hinterlegt und alle Aktionen beziehen sich auf ihn.</p>

<h4>Men&uuml;punkt hinzuf&uuml;gen</h4>
<p>Klicken Sie auf &quot;Neuen Men&uuml;punkt hinzuf&uuml;gen&quot; [7], bzw auf &quot;Neuen Unterpunkt hinzuf&uuml;gen&quot; [8]. Ein neuer Men&uuml;punkt wird eingef&uuml;gt und gleich selektiert. Sie k&ouml;nnen den Eintrag nun bearbeiten.</p>

<h4>Men&uuml;punkt &auml;ndern</h4>
<p>Selektieren Sie den zu &auml;ndernden Men&uuml;punkt in der Liste [2] und tragen Sie die neue Bezeichnung in das Texteingabefeld &quot;Men&uuml;titel&quot; [3] ein.</p>

<h4>Men&uuml;punkt l&ouml;schen</h4>
<p>Selektieren Sie den zu l&ouml;schenden Men&uuml;punkt in der Liste [2] und klicken Sie auf &quot;l&ouml;schen&quot; [9]. Es erscheint eine Sicherheitsabfrage (&quot;Wirklich l&ouml;schen...?&quot;), die mit &quot;Ja&quot; zu best&auml;tigen ist - aber keine Sorge: Der Men&uuml;punkt und die zugeh&ouml;rigen Inhalte werden erst tats&auml;chlich gel&ouml;scht, wenn Sie das &quot;Men&uuml; Bearbeiten&quot;-Fenster mit dem Klick auf &quot;Speichern&quot; [12] verlassen.</p>

<h4>Men&uuml;punkte sortieren</h4>
<p>Die einfachste M&ouml;glichkeit, einen Men&uuml;punkt zu verschieben, ist, ihn mit der Maus an die gew&uuml;nschte Stelle zu ziehen.</p>
<p>Falls Sie einen sehr alten Browser verwenden, funktioniert das evtl. nicht wie vorgesehen. Selektieren Sie in diesem Fall den Men&uuml;punkt und benutzen Sie die Pfeiltasten [6] um ihn zu verschieben.</p>

<h4>Men&uuml;punkt ausblenden</h4>
<p>Standardm&auml;&szlig;ig sind alle Men&uuml;eintr&auml;ge sichtbar. Falls Sie einen oder mehrere ausblenden wollen, ohne sie (und damit auch die verkn&uuml;pften Seiteninhalte) zu l&ouml;schen, k&ouml;nnen Sie dazu das H&auml;kchen bei 'Sichtbar' [5] entfernen. Falls der ausgeblendete Eintrag Unterpunkte hat, werden auch diese ausgeblendet, auch wenn bei diesen nicht explizit das H&auml;kchen bei 'Sichtbar' [5] entfernt wurde. Ausgeblendete Eintr&auml;ge sind nach wie vor im Hauptanzeigebereich [2]; vorhanden, werden aber mit grauer Schrift und kursiv dargestellt und auf der Webseite auch nicht mehr angezeigt.</p>
<p>Sie k&ouml;nnen umfangreiche Untermen&uuml;s auch nur im Editor einklappen, indem Sie auf das Minus-Symbol neben dem Men&uuml;titel klicken. So bleibt der Anzeigebereich &uuml;bersichtlich, auch wenn sie viele verschachtelte Untermen&uuml;s auf Ihrer Seite haben. An der Darstellung auf der Webseite &auml;ndert sich dadurch nichts.</p>

<h4>Men&uuml;punkt einr&uuml;cken bzw. Untermen&uuml;punkt erzeugen</h4>
<p>Sie k&ouml;nnen einger&uuml;ckte Men&uuml;punkte (Untermen&uuml;punkte) auf mehrere Arten erzeugen:</p>
<ol>
  <li>durch Einr&uuml;cken eines vorhandenen Men&uuml;punktes mit den Pfeil-Kn&ouml;pfen [6]</li>
  <li>durch Einr&uuml;cken eines vorhandenen Men&uuml;punktes mit der Maus (drag and drop)</li>
  <li>durch Hinzuf&uuml;gen eines neuen Untermen&uuml;punktes [8]</li>
</ol>

<h4>Speichern</h4>
<p>Nachdem Sie die gew&uuml;nschten &Auml;nderungen an dem Men&uuml; vorgenommen haben, klicken Sie auf &quot;Speichern&quot; [12]. Nach dem Speichern schlie&szlig;t sich das Eingabefenster und  Ihre ge&auml;nderte Webseite erscheint.<br>
   <span class="remark">(In seltenen F&auml;llen m&uuml;ssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchf&uuml;hren)</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span>

<!-- ====================================================================================================================

<h3><a name="aussehen"></a>Hierarchische Men&uuml;s definieren</h3>
<p>Die BenutzerInnen k&ouml;nnen einger&uuml;ckte Men&uuml;punkte (Untermen&uuml;punkte) auf mehrere Arten erzeugen:</p>
<ol>
  <li>durch Einr&uuml;cken eines vorhandenen Men&uuml;punktes mit den Pfeil-Kn&ouml;pfen [6]</li>
  <li>durch Einr&uuml;cken eines vorhandenen Men&uuml;punktes mit der Maus (drag and drop)</li>
  <li>durch Hinzuf&uuml;gen eines neuen Untermen&uuml;punktes [8]</li>
</ol>
<p>Zus&auml;tzlich kann das Verhalten der Men&uuml;punkte noch beeinflusst werden, indem Sie das optionale Feld 'Link' [4] eines Men&uuml;eintrags eine Raute eintragen.</p>

<h4>Untermen&uuml;titel mit einer Seite verkn&uuml;pfen</h4>
<p>Normalerweise &ouml;ffnet ein Untermen&uuml;titel keine Seite &ndash;&nbsp;er fungiert lediglich als &Uuml;berschrift f&uuml;r die Untermen&uuml;punkte. Wenn Sie aber im optionalen Feld 'Link' [4] des Untermen&uuml;titels eine Raute anf&uuml;gen, dann wird bei einem Klick darauf ebenso eine Seite ge&ouml;ffnet, wie bei einem normalen Men&uuml;punkt.</p>

<h4>Einzelnen Men&uuml;punkten individuelle URLs zuweisen</h4>
<p>Normalerweise &ouml;ffnen <em>alle</em> Men&uuml;punkte die selbe Seite &ndash; die Zielseite des Men&uuml; Elementes. Sie k&ouml;nnen aber einzelne Men&uuml;punkte auch andere Seiten &ouml;ffnen lassen. Dazu muss der URL der gew&uuml;nschten Seite in des optionale Feld 'Link' [4] des Men&uuml;eintrags eingetragen werden. Wenn die Seite im selben Ordner wie die normale Zielseite des Men&uuml; Elementes liegt, muss nur der Dateiname angegeben werden, ansonsten muss der vollst&auml;ndige URL angegeben werden</p>
<p class="remark"><span class="remarkHeading">Wichtig:</span> Nachdem die alternative Zielseite ja &uuml;blicherweise auch das selbe Men&uuml; anzeigen soll, muss das Men&uuml; Element  in dieser Seite ebenfalls platziert werden. Damit das Men&uuml; Element aber in allen Seiten die selben Men&uuml;eintr&auml;ge zeigt, muss seine &quot;Inhalte&quot;-Eigenschaft auf &quot;f&uuml;r alle Seiten&quot; gestellt werden (global=true, siehe oben). Wenn die alternative Zielseite in einem anderen Ordner liegt, m&uuml;ssen au&szlig;erdem alle Seiten (die normale Zielseite des Men&uuml; Elements und alle alternativen Zielseiten) als absolute URLs (inkl. voller Pfadangabe) angegeben werden.</p> -->
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine; ?></span>
</body>
</html>
