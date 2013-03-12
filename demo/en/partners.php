<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent" class="noSubMenu">

<h1><?php echo sLS("Unsere Partner", "Our Partners"); ?></h1>
<div style="height: 20px"></div>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<?php foreach (WYLoopElement::aLoopIDs(sWYLS("Termine", "Events")) as $webyep_oCurrentLoop->iLoopID) { $webyep_oCurrentLoop->loopStart(false); ?>
<tr>
<td valign="top" style="padding-right: 20px" width="1%">
    <?php webyep_image(sWYLS("Logo", "Logo"), false, 'class="bordered"', "", "", 120, 0, false); ?>
</td>
<td valign="top">
    <div class="loopControls"><?php $webyep_oCurrentLoop->showEditButtons(); ?></div>
    <h2><?php webyep_shortText(sWYLS("Titel", "Title"), false); ?></h2>
    <div><?php webyep_longText(sWYLS("Beschreibung", "Description"), false, "", true); ?></div>
</td>
</tr>
<tr>
<td valign="top" colspan=2>
    <div style="height: 1px; padding-top: 20px; margin-top:20px; border-top: 1px solid #C0D445"></div>
</td>
</tr>
<?php $webyep_oCurrentLoop->loopEnd(); } ?>
</table>
</div>

<?php
include_once("../footer.inc.php");
?>
