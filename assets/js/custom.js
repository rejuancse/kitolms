// Custom js minify
jQuery(document).ready(function($){
    "use strict";
	
	// Script Show Calling Number
	$('#number').on('click', function() {
		var tel = $(this).data('last');
		$(this).find('span').html( '<a href="tel:' + tel + '">' + tel + '</a>' );
	});

	// Metis Menu
	$('#side-menu').metisMenu();
	
	// Tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Bottom To Top Scroll Script
	$(window).on('scroll', function() {
		var height = $(window).scrollTop();
		if (height > 100) {
			$('#back2Top').fadeIn();
		} else {
			$('#back2Top').fadeOut();
		}
	});
	
	
	// Script For Fix Header on Scroll
	$(window).on('scroll', function() {    
		var scroll = $(window).scrollTop();

		if (scroll >= 50) {
			$(".sticky-menu").addClass("header-fixed");
		} else {
			$(".sticky-menu").removeClass("header-fixed");
		}
	});
	
	
	// location Slide
	$('.slide_items').slick({
	  slidesToShow:3,
	  arrows: true,
	  dots: true,
	  infinite: true,
	  speed: 600,
	  cssEase: 'linear',
	  autoplaySpeed: 2000,
	  autoplay:false,
	  responsive: [
		{
		  breakpoint: 1024,
		  settings: {
			arrows: true,
			dots: true,
			slidesToShow:2
		  }
		},
		{
		  breakpoint: 600,
		  settings: {
			arrows: true,
			dots: true,
			slidesToShow:1
		  }
		}
	  ]
	});
	
	
	
});