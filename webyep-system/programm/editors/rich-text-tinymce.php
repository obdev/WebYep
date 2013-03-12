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

    function sTinyMCELang()
    {
        global $webyep_iLanguageID;
        global $goApp;
  
        switch ($webyep_iLanguageID) {
            case WYLANG_GERMAN: $sL = "de"; break;
            case WYLANG_SRPSKI: $sL = "sr"; break;
            case WYLANG_POLISH: $sL = "pl"; break;
            case WYLANG_PORTUGUESE: $sL = "pt"; break;
            case WYLANG_SWEDISH: $sL = "sv"; break;
            case WYLANG_DUTCH: $sL = "nl"; break;
            case WYLANG_FRENCH: $sL = "fr"; break;
            // case WYLANG_HUNGARIAN: $sL = "hu"; break;
            default: $sL = "en"; break;
        }

        if ($sL != "en") {
            $oP = od_clone($goApp->oProgramPath);
            $oP->addComponent("opt");
            $oP->addComponent("tinymce");
            $oP->addComponent("jscripts");
            $oP->addComponent("tiny_mce");
            $oP->addComponent("langs");
            $oP->addComponent("$sL.js");
            if (!$oP->bExists()) $sL = "en";
        }

        return $sL;
    }

    $bOK = false;
	$sResponse = WYTS("RichTextSaved");
	$sHelpFile = "richtext-tinymce-element.php";

	$oEditor = new WYEditor();
	$oElement = new WYRichTextElement($oEditor->sFieldName, $oEditor->bGlobal, "", false);
	if ($oEditor->bSave) {
		$oElement->setText($goApp->sFormFieldValue('editorArea'));
		$oElement->save();
        $bOK = true;
	} else {
        $sContent = $oElement->sText();
        $sCSSURL = $goApp->sFormFieldValue(WY_QK_RICH_TEXT_CSS);
	}
	
	$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>

<title>
<?php WYTSD("RichTextEditorTitle", true); ?>
</title>
<?php
	if (!isset($bOK)) $bOK = false;
	if ($oEditor->bSave) $bDidSave = true;
	else if (!isset($bDidSave)) $bDidSave = false;
?>
<?php echo $goApp->sCharsetMetatag(); ?>
<link href="../styles.css" rel="stylesheet" type="text/css">
<?php if (!$bDidSave) { ?>
<script type="text/javascript" src="../opt/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<!-- TinyMCE settings -->
<script type="text/javascript">
    tinyMCE.init({
        language : "<?php echo sTinyMCELang() ?>",
        content_css : "<?php echo $sCSSURL ?>",
        elements : "editorArea",
<?php
    $oInitCodePath = od_clone($goApp->oProgramPath);
    $oInitCodePath->addComponent("opt");
    $oInitCodePath->addComponent("tinymce_init.php");
    if ($oInitCodePath->bExists()) {
        include_once($oInitCodePath->sPath);
    } else {
        $oMCImgManagerPath = od_clone($goApp->oProgramPath);
        $oMCImgManagerPath->addComponent("opt");
        $oMCImgManagerPath->addComponent("tinymce");
        $oMCImgManagerPath->addComponent("jscripts");
        $oMCImgManagerPath->addComponent("tiny_mce");
        $oMCImgManagerPath->addComponent("plugins");
        $oMCImgManagerPath->addComponent("imagemanager");
        $sMCImageManager = $oMCImgManagerPath->bExists() ? 'imagemanager,' : '';
        $oFilemanagerPath = od_clone($goApp->oProgramPath);
        $oFilemanagerPath->addComponent('opt');
        $oFilemanagerPath->addComponent('filemanager');
        $sFilemanagerCallback = !$oFilemanagerPath->bExists() ? '' : ',
        file_browser_callback: function(field_name, url, type, win) {
        var wyRE = /^(https?:\/\/.*)(\/webyep-system\/programm?).*$/;
        var wyPP = wyRE.exec(window.location.toString());
        var fbURL = wyPP[1] + wyPP[2] + "/opt/filemanager/index.html";
        if (type == "image") type = "images";
        if (fbURL.indexOf("?") < 0) {
            fbURL = fbURL + "?type=" + type;
        } else {
            fbURL = fbURL + "&type=" + type;
        }
        tinyMCE.activeEditor.windowManager.open({
            file : fbURL,
            width : 1000,
            height : 640,
            resizable : "yes",
            close_previous : "no"
        }, {
            window : win,
            input : field_name
        });
        return false;
    }';
?>
        // cut here ------------------
        mode : "exact",
        theme : "advanced",
        convert_urls : false,
        relative_urls : false,
        plugins : "safari,style,table,advhr,advlink,iespell,<?php echo $sMCImageManager; ?>insertdatetime,media,searchreplace,print,contextmenu,paste,noneditable,visualchars,nonbreaking,spellchecker",
        theme_advanced_buttons1_add_before : "newdocument,spellchecker,separator",
        theme_advanced_buttons1_add : "separator,forecolor,backcolor",
        theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
        theme_advanced_buttons3_add_before : "tablecontrols,separator",
        theme_advanced_buttons3_add : "media",
        theme_advanced_buttons4 : "styleprops,separator,visualchars,nonbreaking",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_path_location : "bottom",
        valid_elements : "*[*]",
        invalid_elements : "",
        remove_linebreaks : false,
        apply_source_formatting : false,
        theme_advanced_resize_horizontal : false,
        theme_advanced_resizing : true,
        theme_advanced_resizing_use_cookie: true,
        nonbreaking_force_tab : true<?php echo $sFilemanagerCallback ?>
        // cut here ------------------
<?php } ?>
    });
</script>
<!-- /TinyMCE -->
<?php } ?>
<?php include("remember-editor-size.js.php"); ?>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="margin:0; padding:0;" onload="wy_restoreSize();" onresize="wy_saveSize();">
<table style="height:100%; width:100%;" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td style="height: 30px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
<h1><span class="editorTitle"><?php echo WYTS("RichTextEditorTitle") . " (TinyMCE):</span> " . $oEditor->sFieldName; ?></h1></td>
        <td align="right"><img src="../images/logo.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><?php if (!$bDidSave) { ?>
      <table border="0" cellspacing="0" cellpadding="6" style="height: 95%; width: 100%;">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <tr>
          <td align="left" valign="top"><textarea id="editorArea" name="editorArea" style="width: 100%; height: 420px"><?php echo $sContent?></textarea>
          </td>
        </tr>
        <tr>
          <td style="height: 30px"><input name="Button" type="button" class="formButton" value="<?php WYTSD("CancelButton", true); ?>" onClick="window.close();"><input type="submit" class="formButton" value="<?php WYTSD("SaveButton", true); ?>"><?php echo WYEditor::sHiddenFieldsForElement($oElement); ?></td>
        </tr>
        </form>
      </table>
	<?php echo $goApp->sHelpLink($sHelpFile); ?>
	<?php } else {
      echo "<blockquote>";
		echo "<div class='response'>$sResponse</div>";
		if ($bOK) echo WYEditor::sPostSaveScript();
      else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>";
      echo "</blockquote>";
	}?></td>
  </tr>
</table>
</body>
</html>
