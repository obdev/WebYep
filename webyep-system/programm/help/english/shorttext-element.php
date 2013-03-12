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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Short
      Text</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>A &quot;Short Text&quot; can be any short text element like a headline, product
  name or price and usually consists  of a single line. Contrary to the Long
  Text Element in a Short Text the formatting is fixed by the web designed.</p>
<h3>Usage</h3>
<p>Enter your text into the text field and klick &quot;save&quot;.</p>
<p>The editor window will close after saving and the changed text will appear
  in you web page.<br>
  <span class="remark">In some rare cases you might need to klick the &quot;Reload Page&quot; button 
of you web browser.</span></p>
 <span class="textButton">&lt;<a href="javascript:window.close();">close
window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
