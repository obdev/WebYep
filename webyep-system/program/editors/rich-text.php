<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

   $oEditorsFolder = od_clone($goApp->oProgramPath);
   $oEditorsFolder->addComponent("editors");

   if ($goApp->bIsiPhone) {
      $oEditorsFolder->addComponent("rich-text-iphone.php");
      include_once($oEditorsFolder->sPath);
   }

   $oP = od_clone($goApp->oProgramPath);
   $oP->addComponent("opt");
   $oP->addComponent("redactor");
   
   
   if ($oP->bExists() && basename($oP->sPath) == 'redactor') {
      $oEditorsFolder->addComponent("rich-text-redactor.php");
	   include_once($oEditorsFolder->sPath);
   }
   else {
      unset($oP);
      $oP = od_clone($goApp->oProgramPath);
      $oP->addComponent("opt");
      $oP->addComponent("redactor");
      if ($oP->bExists()) {
         $oEditorsFolder->addComponent("rich-text-redactor.php");       
         include_once($oEditorsFolder->sPath);
      }
	  // else {
	  // 		  unset($oP);
	  // 		  $oP = od_clone($goApp->oProgramPath);
	  // 		  $oP->addComponent("opt");
	  // 		  $oP->addComponent("rte");
	  // 		  if ($oP->bExists()) {
	  // 			 $oEditorsFolder->addComponent("rich-text-rte.php");
	  // 			 include_once($oEditorsFolder->sPath);
	  // 		  }
		  else {
		  			  unset($oP);
		  			  $oP = od_clone($goApp->oProgramPath);
		  			  $oP->addComponent("opt");
		  			  $oP->addComponent("fckeditor");
		  			  if ($oP->bExists()) {
		  				 $oEditorsFolder->addComponent("rich-text-fckeditor.php");
		  				 include_once($oEditorsFolder->sPath);
		  			  }
			  else {
				  unset($oP);
				  $oP = od_clone($goApp->oProgramPath);
				  $oP->addComponent("opt");
				  $oP->addComponent("tinymce");
				  if ($oP->bExists()) {
					 $oEditorsFolder->addComponent("rich-text-tinymce.php");
					 include_once($oEditorsFolder->sPath);
				  }
				 else {
						unset($oP);
						$oP = od_clone($goApp->oProgramPath);
						$oP->addComponent("opt");
						$oP->addComponent("ckeditor");
						if ($oP->bExists()) {
							$oEditorsFolder->addComponent("rich-text-ckeditor.php");
							include_once($oEditorsFolder->sPath);
						}
						else {
							$oEditorsFolder->addComponent("rich-text-plain.php");
							include_once($oEditorsFolder->sPath);
						}
			 }
		  }
	  }
   }

?>
