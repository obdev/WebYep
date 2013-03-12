<?php
	if (webyep_bCheckImage("RightPhoto$sFieldPostfix", $iRightPhotoWidth, $sWidthCSS) || webyep_bIsEditMode()) {
?>
<!-- Right Photo: ======================================= -->
<?php
   printf('<div style="float: right; margin-left: %dpx; margin-bottom: %dpx;%s" class="WebYepRightPhoto"><div>', $iRightPhotoPadding, $iRightPhotoPadding, $sWidthCSS);
   webyep_image("RightPhoto$sFieldPostfix", false, "", "", "", $iRightPhotoWidth, 0, ##RightPhotoIsThumb##);
   echo "</div>";
	if (webyep_sShortTextContent("RightPhotoCaption$sFieldPostfix", false) || webyep_bIsEditMode()) {
?><div style="padding-top: 4px; text-align: center;"><?php webyep_shortText("RightPhotoCaption$sFieldPostfix", false); ?></div><?php } echo "</div>"; } ?>
