// JavaScript Document
$(document).ready(function() {
	stickFooter();
	$(window).resize(function() {
		stickFooter();
	});
	
});
function stickFooter() {
	var hHeight =  $("#main-navbar").height();
	var fHeight = $("#footer").innerHeight();
	var winHeight = $(window).innerHeight();
	$("body > .wrap").css({"padding-bottom": fHeight + 20, "padding-top": hHeight  });
	$("body > .wrap").css({"min-height": winHeight });
}