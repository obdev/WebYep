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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: <?php echo $webyep_sProductName?>
      is not perpared properly!</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<p><?php echo $webyep_sProductName?> can't write any data because the file permissions where not set correctly.</p>
<p>Please contact the web designer who created your web site to &quot;preparee&quot;
  <?php echo $webyep_sProductName?>.</p>
<p>Or see the documentation (&quot;Installation on the web server / Preparing&quot;)
  on how to prepare <?php echo $webyep_sProductName?>.</p>
<p class="remark"><strong>Technical Remark:</strong> The file permissions needed are &quot;read/write/execute&quot; for
  &quot;all&quot; (unix mode 0777) for the folder &quot;data&quot; inside the webyep-system folder.</p>
 <span class="textButton">&lt;<a href="javascript:window.close();">close
window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
