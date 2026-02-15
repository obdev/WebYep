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
    if (isset($_REQUEST['WEBYEP_ACTION'])) {
        if (isset($oTAWYEditorPostArea->sText)) {
			$chunks = explode('|@|', $oTAWYEditorPostArea->sText());
            $chunks[1] = explode('|§|', $chunks[1]);
			$oElement->dContent = parseDataForServer($chunks[1], $chunks[2]);
            
			
		$oElement->save();
        $bOK = true;
		
		if($bOK){
		            if($webyep_sModalWindowType == "none"){
		                $sOnLoadScript = 'window.opener.location.reload(true);window.close();';
		            }else{
		                $sOnLoadScript = 'window.parent.location.reload(true);window.close();';
		            }
				}
        
		
		}
    } else {
        $sContent = parseDataForClient($oElement->dContent, $oURL->sURL());
    }

    $goApp->outputWarningPanels(); // give App a chance to say something
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php WYTSD("MenuEditorTitle", true); ?></title>
	<meta name="viewport" content="width = 600, minimum-scale = 0.25, maximum-scale = 1.60">
	<meta name="generator" content="Freeway Pro 6.1.2">
	<link rel="stylesheet" href="../css/themes/lightblue/pace-theme-minimal.css" />
	<script src="../javascript/pace.js"></script>
	<script>window.jQuery || document.write('<script src="../javascript/jquery-1.6.1.min--.js"><\/script>');</script>
	<script type="text/javascript" src="../javascript/jquery-ui-1.8.8.custom.min.js"></script>
	<script type="text/javascript" src="../javascript/jquery.ui.nestedSortable.js"></script>
	<script type="text/javascript">/*<![CDATA[*/$(document).ready(function(){var WY=window.WY||{};WY.temp={model:<?php echo $sContent; ?>,messages:{deleteOne:"<?php WYTSD('MenuConfirmRemoveOne',false); ?>",deleteMany:"<?php WYTSD('MenuConfirmRemoveMany',false); ?>",noToggleInvisibleParent:"<?php WYTSD('MenuNoToggleInvisibleParent',false); ?>"}}});/*]]>*/</script>
	<script type="text/javascript" src="../javascript/wyMenu.js"></script>
	<script type="text/javascript" src="../javascript/wyCookie.js"></script>
	<script type="text/javascript" src="../javascript/wyWindow.js"></script>
	<link rel=stylesheet href="css/CSS-mini-reset.css">
	<link rel=stylesheet href="css/wyfontstylesheet.css">
	<style type="text/css">
	<!-- 
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
	body > form {
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
		position: relative;
		min-width: 100% !important;
		width: 100% !important;
		max-width: 100% !important;
		min-height: 100%;
		margin: auto
	}
	#WY_EditArea {
		position: relative;
		width: 50%;
		height: 100% !important;
		z-index: 0;
		margin-left: auto;
		background-color: #fdfcfc;
		border: solid #ddd 1px;
		overflow: hidden;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		overflow-x: hidden;
		overflow-y: auto;
		padding:2px 2px 2px 0px;
	}
	#choose,
	#delete {
		width: 92px;
		height: 26px;
		padding: 0 6px 1px 6px;
		margin: 0 2px;
		text-align: center;
		cursor: pointer;
		letter-spacing: 0px;
		width: 96px;
		font: normal 13px/13px'Helvetica Neue', Helvetica, Arial, sans-serif;
		background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, 0.5)), to(rgba(255, 255, 255, 0)));
		/* Saf4+, Chrome */
		background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
		/* Saf5.1+, Chrome 10+ */
		background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
		/* FF3.6 */
		background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
		/* IE10 */
		background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
		/* Opera 11.10+ */
		background-image: linear-gradient(top, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
		/* Standard CSS3 */
		-webkit-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19);
		-moz-box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19);
		box-shadow: inset 0 0 1px #fff, 0 1px 1px -1px rgba(0, 0, 0, .19)
	}
	#choose.WYchoose {
		color: #2f7fbb;
		background-color: #def7fe;
		border: 1px solid #b8d0d3
	}
	#choose:hover.WYchoose {
		color: #2f7fbb;
		background-color: #d1e5eb;
		border: 1px solid #b8d0d3
	}
	#delete.WYdelete {
		color: #bc1434;
		background-color: #ffe9f0;
		border: 1px solid #D3C2C5
	}
	#delete:hover.WYdelete {
		color: #bc1434;
		background-color: #f0dce4;
		border: 1px solid #D3C2C5
	}
	#logon,
	#save, #WY_EditorButtonSave, #WY_EditorButtonCancel
	#cancel {
		min-width: 92px;
		height: 29px;
		padding: 0 6px 1px 6px;
	}
	/* CSS3 attribute-equals selector */
	#logon,
	#save, #WY_EditorButtonSave,
	.resetButtonClass-Name {
		color: #fff;
		background-color: #9C9C9C;
		font-weight: normal;
	}
	#cancel, #WY_EditorButtonCancel {
		color: #444;
		transition: all 0.2s ease-in-out;
		-webkit-transition: all 0.2s ease-in-out;
		-moz-transition: all 0.2s ease-in-out;
		background-color: #F5F5F5;
	}
	#cancel:hover, #WY_EditorButtonCancel:hover {
		color: #BC1434;
	}
	input[type=submit]:hover,
	#logon:hover,
	#save:hover, #WY_EditorButtonSave:hover,
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
		/* the reset button when focussed by keyboard-navigation */
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
	.WYinput1 {
		width: 100%;
		height: 28px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		overflow: auto;
		margin: 5px 0 10px 0
	}
	.WYinput2 {
		width: 100%;
		height: 28px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		overflow: auto;
		margin: 5px 0 15px 0
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
	.divcell {
		display: table-cell;
		vertical-align: top;
		overflow: hidden
	}
	.divtable {
		display: table;
		table-layout: fixed
	}
	.menupanelborder {
		background-color: #fbfbfb;
		border: solid 1px #DEDEDE
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
	.scrollable {
		width: 100%;
		height: 100%;
		margin: 0;
		padding: 0;
		overflow: auto;
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
	.w16 {
		width: 14px
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
	.s11 {
		font-size: 11px
	}
	.aligncenter {
		text-align: center
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
		overflow:hidden
	}
	#WebYeplogo > img {
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
		z-index: 10;
		padding-top: 13px;
		background-color: #f5f5f5;
		border-top: solid #eee 1px;
		-webkit-box-shadow: inset 0 1px 0 #FFF;
		-moz-box-shadow: inset 0 1px 0 #FFF;
		box-shadow: inset 0 1px 0 #FFF
	}
	#save {
		position: relative
	}
	#cancel {
		position: relative
	}
	#WY-Debug-Message {
		position: absolute;
		left: 18px;
		top: 55px;
		z-index: 4
	}
	#contTwrap {
		position: absolute;
		left: 18px;
		top: 85px;
		right: 18px;
		bottom: 80px;
		min-height: 243px;
		z-index: 6;
		padding-left: 1px;
		padding-right: 1px
	}
	#contT {
		position: absolute;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 1
	}
	#col1 {
		position: relative;
		float: left;
		width: 50%;
		min-height: 229px;
		z-index: 0;
		padding-right: 14px;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box
	}
	#controls {
		position: relative;
		float: left;
		width: 100%;
		z-index: 0;
		margin-bottom: 18px;
		height: auto
	}
	#navheading {
		position: relative;
		float: left;
		margin-top: 7px;
		margin-right: 14px
	}
	#navsubheading {
		position: relative;
		float: left;
		margin-top: 7px;
		margin-right: 14px
	}
	#navdelete {
		position: relative;
		float: left;
		margin-top: 7px;
		margin-right: 38px
	}
	#navleft {
		position: relative;
		vertical-align: top
	}
	#navup {
		position: relative;
		vertical-align: top
	}
	#navright {
		position: relative;
		vertical-align: top
	}
	#navdown {
		position: relative;
		vertical-align: top
	}
	#arrowdown1 {
		position: relative
	}
	#WYEditMenuTitle {
		position: relative;
		width: 100%;
		height: auto
	}
	#arrowdown2 {
		position: relative
	}
	#WYEditMenuLink {
		position: relative;
		width: 100%;
		height: auto
	}
	#arrowleft {
		position: relative
	}
	#WYEditArea {
		position: relative;
		width: 50%;
		height: 100%;
		z-index: 0;
		margin-left: auto;
		background-color: #fdfcfc;
		border: solid #ddd 1px;
		overflow: hidden;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		overflow: auto;
		overflow-x: hidden;
		overflow-y: scroll
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
	     content:"\e806";
	     font-family: webyepfontregular,arial;
	     font-size: 13px;
	     margin-left: 2px;
	}
	.arrowleftbefore:before {
	     color: #a9aaa9;
	     content:"\e804";
	     font-family: webyepfontregular,arial;
	     font-size: 13px;
	     margin: 0 1px 0 1px;
	}
	.mt10 {
		margin-top:10px;
	}
	.linkinstruction {
     	color: #666666;
     	font-size: 11px;
		font-style: italic;
	}
	
	.response {
		font-family:helvetica;
		font-size:14px;
		text-align:center;
	}
	.response:before {
		font-family:webyepfontregular; 
		margin-left:0px; 
		margin-right:8px; 
		content:"\e80F";
	}
	.orange { color: orange }
	.red { color:red; }
	.blue {color:#4aa5ef;}
	
	#controls a img, label.css-label { 
		opacity:0.85; 
	}
	
	#controls a img:hover, label.css-label:hover { 
		outline: #7177BF solid 1px;
		opacity:1; 
	}

	.linkinstruction {
		transition: opacity 0.25s ease;
		opacity:0.5;
	}
	
	#WY_EditMenuExternal.css-checkbox:checked ~ .linkinstruction {
	    opacity:1;
	}
	::-webkit-scrollbar {
	  -webkit-appearance: none;
	  width: 5px;
	}
	::-webkit-scrollbar-thumb {
	  border-radius:5px;
	  background-color: rgba(0, 0, 0, .3);
	  -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);	
	} 
	::-webkit-scrollbar-thumb:hover {
	  background-color: rgba(113, 119, 191, .75);
	}
	
	-->
	</style>
	<!--[if lt IE 9]>
	<script src="../javascript/html5shiv.js"></script>
	<![endif]-->
	<link rel=stylesheet href="css/extra-css.css">
	<link rel=stylesheet href="css/menusort.css">
<?php include("remember-editor-size.js.php"); ?>
</head>
<?php
if (!isset($bOK)) $bOK = false; if ($oEditor->bSave) $bDidSave = true; else if (!isset($bDidSave)) $bDidSave = false;?> 
<body onload="wy_restoreSize();<?php echo isset($sOnLoadScript) ? $sOnLoadScript:"" ?>" onresize="wy_saveSize();">
<?php if (!$bDidSave) { ?>
		<div id="PageDiv" class="modelpoup">			  
			<input type="hidden" value="<?php echo $webyep_submenu; ?>">
			<div id="simplemodal" class="WYsimplemodal">
				<h1 class="simplemodal f-lp"><?php echo WYTS("MenuEditorTitle")?>: <span class="grey"><?php echo $oEditor->sFieldName; ?></span></h1>
				<div id="WebYeplogo">
					<img src="../images/webyep-logo.png" alt="WebYeplogo" style="float:left; width:auto">
				</div>
				<div id="WY-simple-modal-header"></div>
				<div id="wy-simple-modal-footer" class="WYcenteralign">
					<p class="f-fp f-lp">
                    	<input class="WYmainbuttons r3 t2" id="WY_EditorButtonSave" type="button" value="<?php WYTSD("SaveButton", true); ?>" />
                    	<?php if($webyep_sModalWindowType == 'mootools' || $webyep_sModalWindowType == 'scriptaculous'){?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hide();">
                <?php }elseif($webyep_sModalWindowType == 'jquery'){?>
                <input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="parent.wySMLink.hideModal();">
				<?php }
				else{?>
				<input type="button" id="cancel" class="WYmainbuttons r2" value="<?php WYTSD("CancelButton", true); ?>" onclick="window.close();">
				<?php }?>                       
                         
                         
                     
                    </p>
					<div class="WYhelp">
						 <p class="WYhelpstyle">
						 <!-- <a href="/webyep-system/program/help/english/access-denied.php">HELP ?</a> -->
						<?php echo $goApp->sHelpLink($sHelpFile); ?>
						</p>
					</div>
				</div>
				<div id="WY-Debug-Message" class="WYwarning">
					<?php if ($webyep_bDebug) echo '<p>WebYep Debug Mode<em>!</em></p>'; ?>
				</div>
				<div class="WYobd-link">
					<p><a href="<?php echo $webyep_sCompanyLink?>" target="_blank"> <?php echo $webyep_sCompanyName?> </a>
					</p>
				</div>
				<div id="contTwrap">
					<div id="contT">
						<div id="col1">
							<div id="controls">
                            	<a href="#" id="WY_EditMenuAddSibling" title="<?php WYTSD("MenuAddSiblingButtonTitle", true); ?>">
									<img id="navheading" src="../images/nav-heading.png" alt="navheading">
								</a>
								<a href="#" id="WY_EditMenuAddChild" title="<?php WYTSD("MenuAddChildButtonTitle", true); ?>">
									<img id="navsubheading" src="../images/nav-subheading.png" alt="navsubheading">
								</a>
								<a href="#" id="WY_EditMenuDelete" title="<?php WYTSD("MenuRemoveButtonTitle", true); ?>">
									<img id="navdelete" src="../images/nav-delete.png" alt="navdelete">
								</a>&nbsp;
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="WY_EditForm" style="display:none;">
                                    <div>
                                        <textarea name="WY_EditorPostArea" id="WY_EditorPostArea" rows="1" cols="1"></textarea>
                                        <?php echo WYEditor::sHiddenFieldsForElement($oElement); ?>
                                        <?php echo $oHFURL->sDisplay(); ?>
                                    </div>
                                </form> 
                                <table class="aligncenter" style="float:left; border-spacing:0px">
									<tr>
										<td rowspan=2 style="width:28px; vertical-align:middle">
											<p class="f-fp f-lp">
												<a href="#" id="WY_EditorButtonLeft">
													<img id="navleft" src="../images/nav-left.png" alt="">
												</a>
											</p>
										</td>
										<td style="width:28px; height:24px; vertical-align:top">
											<p class="f-fp f-lp">
												<a id="WY_EditorButtonUp">
													<img id="navup" src="../images/nav-up.png" alt="">
												</a>
											</p>
										</td>
										<td rowspan=2 style="width:28px; vertical-align:middle">
											<p class="f-fp f-lp">
												<a href="#" id="WY_EditorButtonRight">
													<img id="navright" src="../images/nav-right.png" alt="">
												</a>
											</p>
										</td>
									</tr>
									<tr>
										<td style="width:28px; height:22px; vertical-align:bottom">
											<p class="f-fp f-lp">
												<a href="#" id="WY_EditorButtonDown">
													<img id="navdown" src="../images/nav-down.png" alt="">
												</a>
											</p>
										</td>
									</tr>
								</table>
							</div>
							<p class="f-fp arrowdownafter"><?php WYTSD("MenuEditorMenuTitle"); ?> <!-- <span class="arrowdown"></span>
								 <img id="arrowdown1" src="../images/arrow-down.png" alt=""> -->
							</p>
							<p style="margin-bottom:8px">
							<input id="WY_EditMenuTitle" class="WYtextfield r3 WYinput1" style="margin-bottom:3px" type=text name="WYEditMenuTitle" placeholder="...">
							<span class="linkinstruction" style="opacity:1">Add a double forward slash  <span class="red">//</span> to force a line break</span>
							</p>
							
							<p class="arrowdownafter"><?php WYTSD("MenuEditorMenuLink"); ?> <!-- <span class="arrowdown"></span> 
								<img id="arrowdown2" src="../images/arrow-down.png" alt=""> -->
							</p>
							<p>
								<input id="WY_EditMenuLink" class="WYtextfield r3 WYinput2" type=text name="WYEditMenuLink" style="width:100%;height:28px;-webkit-box-sizing:border-box; -moz-box-sizing:border-box; box-sizing:border-box; overflow: auto; margin:5px 0 15px 0" placeholder="...">
							</p>
							<p class="f-lp">
								<input id="WY_EditMenuVisible" type="checkbox" class="css-checkbox" checked="checked">
								<label for="WY_EditMenuVisible" class="css-label css-label-nomargin"></label>
								<span class="arrowleftbefore"></span>
								<!-- <img id="arrowleft" src="../images/arrow-left.png" alt=""> --> <?php WYTSD("MenuEditorMenuVisible"); ?></p>
								<p class="f-lp mt10" style="">
									<input id="WY_EditMenuExternal" type="checkbox" class="css-checkbox" value="ako">
									<label for="WY_EditMenuExternal" class="css-label css-label-nomargin"></label>
								<span class="arrowleftbefore"></span> <?php WYTSD("DisableWebYepPageInstance"); ?><br>
								<span class="linkinstruction">Add a forward slash '/' after the URL, only if NO specific page is specified.<br>
Example:- <span class="blue">http://www.apple.com</span> would become <span class="blue">http://www.apple.com</span><span class="red">/</span></p>
						</div>
						<div id="WY_EditArea" class="r3">
							<ul id="WY_InsertMenuItemsHere" class="f-fp f-lp sortable">
								<li>menu entries go here</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else { echo "<blockquote>"; echo "<div class='response'>$sResponse</div>"; if ($bOK) echo WYEditor::sPostSaveScript(); else echo "<p class='textButton'>" . webyep_sBackLink() . "</p>"; echo "</blockquote>"; } 
	?>

</body>
</html>
