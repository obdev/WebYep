<!-- Attachment: ========================================= -->
<?php	if (webyep_sShortTextContent("DateianhangBeschreibung$sFieldPostfix", false) || webyep_bIsEditMode()) { ?>
<p class="WebYepAttachment"><span class="WebYepAttachmentDescription"><?php webyep_shortText("DateianhangBeschreibung$sFieldPostfix", false); ?> </span><span class="WebYepAttachmentFilename"><?php webyep_attachment("Dateianhang$sFieldPostfix"); ?></span></p>
<?php } ?>