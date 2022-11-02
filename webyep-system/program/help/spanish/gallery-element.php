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
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Ayuda: Galería</h1>
	<h3>Descripción</h3>
	<p>En la ventana &quot;Editar galería de imágenes&quot; puedes añadir imágenes<em> (fotografías o gráficos)</em> a la galería de imágenes.</p>
	<p><strong>Importante:<br></strong>La imagen debe haberse guardado con un &quot;formato adecuado para internet&quot;, es decir:</p>
	<ul>
		<li>El peso o tamaño de la imagen debe ser preferiblemente bajo<em> (200 kBytes)</em> y tener pequeñas dimensiones (por ejemplo, que el alto y el ancho no excedan de 1000 pixels).</li><br>
		<li>El formato de archivo de imagen debe ser uno de los soportados por los navegadores web habituales (GIF, PNG o JPEG).</li>
	</ul>
	<p>El sistema creará automáticamente una miniatura de la imagen cargada y modificará su tamaño si éste sobrepasa el ancho o alto máximo definido por el diseñador de la página web.<br>Algunos servidores no permiten el remuestreo de imágenes <em>(cuando no tienen una extensión GD instalada)</em> y mostrarán una advertencia en la ventana &quot;Editar galería de imágenes&quot;.</p>
	<h3>Indicaciones</h3>
	<p><strong>Cambiar / Añadir imagen:<br></strong>Haz click sobre el botón <strong>&quot;Examinar...&quot; </strong>para buscar la imagen que quieres subir (cargar) a tu página web. Selecciona la imagen en la ventana de búsqueda y haz click sobre el botón &quot;OK&quot; (o &quot;Abrir&quot;).</p>
	<p>Añade un pie de foto a la imagen - una breve descripción que aparecerá bajo la imagen en la página web, y también como una etiqueta ALT o sugerencia cuando se pasa el ratón por encima de la imagen.</p>
	<p>Despúes haz click sobre el botón  &quot;Guardar&quot; para subir la imagen.</p>
	<p><strong>Nota: </strong><br>La transferencia de la imagen desde tu ordenador hasta el servidor web (donde está alojada tu página web) puede tardar unos minutos, dependiendo de la velocidad de tu conexión a internet.</p>
	<p>La ventana del editor se cerrará después de que se cargue la imagen y verás los cambios en la página web.<br><span class="remark">En algunos casos puede ser necesario que hagas click sobre el botón &quot;Actualizar página&quot; de tu navegador para ver los cambios realizados.</p>
	<p><strong>Cambiar solamente el pie de foto de la imagen</strong>:<br>Para modificarlo, NO hagas click sobre el botón <strong>&quot;Examinar...&quot; </strong>para seleccionar otra imagen, simplemente modifica el texto del panel de descripción.</p>
	<p>La ventana del editor se cerrará después de que guardes los cambios y el texto modificado aparecerá en tu página web.<br><span class="remark">En algunos casos puede ser necesario que hagas click sobre el botón &quot;Actualizar página&quot; de tu navegador para ver los cambios realizados.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Cerrar ventana</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
