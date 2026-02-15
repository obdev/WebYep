<?php

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

   $oEditorsFolder = od_clone($goApp->oProgramPath);
   $oEditorsFolder->addComponent("editors");

   if ($goApp->bIsiPhone) {
      $oEditorsFolder->addComponent("rich-text-iphone.php");
      include_once($oEditorsFolder->sPath);
   }

   // Supported editors.
   $editors = array('ckeditor', 'fckeditor', 'redactor', 'rte', 'tinymce', 'trumbowyg');
   $activeEditor = NULL;
   foreach ($editors as $editor) {
      $oP = od_clone($goApp->oProgramPath);
      $oP->addComponent("opt");
      $oP->addComponent($editor);
      if ($oP->bExists()) {
         $activeEditor = $editor;
         $oEditorsFolder->addComponent("rich-text-{$editor}.php");
         include_once($oEditorsFolder->sPath);
         break;
      }
   }

   // If no active editor, fall back to the plain text editor.
   if (!$activeEditor) {
      $oEditorsFolder->addComponent("rich-text-plain.php");
      include_once($oEditorsFolder->sPath);
   }

?>
