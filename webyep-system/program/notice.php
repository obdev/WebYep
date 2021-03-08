<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

    $webyep_bDocumentPage = false;
    $webyep_sIncludePath = ".";
    include_once("$webyep_sIncludePath/webyep.php");

    $sTKey = $goApp->sFormFieldValue("TITLE");
    $sTitle = WYTS($sTKey);
   $sTitle = str_replace("WebYep", $webyep_sProductName, $sTitle);
    $sMKey = $goApp->sFormFieldValue("MESSAGE");
    $sMessage = WYTS($sMKey);
   $sMessage = str_replace("WebYep", $webyep_sProductName, $sMessage);
    $sHelpFile = $goApp->sFormFieldValue("HELP");
?>
<!DOCTYPE html>
<html>
<!-- InstanceBegin template="/Templates/panels.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<!-- InstanceBeginEditable name="HeadPHPCode" -->
	<?php
	?><!-- InstanceEndEditable -->
	<!-- InstanceBeginEditable name="doctitle" -->
	<title><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?></title><!-- InstanceEndEditable --><?php echo $goApp->sCharsetMetatag(); ?><!-- ><link href="styles.css" rel="stylesheet" type="text/css"> -->
	<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->

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
	a:link { color:#7177bf }
	a:visited { color:#7177bf }
	a:hover { color:#7177bf }
	.textButton a { -webkit-border-radius:2; -moz-border-radius: 2; border-radius: 2px; color: #ffffff; font-size: 13px; background: #7177bf; padding: 9px 14px 9px 14px; color: #ffffff; text-decoration: none; transition: all 0.2s ease-in-out;-webkit-transition: all 0.2s ease-in-out;-moz-transition: all 0.2s ease-in-out;}
	.textButton a:hover { background:#545454; text-decoration: none; }
	.textButton a:visited { color:#ffffff; text-decoration: none; }
	body { font-family:Helvetica,Arial,sans-serif; font-size:12px; line-height:1.5 }
	em { font-style:italic }
	h1 { color:#7177bf; font-weight:bold; font-size:24px; line-height:26px; margin-top:0px; margin-bottom:15px }
	h1:first-child { margin-top:0px }
	h2 { font-weight:bold; font-size:16px; line-height:1; margin-top:8px; margin-bottom:6px }
	h2:first-child { margin-top:15px }
	h3 { font-weight:bold; font-size:14px; line-height:1; margin-top:20px; margin-bottom:6px }
	h3:first-child { margin-top:0px }
	hr { color:#a5a5a5; background-color:#a5a5a5; border:0; width:100%; height:1px }
	strong { font-weight:bold }
	.style3 { color:#7177bf; font-weight:bold }
	.textButton { text-transform:capitalize; font-variant:normal }
	.remark { font-size:10px }
	#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto; padding:30px 24px 24px }
	#textButtonWrap.f-ms { width:214px; min-height:36px; z-index:0; margin-top:30px; margin-right:auto; margin-bottom:15px }
	-->
	</style>
</head>



<body>
	<table border="0" cellpadding="5" cellspacing="0" width="100%" style="padding:20px;">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td align="left" valign="top">
							<h1><!-- InstanceBeginEditable name="headline" --><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?><!-- InstanceEndEditable --></h1>
						</td>
						<td align="right"><img src="images/logo.png"></td>
					</tr>
				</table>
				<hr noshade size="1">
			</td>
		</tr>
		<tr>
			<td>
				<!-- InstanceBeginEditable name="content" -->
				<h2><?php echo $sTitle; ?></h2>
				<p><?php echo $sMessage; ?></p>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
					<tr>
						<td align="left" valign="top" width="50%">
							<span class="textButton">
								<a href="javascript:window.close();">close window</a>
						</span>
				</td>
						<td align="right" valign="top" width="50%"><?php if ($sHelpFile) echo $goApp->sHelpLink($sHelpFile); ?></td>
					</tr>
				</table>
				<script type="text/javascript">
				setInterval("window.focus()", 2000);
				</script> <!-- InstanceEndEditable -->
			</td>
		</tr>
	</table><!-- InstanceEnd -->
</body>
</html>