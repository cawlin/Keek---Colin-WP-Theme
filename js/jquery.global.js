
jQuery(document).ready(function($) {

    // Search popup
    $('.search > .icon-search').click(function(){
       	$('.search_popup').slideDown('', function() {});
     	$('.search > .icon-search').toggleClass('active');
     	$('.search > .icon-remove').toggleClass('active');
     });

     $('.search > .icon-remove').click(function(){
       	$('.search_popup').slideUp('', function() {});
     	$('.search > .icon-search').toggleClass('active');
     	$('.search > .icon-remove').toggleClass('active');
     });

    // Mobile menu
     $('.menubutton').click(function(){
       	$('header nav').slideToggle('', function() {});
     });

    // Responsive videos
    if (jQuery().fitVids) {
    	$(".post_video").fitVids();
	};
	
    // Gallery slider
    if (jQuery().flexslider) {
	    $('.flexslider').flexslider({
	        animation: "slide",
	        smoothHeight: true,
	    });
	};
});