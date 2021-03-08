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
.numbered-list { line-height:1.25 }
.remark { font-size:10px }
.textButton { text-transform:capitalize; font-variant:normal }
#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:24px }
#menuguide { width:48.9%; float:right; padding:5px; margin-left:20px; margin-bottom:20px; border:solid #a5a5a5 1px }
#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
-->
</style>
<!--[if lt IE 9]>
<script src="../resources/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<div id="PageDiv">
	<h1> <?php echo $webyep_sProductName?> Help: Menu</h1>
	<h3><img id="menuguide" src="../resources/menu-guide.png" alt="menuguide">Description</h3>
	<p>The &quot;Edit Menu&quot; window is used to add/remove menu items and change their order and/or properties. The editor supports drag and drop, i.e. you can use the mouse to rearrange the menu items.</p>
	<p>Please remind that all changes are Not applied to the page <strong>until you click the &quot;Save&quot;</strong>button but <strong>then can not be undone</strong>!</p>
	<h3>A brief description of the user interface:</h3>
	<ol class="numbered-list">
		<li>Field name for this menu</li>
		<li>Main view: the complete menu is displayed here</li>
		<li>Input field 'Menu title': this text is displayed to visitors of your website</li>
		<li>Optional input field 'Link': you may enter the address of another page or site here</li>
		<li>Checkbox to control visibility of the menu entry (and all it's descendants)</li>
		<li>Arrow buttons to move an entry</li>
		<li>Add menu entry (same level as current entry)</li>
		<li>Add submenu entry (subitem of the current entry)</li>
		<li>Delete current menu item (and all subitems)</li>
		<li>Online help for editors (this page)</li>
		<li>Cancel button: discards all changes and closes the window</li>
		<li>Save button: permanently saves all changes and closes the window</li>
		<li>Checkbox to a create a standard url by adding a page instance of &quot;0&quot;</li>
	</ol>
	<p>The editor window will close after saving and the changed text will appear in you web page.<br><span class="remark">In some rare cases you may need to click the &quot;Reload Page&quot; button of your web browser.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">stäng fönstret</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
