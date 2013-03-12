<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent" class="noSidebar">

<h1><?php webyep_shortText(sWYLS("Terminkategorie", "Event Category"), false); ?></h1>
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
    <p><strong><?php echo sLS("Wann", "When") ?>:&nbsp;</strong><?php webyep_shortText(sWYLS("Wann", "When"), false); ?></p>
    <p><strong><?php echo sLS("Wo", "Where") ?>:&nbsp;</strong><?php webyep_longText(sWYLS("Wo", "Where"), false, "", true); ?></p>
    <?php webyep_richText("Text", false, "../tinymce.css"); ?>
    <?php webyep_attachment(sWYLS("Anhang", "Attachment")); ?>
</td>
<td valign="top" style="padding-left: 20px">
    <?php webyep_image(sWYLS("Bild", "Image"), false, 'class="bordered zoomable"', "", "", 192, 0, true); ?>
    <div class="imageCaption"><?php webyep_longText(sWYLS("Bildtext", "Caption"), false, "", true); ?></div>
</td>
</tr>
<?php $webyep_oCurrentLoop->loopEnd(); } ?>
</table>
</div>


<?php
include_once("../footer.inc.php");
?>
