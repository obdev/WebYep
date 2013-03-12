<!-- Gallery: ========================================= -->
<?php
   if (function_exists("webyep_gallery")) webyep_gallery("Bildergalerie", false, ##GalleryTNWidth##, ##GalleryTNHeight##, ##GalleryCellsPerRow##, ##GalleryImageWidth##, ##GalleryImageHeight##, ##GalleryCellWidth##);
   else echo "<p style=\"color: red; font-weight: bold\">Bitte installieren Sie die aktuelle Version des webyep-system Ordners auf diesem Server um das Bildergalerie-Element zu verwenden!</p>";
?>