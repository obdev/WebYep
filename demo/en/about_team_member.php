<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>
<div id="sidebarLeft">
    <?php webyep_image(sWYLS("Foto", "Photo"), false, '', "", "", 120, 0, false); ?>
</div>
<div id="mainContent">

<h2><?php webyep_shortText("Name", false); ?></h2>

<table cellpadding="0" cellspacing="0" border="0" id="teamAttributes">
<tr>
    <td class="fieldLabel"><?php echo sLS("Ausbildung", "Education") ?>:</td>
    <td><?php webyep_longText(sWYLS("Ausbildung", "Education"), false, "", true); ?></td>
</tr>
<tr>
    <td class="fieldLabel"><?php echo sLS("Lebenslauf", "Curriculum Vitae") ?>:</td>
    <td><?php webyep_attachment(sWYLS("Lebenslauf", "CV")); ?>&nbsp;<small>&laquo;&laquo;&laquo;&nbsp;<?php echo sLS("zum Herunterladen anlicken", "click to download") ?></small></td>
</tr>
<tr>
    <td class="fieldLabel"><?php echo sLS("Kontakt", "Contact") ?>:</td>
    <td><?php webyep_longText(sWYLS("Kontakt", "Contact"), false, "", true); ?></td>
</tr>
</table>

</div>
<?php
include_once("../footer.inc.php");
?>
