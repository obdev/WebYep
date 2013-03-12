<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $sPageTitle ?></title>
<link href="../main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="languageSelector"><?php
    $sURL = basename($_SERVER['PHP_SELF']);
    $sQuery = $_SERVER['QUERY_STRING'];
    if ($sQuery) $sQuery = "?$sQuery";
    $sURL = "../en/$sURL$sQuery";
    $sDEURL = str_replace("/en/", "/de/", $sURL);
    $sENURL = str_replace("/de/", "/en/", $sURL);
    printf('<a href="%s" title="deutsch"><img src="../images/flags_de.gif" border="0"></a>', $sDEURL);
    printf('<a href="%s" title="english"><img src="../images/flags_en.gif" border="0"></a>', $sENURL);
?></div>
<div id="mainContainer">
<div><?php echo sIMG('/images/head_top-de.gif') ?></div>
<div id="menuItemsContainer">
    <div class="menuItem"><?php echo sIMG('/images/head_left.gif') ?></div>
    <div class="menuItem"><?php echo sMenuButton("home") ?></div>
    <div class="menuItem"><?php echo sMenuButton("about") ?></div>
    <div class="menuItem"><?php echo sMenuButton("counseling") ?></div>
    <div class="menuItem"><?php echo sMenuButton("therapies") ?></div>
    <div class="menuItem"><?php echo sMenuButton("events") ?></div>
    <div class="menuItem"><?php echo sMenuButton("partners") ?></div>
    <div class="menuItem"><?php echo sMenuButton("contact") ?></div>
    <div class="menuItem"><?php echo sMenuButton("legal_notice") ?></div>
    <div class="menuItem"><?php echo sIMG('/images/head_right-de.gif') ?></div>
</div>
<div id="contentContainer">

<?php
$sSubNavPath = sCurrentSubNavPath();
if (file_exists($sSubNavPath)) {
?>
<div id="subNavContainer">
<div id="subNav">
<?php  include_once($sSubNavPath); ?>
</div>
<?php echo sIMG('/images/subnav_bottom.gif') ?>
</div>
<?php } ?>
