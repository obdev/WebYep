//Model window for login 
window.wySM;
opendModelWindow = function(sTitle, sUrl ){			
		//init model window to 
		var SM = new SimpleModal({"hideHeader":false, "closeButton":true, "hideFooter":true, 'width':405, 'height':225});
		wySM = SM;
		SM.show({
			'title':sTitle,
			'contents':'<iframe src="'+sUrl+'" width="405" height="225" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
			});			
	return false;
}

//Model window for value eiditors
window.wySMLink; 
WYPopupWindowLinkMW = function(oURL, sName, iW, iH){
	var SMLink = new SimpleModal({"hideHeader":true, "closeButton":true, "hideFooter":true, "width":parseInt(iW), "height":parseInt(iH)});
	window.wySMLink = SMLink;
	SMLink.show({
			'title':sName,
			'contents':'<iframe src="'+oURL+'" width="'+parseInt(iW)+'" height="'+parseInt(iH)+'" frameborder="0"></iframe>'			
			});		
	return false;	
}

//Opend login model window if session expired
if(typeof(openLogonModelWindow) != 'undefined' && openLogonModelWindow == 'yes'){
	var $ = document.id;
	window.addEvent('domready', function(e){
		var SM = new SimpleModal({"hideHeader":true, "closeButton":true, "hideFooter":true, 'width':440, 'height':340});
		SM.show({
			'title':'WebYepLogon',
			'contents':'<iframe src="'+openLogonModelWindowUrl+'" width="400" height="300" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
			});
	});
}

///Opend Model window for gallery
window.wySMGallery;
WYPopupWindowGalleryMW = function(oURL, sName, iW, iH){			
	var SMGal = new SimpleModal({"hideHeader":true, "closeButton":true, "hideFooter":true, 'width':(parseInt(iW)-40), 'height':(parseInt(iH)-40)});
	window.wySMGallery = SMGal;
	SMGal.show({
		"model":"modal-ajax",
		"title":sName,
		"param":{
			"url":oURL
		}
	});
	return false;	
}

//Open Model Window for Alert
window.wySMAlert; 
WYPopupWindowAlertMW = function(oText, sName, iW, iH){ 
	var SMAlr = new SimpleModal({"hideHeader":true, "closeButton":true, "hideFooter":true, 'width':parseInt(iW), 'height':(iH)});
	window.wySMAlert = SMAlr;
	SMAlr.show({
          "title":sName,
          "contents":oText
	});
	return false;	
}
