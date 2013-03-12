<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent" class="noSidebar">

<h1><?php echo sLS("Fotos", "Photos"); ?></h1>
<table cellspacing="0" cellpadding="0" border="0">
<?php foreach (WYLoopElement::aLoopIDs(sWYLS("Termine", "Events")) as $webyep_oCurrentLoop->iLoopID) { $webyep_oCurrentLoop->loopStart(false); ?>
<tr>
<td valign="top" colspan=2>
    <div style="height: 1px; padding-top: 20px; margin-top:20px; border-top: 1px solid #C0D445"></div>
</td>
</tr>
<tr>
<td valign="top">
    <div class="loopControls"><?php $webyep_oCurrentLoop->showEditButtons(); ?></div>
    <h2><?php webyep_shortText(sWYLS("Titel", "Title"), false); ?></h2>
	<?php webyep_gallery("PhotoGallery", false, 70, 70, 4, 800, 600, 130); // WebYepV1 ?>
</td>
<?php $webyep_oCurrentLoop->loopEnd(); } ?>
</table>
</div>


<?php
include_once("../footer.inc.php");
?>
