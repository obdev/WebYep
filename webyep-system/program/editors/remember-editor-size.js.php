<?php
		$WYEditor_sWC = $WYEditor_sHC = "";
		$oElement->getSizeCookieNames($WYEditor_sWC, $WYEditor_sHC);
?>
<script type="text/javascript">
function wy_oGetWindowSize()
{
	var iW, iH;

	iW = iH = 0;
	if (window.outerWidth) {
		iW = window.outerWidth;
		iH = window.outerHeight;
	}
	else if (document.documentElement && document.documentElement.clientWidth) {
		iW = document.documentElement.clientWidth;
		iH = document.documentElement.clientHeight;
	}
	else if (document.body.clientWidth) {
		iW = document.body.clientWidth;
		iH = document.body.clientHeight;
	}

	return {width: iW, height: iH};
}

function wy_saveSize()
{
	var oDim;
	oDim = wy_oGetWindowSize();
	document.cookie = "<?php echo $WYEditor_sWC?>=" + oDim.width + "; path=/";
	document.cookie = "<?php echo $WYEditor_sHC?>=" + oDim.height + "; path=/";
}

function wy_restoreSize()
{
	var oDim, iW, iH;
	iW = <?php echo isset($_COOKIE[$WYEditor_sWC]) ? (int)$_COOKIE[$WYEditor_sWC]:0 ?>;
	iH = <?php echo isset($_COOKIE[$WYEditor_sHC]) ? (int)$_COOKIE[$WYEditor_sHC]:0 ?>;
	if (iW>0 && iH>0) {
		oDim = wy_oGetWindowSize();
		window.resizeBy(iW - oDim.width, iH - oDim.height);
	}
}
</script>
