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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Loop</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>With the Loop Element you can repeat parts of a web page. You can change the
  order of the repetitions and also delete them.</p>
<h3>Usage</h3>
<p><b>Add repetition</b></p>
<p>Clicking the &quot;plus&quot; icon in a repetition will add a repetition right <strong>below</strong>  that one.</p>
<p><strong>Move repetition</strong></p>
<p>Clicking the &quot;arrow up&quot;/&quot;arrow down&quot; icons will move a
  repetition up/down (or left/right) - where &quot;up&quot; or &quot;left&quot; means
  towards the beginning of the document and &quot;down&quot;/&quot;right&quot; means
  towards the end.</p>
<p><strong>Delete repetition</strong></p>
<p>Clicking the &quot;trash can&quot; icon in a repetition will delete that repetition.</p>
<blockquote>
  <p><strong>Caution:</strong> This can not be undone!</p>
</blockquote>
<p><b>Saving</b></p>
<p>There's no &quot;Save&quot; button as all changes take effect immediately  and are saved
  instantly!</p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
