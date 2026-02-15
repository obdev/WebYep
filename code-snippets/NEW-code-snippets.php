<!-- //////////   NEW CODE  /////////// -->


<!-- INIT CODE -->
<?php session_start(); // WebYep init WebYepV2
/* ><table><tr><td bgcolor=white><h2>WebYep message: Error, PHP inactive</h2>
<font color=red>The PHP code in this page can not be executed!<ul>
<li>Are you launching this page directly form your harddisc <em>(e.g. via a local browser" instead of accessing it via a webserver?)</em></li>
<li>Has this file the correct file extension for PHP scripts? WebYep pages must have the ".php" extension and <b>not</b> ".html" or ".htm"!</li>
</ul></font></td></tr></table><!--
*/
$webyep_sIncludePath = "./";
$iDepth = 0;
while (!file_exists($webyep_sIncludePath . "webyep-system")) {
	$iDepth++;
	if ($iDepth > 10) {
		error_log("webyep-system folder not found!", 0);
		echo "<html><head><title>WebYep</title></head><body><b>WebYep:</b> This page can not be displayed <br>Problem: The webyep-system folder was not found!</body></html>";
		exit;
	}
	$webyep_sIncludePath = ($webyep_sIncludePath == "./") ? ("../"):("$webyep_sIncludePath../");
}
if (file_exists("${webyep_sIncludePath}webyep-system/programm")) $webyep_sIncludePath .= "webyep-system/programm";
else $webyep_sIncludePath .= "webyep-system/program";
include("$webyep_sIncludePath/webyep.php");
// -->?>




<!-- //////////////  ADD After <body> tag   /////////////// -->

<?php unset($_SESSION["loopid"]); ?>




<!-- //////////////  ELEMENTS   /////////////// -->


<!-- SHORT CODE -->
<?php webyep_shortText("short", false, 550, 240); // WebYepV2 ?>

<!-- LONG CODE -->
<?php webyep_longText("long", false, "", true, 600, 400); // WebYepV2 ?>

<!-- RICH CODE -->
<?php webyep_richText("rich", false, "", true, 900, 600); // WebYepV2 ?>

<!-- MARKUP CODE -->
<?php webyep_markupText("markup", false, "", false, true, 600, 400); // WebYepV3 ?>

<!-- READMORE CODE -->
<?php webyep_readMore("read", "Read More", "readmorepage.php", "_self", 550, 240); // WebYepV2 ?>

<!-- IMAGE CODE -->
<?php webyep_image("image", false, 'class="myclass"', 'http://www.apple.com', '_self', 900, 600, true, 900, 600, 600, 270); // WebYepV2 ?>

<!-- GALLERY CODE -->
<?php webyep_gallery("gallery", false, 35, 35, 30, 900, 600, 35, 600, 400); // WebYepV2 ?>

<!-- ATTACHEMENT CODE -->
<?php webyep_attachment("attachment", false, "images/artwork-highlighter.png", 550, 240); // WebYepV2 ?>
	
<!-- AUDIO CODE -->
<?php webyep_audio("audio files", "", '', '', 230, 650); // WebYepV3 ?>




<!-- ////////////// LOGON  /////////////// -->
	
<!-- LOGON CODE -->
<?php webyep_logonButton(true); // WebYepV1-2 ?>





<!-- ////////////// MENU  /////////////// -->
	
<!-- MENU CODE -->
<?php webyep_menu("menu", false, "index.php", "_self", "", "", 650, 530); // WebYepV2 ?>
	




<!-- //////////////  LOOPS   /////////////// -->

<!-- LOOPSTART CODE -->
<?php foreach ((new WYLoopElement())->aLoopIDs("LoopStart-1") as $webyep_oCurrentLoop->iLoopID) { $loopid=$webyep_oCurrentLoop->iLoopID; $_SESSION["loopid"]=$loopid; $webyep_oCurrentLoop->loopStart(true,$webyep_oCurrentLoop->iLoopID); // WebYepV2 ?>



<!-- LOOPEND CODE -->
<?php $webyep_oCurrentLoop->loopEnd(); } unset($_SESSION["loopid"]); // WebYepV2 ?>


	




<!-- //////////////  DUPLICATE LOOPS   /////////////// -->

<!-- DUPLICATE LOOPSTART CODE -->
<?php $oOldDocument = $goApp->oDocument; $goApp->oDocument = new WYDocument(new WYURL("http://www.mywebsite/dupliacte-loop.php")); $goApp->oDocument->setDocumentInstance(0); ?>
<?php foreach ((new WYLoopElement())->aLoopIDs("LoopStart-1-Duplicate") as $webyep_oCurrentLoop->iLoopID) { $loopid=$webyep_oCurrentLoop->iLoopID; $_SESSION["loopid"]=$loopid; $webyep_oCurrentLoop->loopStart(true,$webyep_oCurrentLoop->iLoopID); // WebYepV2 ?>



<!-- DUPLIACTE LOOPEND CODE -->
<?php $webyep_oCurrentLoop->loopEnd(); } unset($_SESSION["loopid"]); // WebYepV2 ?><?php $goApp->oDocument = $oOldDocument; ?>







<!-- SEPERATE LOOPBUTTONS CODE -->
<?php $webyep_oCurrentLoop->showEditButtons($webyep_oCurrentLoop->iLoopID); // WebYepV2 ?>






<!-- //////////////  GUEST BOOK / COMMENTS   /////////////// -->

<!-- GUESTBOOK CODE -->
<?php webyep_guestbook("TheGuestbook", 200, "example@nowheremail.com", true); // WebYepV3 ?>

<!-- REVIEW THE * webyep-guestbook-example.php * AS A GUIDE FOR THE COMPLETE ACTION -->




