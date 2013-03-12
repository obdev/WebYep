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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: File
      Attachment</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>With the &quot;Edit File
      Attachment Window&quot; you can insert file (documents)
  into your website or remove them again.</p>
<h3>Usage</h3>
<p><b>Change File:</b></p>
<p>Click the &quot;Browse...&quot; button to choose the  file you want insert
  (upload) into your page. Select the  file in the appearing file selection
  dialog
  and click &quot;OK&quot; (or &quot;Open&quot;). Then click &quot;Save&quot; to
  start uploading the file.</p>
<p><i>Remark:</i> Transferring the  file from your computer to the web server
  (where your website resides) can take some time, depending in your internet
  connection speed.</p>
<p><b>Delete File:</b></p>
<p>Click the &quot;Delete&quot; button to remove the  from the page and delete
  it from the web server.</p>
<p>After clicking &quot;Save&quot; or &quot;Delete&quot; the editor window will close and the changed
  page will be displayed.<br>
  <span class="remark">In some rare cases you might need to klick the &quot;Reload
  Page&quot; button
of you web browser.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
