<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <style type="text/css">
                body { font: normal 12px Arial,sans-serif; }
                #embed { width: 100%; height: 110px; margin: 5px 0 0 0; border: 1px solid #a0a0a0; font: normal 11px Courier, Fixedsys, serif; color: #333; }
        </style>
	</head>
	<body>
		<?php WYTSD('RichTextEditorEmbedMediaTitle'); ?>:
		<textarea id="embed" /></textarea>
	</body>
</html>
