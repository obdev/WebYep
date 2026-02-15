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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Ayuda: Bucle</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Descripción</h3>
<p>Con el elemento Bucle puedes repetir partes de tu página web. Puedes modificar el orden de los fragmentos repetidos y también eliminarlos.</p>
<h3>Indicaciones</h3>
<p><b>Añadir una repetición</b></p>
<p>Al hacer click sobre el símbolo &quot;más&quot; en un bucle, se añade una repetición <strong>debajo</strong>  de ella.</p>
<p><strong>Mover una repetición</strong></p>
<p>Al hacer click sobre los símbolos &quot;flecha arriba&quot;/&quot;flecha abajo&quot; se moverá una repetición hacia arriba/abajo (o izquierda/derecha), ya que &quot;arriba&quot; o &quot;izquierda&quot; significa hacia el inicio del documento y &quot;abajo&quot;/&quot;derecha&quot; significa hacia el final del documento.</p>
<p><strong>Eliminar una repetición</strong></p>
<p>Al hacer click sobre el símbolo &quot;papelera&quot; en un bucle, se elimina esa repetición.</p>
<blockquote>
  <p><strong>Advertencia:</strong> Esta acción no puede deshacerse!</p>
</blockquote>
<p><b>Guardar</b></p>
<p>No hay botón &quot;Guardar&quot;, por lo que todos los cambios tienen efecto inmediato y son guardados al instante!</p>
<span class="textButton">&lt;<a href="javascript:window.close();">Cerrar ventana</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
