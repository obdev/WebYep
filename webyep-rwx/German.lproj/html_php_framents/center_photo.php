<?php
	if (webyep_bCheckImage("FotoZentriert$sFieldPostfix", $iCenterPhotoWidth, $sWidthCSS) || webyep_bIsEditMode()) {
?>
<!-- Center Photo: ======================================= -->
<?php
   printf('<div style="text-align: center;" class="WebYepCenterPhoto"><div style="margin-left: auto; margin-right: auto; padding-top: %dpx; %s"><div>', $iCenterPhotoPadding, $sWidthCSS);
   webyep_image("FotoZentriert$sFieldPostfix", false, "", "", "", $iCenterPhotoWidth, 0, ##CenterPhotoIsThumb##);
   echo "</div>";
	if (webyep_sShortTextContent("FotoZentriertBildtext$sFieldPostfix", false) || webyep_bIsEditMode()) {
?><div style="padding-top: 4px; text-align: center;"><?php webyep_shortText("FotoZentriertBildtext$sFieldPostfix", false); ?></div><?php } echo "</div></div>"; } ?>
