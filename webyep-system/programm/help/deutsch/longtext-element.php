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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Hilfe: Text</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Beschreibung</h3>
<p>In <?php echo $webyep_sProductName?>-&quot;Text&quot;-Felder k&ouml;nnen Texte mit einfachen Formatierungsanweisungen eingegeben werden. Bei der Eingabe von Texten gilt es Folgendes zu beachten:</p>
<ul>
<li><?php echo $webyep_sProductName?> ist nicht Word&reg;! Ein in einer Textverarbeitung wie Microsoft&#153; Word&reg; verfa&szlig;ter Text kann meist nicht mit allen Eigenschaften (Tabellen, Listen, verschiedene Schriftgr&ouml;&szlig;en) &uuml;bernommen werden.</li>
<li>Es k&ouml;nnen allerdings mittels einfacher Anweisungen im Text einfache Formatierungen (wie zB. Fettschrift) vorgenommen werden.</li>
<li>Das &Uuml;bertragen eines Textes aus zB. Word&reg; mittels &quot;Kopieren&quot; und &quot;Einsetzen&quot; ist nat&uuml;rlich m&ouml;glich, beschr&auml;nkt sich aber auf den &quot;Inhalt&quot; des Textes - die Formatierung wird nicht &uuml;bernommen.</li>
<li>Am besten sollten die Texte in <?php echo $webyep_sProductName?> formatiert werden. Sie k&ouml;nnen also die Texte in Word&reg; verfassen und mittels &quot;Kopieren&quot; und &quot;Einsetzen&quot; &uuml;bertragen - die Formatierung (&Uuml;berschriften fett, etc.) wird aber erst im <?php echo $webyep_sProductName?> Eingabefenster vorgenommen.</li>
</ul>
<p>Zum Teil wird Ihr eingegebener Text von <?php echo $webyep_sProductName?> automatisch formatiert - zB. bei Links und E-Mail-Adressen:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><b><font color="black">bei Eingabe von</font></b></p>
</td>
<td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>erscheint in der Seite</b></font></p>
</td>
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>zB.:</b></font></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>http://www.test.com</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Der Text &quot;http://www.test.com&quot; als Link auf diese Website - 
        es wird ein neues Web-Browser-Fenster ge&ouml;ffnet!</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="http://www.test.com" target="_blank" class="externalLink">http://www.test.com</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>test@firma.com</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>Der Text &quot;test@firma.com&quot; als Link auf diese <nobr>E-Mail</nobr>-Adresse.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a></p>
</td>
</tr>
  
  
  
  
</table>
<p>Andere Formatierungen k&ouml;nnen mittels folgender Anweisungen im Text vorgenommen werden:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><b><font color="black">bei Eingabe von</font></b></p>
</td>
<td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>erscheint in der Seite</b></font></p>
</td>
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>zB.:</b></font></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;LINK:andereseite.php</nobr> Zur anderen <nobr>Seite&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Der Text &quot;Zur anderen Seite&quot; als Link auf die Datei <i>andereseite.php</i> 
        - es wird <em>kein</em> neues Browserfenster ge&ouml;ffnet! Es k&ouml;nnen 
        auch vollst&auml;ndige Web-Adressen bzw. URLs (inkl. &quot;http://...&quot;) angegeben werden.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="javascript:alert('Dieser Link wuerde auf eine andere Seite Ihrer WebSite fuehren.');" class="externalLink">Zur anderen Seite</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
      <p><nobr>&lt;FETT</nobr> Ein dicker <nobr>Text&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>Der Text &quot;Ein dicker Text&quot; in Fettschrift.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><b>Ein dicker Text</b></p>
</td>
</tr>
<tr> 
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;BEISPIEL</nobr> Ein Text in spezieller <nobr>Form&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Der Text &quot;Ein Text in spezieller Form&quot; in dem von den GestalterInnen Ihrer Website festgelegten Stil &quot;BEISPIEL&quot; 
        formatiert. Welche Stile hier zur Verf&uuml;gung stehen, sollten Ihnen die GestalterInnen Ihrer Website mitteilen.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
<p><font face="Courier New, Courier, mono" color="#009933">Ein Text in spezieller Form</font> </p>
</td>
</tr>
  

  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>---</p>
</td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>Eine horizontale Trennlinie. Die Zeichenfolge &quot;---&quot; mu&szlig; 
        dazu in einer eigenen Zeile stehen!</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<hr width="200">
    </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>* Erster Listenpunkt<br>
      ** Ein Unterpunkt<br>
      * Zweiter Listenpunkt mit einem langen Text<br>
      * Dritter Listenpunkt <nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>Durch Voranstellen eines oder mehrerer Sterne (oder des Listen-Symbols) werden die Zeilen als Liste formatiert.</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>Erster Listenpunkt
          <ul>
            <li>Ein Unterpunkt </li>
          </ul>
      </li>
      <li>Zweiter Listenpunkt mit einem langen Text</li>
      <li>Dritter Listenpunkt <nobr></nobr></li>
  </ul></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ Erster Listenpunkt<br>
      ++ Ein Unterpunkt<br>
      + Zweiter Listenpunkt mit einem langen Text<br>
      + Dritter Listenpunkt <nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>Durch Voranstellen eines oder mehrerer Plus-Zeichen werden die Zeilen als Aufz&auml;hlungs-Liste formatiert.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
      <li>Erster Listenpunkt
          <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>Ein Unterpunkt </li>
          </ol>
      </li>
      <li>Zweiter Listenpunkt mit einem langen Text</li>
      <li>Dritter Listenpunkt <nobr></nobr></li>
  </ol></td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
    111 | 222 | 333<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>Durch verwenden des &quot;|&quot;-Symbols
      (links unten auf der Tastatur neben dem &quot;Y&quot;, dabei AltGr gedr&uuml;ckt
      halten) k&ouml;nnen einfache Tabellen erzeugt werden. Das &quot;|&quot;-Symbol
      dient dabei als Spalten-Trenner.</p>
    <p>Das Aussehen der Tabelle wird durch die GestalterInnen Ihrer Website festgelegt.</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="6">
    <tr>
      <td>aaa</td>
      <td>bbb</td>
      <td>ccc</td>
    </tr>
    <tr>
      <td>111</td>
      <td>222</td>
      <td>333</td>
    </tr>
  </table></td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\&lt;</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">Nachdem das Zeichen &quot;&lt;&quot; für Formatierungsansweisungen verwendet wird, muss ihm das Zeichen &quot;\&quot; (der <strong>umgekehrte</strong> Schrägstrich) vorangestellt werden, um es <em>als solches</em> in den Text einzufügen.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">&lt;</td>
<tr>
</tr>
  <td align="left" valign="top" bgcolor="#FFFFFF">\&gt;</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">Für &quot;&gt;&quot; gilt das Gleiche wie für &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">&gt;</td>
</tr>
</tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\|</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">Für &quot;|&quot; gilt das Gleiche wie für &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">|</td>
</tr>
</table>
<h3>Vorgehensweise</h3>
<p>Geben Sie den Text (ggf. mit diversen Formatierungsanweisungen) in das Textfeld 
   ein und klicken Sie auf &quot;Speichern&quot;.</p>
<p>Nach dem Speichern schlie&szlig;t sich das Eingabefenster und  Ihr ge&auml;nderter Text erscheint in der Webseite.<br>
<span class="remark">(In seltenen F&auml;llen m&uuml;ssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchf&uuml;hren)</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">Hilfe schlie&szlig;en</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
