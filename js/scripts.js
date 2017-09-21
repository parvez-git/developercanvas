/**
 * Main JavaScript File.
 */
jQuery(document).ready(function($){

	"use strict";

	// MASONRY
	jQuery('.grid').masonry({
	    itemSelector: '.grid-item',
	});

	// SMOOTHSCROLL
	jQuery('nav.navbar a').smoothScroll();

});



jQuery(window).scroll(function () {

	if (jQuery(window).scrollTop() > 70) {
		jQuery('nav.navbar.navbar-default').addClass('navbar-fixed-top');
	}
	if (jQuery(window).scrollTop() < 71) {
		jQuery('nav.navbar.navbar-default').removeClass('navbar-fixed-top');
	}

});
