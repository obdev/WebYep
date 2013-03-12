<?php
	if (webyep_bCheckImage("CenterPhoto$sFieldPostfix", $iCenterPhotoWidth, $sWidthCSS) || webyep_bIsEditMode()) {
?>
<!-- Center Photo: ======================================= -->
<?php
   printf('<div style="text-align: center;" class="WebYepCenterPhoto"><div style="margin-left: auto; margin-right: auto; padding-top: %dpx; %s"><div>', $iCenterPhotoPadding, $sWidthCSS);
   webyep_image("CenterPhoto$sFieldPostfix", false, "", "", "", $iCenterPhotoWidth, 0, ##CenterPhotoIsThumb##);
   echo "</div>";
	if (webyep_sShortTextContent("CenterPhotoCaption$sFieldPostfix", false) || webyep_bIsEditMode()) {
?><div style="padding-top: 4px; text-align: center;"><?php webyep_shortText("CenterPhotoCaption$sFieldPostfix", false); ?></div><?php } echo "</div></div>"; } ?>
