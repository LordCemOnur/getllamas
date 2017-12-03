// ==========================================================================
// Navbar Toggle
// ==========================================================================

$(function() {
	$('.header-nav__toggle').click(function() {
		toggleNav();
	});

	$('.search__input').keyup(function() {
		if ($('.search__input').val()) {
			$('.search__clear').css('display','block');
		}
		if ($('.search__input').val() == '') {
			$('.search__clear').css('display','none');
		}
	});

	$('.search__clear').click(function() {
		$('.search__input').val('');
		$('.search__clear').css('display','none');
	}); 
	if($('.accordion__group').css('background-color') == 'rgb(248, 248, 248)') {
		$('.panel-collapse:not(".in")').collapse('show');
		$('.panel-title a').attr('data-toggle','');
		$('.panel-title a').on('click', function(e) {
			e.preventDefault();
		});
	}

	var windowSize = $(window).width();
	var currentColor = 'rgb(0, 0, 0, 0)';
	$(window).resize(function() {
		if($(window).width() != windowSize) {
			if($('.accordion__group').css('background-color') == 'rgb(248, 248, 248)' && currentColor == 'rgb(0, 0, 0, 0)') {
				currentColor = 'rgb(248, 248, 248)';
				$('.panel-collapse').collapse('show').addClass('in').css('height','auto');
				$('.panel-title a').attr('data-toggle','');
				$('.panel-title a').on('click', function(e) {
					e.preventDefault();
				});
			}
			if($('.accordion__group').css('background-color') != 'rgb(248, 248, 248)' && currentColor == 'rgb(248, 248, 248)') {
				currentColor = 'rgb(0, 0, 0, 0)';
				$('.panel-collapse.in').collapse('hide');
				$('.panel-title a').attr('data-toggle','collapse');
				$('.panel-title a').on('click', function(e) {
					return true;
				});
			}
		}
	})

	$('#accordionGeneral').on('show.bs.collapse', function () {
    	$('#accordionGeneral .in').collapse('hide');
	});
	$('#accordionForum').on('show.bs.collapse', function () {
    	$('#accordionForum .in').collapse('hide');
	});
	$('#accordionBlog').on('show.bs.collapse', function () {
    	$('#accordionBlog .in').collapse('hide');
	});
	$('#accordionPurchase').on('show.bs.collapse', function () {
    	$('#accordionPurchase .in').collapse('hide');
	});
	$('#accordionFeatures').on('show.bs.collapse', function () {
    	$('#accordionFeatures .in').collapse('hide');
	});
	$('#accordionLicensing').on('show.bs.collapse', function () {
    	$('#accordionLicensing .in').collapse('hide');
	});
	$('#accordionCommunity').on('show.bs.collapse', function () {
    	$('#accordionCommunity .in').collapse('hide');
	});
	$('#accordionProducts').on('show.bs.collapse', function () {
    	$('#accordionProducts .in').collapse('hide');
	});
	$('#accordionCloud').on('show.bs.collapse', function () {
    	$('#accordionCloud .in').collapse('hide');
	});
	$('#accordionInstallation').on('show.bs.collapse', function () {
    	$('#accordionInstallation .in').collapse('hide');
	});
	$('#faqExpand').on('click', function(event) {
		$('.panel-collapse').collapse('show').addClass('in').css('height','auto');
		$('.panel-title a').removeClass('collapsed');
		event.preventDefault();
	});
	$('#faqCollapse').on('click', function(event) {
		$('.panel-collapse.in').collapse('hide');
		event.preventDefault();
	});

	/*CONTACT US PAGE - FORM */
	$('#contactFormToggle').on('click', function() {
		if ($('#contactForm').css('display') == 'none') {
			$('#contactForm').css('display','block');
		}
		else {
			$('#contactForm').css('display','none');
		}
	});
	$('#clearcontactbutton').on('click', function() {
		document.getElementById("contactForm").reset();
	});
	
	/*END CONTACT US PAGE - FORM */
	
	/**** Close navigation drawer when clicking outside of it ****/
	$('#site-wrapper').click(function(e){
		/**** This is to prevent interference with the hamburger menu and drawer functionality ****/
		if($(e.target).is('.header-nav__toggle') 
			|| $(e.target).parent().is('.header-nav__toggle') 
			|| $(e.target).is('#site-menu')
			|| $(e.target).parents('#site-menu').length == 1){
			return;
		}
		else if($(this).hasClass('show-nav')) {
			$(this).removeClass('show-nav');
		}
	});

});

function toggleNav() {
if ($('#site-wrapper').hasClass('show-nav')) {
	// Do things on Nav Close
	$('#site-wrapper').removeClass('show-nav');
	} else {
	// Do things on Nav Open
	$('#site-wrapper').addClass('show-nav');
	}
}

/* George Changes */

var links = jQuery('.vid-link');
links.each(function(){
	var link = this;
	jQuery(link).click(function(e){
		var href = jQuery(link).attr('href');
		if(href){
			var vidID = href.match(/v=([^&]+)/)[1];	
			BootstrapDialog.show({
				title: false,
				size: BootstrapDialog.SIZE_LARGE,
	            message: '<iframe width="100%" height="350px" src="http://www.youtube.com/embed/'+vidID+'?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>',
	        });
		}
		e.preventDefault();
		return false;
	});
});

function setLocation(url){
    window.location.href = url;
}