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
	<h1> <?php echo $webyep_sProductName?> Aide : Texte</h1>
	<h3>Description</h3>
	<p>Avec <?php echo $webyep_sProductName?> &quot;Texte&quot; vous pouvez effectuer des modifications de textes simples. En insérant du texte, il faut noter que:</p>
	<ul>
		<li><?php echo $webyep_sProductName?> ce n'est pas Word® ! Un texte qui à été conçu dans Word peut souvent ne pas être accepté 1 :1 (Tabulations, listes, polices d'écritures).</li>
		<li>Par contre il est possible d'entreprendre de simples fonctions comme (par ex. Gras)</li>
		<li>Il est possible de copier/coller un texte a partir de Word, mais il prendra en compte que son contenu sans formatage.</li>
		<li>Il est préférable de formater un texte directement dans <?php echo $webyep_sProductName?> . Vous pouvez donc copier/coller du texte depuis Word, mais le formatage (gras, souligné, etc.) se fera ici dans la fenêtre texte.</li>
	</ul>
	<p>Certaines parties seront formatées automatiquement dans <?php echo $webyep_sProductName?> - par ex. pour les liens et les adresses E-Mail:</p>
	<div id="table-1"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">Comme entrée</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>apparaît sur la page</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">par exemple:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>http://www.test.com</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Le texte "http ://www.test.com" comme lien sur cette page ouvrira une nouvelle fenêtre du navigateur.</p>
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
			<p>Le texte "test@firma.com" comme lien sur cette adresse E-Mail.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><a class="externalLink" href="mailto:test@firma.com">test@firma.com</a></p>
		</td>
	</tr>
</table></p>
	</div>
	<p><strong>D'autres formatages peuvent être faits avec les instructions suivantes :</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">Comme entrée</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>apparaît sur la page</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">par exemple:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;LINK :pagesuivante.php</nobr> page suivante<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Le texte &quot;page suivante&quot;comme lien sur le fichier <i>pagesuivante.php</i> 
        - la page ne sera pas ouverte dans une nouvelle fenêtre du navigateur ! Il est aussi possible de mettre une adresse Web- URL (incl. &quot;http ://...&quot;).</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a href="javascript:alert('Dieser Link wuerde auf eine andere Seite Ihrer WebSite fuehren.');" class="externalLink">page suivante</a></p>
		</td>
	</tr>



	<tr>
		<td align="left" style="background-color: #EEEEEE"" valign="top">
			<p><nobr>&lt;FETT</nobr> un texte gras<nobr>&gt;</nobr> ou &lt;BOLD<nobr>...&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Le texte &quot;un texte gras&quot; en gras.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><strong>un texte gras</strong></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;BEISPIEL </nobr> un texte spécial<nobr>&gt;</nobr> <br>
      ou &lt;SPECIAL<nobr>...&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Le texte &quot;un texte spécial&quot; à été conçu par le créateur du site avec le formatage &quot;BEISPIEL&quot; (&quot;<nobr>SPECIAL</nobr>&quot;). le créateur du site pourra vous communiquer le style qui à été décidé.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><font face="Courier New, Courier, mono" color="#009933">un texte spécial</font> </p>		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>---</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>une ligne horizontale. les tirets &quot;---&quot; doivent êtres sur la même ligne!</p>		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<hr width="200">
		</td>
	</tr>

	<tr style="background-color: #FFFFFF">
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>* Premier point<br>
     				 ** un sous point<br>
     				 * Deuxième point avec un long texte<br>
     				 * Troisième point<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>En ajoutant une ou plusieurs étoiles devant le texte (ou en employant les symboles listes) le texte sera formaté en tant que liste.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
      <li>Premier point
        <ul>
            <li>un sous point</li>
          </ul>
      </li>
      <li>Deuxième point avec un long texte</li>
      <li>Troisième point<nobr></nobr></li>
  </ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>+ Premier point<br>
      ++ un sous point<br>
      + Deuxième point avec un long texte<br>
      + troisième point<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>En ajoutant un ou plusieurs &quot;+&quot; (plus) devant le texte  le texte sera formaté en tant que liste à puce.</p>		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
    			  <li>Premier point
      			  <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
         		   <li>un sous point</li>
         		 </ol>
      			</li>
      			<li>Deuxième point avec un long texte</li>
   			   <li>troisième point<nobr></nobr></li>
 			 </ol>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
<p>aaa | bbb | ccc<br>
    111 | 222 | 333<nobr></nobr></p>
</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
<p>En mettant le symbole &quot;|&quot;
      (en bas à gauche à côté du &quot;Y&quot;, rester sur AltGr) les séparations seront sous forme de tabulation.</p>
    <p>La disposition des tabulations seront conçu par le créateur du site.</p>
</td>

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

	<tr>
		<td></td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			\&lt;
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Après avoir inséré le signe &quot;&lt;&quot; il faut encore ajouter le signe &quot;\&quot; au début pour avoir le résultat désiré.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">&gt;</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">\&gt;</td>

		<td align="left" style="background-color: #FFFFFF" valign="top"><p>Pour &quot;&gt;&quot; c'est pareil que pour &quot;&lt;&quot;.</p></td>

		<td align="left" style="background-color: #FFFFFF" valign="top">&gt;</td>
	</tr>

<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">\|</td>

		<td align="left" style="background-color: #EEEEEE" valign="top"><p>Pour &quot;|&quot; c'est pareil que pour  &quot;&lt;&quot;.</p></td>

		<td align="left" style="background-color: #EEEEEE" valign="top">|</td>
	</tr>
</table></p>
	</div>
	<h3>&nbsp;</h3>
	<h3>A procéder comme suit:</h3>
	<p>Ajouter le texte (et formater selon ci-dessus) dans la fenêtre texte et cliquer sur &quot;Enregistrer&quot;</p>
	<p>La fenêtre se ferme après l'enregistrement et votre page web modifiée apparaît.<br>(Dans de rares cas vous devez actualiser votre navigateur pour voir les modifications)</p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Fermer l'aide</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
