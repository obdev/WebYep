<?php
// common.php
include_once("$webyep_sIncludePath/lib/WYLanguage.php");

$languageFile = "$webyep_sIncludePath/../lstrings.dat";
$language = new WYLanguage($languageFile);

if (!function_exists('WYTSD')) {
    function WYTSD($key, $echo = false) {
        global $language;
        $translation = $language->getTranslation($key);
        if ($echo) {
            echo $translation;
        } else {
            return $translation;
        }
    }
}
?>
