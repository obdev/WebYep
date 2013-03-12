<?php
function sMapFieldName($sFieldName)
{
    $sN = "";
	switch ($sFieldName) {
        case "Photo": $sN = "Foto"; break;
        case "CV": $sN = "Lebenslauf"; break;
        case "Contact": $sN = "Kontakt"; break;
        case "Education": $sN = "Ausbildung"; break;
        case "Image": $sN = "Bild"; break;
        case "Caption": $sN = "Bildtext"; break;
        case "Counselings": $sN = "Beratungen"; break;
        case "Therapies": $sN = "Therapien"; break;
        case "When": $sN = "Wann"; break;
        case "Where": $sN = "Wo"; break;
        case "EventTitle": $sN = "Veranstaltungstitel"; break;
        case "Event Categories DE": $sN = "Terminkategorien DE"; break;
        case "Event Categories EN": $sN = "Terminkategorien EN"; break;
        case "Event Category DE": $sN = "Terminkategorie DE"; break;
        case "Event Category EN": $sN = "Terminkategorie EN"; break;
        case "Event Category": $sN = "Terminkategorie"; break;
        case "Events": $sN = "Termine"; break;
        case "Description": $sN = "Beschreibung"; break;
        case "Address DE": $sN = "Adresse DE"; break;
        case "Address EN": $sN = "Adresse EN"; break;
        case "Directions": $sN = "Anfahrtsplan"; break;
        case "Title": $sN = "Titel"; break;
        case "Attachment": $sN = "Anhang"; break;
        
		default:
            $sN = $sFieldName;
	}
    return $sN;
}

WYElement::setFieldNameCallback("sMapFieldName");

?>