<!-- Text: =============================================== -->
<div class="WebYepText"><?php
   /* check for installed WYSIWYG HTML editor */
   if (file_exists("$webyep_sIncludePath/opt/rte") || file_exists("$webyep_sIncludePath/opt/tinymce") || file_exists("$webyep_sIncludePath/opt/fckeditor") || file_exists("$webyep_sIncludePath/opt/ckeditor")) {
	   webyep_richText("Text$sFieldPostfix", false, "/webyep_text.css", true);
   }
   else {
	   webyep_longText("Text$sFieldPostfix", false, "", true);
   }
?></div>
