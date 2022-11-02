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
.numbered-list { line-height:1.25 }
.Nota { font-size:10px }
.textButton { text-transform:capitalize; font-variant:normal }
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:24px }
#menuguide { width:48.9%; float:right; padding:5px; margin-left:20px; margin-bottom:20px; border:solid #a5a5a5 1px }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Ayuda: Menu</h1>
	<h3><img id="menuguide" src="../resources/menu-guide.png" alt="menuguide">Descripción</h3>
	<p>La ventana &quot;Editar Menu&quot; se utiliza para añadir/eliminar elementos de menú y cambiar su orden y/o propiedades. El editor permite arrastrar y soltar los elementos para ordenarlos, por lo que puedes utilizar el ratón para organizarlos.</p>
	<p>Por favor, recuerda que los cambios NO serán guardados <strong>hasta que hagas click sobre el botón &quot;Guardar&quot;</strong> y que esto </strong>no puede deshacerse</strong>!</p>
	<h3>Una breve descripción de la interfaz de usuario:</h3>
	<ol class="numbered-list">
		<li>Campo Nombre del menú</li>
		<li>Vista principal: muestra el menú completo</li>
		<li>Campo de texto 'Título del menú': este texto se muestra a los visitantes de tu página web</li>
		<li>Campo de texto opcional 'Link': puedes introducir la dirección de otra página web aquí</li>
		<li>Casilla de verificación para controlar la visibilidad de las entradas de menú (y sus elementos hijos)</li>
		<li>Botones de Flecha para organizar la posición de las entradas</li>
		<li>Añadir entrada de menú (en el mismo nivel que la entrada de menú actual)</li>
		<li>Añadir entrada de submenú (en un nivel inferior, o subnivel, que la entrada de menú actual)</li>
		<li>Eliminar elemento de menú actual (y todos los subelementos)</li>
		<li>Ayuda online para editores (esta página)</li>
		<li>Botón Cancelar: descarta todos los cambios y cierra la ventana</li>
		<li>Botón Guardar: guarda todos los cambios y cierra la ventana</li>
		<li>Casilla de verificación (checkbox). Si se marca, WebYep mantendrá la página con su URL actual. Si no se marca, añadirá una instancia de la página estándar con, por ejemplo, URL index.php? DOC_INST = 1</li>
	</ol>
	<p>Una vez guardado, la ventana del editor se cerrará y la página web mostrará el texto que acabas de insertar.<br><span class="remark">En algunos casos puede ser necesario que hagas click sobre el botón &quot;Actualizar página&quot; de tu navegador para ver los cambios realizados.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Cerrar ventana</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
