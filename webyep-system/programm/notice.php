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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/panels.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="HeadPHPCode" -->
<?php
?>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="doctitle" -->
<title><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?></title>
<!-- InstanceEndEditable --><?php echo $goApp->sCharsetMetatag(); ?>
<link href="styles.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="5" topmargin="5" marginwidth="5" marginheight="5"<?php if (isset($sOnLoadScript) && $sOnLoadScript) echo " onLoad='$sOnLoadScript'"; ?>>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><h1><!-- InstanceBeginEditable name="headline" --><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?><!-- InstanceEndEditable --></h1></td>
        <td align="right"><img src="images/logo.gif"></td>
      </tr>
    </table>
    <hr noshade size="1"></td>
  </tr>
  <tr>
    <td>  <!-- InstanceBeginEditable name="content" -->
<h2><?php echo $sTitle; ?></h2>
<p><?php echo $sMessage; ?></p>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td width="50%" align="left" valign="top"><span class="textButton">&lt;<a href="javascript:window.close();"><?php WYTSD("CloseWindow", true); ?></a>&gt;</span></td><td width="50%" align="right" valign="top"><?php if ($sHelpFile) echo $goApp->sHelpLink($sHelpFile); ?></td></tr>
</table>
<script type="text/javascript">
	setInterval("window.focus()", 2000);
</script>
<!-- InstanceEndEditable --></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
