<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

	$webyep_bDocumentPage = false;
	$webyep_sIncludePath = "..";
	include_once("$webyep_sIncludePath/webyep.php");

	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYRichTextElement.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextArea.php");
	include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

	$sResponse = WYTS("RichTextSaved");

	$oEditor = new WYEditor();
	$oElement = new WYRichTextElement($oEditor->sFieldName, $oEditor->bGlobal, "", false);
	if ($oEditor->bSave) {
		$oElement->setText($goApp->sFormFieldValue('CKEditor1'));
		$oElement->save();
	}
	else {
      $sContent = $oElement->sText();
      $sCSSURL = $goApp->sFormFieldValue(WY_QK_RICH_TEXT_CSS);
	}

    $oCKBaseURL = od_clone($goApp->oProgramURL);
    $oCKBaseURL->addComponent("opt");
    $oCKBaseURL->addComponent("ckeditor");
	$oCKJSURL = od_clone($oCKBaseURL);
	$oCKJSURL->addComponent("ckeditor.js");

	switch ($webyep_iLanguageID) {
		case WYLANG_GERMAN: $sCKLanguageCode = "de"; break;
		case WYLANG_SRPSKI: $sCKLanguageCode = "sr"; break;
		case WYLANG_POLISH: $sCKLanguageCode = "pl"; break;
		case WYLANG_PORTUGUESE: $sCKLanguageCode = "pt"; break;
		case WYLANG_SWEDISH: $sCKLanguageCode = "sv"; break;
		case WYLANG_DUTCH: $sCKLanguageCode = "nl"; break;
		case WYLANG_FRENCH: $sCKLanguageCode = "fr"; break;
		case WYLANG_ENGLISH:
		default:
			$sCKLanguageCode = "en";
	}

	$goApp->outputWarningPanels(); // give App a chance to say something

	$oCKFinderPath = od_clone($goApp->oProgramPath);
	$oCKFinderPath->addComponent('opt');
	$oCKFinderPath->addComponent('ckfinder');
	$bCKFinderInstalled = $oCKFinderPath->bExists();

	$oFilemanagerPath = od_clone($goApp->oProgramPath);
	$oFilemanagerPath->addComponent('opt');
	$oFilemanagerPath->addComponent('filemanager');
	$bFilemanagerInstalled = $oFilemanagerPath->bExists();

    $oImagePath = od_clone($goApp->oProgramURL);
    $oImagePath->addComponent('images');
    //$oImagePath->normalize();
    /*
(function() {
   CKEDITOR.plugins.addExternal('mediaembed',CKEDITOR.basePath.substr(0, CKEDITOR.basePath.indexOf("ckeditor/"))+'mediaembed/', 'plugin.js');
})();
    */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>

<title>
<?php WYTSD("RichTextEditorTitle", true); ?>
</title>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
</style>
<?php include("remember-editor-size.js.php"); ?>
<script type="text/javascript">
	function loadEditor() {
		dParameters = {
			language : "<?php echo $sCKLanguageCode ?>",
            toolbar: 'WebYep',
            toolbar_WebYep: (function() { return [
                    { name: 'document',    items: [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
                    { name: 'clipboard',   items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                    { name: 'editing',     items: [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
                    { name: 'tools',       items: [ 'Maximize', 'ShowBlocks','-','About' ] },
                    '/',
                    { name: 'paragraph',   items: [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-',
                                                    'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                    { name: 'links',       items: [ 'Link','Unlink','Anchor' ] },
                    { name: 'insert',      items: [ 'Image','MediaEmbed','Flash','-','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
                    '/',
                    { name: 'styles',      items: [ 'Styles','Format','Font','FontSize' ] },
                    { name: 'colors',      items: [ 'TextColor','BGColor' ] },
                    { name: 'basicstyles', items: [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] }
                ];
                })(),
			contentsCss: "<?php echo $sCSSURL ?>"<?php
				$oInitCodePath = od_clone($goApp->oProgramPath);
				$oInitCodePath->addComponent("opt");
				$oInitCodePath->addComponent("ckeditor_init.php");
				if ($oInitCodePath->bExists()) {
					echo ",\n";
					include_once($oInitCodePath->sPath);
				}
			?>
        };
		if (dParameters['filebrowserBrowseUrl'] == undefined) {
<?php
			if ($bCKFinderInstalled) {
				$oCKFinderURL = od_clone($goApp->oProgramURL);
				$oCKFinderURL->addComponent("opt");
				$oCKFinderURL->addComponent("ckfinder");
				$oCKFinderURL->normalize();
				$sCKFinderURL = $oCKFinderURL->sPath;
?>
				dParameters['filebrowserBrowseUrl'] = '<?php echo $sCKFinderURL; ?>/ckfinder.html';
				dParameters['filebrowserImageBrowseUrl'] = '<?php echo $sCKFinderURL; ?>/ckfinder.html?Type=Images';
				dParameters['filebrowserFlashBrowseUrl'] = '<?php echo $sCKFinderURL; ?>/ckfinder.html?Type=Flash';
				dParameters['filebrowserUploadUrl'] = '<?php echo $sCKFinderURL; ?>/core/connector/php/connector.php?command=QuickUpload&type=Files';
				dParameters['filebrowserImageUploadUrl'] = '<?php echo $sCKFinderURL; ?>/core/connector/php/connector.php?command=QuickUpload&type=Images';
				dParameters['filebrowserFlashUploadUrl'] = '<?php echo $sCKFinderURL; ?>/core/connector/php/connector.php?command=QuickUpload&type=Flash';
<?php
			} else if ($bFilemanagerInstalled) {
                $oFilemanagerURL = od_clone($goApp->oProgramURL);
                $oFilemanagerURL->addComponent('opt');
                $oFilemanagerURL->addComponent('filemanager');
                $oFilemanagerURL->normalize();
                $sFilemanagerURL = $oFilemanagerURL->sPath;
?>
				dParameters['filebrowserBrowseUrl'] = '<?php echo $sFilemanagerURL; ?>/index.html';
				dParameters['filebrowserImageBrowseUrl'] = '<?php echo $sFilemanagerURL; ?>/index.html?Type=Images';
				dParameters['filebrowserFlashBrowseUrl'] = '<?php echo $sFilemanagerURL; ?>/index.html?Type=Flash';
<?php
            }
?>
		}
		window.wyCKEditor = CKEDITOR.replace("CKEditor1", dParameters);

        CKEDITOR.dialog.add('MediaEmbedDialog', function() {
            return {
                title: 'Embed Media Dialog',
                minWidth: 550,
                minHeight: 200,
                contents: [{
                    id: 'iframe',
                    label: 'Embed Media Dialog',
                    expand: true,
                    elements: [{
                        type: 'html',
                        id: 'pageMediaEmbed',
                        label: 'Embed Media Dialog',
                        style: 'width: 100%;',
                        html: '<iframe src="ckeditor-embed-media.php" frameborder="0" name="iframeMediaEmbed" id="iframeMediaEmbed" allowtransparency="1" style="width:100%;margin:0;padding:0;"></iframe>'
                    }]
                }],
                onOk: function() {
                    for (var i=0; i<window.frames.length; i++) {
                        if(window.frames[i].name == 'iframeMediaEmbed') {
                            var content = window.frames[i].document.getElementById("embed").value;
                        }
                    }
                    final_html = 'MediaEmbedInsertData|---' + escape('<div class="media_embed">'+content+'</div>') + '---|MediaEmbedInsertData';
                    window.wyCKEditor.insertHtml(final_html);
                    updated_editor_data = window.wyCKEditor.getData();
                    clean_editor_data = updated_editor_data.replace(final_html,'<div class="media_embed">'+content+'</div>');
                    window.wyCKEditor.setData(clean_editor_data);
                }
            };
        });
        window.wyCKEditor.addCommand('MediaEmbed', new CKEDITOR.dialogCommand('MediaEmbedDialog'));

        window.wyCKEditor.ui.addButton('MediaEmbed', {
            label: '<?php WYTSD('RichTextEditorEmbedMediaButton'); ?>',
            command: 'MediaEmbed',
            icon: '<?php echo $oImagePath->sPath . '/media-embed.gif'; ?>'
        });

		CKEDITOR.on('instanceReady', function(evt) {
				var editor = evt.editor;
				editor.execCommand('maximize');
				wy_restoreSize();
			});

<?php
		$oStylesCodePath = od_clone($goApp->oProgramPath);
		$oStylesCodePath->addComponent("opt");
		$oStylesCodePath->addComponent("ckeditor_styles.js");
		if ($oStylesCodePath->bExists()) {
			$oStylesCodeURL = od_clone($goApp->oProgramURL);
			$oStylesCodeURL->addComponent("opt");
			$oStylesCodeURL->addComponent("ckeditor_styles.js");
?>
			CKEDITOR.config.stylesCombo_stylesSet = 'WebYepStyles:"<?php echo $oStylesCodeURL->sPath; ?>"';

<?php   } ?>
	}
</script>
<script type="text/javascript" src="<?php echo $oCKJSURL->sURL(false, false, true); ?>"></script></head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0; padding:0;" onload="loadEditor();" onresize="wy_saveSize();">
<?php if (!$oEditor->bSave) { ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<textarea name="CKEditor1" id="CKEditor"><?php echo $sContent; ?></textarea>
<?php echo WYEditor::sHiddenFieldsForElement($oElement); ?>
</form>
<?php } else {
      echo "<div style=\"margin: 20px\">";
		echo "<div class=\"response\">$sResponse</div>";
		echo WYEditor::sPostSaveScript();
		echo "<p class=\"textButton\">" . webyep_sBackLink() . "</p>";
      echo "</div>";
	}?>

<div id="console"></div>
</body>
</html>
