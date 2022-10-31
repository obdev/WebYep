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
.remark { font-size:10px }
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
	<h1> <?php echo $webyep_sProductName?> Help: Long Text</h1>
	<h3>Descrição</h3>
	<p>Pode usar um campo <?php echo $webyep_sProductName?> de texto longo para adicionar texto com formatação simples (como texto a bold ou lists). Sempre que adicionar texto, deverá ter o seguinte em mente:</p>
	<ul>
		<li><?php echo $webyep_sProductName?> isn't Word®! Um texto criado num processor de texto, como o Word da MS Microsoft™ Word® não poderá ser transferido para um campo de texto longo com toda a formatação, atributos de fontes, etc.</li>
		<li>O que poderá fazer é usar sequencias simples de caracteres especiais para criar, por exemplo, texto a bold, links, etc.</li>
		<li>Poderaá transferir o seu texto escrito no Word® com as opçoes de copy/paste - assim só será copiado o &quot;content&quot;, e não a parte da formatação.</li>
		<li>Portanto, o melhor será criara o seu texto num normal processador de texto, sem a formatação, e depois transferi-lo para o <?php echo $webyep_sProductName?> campo de texto através do comando copy/paste, fazendo depois a desejada formatação com as devidas formatações com as <?php echo $webyep_sProductName?> ssequencias de caracteres especiais.</li>
	</ul>
	<p><strong>Alguma partes do texto será formatado automáticamente, como links e endereços e-mail:</strong></p>
	<div id="table-1"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6"  class="wytable">
  
<tr> 
    
<td align="left" valign="top" bgcolor="#CCCCCC"><b>when entering</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b><?php echo $webyep_sProductName?> will display</b></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>e.g.:</b><img src="../../images/nix.gif" width="200" height="1"></td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>http://www.test.com</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>The text &quot;http://www.test.com&quot; formatado como um link para este URL -
  uma nova janela de um browser web irá ser aberto quando clicar neste link !</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="http://www.test.com" target="_blank" class="externalLink">http://www.test.com</a><br>
  <span class="remark">(a aparência visual dos links poderá variar no seu site !)</span></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>test@company.com</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>The text &quot;test@firma.com&quot; formatado como link de envio de mail.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a><br>
  <span class="remark">(a aparência visual dos links poderá variar no seu site !)</span></p>
</td>
</tr>

</table></p>
	</div>
	<p>&nbsp;</p>
	<p><strong>Poderá usar também estes tags de formatação:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table width="98%" border="0" cellspacing="0" cellpadding="6" class="wytable">
  
<tr> 
    
<td align="left" valign="top" bgcolor="#CCCCCC"><b>when entering</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b><?php echo $webyep_sProductName?> will display</b></td>
<td align="left" valign="top" bgcolor="#CCCCCC"><b>e.g.:</b><br><img src="../../images/nix.gif" width="200" height="1"></td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;LINK:otherpage.php</nobr> To some other page<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>The text &quot;To some other page&quot; formatado como um link para outra página <i>otherpage.php</i> 
        - não será aberta nenhuma janela nova no seu browser quando clicar no link !
        Poderá claro também usar o URL completo (includo &quot;http://...&quot; part)
        em vez de apenas o nome do ficheiro (otherpage.php).</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="javascript:alert('Este link irá ligar para outra página no seu site.');" class="externalLink">To
    some other page</a></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
      <p><nobr>&lt;BOLD</nobr> Some bold Text<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>The text &quot;Some bold text&quot; formatted in bold.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><b>Some bold text</b></p>
</td>
</tr>
<tr> 
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      <p><nobr>&lt;SPECIAL</nobr> Some text with special formatting<nobr>&gt;</nobr></p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p>The text &quot;Texto com formatação especial&quot; num estilo definido pelo web designer. Que estlos e com que nomes (&quot;<nobr>SPECIAL</nobr>&quot;) estão disponiveis na página, são definidos pelo web designer que criou a página.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
<p><font face="Courier New, Courier, mono" color="#009933">Algum texto com formatação especial</font> </p>
</td>
</tr>
  

  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>---</p>
</td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>A horizontal line. The sequence &quot;---&quot; deverá começar no inicio de uma linha!</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<hr width="200">
    </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>* First list item<br>
    ** A subitem
    <br>
      * Second list item with some longer text<br>
      * Third list item<nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>By placing an asterisc or
      bullet list symbol at the beginning of a line you can create lists.</p>
    </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>First list item
        <ul>
          <li>A subitem </li>
        </ul>
      </li>
      <li>Second list item with some longer text</li>
      <li>Third list item<nobr></nobr></li>
    </ul>
  </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>You
      can place several lines of text into a single list item by placing two
      spaces at the beginning of the line - like in:</p>
      <p class="codeExample">* First item<br>
&nbsp;&nbsp;This is all part of the first list item.<br>
      * Second item<br>
      ...</p>
    </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
      <li>First item<br>
        This is all text of the first list item.      </li>
      <li>Second item<nobr></nobr></li>
      </ul>
  </td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p><nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>And you can also combine
      different formatting commands - e.g.:</p>
    <p class="codeExample">* &lt;BOLD First item&gt;<br>
&nbsp;&nbsp;This is all part of the first list item.<br>
  * Second item<br>
  ...</p></td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><ul>
    <li><strong>First item</strong><br>
    This is all text of the first list item. </li>
    <li>Second item<nobr></nobr></li>
  </ul></td>
</tr>
<tr bgcolor="#FFFFFF">
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>+ First list item<br>
      ++ A subitem <br>
      + Second list item with a quite long text<br>
      + Third list item<nobr></nobr></p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><p>By using a &quot;+&quot; (plus) instead of the asterisk, an ordered (numbered) list is created.</p></td>
  <td align="left" valign="top" bgcolor="#EEEEEE"><ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
      <li>First list item
          <ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
            <li>A subitem</li>
          </ol>
      </li>
      <li>Second list item with a quite long text</li>
      <li>Third list item<nobr></nobr></li>
  </ol></td>
</tr>
<tr>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>aaa | bbb | ccc<br>
      111 | 222 | 333<nobr></nobr></p>
  </td>
  <td align="left" valign="top" bgcolor="#FFFFFF"><p>By using the &quot;|&quot; symbol
      you can create simple tables. The &quot;|&quot; serves as the column delimiter.</p>
    <p>The look of the table is  defined by the web designer who created your
      website.</p>
    </td>
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
    </table>
  </td>
</tr>
</table></p>
	</div>
	<h3>&nbsp;</h3>
	<h3>Uso</h3>
	<p>Insira o seu texto no campo respectivo e clique&quot;save&quot;.</p>
	<p>A janela de edição irá fechar depois do SAVE e o texto alterado irá apareçer na página.<br><span class="remark">Nalguns casos terá de clicar em&quot;Reload Page&quot; No seu web browser.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Close Window</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
