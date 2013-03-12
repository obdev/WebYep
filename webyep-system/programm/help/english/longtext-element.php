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
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Long
      Text</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>You can use a <?php echo $webyep_sProductName?> Long Text field to enter text with simple formatting
  (like bold text or lists). When entering text you should keep the following
  in mind:</p>
<ul>
<li><?php echo $webyep_sProductName?> isn't Word&reg;! A text created in a word processing application like
  Microsoft&#153; Word&reg; can not be transferred to a <?php echo $webyep_sProductName?> Long Text field
  with all formatting, font attributes, lists, tables, etc.</li>
<li>What you can do, is to use simple special character sequences to create e.g.
  bold text, links or lists.</li>
<li>You can transfer your text written in Word&reg; with copy/paste - this will
  only transfer the &quot;content&quot;, not the formatting.</li>
<li>So it's best to type your text in some word processor (without formatting),
  then transfer  into the <?php echo $webyep_sProductName?> text field via copy/paste and then do the desired
  formatting with the <?php echo $webyep_sProductName?> special character sequences.</li>
</ul>
<p>Some parts of your text will be formatted automatically - like links and e-mail
  addresses:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
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
      
<p>The text &quot;http://www.test.com&quot; formatted as a link to this URL -
  a new browser window will be opened when clicking the link!</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="http://www.test.com" target="_blank" class="externalLink">http://www.test.com</a><br>
  <span class="remark">(the visual appearance of links in your website might
  vary!)</span></p>
</td>
</tr>
  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>test@company.com</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>The text &quot;test@firma.com&quot; formatted as a mailto link to the given
  e-mail address.</p>
</td>
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p><a href="mailto:test@firma.com" class="externalLink">test@firma.com</a><br>
  <span class="remark">(the visual appearance of links in your website might
  vary!)</span></p>
</td>
</tr>
  
  
  
  
</table>
<p>More formatting can be done by using these formatting tags:</p>
<table width="98%" border="0" cellspacing="0" cellpadding="6">
  
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
      
<p>The text &quot;To some other page&quot; formatted as a link to <i>otherpage.php</i> 
        - no new browser window will be opened when clicking the link!
        You can also use full URLs (including the &quot;http://...&quot; part)
        instead of just the file name (otherpage.php).</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
      
<p><a href="javascript:alert('This link would lead to some other page of your website.');" class="externalLink">To
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
      
<p>The text &quot;Some text with special formatting&quot; in a style defined
  by the webdesigner. Which styles with which names (&quot;<nobr>SPECIAL</nobr>&quot;) are
  available, is defined by the web designer who created your website.</p>
</td>
<td align="left" valign="top" bgcolor="#FFFFFF"> 
<p><font face="Courier New, Courier, mono" color="#009933">Some text with special
    formatting</font> </p>
</td>
</tr>
  

  
<tr> 
    
<td align="left" valign="top" bgcolor="#EEEEEE"> 
      
<p>---</p>
</td>
    <td align="left" valign="top" bgcolor="#EEEEEE"> 
      <p>A horizontal line. The sequence &quot;---&quot; must start at the very beginning
        of a line!</p>
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
<tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\&lt;</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">As the character &quot;&lt;&quot; is used for formatting purposes, it needs to be preceded by the character &quot;\&quot; (the backslash) to be inserted <em>as is</em>.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">&lt;</td>
<tr>
</tr>
  <td align="left" valign="top" bgcolor="#FFFFFF">\&gt;</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">For &quot;&gt;&quot; the same is true as for &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#FFFFFF">&gt;</td>
</tr>
</tr>
  <td align="left" valign="top" bgcolor="#EEEEEE">\|</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">For &quot;|&quot; the same is true as for &quot;&lt;&quot;.</td>
  <td align="left" valign="top" bgcolor="#EEEEEE">|</td>
</tr>
</table>
<h3>Usage</h3>
<p>Enter the desired text (including some formatting sequences) and click the
  &quot;Save&quot; button.</p>
<p>The editor window will close after saving and the changed text will appear
  in you web page.<br>
    <span class="remark">In some rare cases you might need to klick the &quot;Reload
    Page&quot; button of you web browser.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
