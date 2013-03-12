<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = ".";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/panels.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="HeadPHPCode" -->
<?php
?>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="doctitle" -->
<title>WebYep Logon</title>
<!-- InstanceEndEditable --><?php echo $goApp->sCharsetMetatag(); ?>
<link href="styles.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="5" topmargin="5" marginwidth="5" marginheight="5"<?php if (isset($sOnLoadScript) && $sOnLoadScript) echo " onLoad='$sOnLoadScript'"; ?>>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><h1><!-- InstanceBeginEditable name="headline" -->WebYep
              Logon<!-- InstanceEndEditable --></h1></td>
        <td align="right"><img src="images/logo.gif"></td>
      </tr>
    </table>
    <hr noshade size="1"></td>
  </tr>
  <tr>
    <td>  <!-- InstanceBeginEditable name="content" -->
	 <h1>WebYep</h1>
	 <h2>The shiny, tiny Web Content Management System</h2>
	 <p><a href="<?php WYTSD("WebYepProductURL"); ?>">WebYep</a> is a compact Web
	   Content Management System, making editable Websites extremely easy to create
	   and maintain. Different to bigger WebCMS tools, WebYep offers a low priced
	   alternative for small Websites. WebYep is ideal for WebDesigners that
	    don't want to dive into the deep waters of server side scripting with
	   PHP, but just want to create a view editable web pages with a simple to
	   use tool.</p>
	 <p class="warning">To edit these pages with WebYep you need to <strong>enable JavaScript</strong> in your Web
	   Browser!</p>
	 <!-- InstanceEndEditable --></td></tr>
</table>
</body>
<!-- InstanceEnd --></html>
