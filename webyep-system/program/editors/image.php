<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

$webyep_bDocumentPage = false;
$webyep_sIncludePath = "..";
include_once("$webyep_sIncludePath/webyep.php");

include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYImageElement.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYFileUpload.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

$bOK = false;
$sHelpFile = "image-element.php";

$oEditor = new WYEditor();
$oHFDelete = new WYHiddenField("DELETE_IMAGE");
$oHFImageWidth = new WYHiddenField(WY_QK_IMAGE_WIDTH);
$oHFImageHeight = new WYHiddenField(WY_QK_IMAGE_HEIGHT);
$oHFIsThumb = new WYHiddenField(WY_QK_IS_THUMB);
$oHFThumbWidth = new WYHiddenField(WY_QK_THUMB_WIDTH);
$oHFThumbHeight = new WYHiddenField(WY_QK_THUMB_HEIGHT);
$oFU = new WYFileUpload("IMAGE_FILE");
$oFU->setAttribute('id', 'choose');
$oFU->setAttribute('class', 'WYchoose r3 t1');

$oTFURL = new WYTextField("LINK_URL");
$oTFURL->setWidth(40);
$oTFURL->setAttribute('class', 'WYtextfield WYinput r3');
$oTFURL->setAttribute('placeholder', '...');
$oTFAltText = new WYTextField("ALT_TEXT");
$oTFAltText->setWidth(40);
$oTFAltText->setAttribute('class', 'WYtextfield WYinput r3');
$oTFAltText->setAttribute('placeholder', '...');
$oElement = new WYImageElement($oEditor->sFieldName, $oEditor->bGlobal, "", "", "", (int)$oHFImageWidth->sValue(), (int)$oHFImageHeight->sValue(), ((int)$oHFIsThumb->sValue()) == 1 ? true : false, (int)$oHFThumbWidth->sValue(), (int)$oHFThumbHeight->sValue());
$oFP = od_nil;

$sMaxUpload = $goApp->sFormattedByteSizeString($goApp->iMaxUploadBytes());

if ((int)$oHFDelete->sValue() == 1) {
    $oElement->deleteThumbnail();
    $oElement->deleteImage(); // implicit save
    $bOK = true;
    if ($bOK) {
        $sResponse = WYTS("Image Deleted");
        $sOnLoadScript = 'window.parent.location.reload(true)';
    }
} else if (isset($_REQUEST['WEBYEP_ACTION'])) {
    if ($oFU->bFileUploaded()) {
        if ($oFU->bUploadOK()) {
            @$oFP =& $oFU->oFilePath();
            @$oOFP =& $oFU->oOriginalFilename();
            $sExt = strtolower($oOFP->sExtension());
            if ($sExt == 'svg' || $oOFP->bCheck(WYPATH_CHECK_JUSTIMAGE | WYPATH_CHECK_NOPATH)) {
                if ($oElement->bUseUploadedImageFile($oFP, $oOFP)) {
                    $oElement->setLinkURL($oTFURL->sValue());
                    $oElement->setAltText($oTFAltText->sValue());
                    $oElement->save();
                    $sResponse = WYTS("Image Saved");
                    $bOK = true;
                    if ($bOK) {
                        if ($webyep_sModalWindowType == "none") {
                            $sOnLoadScript = 'window.opener.location.reload(true);window.close();';
                        } else {
                            $sOnLoadScript = 'window.parent.location.reload(true);window.close();';
                        }
                    }
                } else {
                    $sResponse = WYTS("ImageStoreFailed");
                    $bOK = false;
                }
            } else {
                $goApp->log("Illegal file/type on image upload: " . $oOFP->sPath);
                $sResponse = WYTS("FileUploadErrorUnknown");
            }
            $oFU->deleteTmpFile();
        } else {
            $sResponse = $oFU->sErrorMessage();
        }
    } else { // maybe only URL changed
        $oElement->setLinkURL($oTFURL->sValue());
        $oElement->setAltText($oTFAltText->sValue());
        $oElement->save();
        $sResponse = WYTS("ImageSaved");
        $bOK = true;
        $sOnLoadScript = 'window.parent.location.reload(true)';
    }
} else {
    $oTFURL->setValue($oElement->sLinkURL());
    $oTFAltText->setValue($oElement->sAltText());
}

$goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php WYTSD("ImageEditorTitle", true); ?></title>
    <meta name="viewport" content="width = device-width, minimum-scale = 0.25, maximum-scale = 1.60">
    <meta name="generator" content="Freeway Pro 7">
    <link rel="stylesheet" href="../css/themes/lightblue/pace-theme-minimal.css" />
    <script src="../javascript/pace.js"></script>
    <link rel=stylesheet href="css/CSS-mini-reset.css">
    <link rel=stylesheet href="css/wyfontstylesheet.css">
    <style type="text/css">
        body {
            color: #404040;
            font-size: 13px;
            margin: 0px;
            height: 100%
        }

        html {
            height: 100%
        }

        form {
            margin: 0px
        }

        body>form {
            height: 100%
        }

        img {
            margin: 0px;
            border-style: none
        }

        button {
            margin: 0px;
            border-style: none;
            padding: 0px;
            background-color: transparent;
            vertical-align: top
        }

        table {
            empty-cells: hide
        }

        td {
            padding: 0px
        }

        .f-sp {
            font-size: 1px;
            visibility: hidden
        }

        .f-lp {
            margin-bottom: 0px
        }

        .f-fp {
            margin-top: 0px
        }

        #PageDiv {
            width: 100% !important;
            max-width: 100% !important;
            min-height: 100% !important;
            position: relative;
            margin: auto
        }

        #delete {
            min-width: 62px;
            height: 29px;
            padding: 0 10px 1px 10px;
        }

        #delete,
        .resetButtonClass-Name {
            color: #fff;
            background-color: #BC1434;
            font-weight: normal;
        }

        input[type=submit]:hover,
        #delete:hover,
        .resetButtonClass-Name:hover {
            background-color: #ED0039;
        }

        input[type=submit]:active,
        #delete:active,
        .resetButtonClass-Name:active {
            background-color: #BC1434;
        }

        input[type=submit]:focus,
        #delete:focus,
        .resetButtonClass-Name:focus {
            background-color: #BC1434;
        }

        #logon,
        #save,
        #cancel {
            min-width: 92px;
            height: 29px;
            padding: 0 6px 1px 6px;
        }

        #logon,
        #save,
        .resetButtonClass-Name {
            color: #fff;
            background-color: #9C9C9C;
            font-weight: normal;
        }

        #cancel {
            color: #444;
            transition: all 0.2s ease-in-out;
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            background-color: #F5F5F5;
        }

        #cancel:hover {
            color: #BC1434;
        }

        input[type=submit]:hover,
        #logon:hover,
        #save:hover,
        .resetButtonClass-Name:hover {
            background-color: #444;
        }

        input[type=submit]:active,
        #logon:active,
        #save:active,
        .resetButtonClass-Name:active {
            background-color: #444;
        }

        input[type=submit]:focus,
        #logon:focus,
        #save:focus,
        .resetButtonClass-Name:focus {
            background-color: #444;
        }

        .greyPanelGrad {
            background-color: #FDFCFC;
            background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, 0.5)), to(rgba(255, 255, 255, 0)));
            background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
            background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
            background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
            background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
            background-image: linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
        }

        .WYhelp {
            color: #979797;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 11px;
            margin-top: 0px;
            margin-bottom: 0.1px;
            text-decoration: none
        }

        .WYhelp a {
            color: #979797;
            text-decoration: none;
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        .WYhelp a:hover {
            color: #6e6e6e;
            text-decoration: none
        }

        .WYhelp img {
            float: left
        }

        .WYinput {
            width: 100%;
            height: 28px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            overflow: auto
        }

        .WYobd-link {
            color: #bebebe;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 11px;
            margin-top: 0px;
            margin-bottom: 0.1px
        }

        .WYobd-link a {
            color: #bebebe;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
            -webkit-transition: color 0.2s ease-in-out;
            -moz-transition: color 0.2s ease-in-out
        }

        .WYobd-link a:hover {
            color: #969696;
            text-decoration: none
        }

        .WYtextfieldST input {
            height: 26px;
            width: 548px;
            max-height: 26px;
            max-width: 548px;
            min-height: 26px;
            min-width: 548px;
        }

        .WYwarning {
            color: #bc1434;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 11px;
            margin-top: 0px;
            margin-bottom: 0.1px
        }

        .r2 {
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            -webkit-background-clip: padding-box;
            background-clip: padding-box
        }

        .r3 {
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -webkit-background-clip: padding-box;
            background-clip: padding-box
        }

        .r5 {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-background-clip: padding-box;
            background-clip: padding-box
        }

        .r6 {
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
            -webkit-background-clip: padding-box;
            background-clip: padding-box
        }

        .t1 {
            -webkit-transition: all 0.1s ease-in-out;
            -moz-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        .t2 {
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        .vcenter {
            display: table
        }

        .vcenter p {
            display: table-cell;
            vertical-align: middle
        }

        ::-webkit-input-placeholder {
            color: #b8d0d3;
        }

        :-moz-placeholder {
            color: #b8d0d3;
            /* Firefox 18- */
        }

        ::-moz-placeholder {
            color: #b8d0d3;
            /* Firefox 19+ */
        }

        :-ms-input-placeholder {
            color: #b8d0d3;
        }

        em {
            font-style: italic
        }

        h1 {
            font-weight: bold;
            font-size: 18px
        }

        h1:first-child {
            margin-top: 0px
        }

        h2 {
            font-weight: bold;
            font-size: 16px
        }

        h2:first-child {
            margin-top: 0px
        }

        h3 {
            font-weight: bold;
            font-size: 14px
        }

        h3:first-child {
            margin-top: 0px
        }

        p.WYwarning {
            color: #bc1434;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 11px;
            margin-top: 0px;
            margin-bottom: 0.1px
        }

        strong {
            font-weight: bold
        }

        .WYsimplemodal {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            background-color: #fff;
            line-height: 18px
        }

        h1.simplemodal {
            color: #404040;
            font-weight: bold;
            font-size: 18px;
            line-height: 24px;
            margin-top: 0px;
            padding-top: 3px
        }

        h1:first-child {
            margin-top: 0px
        }

        .grey {
            color: #6e6e6e
        }

        .WYcenteralign {
            text-align: center
        }

        .WYmainbuttons {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 13px;
            font-weight: normal;
            cursor: pointer;
            letter-spacing: 0px;
            text-shadow: 0 1px 0 rgba(64, 64, 64, 0);
            height: auto;
            color: #fff;
            min-width: 92px;
            text-align: center
        }

        .WYhelpstyle {
            color: #979797;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            text-transform: uppercase;
            line-height: 11px;
            margin-top: 0px;
            margin-bottom: 0.1px
        }

        .midgrey {
            color: #969696
        }

        .s12 {
            font-size: 12px
        }

        .lightgrey {
            color: #cecece
        }

        .borderboxsizingcenter {
            text-align: center;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        .uploadStyle {
            color: #969696;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            text-align: left
        }

        .WYtextfield {
            color: #404040;
            font-family: 'Courier New', Courier;
            font-size: 14px;
            background-color: #fbfdff;
            line-height: 14px;
            text-align: left;
            border: 1px solid #6AC7FD;
            resize: none;
            padding: 5px 6px 5px 6px;
            transition: all 0.25s ease-in-out;
            -webkit-transition: all 0.25s ease-in-out;
            -moz-transition: all 0.25s ease-in-out;
            box-shadow: 0 0 4px rgba(81, 203, 238, 0);
            -webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 0);
            -moz-box-shadow: 0 0 4px rgba(81, 203, 238, 0);
        }

        .WYtextfield:focus {
            box-shadow: 0 0 4px rgba(81, 203, 238, 1);
            -webkit-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
            -moz-box-shadow: 0 0 4px rgba(81, 203, 238, 1);
            border-color: #58bbf4;
        }

        #simplemodal {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 1;
            padding: 11px 18px 16px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box
        }

        #WebYeplogo {
            position: absolute;
            top: 11px;
            right: 44px;
            height: 31px;
            z-index: 1;
            width: auto;
            overflow: hidden
        }

        #WebYeplogo>img {
            max-height: 31px;
        }

        #WY-simple-modal-header {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            min-height: 48px;
            z-index: 2;
            border-bottom: solid #eee 1px
        }

        #wy-simple-modal-footer {
            position: absolute;
            left: 0px;
            width: 100%;
            bottom: 0px;
            min-height: 46px;
            z-index: 3;
            padding-top: 13px;
            background-color: #f5f5f5;
            border-top: solid #eee 1px;
            -webkit-box-shadow: inset 0 1px 0 #FFF;
            -moz-box-shadow: inset 0 1px 0 #FFF;
            box-shadow: inset 0 1px 0 #FFF
        }

        #WYhelp {
            position: absolute;
            right: 18px;
            bottom: 24px;
            min-height: 8px;
            z-index: 1
        }

        #WY-Debug-Message {
            position: absolute;
            left: 18px;
            top: 55px;
            z-index: 4
        }

        #WYobd-link {
            position: absolute;
            top: 55px;
            right: 18px;
            z-index: 5
        }

        #formcontainerouter {
            position: absolute;
            left: 18px;
            top: 87px;
            right: 18px;
            min-height: 56px;
            z-index: 6
        }

        #formcontainerinner {
            width: 100%;
            height: 53px;
            min-height: 41px;
            z-index: 0;
            padding-left: 8px;
            padding-right: 8px;
            background-color: #fdfcfc;
            border: solid #ddd 1px
        }

        #choose {
            width: auto;
            max-width: 165px;
            margin: 0 10px 0 0
        }

        #delete {
            margin: 0 0 0 10px
        }

        #url-alt-container {
            position: absolute;
            left: 18px;
            top: 148px;
            right: 18px;
            min-height: 54px;
            z-index: 7;
            height: auto
        }

        #arrowdown1 {
            overflow: hidden
        }

        #arrowdown2 {
            overflow: hidden
        }

        #textareaURL {
            width: 100%;
            height: auto
        }

        #textareaAlt {
            width: 100%;
            height: auto
        }

        .WYhelp {
            position: absolute;
            right: 18px;
            bottom: 24px;
            min-height: 8px;
            z-index: 1
        }

        .WYobd-link {
            position: absolute;
            top: 55px;
            right: 18px;
            z-index: 5
        }

        .arrowdownafter:after {
            color: #a9aaa9;
            content: "\e806";
            font-family: webyepfontregular, arial;
            font-size: 13px;
            margin-left: 2px;
        }

        @media screen and (max-width: 500px) {
            #choose {
                max-width: 100px
            }
        }

        @media screen and (max-width: 370px) {
            #formcontainerinner {
                padding: 8px
            }

            #delete {
                margin: 8px 8px 0 8px
            }
        }

        .response {
            font-family: helvetica;
            font-size: 14px;
            text-align: center;
            margin: 28% 0 20px 0;
        }

        .response:before {
            font-family: webyepfontregular;
            margin-left: 0px;
            margin-right: 8px;
            content: "\e80F";
        }

        .textButton {
            text-align: center
        }

        .textButton a {
            color: #ffffff;
            font-size: 13px;
            background: #2f9ce0;
            padding: 6px 14px 6px 14px;
            color: #ffffff;
            text-decoration: none;
            margin: 20px 8px 0 8px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 13px;
            font-weight: normal;
            text-transform: capitalize;
            transition: all 0.2s ease-in-out;
            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
        }

        .textButton a:hover {
            background: #545454;
        }
    </style>
    <!--[if lt IE 9]>
    <script src="../javascript/html5shiv.js"></script>
    <![endif]-->
    <?php include("remember-editor-size.js.php"); ?>
    <script type="text/javascript">
        function confirmDelete() {
            if (confirm("<?php WYTSD('DeleteImageQuestion'); ?>")) {
                document.forms[0].<?php echo $oHFDelete->dAttributes["name"]; ?>.value = 1;
                document.forms[0].submit();
            }
        }
    </script>

</head>
<?php if (!isset($bOK)) $bOK = false;
if ($oEditor->bSave) $bDidSave = true;
else if (!isset($bDidSave)) $bDidSave = false; ?>

<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript : "" ?>" onresize="wy_saveSize();">
    <?php if (!$bDidSave) { ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div id="PageDiv">
                <div id="simplemodal" class="WYsimplemodal">
                    <h1 class="simplemodal f-lp"><?php echo WYTS("ImageEditorTitle"); ?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
                    <div id="WebYeplogo">
                        <img src="../images/webyep-logo.png" alt="WebYeplogo" style="float:left; width:auto">
                    </div>
                    <div id="WY-simple-modal-header"></div>
                    <div id="wy-simple-modal-footer" class="WYcenteralign">
                        <p class="f-fp f-lp">
                            <input type="submit" id="save" class="WYmainbuttons r3 t2" value="<?php WYTSD("SaveButton", true); ?>">

                            <?php if ($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous') { ?>
                                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                            <?php } elseif ($webyep_sModalWindowType == 'jquery') { ?>
                                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">
                            <?php } else { ?>
                                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
                            <?php } ?>

                            <?php if (!(new WYImage())->bCanResizeImages()) {  ?>
                                <div class="warning remark" style="padding-top: 8px"><?php echo WYTS("ImageCannotResize") ?></div>
                            <?php } ?>

                            <?php
                            echo (new WYEditor())->sHiddenFieldsForElement($oElement);
                            echo $oHFDelete->sDisplay();
                            echo $oHFImageWidth->sDisplay();
                            echo $oHFImageHeight->sDisplay();
                            echo $oHFThumbWidth->sDisplay();
                            echo $oHFThumbHeight->sDisplay();
                            echo $oHFIsThumb->sDisplay();
                            ?>

                        </p>
                        <div class="WYhelp">
                            <p class="WYhelpstyle">
                                <?php echo $goApp->sHelpLink($sHelpFile); ?>
                            </p>
                        </div>
                    </div>
                    <div id="WY-Debug-Message" class="WYwarning">
                        <?php if ($webyep_bDebug) echo '<p>WebYep Debug Mode<em>!</em></p>'; ?>
                    </div>
                    <div class="WYobd-link">
                        <p><a href="<?php echo $webyep_sCompanyLink ?>" target="_blank"> <?php echo $webyep_sCompanyName ?> </a>
                        </p>
                    </div>
                    <div id="formcontainerouter">

                        <div id="formcontainerinner" class="borderboxsizingcenter r2 vcenter greyPanelGrad">
                            <p class="f-fp f-lp"><strong><?php WYTSD("ImageFile", true); ?>:</strong>
                                <span class="midgrey">
                                    <span class="s12">
                                        <em><?php echo "(max. $sMaxUpload)&nbsp;"; ?></em>
                                    </span>
                                </span>
                                <span class="lightgrey"><?php echo $oFU->sDisplay(); ?> | </span>
                                <input id="delete" name="Button" type="button" class="WYmainbuttons r3 t1" value="<?php WYTSD("DeleteImageButton", true); ?>" onClick="confirmDelete();">
                            </p>
                        </div>

                    </div>
                    <div id="url-alt-container">
                        <table style="width:100%; margin:auto; border-spacing:0px">
                            <tr>
                                <td style="padding:0 0 5px 0; width:225px; height:15px; vertical-align:top">
                                    <p class="f-fp f-lp arrowdownafter"><?php WYTSD("ImageLinkURL", true); ?>
                                    </p>
                                </td>
                                <td style="width:16px;max-width:16px; width:17px; vertical-align:top">
                                    <p class="f-sp">&nbsp;</p>
                                </td>
                                <td style="width:227px; vertical-align:top">
                                    <p class="f-fp f-lp arrowdownafter"><?php WYTSD("ImageAltText", true); ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:225px; vertical-align:top">
                                    <p class="f-fp f-lp">
                                        <?php echo $oTFURL->sDisplay(); ?>
                                    </p>
                                </td>
                                <td style="max-width:16px;width:16px; width:17px; vertical-align:top">
                                    <p class="f-sp">&nbsp;</p>
                                </td>
                                <td style="width:227px; vertical-align:top">
                                    <p class="f-fp f-lp">
                                        <?php echo $oTFAltText->sDisplay(); ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    <?php } else {
        echo "<blockquote>";
        echo "<div class='response'>$sResponse</div>";
        if ($bOK) echo WYEditor::sPostSaveScript();
        else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>";
        echo "</blockquote>";
    } ?>
</body>

</html>
