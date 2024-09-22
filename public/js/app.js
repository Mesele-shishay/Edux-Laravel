"use strict"; // Start use strict
$(document).ready(function(){

	// Custom select Customize
	$('select').each(function () {
		if (!$(this).hasClass('swal2-select')) {
			$(this).select2({
			  theme: 'bootstrap4',
			  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			  placeholder: $(this).data('placeholder'),
			  allowClear: Boolean($(this).data('allow-clear')),
			  closeOnSelect: !$(this).attr('multiple'),
			});
		}

	});

	// Custom Start tool tips
	$('[data-toggle="tooltip"]').tooltip();

	// Scroll to top Button
	$("#sidebarToggleTop").on('click',function(){
		$("body").toggleClass("sidebar-toggled");
		$(".sidebar").toggleClass("toggled");
		if ($(".sidebar").hasClass("toggled")) {
			$('.sidebar .collapse').collapse('hide');
			$("#content").css("padding-left","0");
		}else{
			$("#content").css("padding-left","8.0rem");
		}
	});

	$(window).resize(function(){
		if ($(window).width() < 768) {
			$('.sidebar .collapse').collapse('hide');
			$("#content").css("padding-left","8.0rem");
			if ($(".sidebar").hasClass("toggled")) {
				$("#content").css("padding-left","0rem");
			}
		}
		if ($(window).width() < 468 && !$(".sidebar").hasClass("toggled")) {
			$("body").addClass("sidebar-toggled");
			$(".sidebar").addClass("toggled");
			$(".sidebar .collapse").collapse('hide');
			$("#content").css("padding-left","0rem");
		}

		if ($(window).width() > 768) {
			$("#content").css("padding-left","14.0rem");
			$("body").removeClass("sidebar-toggled");
			$(".sidebar").removeClass("toggled");
		}
	});

	// Prevent the content wrapper from scrolling when the fixed side navigation hovered over
	$('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
	  if ($(window).width() > 768) {
	    var e0 = e.originalEvent,
	      delta = e0.wheelDelta || -e0.detail;
	    this.scrollTop += (delta < 0 ? 1 : -1) * 30;
	    e.preventDefault();
	  }
	});

	// Scroll to top button appear
	$(document).on('scroll', function() {
	  var scrollDistance = $(this).scrollTop();
	  if (scrollDistance > 100) {
	    $('.scroll-to-top').fadeIn();
	  } else {
	    $('.scroll-to-top').fadeOut();
	  }
	});

	// Smooth scrolling using jQuery easing
	$(document).on('click', 'a.scroll-to-top', function(e) {
	  var $anchor = $(this);
	  $('html, body').stop().animate({
	    scrollTop: ($($anchor.attr('href')).offset().top)
	  }, 1000, 'easeInOutExpo');
	  e.preventDefault();
	});

	// Navbar shrink function
	var navBarShrink = function() {
		if ($(document).scrollTop() === 0) {
		    $('#mainNav').removeClass('navbar-shrink');
		} else {
		    $('#mainNav').addClass('navbar-shrink');
		}
	}

	// Shrink the Navbar
	navBarShrink();

	// Shrink the Navbar when page is scrolled
	$(document).scroll(function(){
		return navBarShrink();
	});

	// Print Page Tool
	$('#print_page').click(function (){
	   window.print();
	})

	$('.config-edit').click(function(){

		var currentInputId = this.id;
		var currentInputSettingName = $("#config-"+currentInputId).attr('name');
		var currentInputVal = $("#config-"+currentInputId).val();

		$(this).toggleClass("config-save");
		var child = $(this).children('i.fas');

		if (child.hasClass('fa-save')) {
			child.removeClass('fa-save').addClass("fa-edit");
			$("#config-"+currentInputId).attr('disabled',true);
			$.ajaxSetup({
				headers : {
					'X-CSRF-TOKEN' : $('#csrf-token').attr('content')
				}
			});

		  	Ajax .send(
		  	    '/ajax/config-edit',
		  	    {"configName" : currentInputSettingName,  "configValue" : currentInputVal},
		  	);

		} else if (child.hasClass('fa-edit')) {
			child.removeClass('fa-edit').addClass("fa-save");
			$("#config-"+currentInputId).attr('disabled',false);
		}

	});

});

