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
	<h3>Description</h3>
	<p>You can use a WebYep Long Text field to enter text with simple formatting (like bold text or lists). When entering text you should keep the following in mind:</p>
	<ul>
		<li>WebYep isn't Word®! A text created in a word processing application like Microsoft™ Word® can not be transferred to a WebYep Long Text field with all formatting, font attributes, lists, tables, etc.</li>
		<li>What you can do, is to use simple special character sequences to create e.g. bold text, links or lists.</li>
		<li>You can transfer your text written in Word® with copy/paste - this will only transfer the &quot;content&quot;, not the formatting.</li>
		<li>So it's best to type your text in some word processor (without formatting), then transfer into the WebYep text field via copy/paste and then do the desired formatting with the WebYep special character sequences.</li>
	</ul>
	<p>Some parts of your text will be formatted automatically - like links and e-mail addresses:</p>
	<div id="table-1"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">when entering </th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?> will display</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">e.g.:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>http://www.test.com</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>The text &quot;http://www.test.com&quot; formatted as a link to this URL - a new browser window will be opened when clicking the link!</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a class="externalLink" href="http://www.test.com" target="_blank">http://www.test.com</a><br>
			<span class="remark">(the visual appearance of links in your website might vary!)</span></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>test@company.com</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>The text &quot;test@firma.com&quot; formatted as a mailto link to the given e-mail address.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><a class="externalLink" href="mailto:test@firma.com">test@firma.com</a><br>
			<span class="remark">(the visual appearance of links in your website might vary!)</span></p>
		</td>
	</tr>
</table></p>
	</div>
	<p><strong>More formatting can be done by using these formatting tags:</strong></p>
	<div id="table-2"><p class="f-fp f-lp"><table border="0" cellpadding="6" cellspacing="0" class="wytable" width="98%">
	<tr>
		<th align="left" style="background-color: #CCCCCC" valign="middle">when entering</th>

		<th align="left" style="background-color: #CCCCCC; font-weight: bold" valign="middle"><?php echo $webyep_sProductName?>will display</th>

		<th align="left" style="background-color: #CCCCCC" valign="middle">e.g.:</th>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;LINK:otherpage.php</nobr> To some other page<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>The text &quot;To some other page&quot; formatted as a link to <i>otherpage.php</i> - no new browser window will be opened when clicking the link! You can also use full URLs (including the &quot;http://...&quot; part) instead of just the file name (otherpage.php).</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><a class="externalLink" href="javascript:alert('This%20link%20would%20lead%20to%20some%20other%20page%20of%20your%20website.');">To some other page</a></p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p><nobr>&lt;BOLD</nobr> Some bold Text<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>The text &quot;Some bold text&quot; formatted in bold.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p style="font-weight: bold">Some bold text</p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr>&lt;SPECIAL</nobr> Some text with special formatting<nobr>&gt;</nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>The text &quot;Some text with special formatting&quot; in a style defined by the webdesigner. Which styles with which names (&quot;<nobr>SPECIAL</nobr>&quot;) are available, is defined by the web designer who created your website.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>Some text with special formatting</p>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>---</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>A horizontal line. The sequence &quot;---&quot; must start at the very beginning of a line!</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<hr width="200">
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>* First list item<br>
			** A subitem<br>
			* Second list item with some longer text<br>
			* Third list item<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>By placing an asterisc or bullet list symbol at the beginning of a line you can create lists.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li>First list item

					<ul>
						<li>A subitem</li>
					</ul>
				</li>

				<li>Second list item with some longer text</li>

				<li>Third list item<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>You can place several lines of text into a single list item by placing two spaces at the beginning of the line - like in:</p>

			<p class="codeExample">* First item<br>
			&nbsp;&nbsp;This is all part of the first list item.<br>
			* Second item<br>
			...</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li>First item<br>
				This is all text of the first list item.</li>

				<li>Second item<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p><nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>And you can also combine different formatting commands - e.g.:</p>

			<p class="codeExample">* &lt;BOLD First item&gt;<br>
			&nbsp;&nbsp;This is all part of the first list item.<br>
			* Second item<br>
			...</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<ul>
				<li><strong>First item</strong><br>
				This is all text of the first list item.</li>

				<li>Second item<nobr></nobr></li>
			</ul>
		</td>
	</tr>

	<tr style="background-color: #FFFFFF">
		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>+ First list item<br>
			++ A subitem<br>
			+ Second list item with a quite long text<br>
			+ Third list item<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<p>By using a &quot;+&quot; (plus) instead of the asterisk, an ordered (numbered) list is created.</p>
		</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">
			<ol style="list-style: upper-roman; margin: 0; margin-left: 30px; padding: 0px">
				<li>First list item

					<ol style="list-style: lower-roman; margin: 0; margin-left: 30px; padding: 0px">
						<li>A subitem</li>
					</ol>
				</li>

				<li>Second list item with a quite long text</li>

				<li>Third list item<nobr></nobr></li>
			</ol>
		</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>aaa | bbb | ccc<br>
			111 | 222 | 333<nobr></nobr></p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<p>By using the &quot;|&quot; symbol you can create simple tables. The &quot;|&quot; serves as the column delimiter.</p>

			<p>The look of the table is defined by the web designer who created your website.</p>
		</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">
			<table border="0" cellpadding="6" cellspacing="0">
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
		<td align="left" style="background-color: #EEEEEE" valign="top">\&lt;</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">As the character &quot;&lt;&quot; is used for formatting purposes, it needs to be preceded by the character &quot;\&quot; (the backslash) to be inserted <em>as is</em>.</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">&lt;</td>
	</tr>

	<tr>
		<td></td>
	</tr>

	<tr>
		<td align="left" style="background-color: #FFFFFF" valign="top">\&gt;</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">For &quot;&gt;&quot; the same is true as for &quot;&lt;&quot;.</td>

		<td align="left" style="background-color: #FFFFFF" valign="top">&gt;</td>
	</tr>

	<tr>
		<td align="left" style="background-color: #EEEEEE" valign="top">\|</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">For &quot;|&quot; the same is true as for &quot;&lt;&quot;.</td>

		<td align="left" style="background-color: #EEEEEE" valign="top">|</td>
	</tr>
</table></p>
	</div>
	<h3>&nbsp;</h3>
	<h3>Usage</h3>
	<p>Enter your text into the text field and click &quot;save&quot;.</p>
	<p>The editor window will close after saving and the changed text will appear in you web page.<br><span class="remark">In some rare cases you may need to click the &quot;Reload Page&quot; button of your web browser.</span></p>
	<div id="textButtonWrap" class="f-ms"><p class="f-fp f-lp"><span class="textButton"><a href="javascript:window.close()%3B">Close Window</a></span></p>
	</div>
	<hr>
	<p class="f-lp"><span class="remark"> <?php echo $webyep_sCopyrightLine?> </span></p>
</div>
</body>
</html>
