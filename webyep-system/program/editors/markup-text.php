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
      // $oEditorsFolder->addComponent("rich-text-iphone.php");
	  $oEditorsFolder->addComponent("markup-text-plain.php");
      include_once($oEditorsFolder->sPath);
   }
else {
	$oEditorsFolder->addComponent("markup-text-plain.php");
	include_once($oEditorsFolder->sPath);
}

?>