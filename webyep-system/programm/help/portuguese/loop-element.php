<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<html><!-- #BeginTemplate "/Templates/help-1.1-en.dwt" --><!-- DW6 -->
<head>
<!--
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at
-->
<title><?php echo $webyep_sProductName?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Loop</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Descrição</h3>
<p>Com o elemento LOOP poderá repetir partes de uma página. Poderá alterar a ordem das repetições ou deletá-las.</p>
<h3>Uso</h3>
<p><b>Adicionar repetições</b></p>
<p>Clique no &quot;plus&quot; icon numa repetição irá adicionar uma repetição logo abaixo <strong>below</strong> à presente.</p>
<p><strong>Mover uma repetição</strong></p>
<p>Clique &quot;arrow up&quot;/&quot;arrow down&quot; icons irão mover a repetição para cima ou para baixo (ou esquerfa / direita) - onde &quot;up&quot; or &quot;left&quot; significa ida para o inicio do documento e &quot;down&quot;/&quot;right&quot; significa ida para o final do documento.</p>
<p><strong>Delete repetition</strong></p>
<p>Clique no &quot;trash can&quot; icon numa repetição para deletar essa mesma repetição.</p>
<blockquote>
  <p><strong>Atenção: Tem a certeza ? Caution:</strong> A alteração será definitiva !</p>
</blockquote>
<p><b>Guardar</b></p>
<p>Não existe nenhum &quot;Save&quot; butão pois as alterações são efectuadas imediatamente a são guardadas de imediato !</p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
