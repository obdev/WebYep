<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent">
<?php webyep_richText("Text", false, "../tinymce.css"); ?>
<div style="height: 100px"></div>
</div>

<div id="sidebarRight">
    <?php webyep_image(sWYLS("Bild", "Image"), false, '', "", "", 192, 0, false); ?>
    <div class="imageCaption"><?php webyep_longText(sWYLS("Bildtext", "Caption"), false, "", true); ?></div>
</div>

<?php
include_once("../footer.inc.php");
?>
