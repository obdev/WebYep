<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<html>
<!-- DW6 -->
<head>
<!--
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
-->

<title><?php echo $webyep_sProductName?>
</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nstret</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?>
  : L&auml;ngre text</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>

<p>Anv&auml;nd 
  f&auml;ltet  
L&auml;ngre text f&ouml;r br&ouml;dtext, listor eller annan text som l&ouml;per &ouml;ver flera rader. F&auml;ltet kan inneh&aring;lla  enklare  formatering. T&auml;nk dock p&aring; f&ouml;ljande:</p>
<ul>
  <li><?php echo $webyep_sProductName?> &auml;r inte Word&reg;! Det &auml;r inte m&ouml;jligt att kopiera &ouml;ver all formatering fr&aring;n ett textdokument till ett <?php echo $webyep_sProductName?> L&auml;ngre text-f&auml;lt.
  Det g&auml;ller t ex val av typsnitt, listor, tabeller etc. </li>
  <li>Du kan i <?php echo $webyep_sProductName?>
  anv&auml;nda enklare former av formatering  f&ouml;r att t ex ange  fet stil, skapa listor och l&auml;gga in  l&auml;nkar. L&auml;s mer om detta l&auml;ngre ner p&aring; sidan.</li>
  <li>Du kan flytta text fr&aring;n Word&reg; med klipp-och-klistra men d&aring; &auml;r det bara inneh&aring;llet som klistras in &ndash; inte formateringen.</li>
  <li>Den b&auml;sta metoden &auml;r  att f&ouml;rst skriva in texten utan formatering i en ordbehandlare. Kopiera sedan texten och klistra in i det aktuella textf&auml;ltet. Formatera sedan   texten  med funktionerna i
  <?php echo $webyep_sProductName?>.</li>
</ul>
<p>L&auml;nkar och e-postadresser formateras automatiskt:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#CCCCCC"><b>n&auml;r du skriver</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
  <td align="left" valign="top" bgcolor="#CCCCCC"><b> visar 
    <?php echo $webyep_sProductName?>
    f&ouml;ljande</b></td>
  <td align="left" valign="top" bgcolor="#CCCCCC"><b>exempel</b><img src="../../images/nix.gif" width="200" height="1"></td>
  </tr>
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p>http://www.test.se</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p>Texten &rdquo;http://www.test.se&rdquo; formateras som en l&auml;nk till denna URL &ndash;
    ett nytt f&ouml;nster &ouml;ppnas n&auml;r l&auml;nken klickas!</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p><a href="http://www.test.se" target="_blank" class="externalLink">http://www.test.se</a><br>
    <span class="remark">(l&auml;nkars utseende kan variera! Detta &auml;r endast ett exempel.)</span></p></td>
  </tr>
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p>test@firman.se</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p>Texten &rdquo;test@firman.se&rdquo; formateras som en mailto-l&auml;nk till den angivna e-postadressen.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p><a href="mailto:test@firman.se" class="externalLink">test@firman.se</a><br>
    <span class="remark">(l&auml;nkars utseende kan variera! Detta &auml;r endast ett exempel.)</span></p></td>
  </tr>
</table>
<p>Ytterligare formatering kan &aring;stadkommas med f&ouml;ljande taggar:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#CCCCCC"><b>n&auml;r du skriver</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
  <td align="left" valign="top" bgcolor="#CCCCCC"><b> visar
    <?php echo $webyep_sProductName?> 
    f&ouml;ljande</b></td>
  <td align="left" valign="top" bgcolor="#CCCCCC"><b>exempel</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
  </tr>
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    <p><nobr>&lt;LINK:sid2.php</nobr> G&aring; till sid 2<nobr>&gt;</nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p>Texten &rdquo;G&aring; till sid 2&rdquo; formateras som en l&auml;nk till <i>sid2.php. </i>Den h&auml;r l&auml;nktypen &ouml;ppnas inte i nytt f&ouml;nster! Du g&aring;r  &auml;ven att ange l&auml;nkens fullst&auml;ndiga URL (inklusive  &rdquo;http://...&rdquo;-delen).</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p><a href="javascript:alert('Denna länk hade öppnat sida 2 i samma fönster.');" class="externalLink">G&aring; till sid 2</a></p></td>
  </tr>
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
    <p><nobr>&lt;BOLD</nobr> Fet text<nobr>&gt;</nobr></p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p>Texten &rdquo;Fet  text&rdquo; formateras i fet stil.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p><b>Fet  text</b></p></td>
  </tr>
  <tr> 
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    <p><nobr>&lt;SPECIAL</nobr>  Text med speciell formatering<nobr>&gt;</nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
    
  <p>Texten &rdquo;Text med speciell formatering&rdquo; visas med den  formatering som webbdesignern angett f&ouml;r stilen SPECIAL. Stilnamnet &auml;r godtyckligt men m&aring;ste vara skrivet i versaler.</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"> 
  <p><font face="Courier New, Courier, mono" color="#009933">Text med speciell formatering</font></p></td>
  </tr>
  
  
  
  <tr> 
    
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <p>---</p></td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>En horisontell linje. Raden m&aring;ste b&ouml;rja med sekvensen &rdquo;---&rdquo;!</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"> 
    
  <hr width="200">    </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>* F&ouml;rsta listpunkten<br>
      ** En underniv&aring;<br>
      * Andra listpunkten med l&auml;ngre text<br>
      * Tredje listpunkten<nobr></nobr></p>  </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>Skapa listor genom att skriva en eller flera asterisker (eller
      <i>&rdquo;bullet&rdquo;</i>) f&ouml;rst i meningen.</p>    </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>F&ouml;rsta listpunkten
        <ul>
          <li>En underniv&aring; </li>
          </ul>
        </li>
        <li>Andra listpunkten med l&auml;ngre text</li>
        <li>Tredje listpunkten<nobr></nobr></li>
    </ul>  </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p>  </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>En listpunkt kan skrivas &ouml;ver flera rader. Skriv in tv&aring; mellanslag f&ouml;rst p&aring; raden s&aring; hamnar texten inom f&ouml;reg&aring;ende punkt. S&aring; h&auml;r:</p>
      <p class="codeExample">* F&ouml;rsta listpunkten<br>
  &nbsp;&nbsp;Det h&auml;r h&ouml;r ocks&aring; till den f&ouml;rsta listpunkten.<br>
        * Andra listpunkten<br>
      ...</p>    </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>F&ouml;rsta listpunkten<br>
        Det h&auml;r h&ouml;r ocks&aring; till den f&ouml;rsta listpunkten. </li>
        <li> Andra listpunkten<nobr></nobr></li>
      </ul>  </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>Det g&aring;r &auml;ven att kombinera olika formateringskommandon:</p>
      <p class="codeExample">* &lt;BOLD F&ouml;rsta punkten&gt;<br>
  &nbsp;&nbsp;Det h&auml;r h&ouml;r ocks&aring; till den f&ouml;rsta punkten.<br>
        * Andra punkten<br>
    ...</p></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li><strong>F&ouml;rsta punkten</strong><br>
        Det h&auml;r h&ouml;r ocks&aring; till den f&ouml;rsta punkten. </li>
      <li>Andra punkten<nobr></nobr></li>
    </ul></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ F&ouml;rsta punkten<br>
      ++ En underniv&aring;<br>
      + Andra punkten med en l&auml;ngre text<br>
      + Tredje punkten <nobr></nobr></p></td>
    <td align="left" valign="top" bgcolor="#EEEEEE"><p>Med ett &rdquo;+&rdquo; (plus) i b&ouml;rjan av raden skapas ist&auml;llet en numrerad lista.</p></td>
    <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
      <li>F&ouml;rsta punkten
        <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
          <li>En underniv&aring;</li>
          </ol>
        </li>
        <li>Andra punkten med en l&auml;ngre text</li>
        <li>Tredje punkten<nobr></nobr></li>
    </ol></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
      111 | 222 | 333<nobr></nobr></p>  </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>Med tecknet &rdquo;|&rdquo;      kan man skapa enklare tabeller. Varje &rdquo;|&rdquo; ger en ny kolumn.</p>
    <p>Tabellens utseende   definieras av webbdesigner som skapat webbsidan.</p>    </td>
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
    </table>  </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#EEEEEE">\&lt;</td>
    <td align="left" valign="top" bgcolor="#EEEEEE">D&aring; haktecknet &rdquo;&lt;&rdquo; anv&auml;nds i  formateringssyfte s&aring; m&aring;ste en  &rdquo;\&rdquo; (<i>backslash</i>) f&ouml;reg&aring;  tecknet om det ska g&aring; att l&auml;sa i vanlig text.</td>
    <td align="left" valign="top" bgcolor="#EEEEEE">&lt;</td>
  <tr></tr>
  <td align="left" valign="top" bgcolor="#FFFFFF">\&gt;</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">Det samma g&auml;ller &auml;ven f&ouml;r det omv&auml;nda haktecknet  &rdquo;&lt;&rdquo;.</td>
    <td align="left" valign="top" bgcolor="#FFFFFF">&gt;</td>
  </tr>
  </tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\|</td>
    <td align="left" valign="top" bgcolor="#EEEEEE">Samma sak g&auml;ller &auml;ven f&ouml;r tecknet &rdquo;|&rdquo;.</td>
    <td align="left" valign="top" bgcolor="#EEEEEE">|</td>
  </tr>
</table>
<h3>Redigering</h3>
<p>Skriv in (eller kopiera in) &ouml;nskad text. Anv&auml;nd metoderna ovan f&ouml;r att formatera texten om s&aring; erfordras. Klicka knappen Spara n&auml;r du &auml;r klar.</p>
<p>Redigeringsf&ouml;nstret st&auml;ngs automatiskt n&auml;r texten sparas och den &auml;ndrade texten visas  p&aring; sidan i webbl&auml;saren. <br>
    <span class="remark">I enstaka fall kan du beh&ouml;va ladda om sidan manuellt innan &auml;ndringen syns.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">st&auml;ng f&ouml;nster</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
