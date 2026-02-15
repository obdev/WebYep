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
	<h1> <?php echo $webyep_sProductName?> Hjälp: Längre text</h1>
	<h3><span class="style1">Beschreibung</span></h3>
	<p><span class="style1">Använd fältet Längre text för brödtext, listor eller annan text som löper över flera rader. Fältet kan innehålla enklare formatering. Tänk dock på följande:</span></p>
	<ul>
		<li><?php echo $webyep_sProductName?> iär inte Word®! Det är inte möjligt att kopiera över all formatering från ett textdokument till ett <?php echo $webyep_sProductName?>  Längre text-fält. Det gäller t ex val av typsnitt, listor, tabeller etc. </li>
		<li>Du kan i <?php echo $webyep_sProductName?> använda enklare former av formatering för att t ex ange fet stil, skapa listor och lägga in länkar. Läs mer om detta längre ner på sidan.</li>
		<li>Du kan flytta text från Word® med klipp-och-klistra men då är det bara innehållet som klistras in &#8211; inte formateringen.</li>
		<li>Den bästa metoden är att först skriva in texten utan formatering i en ordbehandlare. Kopiera sedan texten och klistra in i det aktuella textfältet. Formatera sedan texten med funktionerna i <?php echo $webyep_sProductName?> .</li>
	</ul>
	<p>Länkar och e-postadresser formateras automatiskt:</p>
	<div id="table-1"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6" class="wytable">
  
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
</table></p>
	</div>
	<p>&nbsp;</p>
	<p><strong>Ytterligare formatering kan åstadkommas med följande taggar:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6" class="wytable">
  
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
</table></p>
	</div>
	<h3>Redigering</h3>
	<p>Skriv in (eller kopiera in) önskad text. Använd metoderna ovan för att formatera texten om så erfordras. Klicka knappen Spara när du är klar.</p>
	<p>Redigeringsfönstret stängs automatiskt när texten sparas och den ändrade texten visas på sidan i webbläsaren.<br><span class="remark">I enstaka fall kan du behöva ladda om sidan manuellt innan ändringen syns.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">stäng fönster</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
