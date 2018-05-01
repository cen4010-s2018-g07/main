$(document).ready(function() {

	$window = $(window);
	$body = $('body');
	
	// Show confirmation for Remove Single Product
	$(".ct-removeSingle").on( "click", function(event) {
		event.preventDefault();
		$(this).parents('form').removeAttr('class').addClass('trolley-conf-single-in');
	});

	// Hide confirmation for Remove Single Product
	$(".ct-singleRemoveCancel").on( "click", function(event) {
		event.preventDefault();
		$(this).parents('form').removeAttr('class').addClass('trolley-conf-single-out');
	});
	
	// Remove Single Product
	$(".ct-singleRemoveOK").on( "click", function(event) {
		event.preventDefault();
		$(this).parents('form').removeAttr('class');
		$(this).parents('.prodListDisplay').addClass('trolley-remove-product');
	});
  
});