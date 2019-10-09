<?php
   // WebYep
   // (C) Objective Development Software GmbH
   // http://www.obdev.at

   // Wichtig:   In dieser Datei dŸrfen am Beginn und Ende keine Leerzeilen eingefŸgt werden!!!
   //            Achten Sie auch darauf, dass diese Datei keinen Unicode Byte Order Marker (BOM) enthŠlt!!!
   // Important: Do not insert ANYTHING before or after the PHP block in this file!!!
   //            Also make sure this file does not contain a Unicode Byte Order Marker (BOM)!!!

   // NŠhere Informationen zu den hier mšglichen Einstellungen finden Sie in der WebYep Dokumentation
   // Further information on the configuration settings in this file can be found in the WebYep documentation



   // Name und Kennwort fŸr die Anmeldung
   // --
   // Username and password logging in


$webyep_sAdminName = "admin";
$webyep_sAdminPassword = "";


   // Multi Login - zusŠtzliche Logins fŸr einzelne Seiten o. Seitengruppen
   // (entfernen Sie die Doppel-SchrŠgstriche, um es zu verwenden)
   // $webyep_aMultiLoginName[] = "einName";
   // $webyep_aMultiLoginPassword[] = "einKennwort";
   // $webyep_aMultiLoginURLPatterns[] = "/eineSeite.php /einOrdner/*";

   // Multiple Logins - additional logins for specific pages or groups of pages
   // (remove the double slashes to use it)
// $webyep_aMultiLoginName[] = "admin";
// $webyep_aMultiLoginPassword[] = "";
// $webyep_aMultiLoginURLPatterns[] = "/pageA.php /pageB.php";

// $webyep_aMultiLoginName[] = "admin";
// $webyep_aMultiLoginPassword[] = "";
// $webyep_aMultiLoginURLPatterns[] = "/workshops/* /news.php";

// $webyep_aMultiLoginName[] = "admin";
// $webyep_aMultiLoginPassword[] = "";
// $webyep_aMultiLoginURLPatterns[] = "/workshops/* /workshops/*/*";

// $webyep_aMultiLoginName[] = "admin";
// $webyep_aMultiLoginPassword[] = "";
// $webyep_aMultiLoginURLPatterns[] = "*public.php";


ini_set('display_errors', 'off');
error_reporting(E_ALL);


   //system url use to show uploaded files from rich text editors and inside edotors

define('BASE_URL', '');


   //system base path use to upload files and images from rich text editors

define('BASE_PATH', realpath(dirname(__FILE__) . '/../webyep-system'));


   // Wenn eine Seite editierbare Felder enthŠlt, der/die BenutzerIn aber keine Editier-Rechte hat,
   // kšnnen die Editier-Knšpfe inaktiv oder gar nicht angezeigt werden
   // --
   // If a page contains editable fields but the user has insiffucient privileges
   // WebYep can display the edit buttons disable ot not at all

$webyep_bShowDisabledEditButtons = false;


   // Ob andere BenutzerInnen als der/die Haupt-BenutzerIn ($webyep_sAdminName) "globale" Inhalte editieren dŸrfen sollen
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

$webyep_sCharset = "utf-8";



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


   // Die Einstellung $webyep_bUseTablesForMenus wird nicht mehr unterstŸtzt!
   // $webyep_bUseTablesForMenus is deprecated and always false now!

$webyep_sMenuType = "listJS";
   // mšgliche Werte:
   // "list".....ohne JavaScript-Funktion
   // "listJS"...mit JavaScript-Funktion zum Ein-/Ausblenden von MenŸzweigen
   // --
   // possible values are:
   // "list".....no JavaScript functionality
   // "listJS"...use JavaScript to show/hide menu trees



   // nur fŸr $webyep_sMenuType="listJS":
   // only for $webyep_sMenuType="listJS":

$webyep_bAutoCloseMenus = true;
   // mšgliche Werte:
   // true.....beim šffnen eines MenŸzweiges werden automatisch alle anderen Zweige geschlossen
   // false....die MenŸzweige werden manuell von den BenutzerInnen geschlossen
   // --
   // possible values are:
   //    true.....when expanding a menu tree, all other tree collapse automatically
   //    false....menu trees are not automatically collapsed

$webyep_bRememberOpenMenus = true;
   // mšgliche Werte:
   // true.....gešffnete MenŸzweige werden in einem Cookie gespeichert
   // false....gešffnete MenŸzweige werden nicht gespeichert - sobald eine neue Seite gešffnet wird, werden alle Zweige automatisch geschlossen, au§er der, zu dem die aktuelle Seite gehšrt
   // --
   // possible values are:
   // true.....expanded menu trees will be saved in a cookie
   //  false....expanded menu trees will not be saved - when a new page is opened, all trees but the one the page belongs to are closed.
   
   
$webyep_submenu = "OFF";
   // possible values are:
   // OFF..... Collapse Menu Trees of WebYep menu window in 'Edit Mode' 
   // ON.... Expand Menu Trees of WebYep menu window in 'Edit Mode'  
 
   



$webyep_bOpenFullURLsInNewWindow = false;
   // Set to true of you want the Long Text and Image Elements to open full URLs (including the http:// part) in a new browser window
   // --
   // Setzen Sie diesen Wert auf true, wenn das Flie§text-Element und das Bild-Element absolute URLs (die den "http://"-Teil enthalten) in einem neuen Browser-Fenster šffnen sollen



   //   // Wenn Sie das wei§e Etikett webyep wŸnschen, kšnnen Sie die...
   // 1 - Produktname,
   // 2 - der Firmenname,
   // 3 - und Firmen-URL-Link
   // Dies wird in jedem: Editor-Fenster, die Hilfe und die AnkŸndigung Fenster erscheinen)
   // --
   // If you wish to white label webyep, you can change the... 
   // 1 - product name, 
   // 2 - the company name, 
   // 3 - and company URL link 
   // Note this will appear in every: editor window, the help and the notice windows)
$webyep_sProductName = 'MyProduct';
$webyep_sCompanyName = 'WebYep by Objective Development';
$webyep_sCompanyLink = 'http://www.obdev.at/index.html';


   // If you want to use the German version of WebYep, please change this value from "auto" to "deutsch".
   // If you want to use the English version of WebYep, please change this value from "auto" to "english".
   // If you want to use the French version of WebYep, please change this value from "auto" to "french".
   // If you want to use the Serbian version of WebYep, please change this value from "auto" to "srpski".
   // If you want to use the Swedish version of WebYep, please change this value from "auto" to "swedish".
   // If you want to use the Dutch version of WebYep, please change this value from "auto" to "dutch".
   // If you want to use the Portuguese version of WebYep, please change this value from "auto" to "portuguese".
   // If you want to use the Polish version of WebYep, please change this value from "auto" to "polski".
   // If you want to use the Spanish version of WebYep, please change this value from "auto" to "spanish".
$webyep_sLang = "english";



   // If you are using Redactor WYSIWYG editor then you can choose your language from the list below.
   // 	ar		Arabic
   // 	de		German
   // 	en		English  (default)
   // 	es		Spanish
   // 	fa		Persian
   // 	fi		Finnish
   // 	fr		French
   // 	he		Hebrew
   // 	hu		Hungarian
   // 	it		Italian
   // 	ja		Japanese
   // 	ko		Korean
   // 	nl		Dutch
   // 	no		Norwegian
   // 	pl		Polish
   // 	pt_br	Brazilian Portuguese
   // 	ru		Russian
   // 	sv		Swedish
   // 	tr		Turkish
   // 	zh_cn	Chinese Simplified
   // 	zh_tw	Chinese Traditional
$webyep_rLang = 'en';





   // Zur Problembehebung bittet Sie der WebYep Support manchmal, den WebYep Debug Modus zu aktivieren
   // --
   // Sometimes WebYep Support will ask you to activate WebYep's debug mode to solve a problem
$webyep_bDebug = false;



   // Choose which javascript library you wish to use with the WebYep items
   // If you're using Mootools then set to "mootools".
   // If you're using jQuery then set to "jquery".
   // If you're using Scriptaculous/Prototype then set to "scriptaculous".
   // If do NOT wish to use any javascript libraries then set to "none".
$webyep_JsLibariesType = "jquery";

   // Choose which modal scripts library you wish to use with the WebYep items
   // If you're using Mootools Modal window then set to "mootools".
   // If you're using jQuery Modal window then set to "jquery".
   // If you're using Scriptaculous/Prototype Modal window then set to "scriptaculous".
   // If do NOT wish to use any modal scripts libraries then set to "none" and a standard popup will be used.
$webyep_sModalWindowType = "jquery";

   // Choose which lightbox scripts library you wish to use with the WebYep items
   // If you're using Mootools lightbox then set to "mootools".
   // If you're using jQuery lightbox then set to "jquery".
   // If you're using Scriptaculous/Prototype lightbox then set to "scriptaculous".
   // If do NOT wish to use any lightbox scripts then set to "none" and a standard popup will be used.
$webyep_LightboxType = "jquery";



   /**
   * Define date format and time format according to your region
   * Defined format will be shown on Gustebook 
   * Refrence : http://php.net/manual/en/datetime.formats.date.php
   */
$webyep_CustomDateFromat = "j-n-Y";
$webyep_CustomTimeFromat = "g:m a";


   // Wichtig: In dieser Datei dŸrfen am Beginn und Ende keine Leerzeilen eingefŸgt werden!!!
   //          Achten Sie auch darauf, dass diese Datei keinen Unicode Byte Order Marker (BOM) enthŠlt!!!
   // --
   // Important: Do not insert ANYTHING before or after the PHP block in this file!!!
   //            Also make sure this file does not contain a Unicode Byte Order Marker (BOM)!!!
?>