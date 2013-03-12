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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../styles.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Rich
      Text with RTE Editor</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>Using the <strong>RTE</strong> WYSIWYG HTML Editor extension to the <?php echo $webyep_sProductName?> Rich Text field you can create HTML formatted content without needing to enter the HTML code by hand.</p>
<p>The <strong>RTE</strong> editor's capabilities might vary, depending on which web browser you are using.</p>
<p>Please note that copy/pasting in formatted code from a word processing or page layout application might not work as expected, as the conversion of formatted content to HTML is limited.</p>
<h3>Usage</h3>
<p>Enter the desired text, use the editors buttons to format the text and click the
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
