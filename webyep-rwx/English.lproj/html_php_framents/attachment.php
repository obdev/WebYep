<!-- Attachment: ========================================= -->
<?php if (webyep_sShortTextContent("AttachmentDescription$sFieldPostfix", false) || webyep_bIsEditMode()) { ?>
<p class="WebYepAttachment"><span class="WebYepAttachmentDescription"><?php webyep_shortText("AttachmentDescription$sFieldPostfix", false); ?> </span><span class="WebYepAttachmentFilename"><?php webyep_attachment("AttachedFile$sFieldPostfix"); ?></span></p>
<?php } ?>