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
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Help: Gallery</h1>
	<h3>Description</h3>
	<p>With the &quot;Edit Gallery Image Window&quot; you can add images<em> (like fotos or graphics)</em> to your image gallery.</p>
	<p><strong>Important:<br></strong>The image must be stored in an &quot;internet usable&quot; format - which means:</p>
	<ul>
		<li>The image file should be small<em> (max. 100-150 kBytes)</em> and the image should have small dimensions (width and height should not exceed 200-300 pixels).</li>
		<li>The image file format should be one supported by common web browsers (GIF or JPEG).</li>
	</ul>
	<p>The system will automatically create a thumbnail for the uploaded image and will resize the uploaded image, if it exceeds the maximum width or hight defined by the web designer.<br>Some servers do not allow the resizing of images <em>(have no GD extension installed)</em> - a warning will be displayed in the Edit Gallery Image Window then.</p>
	<h3>Usage</h3>
	<p><strong>Change/Add Image:<br></strong>Click the <strong>&quot;Browse...&quot; </strong>button to choose the image file you want to insert <em>(upload)</em> into your page. Select the image file in the appearing file selection dialog and click <strong>&quot;OK&quot;</strong> or <strong>&quot;Open&quot;</strong>.</p>
	<p>Enter some image caption - a short decription of the image that will be displayed below the image in the page and also as a hint (tooltip) when the user hovers over the image.</p>
	<p>Then click <strong>&quot;Save&quot;</strong> to start uploading the image file.</p>
	<p><strong>Remark: </strong><br>Transferring the image file from your computer to the web server (where your website resides) can take some time, depending in your internet connection speed.</p>
	<p>When the upload is finished the editor window will close and the changed page will be displayed.<br>In some rare cases you might need to klick the <strong>&quot;Reload Page&quot;</strong> button of you web browser.</p>
	<p><strong>Just change the caption</strong>:<br>You can also just change the caption of an image: Just do not click the <strong>&quot;Browse...&quot;</strong> button to select another image.</p>
	<p>The editor window will close after saving and the changed text will appear in you web page.<br><span class="remark">In some rare cases you may need to click the &quot;Reload Page&quot; button of your web browser.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Close Window</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
