@@CopyrightJavaScript@@

function webyep_debugLog(sText)
{
	alert(sText);
}

function webyep_bCheckDWVersion(rExp)
{
	return dreamweaver.appVersion.substr(0, sV.length) == sV;
}

function webyep_checkForInitCode(bAsk)
{
	var oDOM = dw.getDocumentDOM();
	oDOM.synchronizeDocument(); // Don't remove this! We NEED to synch BEFORE we inspect AND AFTERWARDS, so designer gets the changes!
	var sHTML = oDOM.documentElement.outerHTML.substr(0, 30);

	if (sHTML.indexOf("WebYep init") == -1) {
		if (!bAsk || confirm("@@Confirm@@")) {
			sInitHTML = '<?php // WebYep init WebYepV1\n';
			sInitHTML += '/* >';
			if (@@LanFlagEn@@) {
				sInitHTML += '<table><tr><td bgcolor=white><h2>WebYep message: Error, PHP inactive</h2>\n';
				sInitHTML += '<font color=red>The PHP code in this page can not be executed!<ul>\n';
				sInitHTML += '<li>Are you launching this page directly form your harddisc (e.g. using a\n';
				sInitHTML += '&quot;Preview in Browser&quot function of your web design application instead of accessing it via a webserver?</li>\n';
				sInitHTML += '<li>Has this file the correct file extension for PHP scripts?\n';
				sInitHTML += 'WebYep pages must have the &quot;.php&quot; extension and <b>not</b> ".html" or ".htm"!</li>\n';
				sInitHTML += '</ul></font></td></tr></table>';
			}
			else {
				sInitHTML += '<table><tr><td bgcolor=white><h2>WebYep meldet: Fehler, PHP inaktiv</h2>\n';
				sInitHTML += '<font color=red>Der PHP-Code in dieser Seite wird nicht durchgef&uuml;hrt!<ul>\n';
				sInitHTML += '<li>Entweder rufen Sie die Seite nicht &uuml;ber den WebServer sondern direkt\n';
				sInitHTML += 'von Ihrer Festplatte aus auf (zB. mittels &quot;Voransicht im Browser&quot; im Dreamweaver).</li>\n';
				sInitHTML += '<li>Oder Sie haben der Datei nicht die richtige Dateierweiterung (extension) gegeben -\n';
				sInitHTML += 'WebYep-Seiten m&uuml;ssen die Erweiterung &quot;.php&quot; aufweisen und <b>nicht</b> ".html" bzw. ".htm"!</li>\n';
				sInitHTML += '</ul></font></td></tr></table>';
			}
			sInitHTML += '<!--\n';
			sInitHTML += '*/\n';
			sInitHTML += '$webyep_sIncludePath = "./";\n';
			sInitHTML += '$iDepth = 0;\n';
			sInitHTML += 'while (!file_exists($webyep_sIncludePath . "webyep-system")) {\n';
			sInitHTML += '	$iDepth++;\n';
			sInitHTML += '	if ($iDepth > 10) {\n';
			sInitHTML += '		error_log("@@ErrorFolderNotFound@@", 0);\n';
			sInitHTML += '		echo "<html><head><title>WebYep</title></head><body><b>WebYep:</b> @@MessageFolderNotFound@@</body></html>";\n';
			sInitHTML += '		exit;\n';
			sInitHTML += '	}\n';
			sInitHTML += '	$webyep_sIncludePath = ($webyep_sIncludePath == "./") ? ("../"):("$webyep_sIncludePath../");\n';
			sInitHTML += '}\n';
			sInitHTML += 'if (file_exists("${webyep_sIncludePath}webyep-system/programm")) $webyep_sIncludePath .= "webyep-system/programm";\n';
			sInitHTML += 'else $webyep_sIncludePath .= "webyep-system/program";\n';
			sInitHTML += 'include("$webyep_sIncludePath/webyep.php");\n';
			sInitHTML += '// -->?>\n';

			oDOM.source.insert(0, sInitHTML);
			oDOM.synchronizeDocument();
		}
	}
}

function webyep_showHelpDocument(sPage)
{
		var sPath = dreamweaver.getConfigurationPath();

		dreamweaver.browseDocument(sPath+"/@@HelpFolder@@/"+sPage);
}
