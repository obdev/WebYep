<?php
	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "../..";
	include_once("$webyep_sIncludePath/webyep.php");
?>
<!DOCTYPE html SYSTEM>
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

<body class="onlineHelp">
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span><br>
<img src="../../images/nix.gif" width="8" height="8" alt="" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top"><h1><?php echo $webyep_sProductName?> Help: Menu</h1></td>
    <td align="right" valign="top"><img src="../../images/logo.gif" align="top" border="0" alt="" /><img src="../../images/nix.gif" width="8" height="8" align="top" alt="" /></td>
</tr>
</table>
<div><img src="../../images/nix.gif" width="8" height="10" alt="" /></div>
<h3>Description</h3>
<p>The &quot;Edit Menu&quot; window is used to add/remove menu items and change their order and/or properties.<br>
The editor supports drag and drop, i.e. you can use the mouse to rearrange the menu items.</p>
<p>Please remind that all changes are not applied to the page <strong>until you click the &quot;Save&quot;</strong> [12] button but <strong>then can not be undone!</strong></p>
<table border="0" cellspacing="0" cellpadding="0" class="description">
  <tr>
    <td><strong>A brief description of the user interface:</strong>
      <ol>
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
      </ol>
    </td>
    <td>
      <p align="center"><img src="./images/menu-editor-detail.png" width="495" height="434" alt="" /><br>
      <span class="picturetext">The Edit Menu window in detail</span></p>
    </td>
  </tr>
</table>


<h3>Usage</h3>

<p>When you click an entry in the main view [2], the details for this entry are shown in the input fields to the right [3,4,5]. The current entry will be highlighted in the main view [2] and all actions will refer to this entry.</p>

<h4>Add menu item</h4>
<p>To add a menu item, click the 'Add Menu Entry' [7], or 'Add Submenu Entry' [8] button. A new menu item will be inserted below the current item. This new item will be selected and can be edited now.</p>

<h4>Change menu item</h4>
<p>Select the item you want to change in the list [2] and enter the new text into the text field [3].</p>

<h4>Delete menu item</h4>
<p>Select the item you want to delete and then click the 'remove' button [9]. A confirmation panel will appear (&quot;Really remove item...?&quot;) - click &quot;yes&quot; to delete the item and all it's subitems.<br>
Note that the item will not really be deleted until you safe the menu by clicking the &quot;Save&quot; button. [12]</p>

<h4>Reorder menu items</h4>
<p>The easiest way to move a menu entry is to use the mouse to drag it to the desired position.</p>
<p>This might not work if you use a really old browser. In this case, select an item and click the arrow buttons [6] to move it.</p>

<h4>Hiding menu items</h4>
<p>All menu entries are visible by default. If you want to hide one or more of them, without actually deleting them (and therefore all subitems as well), you can uncheck 'Visible' [5]. If this entry has subentries, they all will be hidden, even when 'Visible' [5] was not unchecked for them. Hidden entries still exist in the menu, but will be displayed in grey and won't be visible on the website.</p>
<p>You can also fold big submenues in the editor by clicking the minus symbol on a submenu title. This is for your convenience only and won't change anythin on the website.</p>

<h4>Indent menu item (create submenu item)</h4>
<p>There are various ways to create submenues:</p>
<ol>
  <li>Indent an existing entry with the arrow buttons [6]</li>
  <li>Indent an entry by dragging it with the mouse</li>
  <li>Add a new submenu item [8]</li>
</ol>

<!-- Assigning URLs to menu items </h4> do not let normal users know that - only describe it in developer docu -->

<p><b>Saving</b></p>
<p>After making you changes click the &quot;Save&quot; button [12]. This will make all your changes permanent and close the editor window. After that, the changed menu
  will be displayed in your web page.<br>
  <span class="remark">In some rare cases you might need to klick the &quot;Reload Page&quot; button of you web browser.</span></p>
<span class="textButton">&lt;<a href="javascript:window.close();">close window</a>&gt;</span>
<hr>
<span class="remark"><?php echo $webyep_sCopyrightLine?></span>
</body>
</html>
