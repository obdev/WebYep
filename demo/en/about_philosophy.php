<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>
<div id="mainContent">

<?php if($gsLang == "de") { ?>
<h1>Unsere Philosophie</h1>

<p>„Der Mensch steht im Mittelpunkt“.</p>

<?php } else { ?>

<h1>Our Philosophy</h1>

<p>„The Human Beeing is the centre of our attention“.</p>

<?php } ?>

<p>Magna commy nosto dolore dipsusc ilisci blaore facipis nonse ming eugiam augiam eugue min ulla conum etuerci blandit ex estio eliqui te faccumsandip essent vel duis auguercidunt lor suscin vulla adit alis esequipit, susto euissi.</p>

<div style="height: 200px"></div>
</div>
<div id="sidebarRight">
    <?php echo sIMG('/photos/about_philosophy.jpg', '') ?>
</div>
<?php
include_once("../footer.inc.php");
?>
