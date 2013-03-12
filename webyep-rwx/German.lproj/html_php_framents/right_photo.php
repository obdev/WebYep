<?php
	if (webyep_bCheckImage("FotoRechts$sFieldPostfix", $iRightPhotoWidth, $sWidthCSS) || webyep_bIsEditMode()) {
?>
<!-- Right Photo: ======================================= -->
<?php
   printf('<div style="float: right; margin-left: %dpx; margin-bottom: %dpx;%s" class="WebYepRightPhoto"><div>', $iRightPhotoPadding, $iRightPhotoPadding, $sWidthCSS);
   webyep_image("FotoRechts$sFieldPostfix", false, "", "", "", $iRightPhotoWidth, 0, ##LeftPhotoIsThumb##);
   echo "</div>";
	if (webyep_sShortTextContent("FotoRechtsBildtext$sFieldPostfix", false) || webyep_bIsEditMode()) {
?><div style="padding-top: 4px; text-align: center;"><?php webyep_shortText("FotoRechtsBildtext$sFieldPostfix", false); ?></div><?php } echo "</div>"; } ?>
