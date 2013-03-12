<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

   // Wichtig: In dieser Datei dürfen am Beginn und Ende keine Leerzeilen eingefügt werden!!!
   //          Achten Sie auch darauf, dass diese Datei keinen Unicode Byte Order Marker (BOM) enthält!!!
   // Important: Do not insert ANYTHING before or after the PHP block in this file!!!
   //            Also make sure this file does not contain a Unicode Byte Order Marker (BOM)!!!

	// Nähere Informationen zu den hier möglichen Einstellungen finden Sie in der WebYep Dokumentation
	// Further information on the configuration settings in this file can be found in the WebYep documentation



   // Name und Kennwort für die Anmeldung
	// --
   // Username and password logging in

   $webyep_sAdminName = "admin";
   $webyep_sAdminPassword = "";


	// Multi Login - zusätzliche Logins für einzelne Seiten o. Seitengruppen
	// (entfernen Sie die Doppel-Schrägstriche, um es zu verwenden)
	//	$webyep_aMultiLoginName[] = "einName";
	//	$webyep_aMultiLoginPassword[] = "einKennwort";
	//	$webyep_aMultiLoginURLPatterns[] = "/eineSeite.php /einOrdner/*";

	// Multiple Logins - additional logins for specific pages or groups of pages
	// (remove the double slashes to use it)
	//	$webyep_aMultiLoginName[] = "someUserName";
	//	$webyep_aMultiLoginPassword[] = "somePassword";
	//	$webyep_aMultiLoginURLPatterns[] = "/somePage.php /someFolder/*";


	// Wenn eine Seite editierbare Felder enthält, der/die BenutzerIn aber keine Editier-Rechte hat,
	// können die Editier-Knöpfe inaktiv oder gar nicht angezeigt werden
	// --
	// If a page contains editable fields but the user has insiffucient privileges
	// WebYep can display the edit buttons disable ot not at all

	$webyep_bShowDisabledEditButtons = true;


	// Ob andere BenutzerInnen als der/die Haupt-BenutzerIn ($webyep_sAdminName) "globale" Inhalte editieren dürfen sollen
	// --
	// Whether editors other than the main editor should be able to edit "global" fields

	$webyep_bOtherLoginsMayEditGlobalData = false;



   // Tragen Sie hier die Zeichenkodierung (z.B. "utf-8") ein, die Sie in Ihren Webseiten verwenden
	// Wenn Sie hier eine Kodierung eintragen, wird WebYep Sonderzeichen nicht
	// --
   // If you've set a character set in you pages (with the "Content-Type" meta tag),
   // you should also set this character set here.
   // (e.g. "utf-8" or "iso-8859-2" for eastern european languages)
   // This will make sure, WebYep displays the special characters using this character set. But it will
   // also stop WebYep from converting texts to HTML entities! WebYep will instead insert the meta tag
   // also in each of it's editor pages.

   $webyep_sCharset = "";



   // Geben Sie hier an, welche Syntax WebYep beim generieren von HTML-Tags verwenden soll
   // "HTML" => HTML 4.01 Strict
   // "XHTML" => XHTML 1.0 Strict
   // "auto" => WebYep versucht anhand der !DOCTYPE Direktive des Dokuments automatisch die Syntax zu eruieren
	// --
   // Set this to define which syntax WebYep should use when creating HTML tags
   // "HTML" => HTML 4.01 Strict
   // "XHTML" => XHTML 1.0 Strict
   // "auto" => WebYep tries to detect the used syntax via the !DOCTYPE directive of the document

   $webyep_sHTMLStandard = "auto";



   // Die Einstellung $webyep_bUseTablesForMenus wird nicht mehr unterstützt!
   // $webyep_bUseTablesForMenus is deprecated and always false now!

   $webyep_sMenuType = "listJS";
   // mögliche Werte:
   //    "list".....ohne JavaScript-Funktion
   //    "listJS"...mit JavaScript-Funktion zum Ein-/Ausblenden von Menüzweigen
	// --
   // possible values are:
   //    "list".....no JavaScript functionality
   //    "listJS"...use JavaScript to show/hide menu trees



   // nur für $webyep_sMenuType="listJS":
   // only for $webyep_sMenuType="listJS":

   $webyep_bAutoCloseMenus = false;
   // mögliche Werte:
   //    true.....beim öffnen eines Menüzweiges werden automatisch alle anderen Zweige geschlossen
   //    false....die Menüzweige werden manuell von den BenutzerInnen geschlossen
	// --
   // possible values are:
   //    true.....when expanding a menu tree, all other tree collapse automatically
   //    false....menu trees are not automatically collapsed

   $webyep_bRememberOpenMenus = true;
   // mögliche Werte:
   //    true.....geöffnete Menüzweige werden in einem Cookie gespeichert
   //    false....geöffnete Menüzweige werden nicht gespeichert - sobald eine neue Seite geöffnet wird, werden alle Zweige automatisch geschlossen, außer der, zu dem die aktuelle Seite gehört
	// --
   // possible values are:
   //    true.....expanded menu trees will be saved in a cookie
   //    false....expanded menu trees will not be saved - when a new page is opened, all trees but the one the page belongs to are closed.



   $webyep_bOpenFullURLsInNewWindow = false;
   // Set to true of you want the Long Text and Image Elements to open full URLs (including the http:// part) in a new browser window
	// --
   // Setzen Sie diesen Wert auf true, wenn das Fließtext-Element und das Bild-Element absolute URLs (die den "http://"-Teil enthalten) in einem neuen Browser-Fenster öffnen sollen



   // Hier können Sie den Namen des Produktes angeben, wenn es unter einem eigenen Namen präsentieren wollen
   // (dieser erscheint in den Editoren, der Hilfe und den Hinweis-Fenstern)
   // Das WebYep Logo kann unter webyep-system/programm/images/logo.gif geändert werden
   // --
   // Here you can change the product name, if you want to present it under a different name
   // (it will appear in the editor windows, the help and the notice windows)
   // The WebYep logo can be changed in webyep-system/programm/images/logo.gif

   $webyep_sProductName = 'WebYep';



   // Wenn Sie die deutsche Version von WebYep verwenden, müssen Sie hier nichts einstellen
   // If you're using the English version of WebYep, you do not need to change anything here
   // If you want to use the French version of WebYep, please change this value from "auto" to "french".
   // If you want to use the Serbian version of WebYep, please change this value from "auto" to "srpski".
   // If you want to use the Swedish version of WebYep, please change this value from "auto" to "swedish".
   // If you want to use the Dutch version of WebYep, please change this value from "auto" to "dutch".
   // If you want to use the Portuguese version of WebYep, please change this value from "auto" to "portuguese".
   // If you want to use the Polish version of WebYep, please change this value from "auto" to "polski".

   $webyep_sLang = "auto";



   // Zur Problembehebung bittet Sie der WebYep Support manchmal, den WebYep Debug Modus zu aktivieren
	// --
   // Sometimes WebYep Support will ask you to activate WebYep's debug mode to solve a problem

   $webyep_bDebug = false;


   // Wichtig: In dieser Datei dürfen am Beginn und Ende keine Leerzeilen eingefügt werden!!!
   //          Achten Sie auch darauf, dass diese Datei keinen Unicode Byte Order Marker (BOM) enthält!!!
	// --
   // Important: Do not insert ANYTHING before or after the PHP block in this file!!!
   //            Also make sure this file does not contain a Unicode Byte Order Marker (BOM)!!!
?>