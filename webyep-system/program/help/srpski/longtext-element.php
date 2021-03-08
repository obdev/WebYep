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
.textButton { text-transform:capitalize; font-variant:normal }
.remark { font-size:10px }
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
	<h1> <?php echo $webyep_sProductName?> Pomoc: Tekst</h1>
	<h3>Opis</h3>
	<p>U poljima za tekst <?php echo $webyep_sProductName?>  -a&nbsp;mozete da upisete jednostavno formatirane tekstove. Pri tome treba obratii paznju na sledece:</p>
	<ul>
		<li><?php echo $webyep_sProductName?> nije Word®!&nbsp;Tekst obradjen u programima za obradu teksta, kao sto je Microsoft&#8482; Word® se u vecini slucajeva ne moze direktno preneti (odnosi se na tabele, liste, razlicite velicina fontova).</li>
		<li>Moguce je jednostavno formatiranje teksta (masla slova, na primer).</li>
		<li>Prebacivanje teksta iz na pr. Word®-a pomocu copy/paste je moguce, ali ogranicava na sadrzaj teksta, ne i na format.</li>
		<li>Najbolje bi bilo tekstove formatirati u <?php echo $webyep_sProductName?> -u. Znaci, sastaviti tekstove na pr. u Word®-u, prebaciti ih uz pomoc copy/paste i u -u tek formatirati.</li>
	</ul>
	<p>Vas tekst ce biti delom automatski od strane <?php echo $webyep_sProductName?> -a formatiran - na pr. linkovi i E-mail adrese:</p>
	<div id="table-1"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">kod upisivanja</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>ce na web sajtu biti</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">na primer:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>http://www.test.com</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Tekst "http://www.test.com" kao link an web sajtu - bice otvoren u novom prozoru!.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a class="externalLink" href="http://www.test.com" target="_blank">http://www.test.com</a></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>test@firma.com</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Tekst "test@firma.com" kao link za E-mail adresu.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><a class="externalLink" href="mailto:test@firma.com">test@firma.com</a></p>
		</td>
	</tr>
</table></p>
	</div>
	<p><strong>Ostala formatiranja mozete uraditi na sledeci nacin:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">kod upisivanja</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>ce na web sajtu biti</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">na primer:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;LINK:drugastrana.php</nobr> 
        Druga strana<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Tekst "Druga strana" kao link prema drugastrana.php - nece biti otvoren novi prozor!Mozete takodje upisati potpune web adrese odnostno URL (zajedno sa "http://...").</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a href="javascript:alert('Dieser Link wuerde auf eine andere Seite Ihrer WebSite fuehren.');" class="externalLink">Druga 
        strana</a></p>
		</td>
	</tr>



	<tr>
		<td align="left" style="background-color: #EEEEEE"" valign="top">
			<p><nobr>FETT Podebljani tekst</nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Tekst "Podebljani tekst", napisan manim slovoma..</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><strong>Podebljani tekst</strong></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;PRIMER 
        Specijalno formatiran tekst&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Tekst &quot;Specijalno 
        formatiran tekst&quot; ce biti formatiran na nacin definisan od strane 
        Vaseg web dizajnera, u stilu &quot;PRIMER&quot;</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><font face="Courier New, Courier, mono" color="#009933">Specijalno 
        formatiran tekst</font></p>		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>---</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Horizontalna linija za 
        razdvajanje. &quot;---&quot; mora da stoji u posebnom redu! </p>		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<hr width="200">
		</td>
	</tr>

	<tr style="background-color: #FFFFFF">
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>* Prva tacka u listi<br>
        ** Podtacka<br>
        * Druga tacka sa duzim tekstom<br>
        * Treca tacka</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Ubacivanjem jedne ili vise 
        zvezdica (ili simbola za liste) ce redovi biti formatirani kao liste.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
        <li>Prva tacka u listi 
          <ul>
            <li>Podtacka</li>
          </ul>
        </li>
        <li>Druga tacka sa duzim tekstom</li>
        <li>Treca tacka<nobr></nobr></li>
      </ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>+ Prva tacka u listi<br>
        ++ Podtacka<br>
        + Druga tacka sa duzim tekstom<br>
        + Treca tacka</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Ubacivanjem jedog ili vise pluseva ce redovi biti formatirani kao numerisana lista.</p>		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
        <li> Prva tacka u listi 
          <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>Podtacka</li>
          </ol>
        </li>
        <li>Druga tacka sa duzim tekstom</li>
        <li>Treca tacka<nobr></nobr></li>
      </ol>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
<p>aaa | bbb | ccc<br>
    111 | 222 | 333<nobr></nobr></p>
</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
<p>Upotrebom simobola &quot;|&quot; 
        (levo dole na tastaturi, pored tastera &quot;Y&quot;, sa istovremeno pritisnutim 
        &quot;AltGr&quot; tasterom, moguce je formirati jednostavne tabele. Simbol 
        &quot;|&quot; sluzi samo za razdvajanje pojedinih polja tabele.</p>
      <p>Sam izgled tabele ce biti definisan od strane Vaseg web dizajnera.</p></td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<table border="0" cellspacing="0" cellpadding="6">
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

	</table></p>
	</div>
	<p>&nbsp;</p>
	<h3>Postupak</h3>
	<p>Upisite tekst u polje za tekst (formatirajte ga ako je potrebno) i kliknite na &quot;sacuvaj&quot;.</p>
	<p>Posle klika na &quot;sacuvaj&quot; se prozor za upisivanje zatvara i mozete da vidite svoj web sajt sa promenjenim tekstom.<br>(u retkim slucajevima morate u Browser-u da aktuelizujete svoj sajt).</p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">zatvori pomoc</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
