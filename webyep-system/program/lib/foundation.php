<?php
// WebYep
// (C) Objective Development Software GmbH
// http://www.obdev.at

define("od_nil", NULL); // NULL object

function webyep_array_insert(&$array, $pos, $value) {
    $last = array_splice($array, $pos);
    array_push($array, $value);
    $array = array_merge($array, $last);
}

function webyep_strpos_backwards($haystack, $needle, $offset = 0) {
    $length = strlen($haystack);
    $offset = ($offset > 0) ? ($length - $offset) : abs($offset);
    $pos = strpos(strrev($haystack), strrev($needle), $offset);
    return ($pos === false) ? false : ($length - $pos - strlen($needle));
}


function webyep_str_murks($s) {
    return strtr($s, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", "nopqrstuvwxyzabcdefghijklmNOPQRSTUVWXYZABCDEFGHIJKLM");
}

function webyep_sBackLink() {
    $s = "<a href='javascript:window.history.back()'>";
    $s .= WYTS("BackLink");
    $s .= "</a>";
    return $s;
}

// Now it's getting weird: We need to have a od_clone() function in PHP4
// to be compatible with PHP5 - but PHP5 must not see this function def!!!
// Thanx to Steven Wittens for the hint!
if (preg_match("|^8|", phpversion())) {
	eval('function od_clone($o) { return $o === od_nil ? od_nil:clone $o; }');
} elseif(preg_match("|^7|", phpversion())) {
	eval('function od_clone($o) { return $o === od_nil ? od_nil:clone $o; }');
} elseif (preg_match("|^5|", phpversion())) {
   eval('function od_clone($o) { return $o === od_nil ? od_nil:clone($o); }');
} else {
   eval('function od_clone($o) { return $o; }');
}

function webyep_aScanDirectory ($sDir, $sPattern = "") { // use WYPath instead of string? 
    if ($dh = opendir($sDir)) {
        while (false !== ($filename = readdir($dh))) {
            if ($filename != "." && $filename != "..") {
                if ($sPattern) {
                    if (preg_match("|".$sPattern."|", $filename)) {
                        $aFiles[] = $filename;
                    }
                } else {
                    $aFiles[] = $filename;
                }
            }
        }
        closedir($dh);
    }

    return $aFiles;
}

// check for file managers (session handling)
function webyep_bHasFilemanager() {
    global $goApp;
    $oOptPath = od_clone($goApp->oProgramPath);
    $oOptPath->addComponent("opt");
    $aFileManagers = array('ckfinder', 'filemanager', 'tinymce/jscripts/tiny_mce/plugins/imagemanager');
    foreach ($aFileManagers as $fileManager) {
        $oOptPath->addComponent($fileManager);
        if ($oOptPath->bExists()) {
            return true;
        } else {
            $oOptPath->removeLastComponent();
        }
    }
    return false;
}
?>
