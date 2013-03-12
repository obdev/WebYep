<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

    $webyep_bDocumentPage = false;
    $webyep_sIncludePath = "..";
    include_once("$webyep_sIncludePath/webyep.php");

    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/elements/WYMenuElement.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextField.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYTextArea.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYHiddenField.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYSelectMenu.php");
    include_once(@webyep_sConfigValue("webyep_sIncludePath") . "/lib/WYEditor.php");

    /**
     * Takes data from client-side editor and turns it into a MenuItem
     *
     * @param  string $data Data from menu editor (POSTed)
     * @param  string $liID Last insert ID (POSTed)
     * @return mixed        MenuItem data object
     */
    function parseDataForServer($data, $liID) {
        // $data = Array of "22|#|3|#|0|#|SubMenu2.3.5.1|#|/foo.html";
        //                   ID  lvl vis  Title            URL
        $mess = '|#|'; // M.E.S.S. = menu entry separator string :)
        $tmpData = array('VERSION' => 2
                        ,'LIID'    => $liID
                        ,'CONTENT' => array()
                        );
        $lastLevel  = 0;
        $lastParentNode = array();
        $tmpData['CONTENT'] =& $lastParentNode[0];
        foreach ($data as $menuEntry) {
            $parts = explode($mess, $menuEntry);
            $newEntry = array('ID'       => $parts[0]
                             ,'TITLE'    => $parts[3]
                             ,'URL'      => $parts[4]
                             ,'VISIBLE'  => $parts[2] == '0' ? 0 : 1
                             ,'SUBITEMS' => array()
                             );
            $currentLevel = $parts[1];
            if ($currentLevel > $lastLevel) {
                unset ($lastParentNode[$currentLevel]);
                $lastParentNode[$lastLevel][count($lastParentNode[$lastLevel])-1]['SUBITEMS'] =& $lastParentNode[$currentLevel];
            }
            $lastLevel = $currentLevel;
            $lastParentNode[$currentLevel][] = $newEntry;
        }
        return $tmpData;
    }

    /**
     * Produce JSON string for JS-MenuEditor
     *
     * @param  string $data The unserialized DataFile
     * @param  string $sURL The base URL of the menu
     * @return string       JSON representation for client side editor
     */
    function parseDataForClient($data, $sURL) {
        return '{version:2,baseUrl:"'.$sURL.'",content:[' . implode(',',toJSON($data['CONTENT'])) . '],lastInsertId:'.$data['LIID'].'}';
    }

    /**
     * Recursive function to parse nested dictionaries.
     * Un-nests input data and adds hierarchy level to every item.
     *
     * @param  mixed $data  Dictionary which holds menu entries (may contain subitems/-trees)
     * @param  int   $level Hierarchy level of the (sub)tree to start with
     * @return array        An array of JSON objects
     */
    function toJSON($data, $level = 0) {
        $tmp = array(); $index = 0;
        while ($index < count($data)) {
            $data[$index]['TITLE'] = str_replace("\\", "\\\\", $data[$index]['TITLE']);
            $data[$index]['TITLE'] = str_replace("\"", "\\\"", $data[$index]['TITLE']);
            $entry = '{id:' . $data[$index]['ID'] . ',level:' . $level . ',visible:' . $data[$index]['VISIBLE']
                   . ',hideChildren:0,text:"' . $data[$index]['TITLE'] . '",link:"' . $data[$index]['URL'] . '"}';
            $tmp[] = $entry;
            if (count($data[$index]['SUBITEMS'])) {
                $tmp = array_merge($tmp, toJSON($data[$index]['SUBITEMS'], $level + 1));
            }
            $index++;
        }
        return $tmp;
    }

    $bOK = false;
    $sResponse = WYTS("MenuSaved");
    $sHelpFile = "menu-element.php";

    $oEditor = new WYEditor();
    //$sMenuName = "MENU";
    //$sTextFieldName = "ITEM";

    //$aTitles = array();
    //$aIDs = array();
    //$dItems = array();
    //$i = 0;
    //$iC = 0;
    //$oSM = od_nil;
    //$oTFItem = od_nil;
    //$oHFTitles = new WYHiddenField("MENU_TITLES");
    //$oHFIDs = new WYHiddenField("MENU_IDS");
    $oTAWYEditorPostArea = new WYTextArea('WY_EditorPostArea');
    $oHFURL = new WYHiddenField(WY_QK_MENU_URL);
    $sURL = $oHFURL->sValue();
    if ($sURL) {
        $oURL = new WYURL($sURL);
        //echo '$oURL = '.$oURL->sEURL().', $sURL = '.$sURL;
    } else {
        $oURL = od_nil;
        //echo '$oURL = od_nil';
    }
    $oElement = new WYMenuElement($oEditor->sFieldName, $oEditor->bGlobal, $oURL, "", "", od_nil);

    if ($oEditor->bSave) {
        if (isset($oTAWYEditorPostArea->sText)) {
            $chunks = explode('|@|', $oTAWYEditorPostArea->sText());
            $chunks[1] = explode('|§|', $chunks[1]);
            $oElement->dContent = parseDataForServer($chunks[1], $chunks[2]);
            $oElement->save();
            $bOK = true;
        }
    } else {
        $sContent = parseDataForClient($oElement->dContent, $oURL->sURL());
    }

    $goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php global $webyep_sHTMLStandard; $webyep_sHTMLStandard = 'XHTML'; echo $goApp->sCharsetMetatag(); ?>
<title><?php WYTSD("MenuEditorTitle", true); ?></title>
<link rel="stylesheet" type="text/css" href="../styles.css"/>
<script type="text/javascript" src="../javascript/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../javascript/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="../javascript/jquery.ui.nestedSortable.js"></script>
<script type="text/javascript">/*<![CDATA[*/$(document).ready(function(){var WY=window.WY||{};WY.temp={model:<?php echo $sContent; ?>,messages:{deleteOne:"<?php WYTSD('MenuConfirmRemoveOne',false); ?>",deleteMany:"<?php WYTSD('MenuConfirmRemoveMany',false); ?>",noToggleInvisibleParent:"<?php WYTSD('MenuNoToggleInvisibleParent',false); ?>"}}});/*]]>*/</script>
<script type="text/javascript" src="../javascript/wyMenu.js"></script>
<script type="text/javascript" src="../javascript/wyCookie.js"></script>
<script type="text/javascript" src="../javascript/wyWindow.js"></script>
</head>
<?php
    if (!isset($bOK)) $bOK = false;
    if ($oEditor->bSave) $bDidSave = true;
    else if (!isset($bDidSave)) $bDidSave = false;
?>
<body>
    <table cellspacing="0" cellpadding="6" border="0" style="height: 100%; width: 100%;">
        <tbody>
            <tr>
                <td style="height: 30px;">
                    <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;">
                        <tbody>
                            <tr>
                                <td align="left" valign="top"><?php if ($webyep_bDebug) echo "<h1 class='warning'>WebYep Debug Mode!</h1>"; ?>
                                    <h1><span class="editorTitle"><?php echo WYTS("MenuEditorTitle") . ":</span> " . $oEditor->sFieldName; ?></h1>
                                </td>
                                <td align="right">
                                    <img src="../images/logo.gif" alt="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" align="left"><?php if (!$bDidSave) { ?>
                    <table cellspacing="0" cellpadding="6" border="0" style="height: 100%; width: 100%;">
                        <tbody>
                            <tr>
                                <td valign="top" align="left">
                                    <div id="WY_EditArea">
                                        <ul id="WY_InsertMenuItemsHere" class="sortable">
                                            <li> menu entries go here </li>
                                        </ul>
                                    </div>
                                </td>
                                <td valign="top" align="left" style="width: 220px; min-width: 200px;">
                                    <div style="border: solid 0px black">
                                        <!-- Controls -->
                                        <div class="WY_EditorInputField">
                                            <label for="WY_EditMenuTitle"><?php WYTSD("MenuEditorMenuTitle"); ?></label>
                                            <input id="WY_EditMenuTitle" class="WY_EditMenu" type="text" value="" />
                                        </div>
                                        <div class="WY_EditorInputField vSpace">
                                            <label for="WY_EditMenuLink"><?php WYTSD("MenuEditorMenuLink"); ?></label>
                                            <input id="WY_EditMenuLink" class="WY_EditMenu" type="text" value="" />
                                        </div>
                                        <div class="WY_EditorInputField vSpace">
                                            <label for="WY_EditMenuVisible"><?php WYTSD("MenuEditorMenuVisible"); ?></label>
                                            <input id="WY_EditMenuVisible" type="checkbox" checked="checked" />
                                        </div>
                                        <div id="WY_EditorButtonPanel1">
                                            <div class="WY_EditorButtonRow">
                                                <a id="WY_EditorButtonUp"><img src="../images/menu-up-button.gif" alt="" /></a>
                                            </div>
                                            <div class="WY_EditorButtonRow">
                                                <a id="WY_EditorButtonLeft"><img src="../images/menu-left-button.gif" alt="" /></a>
                                                &nbsp;&nbsp;
                                                <a id="WY_EditorButtonRight"><img src="../images/menu-right-button.gif" alt="" /></a>
                                            </div>
                                            <div class="WY_EditorButtonRow">
                                                <a id="WY_EditorButtonDown"><img src="../images/menu-down-button.gif" alt="" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="left">
                                    <!-- More Controls -->
                                    <div class="WY_EditorInputField">
                                        <a id="WY_EditMenuAddSibling" title="<?php WYTSD("MenuAddSiblingButtonTitle", true); ?>"><img src="../images/menu-add_sibling.gif" alt="" /></a>
                                        <a id="WY_EditMenuAddChild" title="<?php WYTSD("MenuAddChildButtonTitle", true); ?>"><img src="../images/menu-add_child.gif" alt="" /></a>
                                        <a id="WY_EditMenuDelete" title="<?php WYTSD("MenuRemoveButtonTitle", true); ?>"><img src="../images/menu-remove-button.gif" alt="" /></a>
                                    </div>
                                </td>
                                <td valign="middle" align="left">
                                    <!-- Empty -->
                                </td>
                            </tr>
                            <tr>
                                <td valign="middle" align="left">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="WY_EditForm">
                                        <div>
                                            <textarea name="WY_EditorPostArea" id="WY_EditorPostArea" rows="1" cols="1"></textarea>
                                            <?php echo WYEditor::sHiddenFieldsForElement($oElement); ?>
                                            <?php echo $oHFURL->sDisplay(); ?>
                                        </div>
                                    </form>
                                    <!--<a class="helpLinkNew" href="/webyep-system/programm/editors/../help/deutsch/menu-element.php">Hilfe</a>-->
                                    <?php echo $goApp->sHelpLink($sHelpFile); ?>
                                </td>
                                <td valign="middle" align="left">
                                    <div id="WY_EditorButtonPanel2">
                                        <div class="WY_EditorButtonRow">
                                            <input id="WY_EditorButtonCancel" type="button" value="<?php WYTSD("CancelButton", true); ?>" />
                                            <input id="WY_EditorButtonSave" type="button" value="<?php WYTSD("SaveButton", true); ?>" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table><?php } else {
                    echo "<blockquote>";
                    echo "<div class='response'>$sResponse</div>";
                    if ($bOK) {
                        echo WYEditor::sPostSaveScript();
                    } else {
                        echo "<p class='textButton'>" . webyep_sBackLink() . "</p>";
                    }
                    echo "</blockquote>";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>