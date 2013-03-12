<h1><?php echo sLS("Nächste Veranstaltung", "Next event") ?>:</h1>
<div class="divider"></div>
<h2><?php webyep_shortText(sWYLS('Veranstaltungstitel', 'EventTitle'), false); ?></h2>
<p><strong><?php echo sLS('Wann', 'When') ?>:</strong><br /><?php webyep_shortText(sWYLS('Wann', 'When'), false); ?></p>
<p><strong><?php echo sLS('Wo', 'Where') ?>:</strong><br /><?php webyep_shortText(sWYLS('Wo', 'Where'), false); ?></p>
<!--
<h2>„Tag der offenen Tür“</h2>
<p><strong>Wann: </strong>15.10.2010, 14.00–20.00 Uhr</p>
<p><strong>Wo: </strong>Therapiezentrum „Leben in Balance“</p>
-->
<div class="divider"></div>
<a href="events.php">»»» <?php echo sLS('Weitere Termine', 'More events') ?></a>
