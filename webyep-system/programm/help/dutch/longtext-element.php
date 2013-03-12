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
<span class="textButton">&lt;<a href="javascript:window.close();">sluit venster</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Alinea</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Omschrijving</h3>
<p>U kunt het <?php echo $webyep_sProductName?> Alinea veld gebruiken om tekst  met eenvoudige opmaak toe te voegen aan uw website
  (zoals vette tekst of lijsten). Als u tekst invoert, houd dan het volgende in gedachten:</p>
<ul>
<li><?php echo $webyep_sProductName?> is geen Word&reg;! Een tekst die in een wordprocessor zoals
  Microsoft&#153; Word&reg; is gemaakt, kan niet worden overgezet in een <?php echo $webyep_sProductName?> Alinea veld met behoud van opmaakkenmerken, fonts, lijsten of tabellen en dergelijke.</li>
<li>U kunt wel eenvoudige codes gebruiken om teksten vet te maken, links aan te leggen en lijsten aan te maken.</li>
<li>U kunt teksten aanmaken in Word&reg; met behulp van kopieer/plak - hiermee voegt u alleen de &quot;content&quot; toe, niet de opmaak.</li>
<li>het beste is om uw tekst zonder opmaak te typen in een word processor, het dan over te zetten in het <?php echo $webyep_sProductName?> Alinea veld d.m.v. kopieer/plak (copy/paste) en vervolgens de gewenste opmaak aan te brengen met de eenvoudige <?php echo $webyep_sProductName?> code.</li>
</ul>
<p>Sommige delen van uw tekst worden automatisch omgezet - zoals links en e-mailadressen:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" bgcolor="#CCCCCC"><b>Als u invoert:</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>geeft <?php echo $webyep_sProductName?> weer:</b></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>Bijvoorbeeld:</b><img src="../../images/nix.gif" width="200" height="1"></td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>http://www.test.com</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>De tekst &quot;http://www.test.com&quot; wordt opgemaakt als een link naar deze URL; er zal een nieuw browservenster openen als u er op klikt.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="http://www.test.com" target="_blank" class="externalLink">http://www.test.com</a><br>
  <span class="remark">(de visuele weergave van links in uw website kan vari&euml;ren!)</span></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>test@firma.com</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>De tekst &quot;test@firma.com&quot; wordt opgemaakt als een mailto-link naar het opgegeven e-mailadres.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a><br>
  <span class="remark">(de visuele weergave van links in uw website kan veri&euml;ren!)</span></p>
</td>
</tr>
  
  
  
  
</table>
<p>Verdere opmaak is mogelijk met de volgende opmaaktags:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" bgcolor="#CCCCCC"><b>Als u invoert:</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>geeft <?php echo $webyep_sProductName?> weer:</b></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>Bijvoorbeeld:</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;LINK:voorbeeldpagina.php</nobr> Naar andere pagina<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>De tekst &quot;Naar andere pagina&quot; wordt opgemaakt als link naar <i>voorbeeldpagina.php</i> 
        - er zal geen nieuw browservenster worden geopend als u op de linkt klikt!
        U kunt ook volledige URL's gebruiken (inclusief het &quot;http://...&quot; gedeelte)
        in plaats van de bestandnaam (voorbeeldpagina.php).</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="javascript:alert('Deze link zou doorlinken naar een andere pagina op uw website.');" class="externalLink">Naar andere pagina</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
      <p><nobr>&lt;BOLD</nobr> vette tekst<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>De zinsnede &quot;vette tekst&quot; wordt opgemaakt als vet (bold).</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><b>vette tekst</b></p>
</td>
</tr>
<tr> 
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;SPECIAL</nobr> Speciale opmaak<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>De zinsnede &quot;speciale opmaak&quot; wordt omgezet in een stijl die is vastgelegd door de webdesigner. De stijlen en hun namen (&quot;<nobr>SPECIAL</nobr>&quot;) worden gedefinieerd door de webdesigner die uw website heeft ontwikkeld.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
<p><font face="Courier New, Courier, mono" color="#009933">Speciale opmaak</font> </p>
</td>
</tr>
  

  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>---</p>
</td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>Een horizontale lijn. De streepjes &quot;---&quot; moeten beginnen aan het begin van een regel!</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<hr width="200">
    </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>* Eerste item<br>
    ** Een subitem
    <br>
      * Tweede item met wat meer tekst<br>
      * Derde item<nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>U kunt lijsten maken door een asterisk of
      bullet symbool aan het begin van een regel te plaatsen.</p>
    </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>Eerste item
        <ul>
          <li>Een subitem </li>
        </ul>
      </li>
      <li>Tweede item met wat meer tekst</li>
      <li>Derde item<nobr></nobr></li>
    </ul>
  </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>U kunt meerdere regels tekst toevoegen aan een item door twee spaties te typen aan het begin van een regel - zoals in:</p>
      <p class="codeExample">* Eerste item<br>
&nbsp;&nbsp;Dit is onderdeel van het eerste item.<br>
      * Tweede item<br>
      ...</p>
    </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>Eerste item<br>
        Dit is onderdeel van het eerste item.</li>
      <li>Tweede item<nobr></nobr></li>
      </ul>
  </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>U kunt ook opmaak combineren - bijvoorbeeld:</p>
    <p class="codeExample">* &lt;BOLD Eerste item&gt;<br>
&nbsp;&nbsp;Dit is onderdeel van het eerste item.<br>
  * Tweede item<br>
  ...</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
    <li><strong>Eerste item</strong><br>
    Dit is onderdeel van het eerste item. </li>
    <li>Tweede item<nobr></nobr></li>
  </ul></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ Eerste item<br>
      ++ Een subitem <br>
      + Tweede item met wat meer tekst<br>
      + Derde item<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>Door een &quot;+&quot; (plusteken) te gebruiken in plaats van een asterisk, wordt een genummerde lijst aangemaakt.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
      <li>Eerste item
          <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>Een subitem</li>
          </ol>
      </li>
      <li>Tweede item met wat meer tekst</li>
      <li>Derde item<nobr></nobr></li>
  </ol></td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
      111 | 222 | 333<nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>Door het gebruik van het &quot;|&quot; symbool
      zijn eenvoudige tabellen te maken. Het &quot;|&quot; teken fungeert als een kolomverdeler.</p>
    <p>Het uiterlijk van een tabel is gedefini&euml;erd door de webdesigner die uw website heeft ontwikkeld.</p>
    </td>
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
    </table>
  </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\&lt;</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">Als het &quot;&lt;&quot; teken niet wordt gebruikt voor opmaakdoeleinden, moet het vooraf gegaan worden door het karakter &quot;\&quot; (backslash).</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">&lt;</td>
<tr>
</tr>
  <td align="left" valign="top" bgcolor="#FFFFFF">\&gt;</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">Voor het teken &quot;&gt;&quot; geldt hetzelfde als voor het teken &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">&gt;</td>
</tr>
</tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\|</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">Voor het teken &quot;|&quot; geldt hetzelfde als voor het teken &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">|</td>
</tr>
</table>
<h3>Gebruik</h3>
<p>Voer de gewenste tekst in (inclusief de gewenste opmaakcodes) en klik op de knop &quot;Bewaar&quot;.</p>
<p>Het bewerkingsvenster zal sluiten en de gewijzigde tekst zal verschijnen in uw webpagina.<br>
  <span class="remark">In sommmige uitzonderlijke gevallen kan het nodig zijn om de pagina in uw brwoser te verversen.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">sluit venster</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
