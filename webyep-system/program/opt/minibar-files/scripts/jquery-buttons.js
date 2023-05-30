$(document).ready(function() {
var mouseX = 0;
var mouseY = 0;
$("#mytext").mousemove(function(e) {
// track mouse position
mouseX = e.pageX;
mouseY = e.pageY;
});
$("#mytext").mousedown(function() {
	// fade the menu away if mouse down 
 $("#menu").fadeOut("1000");
});
// get the mouse position and show the menu
$("#mytext").select(function() {
if ($('#inlinemenu').prop('checked')){
	$("#menu").css("top", mouseY - 44).css("left", mouseX + 0).css("z-index", 100).show().fadeIn("1000");
}
});


// Begining of webyep popup menu buttons //

// 1 DO NOT ADJUST THIS BUTTON //
	$("#bold").click(function() {
		formatText(document.getElementById('mytext'),'<BOLD ','>')
			$("#menu").fadeOut("1000");
	});

// 2 wrap selected text in a WebyYep tag //
	$("#italic").click(function() {
		formatText(document.getElementById('mytext'),'<em> ','</em>')
			$("#menu").fadeOut("1000");
	});

// 3 wrap selected text in a WebyYep tag //
	$("#h1").click(function() {
		formatText(document.getElementById('mytext'),'<h1> ','</h1>')
			$("#menu").fadeOut("1000");
	});

// 4 wrap selected text in a WebyYep tag //
	$("#h2").click(function() {
		formatText(document.getElementById('mytext'),'<h2> ','</h2>')
			$("#menu").fadeOut("1000");
	});


// 5 wrap selected text in a WebyYep tag //
	$("#h3").click(function() {
		formatText(document.getElementById('mytext'),'<h3> ','</h3>')
			$("#menu").fadeOut("1000");
	});

// 6 wrap selected text in a WebyYep tag //
	$("#h4").click(function() {
		formatText(document.getElementById('mytext'),'<h4> ','</h4>')
			$("#menu").fadeOut("1000");
	});

// 7 wrap selected text in a WebyYep tag //
	$("#h5").click(function() {
		formatText(document.getElementById('mytext'),'<h5> ','</h5>')
			$("#menu").fadeOut("1000");
	});

// 8 DO NOT ADJUST THIS BUTTON  //
	$("#link").click(function() {
		var url = prompt("Enter URL", "http://");
		if (url != null && url != "")
			formatText(document.getElementById('mytext'),'<LINK:' + url + ' ','>')
			$("#menu").fadeOut("1000");
	});
	
//End of webyep popup menu buttons// 	

});

//End of WebYep inline popup menu

