<!-- Gallery: ========================================= -->
<?php
   if (function_exists("webyep_gallery")) webyep_gallery("ImageGallery", false, ##GalleryTNWidth##, ##GalleryTNHeight##, ##GalleryCellsPerRow##, ##GalleryImageWidth##, ##GalleryImageHeight##, ##GalleryCellWidth##);
   else echo "<p style=\"color: red; font-weight: bold\">Please install the current version of the webyep-system folder on this server to use the Image Gallery Element!</p>";
?>