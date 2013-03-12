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
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Image Gallery</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0"><img src="../../images/nix.gif" width="8" height="8" align="top"></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10"></div>
<h3>Description</h3>
<p>With the &quot;Edit Gallery Image Window&quot; you can add images (like fotos or graphics)
  to your image gallery.</p>
<p><b>Important:</b> The image must be stored in an &quot;internet usable&quot; format
  - which means:</p>
<ul>
  <li>The image file should be small (max. 100-150 kBytes) and the image should
       have small dimensions (width and height should not exceed 200-300 pixels).</li>
  <li>The image file format should be one supported by common web browsers (GIF
    or JPEG).</li>
</ul>
<p>The system will automatically create a thumbnail for the uploaded image and will resize the uploaded image, if it exceeds the maximum width or hight defined by the web designer.</p>
<p>Some servers do not allow the resizing of images (have no GD extension installed) - a warning will be displayed in the Edit Gallery Image Window then.</p>
<h3>Usage</h3>
<p><b>Change/Add Image:</b></p>
<p>Click the &quot;Browse...&quot; button to choose the image file you want to insert (upload)
  into your page. Select the image file in the appearing file selection dialog
  and click &quot;OK&quot; (or &quot;Open&quot;).</p>
<p>Enter some image caption - a short decription of the image that will be displayed below the image in the page and also as a hint (tooltip) when the user hovers over the image.</p>
<p>Then click &quot;Save&quot; to start uploading the image
  file.</p>
<p><i>Remark:</i> Transferring the image file from your computer to the web server
  (where your website resides) can take some time, depending in your internet
  connection speed.</p>
<p>When the upload is finished the editor window will close and the changed
  page will be displayed.<br>
  <span class="remark">In some rare cases you might need to klick the &quot;Reload
  Page&quot; button
of you web browser.</span></p>
<p><b>Just change the caption:</b></p>
<p>You can also just change the caption of an image: Just do <em>not</em> click the &quot;Browse...&quot; button to select another image.</p>
<p class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</p>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
