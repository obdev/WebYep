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
<span class="textButton">&lt;<a href="javascript:window.close();">Cerrar ventana</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Ayuda: Texto Enriquecido con Editor RTE</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Descripci�n</h3>
<p>Usando la extensi�n de edici�n WYSIWYG HTML <strong>RTE</strong> sobre el campo de Texto Enriquecido de <?php echo $webyep_sProductName?>, puedes crear contenido formateado con HTML sin necesidad de escribir ning�n c�digo HTML.</p>
<p>Las capacidades del Editor  <strong>RTE</strong> podr�an verse alteradas, dependiendo de qu� navegador est�s empleando.</p>
<p>Por favor, ten en cuenta que copiar y pegar un texto con formato de un procesador de texto o un programa de dise�o de p�ginas podr�a no funcionar como esperas, ya que la conversi�n del contenido con formato a HTML es limitada.</p>
<h3>Indicaciones</h3>
<p>Introduce el texto, utiliza las opciones del editor para formatear el texto, y haz click sobre el bot�n &quot;Guardar&quot;.</p>
<p>Una vez guardado, la ventana del editor se cerrar� y la p�gina web mostrar� el texto que acabas de insertar.<br><span class="remark">En algunos casos puede ser necesario que hagas click sobre el bot�n &quot;Actualizar p�gina&quot; de tu navegador para ver los cambios realizados.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">Cerrar ventana</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
