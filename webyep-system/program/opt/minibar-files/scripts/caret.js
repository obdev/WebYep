function formatText(el, tagstart, tagend){  	
	if (el.setSelectionRange) {
		el.value = el.value.substring(0,el.selectionStart) + tagstart + el.value.substring(el.selectionStart,el.selectionEnd) + tagend + el.value.substring(el.selectionEnd,el.value.length)
	}else{
		var selectedText = document.selection.createRange().text; 
         
		if (selectedText != "") { 
			var newText = tagstart + selectedText + tagend; 
			document.selection.createRange().text = newText; 
		}
	}		
}