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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../styles.css" type="text/css"></head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Aide : Texte</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>Avec <?php echo $webyep_sProductName?> &quot;Texte&quot; vous pouvez effectuer des modifications de textes simples. En insérant du texte, il faut noter que :</p>
<ul>
<li><?php echo $webyep_sProductName?> ce n'est pas Word&reg; ! Un texte qui à été conçu dans Word peut souvent ne pas être accepté 1 :1 (Tabulations, listes, polices d'écritures).</li>
<li>Par contre il est possible d'entreprendre de simples fonctions comme (par ex. Gras)</li>
<li>Il est possible de copier/coller un texte a partir de Word, mais il prendra en compte que son contenu sans formatage.</li>
<li>Il est préférable de formater un texte directement dans <?php echo $webyep_sProductName?> . Vous pouvez donc copier/coller du texte depuis Word, mais le formatage (gras, souligné, etc.) se fera ici dans la fenêtre texte.</li>
</ul>
<p>certaines parties seront formatées automatiquement dans <?php echo $webyep_sProductName?>  - par ex. pour les liens et les adresses E-Mail :</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><strong><font color="black">Comme entrée</font></strong></p>
</td>
<td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> 
      
<p><strong><font color="black">apparaît sur la page</font></strong></p>
</td>
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>par exemple :</b></font></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>http ://www.test.com</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Le texte &quot;http ://www.test.com&quot; comme lien sur cette page ouvrira une nouvelle fenêtre du navigateur.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="http://www.test.com" target="_blank" class="externalLink">http ://www.test.com</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>test@firma.com</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>Le texte &quot;test@firma.com&quot; comme lien sur cette adresse E-Mail<nobr></nobr>.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a></p>
</td>
</tr>
  
  
  
  
</table>
<p>d'autres formatages peuvent être faits avec les instructions suivantes :</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
<tr> 
    
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><strong><font color="black">Comme entrée</font></strong></p>
</td>
<td align="left" valign="top" width="60%" bgcolor="#CCCCCC"> 
      
<p><strong><font color="black">apparaît sur la page</font></strong></p>
</td>
<td align="left" valign="top" width="20%" bgcolor="#CCCCCC"> 
      
<p><font color="black"><b>par exemple :</b></font></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;LINK :pagesuivante.php</nobr> page suivante<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Le texte &quot;page suivante&quot;comme lien sur le fichier <i>pagesuivante.php</i> 
        - la page ne sera pas ouverte dans une nouvelle fenêtre du navigateur ! Il est aussi possible de mettre une adresse Web- URL (incl. &quot;http ://...&quot;).</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="javascript:alert('Dieser Link wuerde auf eine andere Seite Ihrer WebSite fuehren.');" class="externalLink">page suivante</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
      <p><nobr>&lt;FETT</nobr> un texte gras<nobr>&gt;</nobr> ou &lt;BOLD<nobr>...&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>Le texte &quot;un texte gras&quot; en gras.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><strong>un texte gras</strong></p>
</td>
</tr>
<tr> 
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;BEISPIEL </nobr> un texte spécial<nobr>&gt;</nobr> <br>
      ou &lt;SPECIAL<nobr>...&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>Le texte &quot;un texte spécial&quot; à été conçu par le créateur du site avec le formatage &quot;BEISPIEL&quot; (&quot;<nobr>SPECIAL</nobr>&quot;). le créateur du site pourra vous communiquer le style qui à été décidé.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
<p><font face="Courier New, Courier, mono" color="#009933">un texte spécial</font> </p>
</td>
</tr>
  

  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>---</p>
</td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>une ligne horizontale. les tirets &quot;---&quot; doivent êtres sur la même ligne !</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<hr width="200">
    </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>* Premier point<br>
      ** un sous point<br>
      * Deuxième point avec un long texte<br>
      * Troisième point<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>En ajoutant une ou plusieurs étoiles devant le texte (ou en employant les symboles listes) le texte sera formaté en tant que liste.</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>Premier point
        <ul>
            <li>un sous point</li>
          </ul>
      </li>
      <li>Deuxième point avec un long texte</li>
      <li>Troisième point<nobr></nobr></li>
  </ul></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ Premier point<br>
      ++ un sous point<br>
      + Deuxième point avec un long texte<br>
      + troisième point<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>En ajoutant un ou plusieurs &quot;+&quot; (plus) devant le texte  le texte sera formaté en tant que liste à puce.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
      <li>Premier point
        <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>un sous point</li>
          </ol>
      </li>
      <li>Deuxième point avec un long texte</li>
      <li>troisième point<nobr></nobr></li>
  </ol></td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
    111 | 222 | 333<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>En mettant le symbole &quot;|&quot;
      (en bas à gauche à côté du &quot;Y&quot;, rester sur AltGr) les séparations seront sous forme de tabulation.</p>
    <p>La disposition des tabulations seront conçu par le créateur du site.</p></td>
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
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>Après avoir inséré le signe &quot;&lt;&quot; il faut encore ajouter le signe &quot;\&quot; au début pour avoir le résultat désiré.</p>
    </td>
  <td align="left" valign="top" bgcolor="#EEEEEE">&lt;</td>
<tr>
</tr>
  <td align="left" valign="top" bgcolor="#FFFFFF">\&gt;</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">Pour &quot;&gt;&quot; c'est pareil que pour &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">&gt;</td>
</tr>
</tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\|</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">Pour &quot;|&quot; c'est pareil que pour  &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">|</td>
</tr>
</table>
<h3>A procéder comme suit :</h3>
<p>Ajouter le texte (et formater selon ci-dessus) dans la fenêtre texte et cliquer sur &quot;Enregistrer&quot;</p>
<p>La fenêtre se ferme après l'enregistrement et votre page web modifiée apparaît.<br>
  <span class="remark">(Dans de rares cas vous devez actualiser votre navigateur pour voir les modifications)</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">Fermer l'aide</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
