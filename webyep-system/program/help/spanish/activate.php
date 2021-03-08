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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Ayuda: <?php echo $webyep_sProductName?>
      ¡No está configurado correctamente!</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p><?php echo $webyep_sProductName?> No puedes introducir ningún dato porque el archivo de permisos de escritura no está correctamente configurado.</p>
<p>Por favor, contacta con el diseñador web que ha realizado tu página web para recibir asistencia sobre &quot;configuración&quot;<?php echo $webyep_sProductName?>.</p>
<p>O revisa la documentación (&quot;Instalación en el servidor web / Configuración&quot;)
  sobre cómo configurarlo<?php echo $webyep_sProductName?>.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">Cerrar ventana</a>&gt;</span>
<hr>
<span class="Nota"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
