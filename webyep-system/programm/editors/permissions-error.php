<?php
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?></title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="5" topmargin="5" marginwidth="5" marginheight="5">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><h1><?php echo $webyep_sProductName?> <?php echo WYTS("WebYepNotice");?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table>
    <hr noshade size="1"></td>
  </tr>
  <tr>
    <td>

<h2><?php WYTSD("PermissionErrorTitle") ?></h2>
<p><?php WYTSD("PermissionErrorMessage") ?></p>
<div class="textButton">&lt;<a href="javascript:window.close();"><?php WYTSD("CloseWindow", true); ?></a>&gt;</div>

    </td>
  </tr>
</table>
</body>
</html>
