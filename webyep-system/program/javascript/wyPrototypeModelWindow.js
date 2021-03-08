//Model window for login 
window.wySM;
opendModelWindow = function(sTitle, sUrl ){
	 wySM = new SimpleModal({
		//hideHeader:true,
		hideFooter: true,
		width: parseInt(405),
	//	height: parseInt(225),
		title: sTitle,
		model: 'modal',
		contents: '<iframe src="'+sUrl+'" width="'+(parseInt(405)-20)+'" height="'+parseInt(225)+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
    });
	wySM.showModal();  		
	return false;
}

//Model window for value eiditors
window.wySMLink; 
WYPopupWindowLinkMW = function(oURL, sName, iW, iH){
	 var SMLink = new SimpleModal({
		//hideHeader:true,
		hideFooter: true,
		width: parseInt(iW),
	//	height: parseInt(iH),
		title: sName,
		model: 'modal',
		contents: '<iframe src="'+oURL+'" width="'+(parseInt(iW)-20)+'" height="'+(parseInt(iH)-10)+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
    });
    SMLink.showModal();
	window.wySMLink = SMLink;	
	return false;	
}


//Opend login model window if session expired
if(typeof(openLogonModelWindow) != 'undefined' && openLogonModelWindow == 'yes'){
	Event.observe(window, 'load', function(){
		wySM = new SimpleModal({
			//hideHeader:true,
			hideFooter: true,
			width: parseInt(405),
			model: 'modal',
			contents: '<iframe src="'+openLogonModelWindowUrl+'" width="'+(parseInt(405)-20)+'" height="'+parseInt(225)+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
		});
		wySM.showModal();  		
		return false
	});
	
}

///Opend Model window for gallery
window.wySMGallery;
WYPopupWindowGalleryMW = function(oURL, sName, iW, iH){
	var SMLinkGal = new SimpleModal({
		//hideHeader:true,
		hideFooter: true,
		width: parseInt(iW),
	//	height: parseInt(iH),
		title: sName,
		model: 'modal',
		contents: '<iframe src="'+oURL+'" width="'+(parseInt(iW)-20)+'" height="'+(parseInt(iH)-10)+'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
    });
    SMLinkGal.showModal();
	window.wySMGallery = SMLinkGal;	
	return false;
	
}

//Open Model Window for Alert
window.wySMAlert; 
WYPopupWindowAlertMW = function(oText, sName, iW, iH){	
	var SMAlr = new SimpleModal({
	  title: sName,
	  width:(iW-40), 
	  height:(iH-40),
      btn_ok: 'Close',
      contents: "<div style='padding:10px'>"+oText+"</div>"
    });
    SMAlr.showModal();
	
	window.wySMAlert = SMAlr;
	return false;	
}
