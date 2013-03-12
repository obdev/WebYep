<?php

include_once("../main.inc.php");

$sPageTitle = sLS("Leben in Balance", "Life in Balance");

?>
<?php
include_once("../header.inc.php");
?>

<div id="mainContent" class="noSubMenu">
<h1><?php echo sLS("Impressum", "Legal Notice") ?></h1>

<p><?php webyep_longText(sWYLS(sLS("Adresse DE", "Adresse EN"), sLS("Address DE", "Address EN")), true, "", true); ?></p>
<hr>

<?php if($gsLang == "de") { ?>

<p>Konzept und Grafik: Hilde Matouschek | <a href="http://www.officina.at" target="_blank">www.officina.at</a></p>
<p>Bilder: Hilde Matouschek (officina); Robert P. Mobley Jr., Alfred Wekelo, Pippa West, Vitalii Gubin, Yuri Arcurs, Mitarart, Dmitry Koksharov (alle: Fotolia.de)</p>
<p><strong>Hinweis:</strong> „Leben in Balance“ ist ein fiktives Projekt zur Demonstration des webbasierenden Content-Management-Systems WebYep! der Objective Development Software GmbH.</p>

<?php } else { ?>

<p>Concept and design: Hilde Matouschek | <a href="http://www.officina.at" target="_blank">www.officina.at</a></p>
<p>Fotos: Hilde Matouschek (officina); Robert P. Mobley Jr., Alfred Wekelo, Pippa West, Vitalii Gubin, Yuri Arcurs, Mitarart, Dmitry Koksharov (all: Fotolia.de)</p>
<p><strong>Notice:</strong> "Life in Balance" is a fictitious project, created to demonstrate the browser based web content management system WebYep! from Objective Development Software GmbH..</p>

<?php } ?>

</div>

<?php
include_once("../footer.inc.php");
?>
