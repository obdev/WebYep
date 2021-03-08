<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="ISO-8859-1">
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
.style1 { color:#000 }
.remark { font-size:10px }
.textButton { text-transform:capitalize; font-variant:normal }
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:24px }
#table-1 { width:100%; min-height:71px; z-index:0 }
#table-2 { width:100%; min-height:83px; z-index:0 }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
<link rel=stylesheet href="../css/tablecss.css">
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Hilfe: Long Text</h1>
	<h3>Beschreibung</h3>
	<p><span class="style1">In WebYep-&quot;Text&quot;-Felder können Texte mit einfachen Formatierungsanweisungen eingegeben werden. Bei der Eingabe von Texten gilt es Folgendes zu beachten:</span></p>
	<ul>
		<li>WebYep ist nicht Word®! Ein in einer Textverarbeitung wie Microsoft&#8482; Word® verfaßter Text kann meist nicht mit allen Eigenschaften (Tabellen, Listen, verschiedene Schriftgrößen) übernommen werden.</li>
		<li>Es können allerdings mittels einfacher Anweisungen im Text einfache Formatierungen (wie zB. Fettschrift) vorgenommen werden.</li>
		<li>Das Übertragen eines Textes aus zB. Word® mittels &quot;Kopieren&quot; und &quot;Einsetzen&quot; ist natürlich möglich, beschränkt sich aber auf den &quot;Inhalt&quot; des Textes - die Formatierung wird nicht übernommen.</li>
		<li>Am besten sollten die Texte in WebYep formatiert werden. Sie können also die Texte in Word® verfassen und mittels &quot;Kopieren&quot; und &quot;Einsetzen&quot; übertragen - die Formatierung (Überschriften fett, etc.) wird aber erst im WebYep Eingabefenster vorgenommen.</li>
	</ul>
	<p>Zum Teil wird Ihr eingegebener Text von WebYep automatisch formatiert - zB. bei Links und E-Mail-Adressen:</p>
	<div id="table-1"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6" class="wytable">
  
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

</table></p>
	</div>
	<p>&nbsp;</p>
	<p><strong>Andere Formatierungen können mittels folgender Anweisungen im Text vorgenommen werden:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6" class="wytable">
  
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
</table></p>
	</div>
	<h3>&nbsp;</h3>
	<h3>Vorgehensweise</h3>
	<p>Geben Sie den Text (ggf. mit diversen Formatierungsanweisungen) in das Textfeld ein und klicken Sie auf &quot;Speichern&quot;.</p>
	<p>Nach dem Speichern schließt sich das Eingabefenster und Ihr geänderter Text erscheint in der Webseite.<br><span class="remark">(In seltenen Fällen müssen sie noch den &quot;Seite Aktualisieren&quot;-Befehl Ihres Web-Browsers durchführen)</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Hilfe schließen</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
