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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Image</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>Com a janela&quot;de edição&quot; poderá adicionar imagens (como fotos ou gráficos)
  no seu site ou poderá remover esses ficheiros.</p>
<p><b>Important:</b> A imagem deverá ser gravada num formato e tamanho autorizado - o que significa&quot;para a internet&quot; - o que significa:</p>
<ul>
  <li>Ficheiro deverá ser pequeno (max. 100-150 kBytes) e deverá ter um tamanho máximo de 200-300 pixels (comp e altura).</li>
  <li>O ficheiro também deverá ser criado no formato JPEG ou GIF.</li>
</ul>
<h3>Utilizaçãoe</h3>
<p><b>Mudar imagem:</b></p>
<p>Clique no &quot;Browse...&quot; butão para selecionar o ficheiro que pretende adicionar (upload) na página e clique &quot;OK&quot; (or &quot;Abrir&quot;). Depois clique &quot;Save&quot; para iniciar o envio do ficheiro.</p>
<p><i>Remark:</i> Ficheiro a ser transferido (upload) para o servidor onde o seu site está instalado. Este envio poderá demorar um pouco dependente de diversos factores, congestão na rede, a sua velocidade de acesso, etc.</p>
<p><b>Apagar Imagem:</b></p>
<p>Clique no &quot;Delete&quot; butão para remover a imagem da página e deleta-la do servidor.</p>
<p>Depois de clicar em &quot;Save&quot; ou &quot;Delete&quot; a janela de edição irá fechar e a página alterada será mostrada.<br>
  <span class="attn">Se a página alterada não apareçer, é fazer no seu Browser &quot;Reload ou Carregar de novo
  &quot; no seu web browser.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
