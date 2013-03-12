<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent">

<div><?php webyep_richText("Text", false, "../tinymce.css"); ?></div>

</div>

<div id="sidebarRight"><?php echo sIMG('/images/slogan-de.gif', 'style="margin-top: 100px; border: none"') ?></div>

<?php
include_once("../footer.inc.php");
?>
