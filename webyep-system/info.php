<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de"> 
   <head> 
   <title>phpinfo()</title>
   <style> 
   * { box-sizing: border-box }
  	#PageDiv { position:relative; min-height:100%; max-width:960px; margin:auto }
   table { margin-left: 0 !important }
   hr { margin-left: 0 !important; width:100% !important }
   body{ width:100% !important; }
   body>div>header>table>tbody>tr>td { border:none !important;font-size:18px; padding:0 0 4px 0; color:gray; font-family:helvetica,roboto,arial;}
   header>h2 { text-align: left !important; margin-top:20px; }
   header  { margin-bottom:30px; }
   table { -webkit-box-shadow: 0 0 0 #fff !important; -moz-box-shadow: 0 0 0 #fff !important; box-shadow:  0 0 0 #fff !important; width:100%; }
   body>div>table>tbody>tr>td { border:none !important; padding-left:0 !important; padding-right:0 !important; }
   h1.p {color:#fff !important;}
   table>tbody>tr>td:nth-child(1) {
      width: 40%;
   }
</style> 
</style> 
   </head> 

<body> 
<div id="PageDiv">
<header>	
<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

$webyep_bDocumentPage = false;
if (file_exists("programm")) $webyep_sIncludePath = "programm";
else $webyep_sIncludePath = "program";
include_once("$webyep_sIncludePath/webyep.php");
include_once(webyep_sConfigValue("webyep_sIncludePath") . "/" . WYTS("info.php"));
?>
</header>
<?php phpinfo(); ?>
</div>

</body> 
</html> 


