// namespacing jQuery and all plugins loaded so far //
//var WY = window.WY || {}; WY.$ = jQuery.noConflict(true);

//Model window for login 
window.wySM;
opendModelWindow = function(sTitle, sUrl ){
		//init model window to 
		$.fn.SimpleModal({
			hideFooter: true,
			width:400,
			height:220,
			title: sTitle,
			model: 'modal',
			contents: '<iframe src="'+sUrl+'" width="400" height="220" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
		}).showModal();
		wySM = $.fn.SimpleModal();
	return false;
}

//Model window for value eiditors
window.wySMLink; 
WYPopupWindowLinkMW = function(oURL, sName, iW, iH){
	$.fn.SimpleModal({
			hideFooter: true,
			closeButton: true,
			width:iW,
			height:iH,
			title: '',
			model: 'modal',
			contents: '<iframe src="'+oURL+'" width="'+iW+'" height="'+iH+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
	}).showModal();
	wySMLink = $.fn.SimpleModal();
	return false;
}

//Open login model window if session expired
if(typeof(openLogonModelWindow) != 'undefined' && openLogonModelWindow == 'yes'){
	WY.$(document).ready(function(e) {
		//init model window to 
		$.fn.SimpleModal({
			hideFooter: true,
			width:400,
			height:220,
			title: '',
			model: 'modal',
			contents: '<iframe src="'+openLogonModelWindowUrl+'" width="400" height="220" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
		}).showModal();
		wySM = $.fn.SimpleModal();
	});
}

///Opend Model window for gallery
window.wySMGallery;
WYPopupWindowGalleryMW = function(oURL, sName, iW, iH){
	$.fn.SimpleModal({
			hideFooter: true,
			width:iW,
			height:iH,
			title: sName,
			model: 'modal',
			contents: '<iframe src="'+oURL+'" width="'+iW+'" height="'+iH+'" frameborder="0" ></iframe>'
	}).showModal();
	
	wySMGallery = $.fn.SimpleModal();
	return false;	
}

//Open Model Window for Alert
window.wySMAlert; 
WYPopupWindowAlertMW = function(oText, sName, iW, iH){
	$.fn.SimpleModal({
			hideHeader: true,
			closeButton: false,
			width: iW,
			height: iH,
			title: sName,
			model: 'alert',
			contents: oText
		}).showModal();
	wySMAlert = $.fn.SimpleModal();
	return false;	
}
