<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent">

<div><?php webyep_richText("Text", false, "../tinymce.css"); ?></div>
<div><?php webyep_attachment("InfoFolder"); ?></div>

</div>

<div id="sidebarRight">
    <?php echo sIMG('/photos/about.jpg', '') ?>
    <div class="imageCaption"><?php echo sLS("Ein freundliches, modernes Ambiente erwartet Sie.", "A friendly, modern atmosphere welcomes you.") ?></div>
</div>

<?php
include_once("../footer.inc.php");
?>
