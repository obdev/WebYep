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
<!-- #BeginEditable "doctitle" -->
<title><?php echo $webyep_sProductName?></title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1> 
        <?php echo $webyep_sProductName?>
        Pomoc: Tekst</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<!-- #BeginEditable "content" --> 
<h3>Opis</h3>
<p>U poljima za tekst 
  <?php echo $webyep_sProductName?>
  -a&nbsp;mozete da upisete jednostavno formatirane tekstove. Pri tome treba obratii 
  paznju na sledece:</p>
<ul>
  <li> 
    <?php echo $webyep_sProductName?>
    &nbsp;nije Word&reg;!&nbsp;Tekst obradjen u programima za obradu teksta, kao 
    sto je Microsoft&#153; Word&reg; se u vecini slucajeva ne moze direktno preneti 
    (odnosi se na tabele, liste, razlicite velicina fontova).</li>
  <li>Moguce je jednostavno formatiranje teksta (masla slova, na primer).</li>
  <li>Prebacivanje teksta iz na pr. Word&reg;-a pomocu copy/paste je moguce, ali 
    ogranicava na sadrzaj teksta, ne i na format.</li>
  <li>Najbolje bi bilo tekstove formatirati u 
    <?php echo $webyep_sProductName?>
    -u. Znaci, sastaviti tekstove na pr. u Word&reg;-u, prebaciti ih uz pomoc 
    copy/paste i u 
    <?php echo $webyep_sProductName?>
    -u tek formatirati.</li>
</ul>
<p>Vas tekst ce biti delom automatski od strane 
  <?php echo $webyep_sProductName?>
  -a formatiran - na pr. linkovi i E-mail adrese:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  <tr> 
    <td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> <p><b><font color="black">kod 
        upisivanja</font></b></p>
      </td>
    <td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> <p><b><font color="black">ce 
        na web sajtu biti</font></b></p>
      </td>
    <td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> <p><b><font color="black">na 
        primer:</font></b></p>
      </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p>http://www.test.com</p></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p>Tekst &quot;http://www.test.com&quot; 
        kao link an web sajtu - bice otvoren u novom prozoru!</p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p><a href="http://www.test.com" target="_blank" class="externalLink">http://www.test.com</a></p></td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p>test@firma.com</p></td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p>Tekst &quot;test@firma.com&quot; 
        kao link za E-mail adresu.</p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a></p></td>
  </tr>
</table>
<p>Ostala formatiranja mozete uraditi na sledeci nacin:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  <tr> 
    <td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> <p><b><font color="black">kod 
        upisivanja</font></b></p>
      </td>
    <td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> <p><b><font color="black">ce 
        na web sajtu biti</font></b></p>
      </td>
    <td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> <p><b><font color="black">na 
        primer:</font></b></p>
      </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p><nobr></nobr><nobr>&lt;LINK:drugastrana.php</nobr> 
        Druga strana<nobr>&gt;</nobr></p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p>Tekst &quot;Druga strana&quot; 
        kao link prema <em>drugastrana.php</em>&nbsp;- <em>nece</em> biti otvoren 
        novi prozor!Mozete takodje upisati potpune web adrese odnostno URL (zajedno 
        sa &quot;http://...&quot;).</p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p><a href="javascript:alert('Dieser Link wuerde auf eine andere Seite Ihrer WebSite fuehren.');" class="externalLink">Druga 
        strana</a></p>
      </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p><nobr></nobr><nobr></nobr><nobr>&lt;FETT 
        Podebljani tekst&gt;</nobr></p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p>Tekst &quot;Podebljani 
        tekst&quot;, napisan manim slovoma.</p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p><b>Podebljani tekst</b></p>
      </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p><nobr></nobr><nobr>&lt;PRIMER 
        Specijalno formatiran tekst&gt;</nobr></p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p>Tekst &quot;Specijalno 
        formatiran tekst&quot; ce biti formatiran na nacin definisan od strane 
        Vaseg web dizajnera, u stilu &quot;PRIMER&quot;</p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <p><font face="Courier New, Courier, mono" color="#009933">Specijalno 
        formatiran tekst</font></p>
      </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p>---</p></td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <p>Horizontalna linija za 
        razdvajanje. &quot;---&quot; mora da stoji u posebnom redu! </p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> <hr width="200"> </td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr>* Prva tacka u listi<br>
        ** Podtacka<br>
        * Druga tacka sa duzim tekstom<br>
        * Treca tacka<nobr></nobr></nobr></p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>Ubacivanjem jedne ili vise 
        zvezdica (ili simbola za liste) ce redovi biti formatirani kao liste.</p>
      </td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
        <li>Prva tacka u listi 
          <ul>
            <li>Podtacka</li>
          </ul>
        </li>
        <li>Druga tacka sa duzim tekstom</li>
        <li>Treca tacka<nobr></nobr></li>
      </ul></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ Prva tacka u listi<br>
        ++ Podtacka<br>
        + Druga tacka sa duzim tekstom<br>
        + Treca tacka<nobr></nobr></p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"><p>Ubacivanjem jedog ili vise 
        pluseva ce redovi biti formatirani kao numerisana lista. </p>
      </td>
    <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
        <li> Prva tacka u listi 
          <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>Podtacka</li>
          </ol>
        </li>
        <li>Druga tacka sa duzim tekstom</li>
        <li>Treca tacka<nobr></nobr></li>
      </ol></td>
  </tr>
  <tr> 
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
        111 | 222 | 333<nobr></nobr></p></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><p>Upotrebom simobola &quot;|&quot; 
        (levo dole na tastaturi, pored tastera &quot;Y&quot;, sa istovremeno pritisnutim 
        &quot;AltGr&quot; tasterom, moguce je formirati jednostavne tabele. Simbol 
        &quot;|&quot; sluzi samo za razdvajanje pojedinih polja tabele.</p>
      <p>Sam izgled tabele ce biti definisan od strane Vaseg web dizajnera.</p>
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
      </table></td>
  </tr>
</table>
<h3>Postupak</h3>
<p>Upisite tekst u polje za tekst (formatirajte ga ako je potrebno) i kliknite 
  na &quot;sacuvaj&quot;.</p>
<p><span class="remark">Posle klika na &quot;sacuvaj&quot; se prozor za upisivanje 
  zatvara i mozete da vidite svoj web sajt sa promenjenim tekstom.<br>
  (u retkim slucajevima morate u Browser-u da aktuelizujete svoj sajt).</span></p>
 <span class="textButton">&lt;<a href="javascript:window.close();">zatvori pomoc</a>&gt;</span> 
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
