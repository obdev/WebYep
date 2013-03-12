<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>
<div id="mainContent">

<?php if($gsLang == "de") { ?>

<h1>Unser Team</h1>

Erfahrene ÄrztInnen, TherapeutInnen und TrainerInnen betreuen Sie bei „Leben in Balance“. 

<?php } else { ?>

<h1>Our Team</h1>

<p>At „Live in Balance“ you in the hands of experienced medics, therapists and coaches.</p>

<?php } ?>

<p>Magna commy nosto dolore dipsusc ilisci blaore facipis nonse ming eugiam augiam eugue min ulla conum etuerci blandit ex estio eliqui te faccumsandip essent vel duis auguercidunt lor suscin vulla adit alis esequipit, susto euissi.</p>

<p>Se vullamet landre modiat inci eummy niamcore te dignit ullamco mmodoluptat acing er sumsan hent eugiamet ipisse tatin volorting exer sustrud ea faccum dolorem vel ulputpat, commod ming eu facin ex ero odolorper ad te magna feu faci et ipit acil essit, con euissi.</p>

</div>
<div id="sidebarRight">
    <?php echo sIMG('/photos/about_team.jpg', '') ?>
</div>
<?php
include_once("../footer.inc.php");
?>
