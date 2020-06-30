/* =================================
------------------------------------
	Template Name: Industry.INC
	Description: Industry.INC HTML Template
	Author: colorlib
	Author URI: https://www.colorlib.com/
	Version: 1.0
	Created: colorlib
 ------------------------------------
 ====================================*/


'use strict';

$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");


});

(function($) {
	/*------------------
		Navigation
	--------------------*/
	$('.site-nav-menu > ul').slicknav({
		appendTo:'.header-section',
		closedSymbol: '<i class="fa fa-angle-down"></i>',
		openedSymbol: '<i class="fa fa-angle-up"></i>',
		allowParentLinks: true
	});

	$('.slicknav_nav').append('<li class="search-switch-warp"><button class="search-switch"><i class="fa fa-search"></i></button></li>');

	/*------------------
		find pro model
	--------------------*/
	$('.accord-header-find-white').on('click', function() {
		if ($(this).hasClass('ft-accord-hide')) {
			$(this).removeClass('ft-accord-hide');
			$(this).addClass('ft-accord-show');
			$(this).find('span.icon-arrow-up-accord').removeClass('display-hidden');
			$(this).find('span.icon-arrow-down-accord').addClass('display-hidden');
		}
		else if ($(this).hasClass('ft-accord-show')) {
			$(this).removeClass('ft-accord-show');
			$(this).addClass('ft-accord-hide');
			$(this).find('span.icon-arrow-up-accord').addClass('display-hidden');
			$(this).find('span.icon-arrow-down-accord').removeClass('display-hidden');
		}
	});
	/*------------------
		Search model
	--------------------*/
	$('.search-switch').on('click', function() {
		$('.search-model').fadeIn(400);
	});

	$('.search-close-switch').on('click', function() {
		$('.search-model').fadeOut(400,function(){
			$('#search-input').val('');
		});
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});


	/*------------------
		Hero Slider
	--------------------*/
	$('.hero-slider').owlCarousel({
		autoplayHoverPause: true,
		nav: true,
		dots: false,
		loop: false,
		rewind:true,
		slideSpeed : 12000,
		autoplaySpeed:12000,
		autoplayTimeout:9000,
		navText: ['<i class="fa fa-angle-left play"></i>','<i class="fa fa-angle-right play"></i>'],
		autoplay: true,
		items: 1,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
	});


	$('.pricing-mobile-slider').owlCarousel({
		autoHeight: true,
		autoplayHoverPause: false,
		nav: true,
		dots: false,
		loop: false,
		slideSpeed : 12000,
		autoplaySpeed:1200000,
		autoplayTimeout:9000000,
		navText: ['<i class="fa fa-angle-left play"></i>','<i class="fa fa-angle-right play"></i>'],
		autoplay: false,
		items: 1,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
	});

	$('.play').on('click',function(){
	    $('.hero-slider').trigger('play.autoplay',[1000])
	})

	$('.stop').on('click',function(){
	    $('.hero-slider').trigger('stop.autoplay')
	})
	/*------------------
		Hero Slider homepage signup
	--------------------*/
	$('.hero-slider-signup').owlCarousel({
		autoplayHoverPause: false,
		nav: false,
		dots: false,
		loop: true,
		autoplay: true,
		items: 1,
		animateOut: 'fadeOut',
    	animateIn: 'fadeIn',
	});

	/*------------------
		Brands Slider
	--------------------*/
	$('#client-carousel').owlCarousel({
		nav: false,
		loop: true,
		margin:20,
		autoplay: true,
		responsive:{
			0:{
				items:2,
				margin: 0
			},
			600:{
				items:3
			},
			800:{
				items:4
			},
			992:{
				items:4
			},
			1200:{
				items:5
			},
		}
	});

	/*---------------------
		Testimonial Slider
	----------------------*/
	$('.testimonial-slider').owlCarousel({
		nav: false,
		dots: true,
		loop: true,
		autoplay: true,
		items: 1,
	});

	/*------------------
		Image Popup
	--------------------*/
	$('.video-popup').magnificPopup({
		type: 'iframe'
	});

	/*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').parent('.panel-header').removeClass('active');
		var $this = $(this).parent('.panel-header');
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});

	/*------------------
		Progress Bar
	--------------------*/
	$('.progress-bar-style').each(function() {
		var progress = $(this).data("progress");
		var prog_width = progress + '%';
		if (progress <= 100) {
			$(this).append('<div class="bar-inner" style="width:' + prog_width + '"><span>' + prog_width + '</span></div>');
		}
		else {
			$(this).append('<div class="bar-inner" style="width:100%"><span>' + prog_width + '</span></div>');
		}
	});

	/*------------------
		Circle progress
	--------------------*/
	$('.circle-progress').each(function() {
		var cpvalue = $(this).data("cpvalue");
		var cpcolor = $(this).data("cpcolor");
		var cpid 	= $(this).data("cpid");

		$(this).prepend('<div class="'+ cpid +' circle-warp"><h2>'+ cpvalue +'%</h2></div>');

		if (cpvalue < 100) {

			$('.' + cpid).circleProgress({
				value: '0.' + cpvalue,
				size: 112,
				thickness: 3,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		} else {
			$('.' + cpid).circleProgress({
				value: 1,
				size: 112,
				thickness: 3,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		}

	});

	/*------------------
		Feature Hover
	--------------------*/

	$(".group-feature").hover(
		function(){
			var key = $(this).attr("data-key");
			$(".group-"+key).addClass("group-feature-text");
		},
		function(){
			var key = $(this).attr("data-key");
	  		$(".group-"+key).removeClass("group-feature-text");
		}
	);

})(jQuery);
