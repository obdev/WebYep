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
<title>
WebYep Anmeldung
</title>
<!-- InstanceEndEditable --><?php echo $goApp->sCharsetMetatag(); ?>
<link href="styles.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body leftmargin="5" topmargin="5" marginwidth="5" marginheight="5"<?php if (isset($sOnLoadScript) && $sOnLoadScript) echo " onLoad='$sOnLoadScript'"; ?>>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><h1><!-- InstanceBeginEditable name="headline" -->WebYep Anmeldung<!-- InstanceEndEditable --></h1></td>
        <td align="right"><img src="images/logo.gif"></td>
      </tr>
    </table>
    <hr noshade size="1"></td>
  </tr>
  <tr>
    <td>  <!-- InstanceBeginEditable name="content" -->
	 <h1>WebYep</h1>
	 <h2>Das feine, kleine Web Content Management System</h2>
	 <p><a href="<?php WYTSD("WebYepProductURL"); ?>">WebYep</a> ist ein kompaktes Web Content
	   Management System, mit dem editierbare Web-Seiten besonders einfach erstellt
	   und verwaltet werden k&ouml;nnen. Im Gegensatz zu gr&ouml;&szlig;eren CMS
	   L&ouml;sungen, bietet WebYep eine kosteng&uuml;nstige Alternative f&uuml;r
	   kleinere Anwendungen. WebYep richtet sich vor allem an Anwender ohne PHP
	   oder HTML Kenntnisse, die rasch und unkompliziert editierbare Web Seiten
	   erstellen wollen.</p>
	 <p class="warning">Um mit WebYep Ihre Webseiten bearbeiten zu k&ouml;nnen, m&uuml;ssen
	   Sie in Ihrem Webbrowser <b>JavaScript aktivieren</b>! </p>
	 <!-- InstanceEndEditable --></td></tr>
</table>
</body>
<!-- InstanceEnd --></html>
