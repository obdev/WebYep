<?

   define("MAX_TRIES", 200);
   define("WEBYEP_SYSTEM_FOLDER", "./webyep-system");
   define("MAX_DEMO_LIFETIME", 3600*3);
   define("WEBYEP_DEMOSLOT_PREFIX", "demoslot_");

   if (!function_exists("file_put_contents")) {
	   function file_put_contents($sFN, $sC) {
		   $f = fopen($sFN, "w");
         fwrite($f, $sC);
         fclose($f);
	   }
   }

   function doGarbageCollection()
   {
      global $bDebug;
      $sLockFilePath = WEBYEP_SYSTEM_FOLDER . "/garbage_collection.lock";
      $rLockFile = fopen($sLockFilePath, "w");
      if (flock($rLockFile, LOCK_EX+LOCK_NB, $bWouldBlock) && !$bWouldBlock) {
	      set_time_limit(600);
	      $rDir = opendir(WEBYEP_SYSTEM_FOLDER);
	      while (($s = readdir($rDir)) !== false) {
		      if (preg_match('|daten_[0-9]+|', $s)) {
               $sFolderPath = WEBYEP_SYSTEM_FOLDER . "/$s";
			      $d = stat($sFolderPath);
			      if (time() - $d['mtime'] > MAX_DEMO_LIFETIME) {
				      if (!$bDebug) exec("rm -rf $sFolderPath");
				      else echo "Would remove $sFolderPath\n";
			      }
		      }
	      }
	      closedir($rDir);
      } else if ($bDebug) echo "Skipping GC\n";
      fclose($rLockFile);
   }

   function sNewSlotID()
   {
	   $sID = "";
	   for ($i = 0; $i < 4; $i++) {
		   $sID .= mt_rand(1000, 9999);
	   }
	   return $sID;
   }

   // when launched from obdev's website main, current dir is not scripts dir
   if (isset($_SERVER["PATH_TRANSLATED"])) chdir(dirname($_SERVER["PATH_TRANSLATED"]));

	if (isset($_GET["LANG"]) && $_GET["LANG"] == "de") $sLang = "de";
   else $sLang = "en";

   $bDebug = isset($_GET["DEBUG"]);

   doGarbageCollection();

   $iTries = 0;
   do {
	   $sSlotID = sNewSlotID();
		$sSlotFolderName = "daten_$sSlotID";
      $sSlotFolderPath = WEBYEP_SYSTEM_FOLDER . "/$sSlotFolderName";
      $iTries++;
   } while (file_exists($sSlotFolderPath) && $iTries < MAX_TRIES);

   if ($iTries < MAX_TRIES) {
      mkdir($sSlotFolderPath);
      chmod($sSlotFolderPath, 0777);
      $host = strlen($_SERVER['HTTP_HOST']) > 0 ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
      $sStartURL = "http://" . $host . "/" . WEBYEP_DEMOSLOT_PREFIX . "$sLang$sSlotID/";
      $sStartURL .= ($sLang == "en" ? "en/":"de/") . 'index.php';
   }
   else die("Demo can not be started - sorry.");

   if (!$bDebug) header ("Location: $sStartURL");
   else echo "Would redirect to $sStartURL\n";

?>
