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
.Nota { font-size:10px }
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
	<h1> <?php echo $webyep_sProductName?> Ayuda: Texto de Párrafo</h1>
	<h3>Descripción</h3>
	<p>Puedes utilizar un campo de Texto de Párrafo para introducir texto con un formato sencillo (como listas o negritas). Cuando uses este editor, por favor, ten en cuenta que: </p>
	<ul>
		<li>WebYep no es Word®! Un texto generado en un procesador de texto como Microsoft™ Word® no puede copiarse y pegarse en un campo de Texto de Párrafo de WebYep con todas sus opciones de formato, atributos, fuentes, listas, tablas...</li>
		<li>En WebYep, lo que sí puedes hacer es utilizar secuencias simples de caracteres especiales para crear, por ejemplo, negritas, listas, o links. </li>
		<li>Si pegas un texto escrito en Word® se pegará el &quot;contenido&quot;, pero no el formato.</li>
		<li>Por tanto, es recomendable que escribas el texto en algún procesador de texto (sin formatear), lo copies y lo pegues en el campo de texto de WebYep, y entonces le des el formato deseado con los botones de formato de texto de WebYep. También puedes introducir el código HTML de formato a mano.</li>
	</ul>
	<p>Algunas partes del texto se formatearán automáticamente, como links y direcciones de correo electrónico:</p>
	<div id="table-1"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">al introducir </th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>se mostrará</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">ejemplo:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>http://www.test.com</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>El texto &quot;http://www.test.com&quot; formateado como un link que abrirá esa URL en una nueva ventana del navegador al pulsar sobre él!</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a class="externalLink" href="http://www.test.com" target="_blank">http://www.test.com</a><br>
			<span class="remark">(la apariencia visual de los links podría variar en tu página web!)</span></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>nombre@test.com</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>El texto &quot;nombre@test.com&quot; formateado como un link mailto: que envía un correo electrónico a la dirección indicada.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><a class="externalLink" href="mailto:test@firma.com">nombre@test.com</a><br>
			<span class="remark">(la apariencia visual de los links podría variar en tu página web!)</span></p>
		</td>
	</tr>
</table></p>
	</div>
	<p><strong>Otras opciones de formato que pueden realizarse empleando etiquetas de formato:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">al introducir</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>se mostrará</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">ejemplo:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;LINK:otrapagina.php</nobr> Ir a otra página<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>El texto &quot;Ir a otra página&quot; formateado como un link a <i>otrapagina.php</i> - no se abrirá en una nueva ventana del navegador cuando hagas click sobre el link! Puedes usar URLs completas (incluyendo la parte inicial &quot;http://...&quot;) en lugar de usar solamente el nombre del archivo (otrapagina.php).</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a class="externalLink" href="javascript:alert('This%20link%20would%20lead%20to%20some%20other%20page%20of%20your%20website.');">Ir a otra página</a></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><nobr>&lt;BOLD</nobr> Texto en negrita<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>El texto &quot;Texto en negrita&quot; formateado en negrita.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p style="font-weight: bold">Texto en negrita</p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;SPECIAL</nobr> Texto con formato especial <nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>El texto &quot;Texto con formato especial&quot; es un estilo definido por el diseñador de tu página web. Él designará los estilos y los nombres asignados (&quot;<nobr>SPECIAL</nobr>&quot;) a cada estilo que esté disponible.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Texto con formato especial</p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>---</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Línea horizontal. La secuencia &quot;---&quot; debe comenzar al inicio de una línea!</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<hr width="200">
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>* Primer elemento de la lista<br>
			** Subelemento<br>
			* Segundo elemento de la lista, con algo más de texto<br>
			* Tercer elemento de la lista<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Puedes crear listas insertando un símbolo de asterisco o viñeta de lista al comienzo de una línea.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li>Primer elemento de la lista

					<ul>
						<li>Subelemento</li>
					</ul>
				</li>

				<li>Segundo elemento de la lista, con algo más de texto</li>

				<li>Tercer elemento de la lista<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Un elemento de lista puede tener varias líneas, insertando 2 espacios al comienzo de la linea, de esta manera: </p>

			<p class="codeExample">* Primer elemento<br>
			&nbsp;&nbsp;Todo esto sigue siendo parte del Primer Elemento de la lista.<br>
			* Segundo elemento<br>
			...</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li>Primer elemento<br>
				Este texto pertenece al primer elemento de la lista.</li>

				<li>Segundo elemento<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Y también puedes combinar diferentes opciones de formato, por ejemplo:</p>

			<p class="codeExample">* &lt;Primer elemento en NEGRITA&gt;<br>
			&nbsp;&nbsp;Este texto pertenece al primer elemento de la lista.<br>
			* Segundo elemento<br>
			...</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li><strong>Primer elemento</strong><br>
				Este texto pertenece al primer elemento de la lista.</li>

				<li>Segundo elemento<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr style="background-color: #FFFFFF">
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>+ Primer elemento de la lista<br>
			++ Subelemento<br>
			+ Segundo elemento de la lista, con algo más de texto<br>
			+ Tercer elemento de la lista<nobr></nobr></p>
		</td>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>Usando el símbolo &quot;+&quot; (más) en lugar de un asterisco, puedes crear una lista numerada.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
				<li>Primer elemento de la lista

					<ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
						<li>Subelemento</li>
					</ol>
				</li>

				<li>Segundo elemento de la lista, con algo más de texto</li>

				<li>Tercer elemento de la lista<nobr></nobr></li>
			</ol>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>aaa | bbb | ccc<br>
			111 | 222 | 333<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Usando el símbolo &quot;|&quot; puedes crear tablas simples. El símbolo &quot;|&quot; actúa como un delimitador de columna.</p>

			<p>El aspecto de la tabla está definido por el diseñador de tu página web.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<table border="0" cellpadding="6" cellspacing="0">
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
		<td align="left" style="background-color: #EEEEEE" valign="top">\&lt;</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">Como el símbolo &quot;&lt;&quot; se usa para formatear, debe ser precedido por el símbolo &quot;\&quot; (barra invertida) para que se inserte <em>como es</em>.</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">&lt;</td>
	</tr>

	<tr>
		<td></td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">\&gt;</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">Con el símbolo &quot;&gt;&quot; ocurre lo mismo que con el símbolo &quot;&lt;&quot;.</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">&gt;</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">\|</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">Con el símbolo &quot;|&quot; ocurre lo mismo que con el símbolo &quot;&lt;&quot;.</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">|</td>
	</tr>
</table></p>
	</div>
	<h3>&nbsp;</h3>
	<h3>Indicaciones</h3>
    <p>Introduce el texto en el campo de texto de párrafo y haz click sobre el botón &quot;Guardar&quot;.</p>
	<p>Una vez guardado, la ventana del editor se cerrará y la página web mostrará el texto que acabas de insertar.<br><span class="remark">En algunos casos puede ser necesario que hagas click sobre el botón &quot;Actualizar página&quot; de tu navegador para ver los cambios realizados.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Cerrar ventana</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
