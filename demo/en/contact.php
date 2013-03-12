<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent" class="noSubMenu">
<h1><?php echo sLS("Kontakt", "Contact") ?></h1>

<p><?php webyep_longText(sWYLS(sLS("Adresse DE", "Adresse EN"), sLS("Address DE", "Address EN")), true, "", true); ?></p>

<p>»»» <?php echo sLS("Plan zum Vergrößern anklicken:", "Click the plan to zoom:"); ?><br />
<?php webyep_image(sWYLS("Plan", "Plan"), false, 'class="bordered"', "", "", 220, 0, true); ?></p>

<p>»»» <?php echo sLS("Anfahrtsplan und Beschreibung als PDF herunterladen:", "Download map and directions:"); ?>&nbsp;
<?php webyep_attachment(sWYLS("Anfahrtsplan", "Directions")); ?></p>

</div>

<?php
include_once("../footer.inc.php");
?>
