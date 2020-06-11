jQuery(function($) {

	"use strict";

	var win = $(window);
	var doc = $(document);

	/*----------------------/
	/* MAIN NAVIGATION
	/*---------------------*/

	win.on('scroll', function() {
		if(win.width() > 1199) {
			if(doc.scrollTop() > (win.height() / 2)) {
				setNavbarLight();
			}else {
				setNavbarTransparent();
			}
		}
	});

	function toggleNavbar() {
		if((win.width() > 1199) && (doc.scrollTop() <= win.height())) {
			setNavbarTransparent();
		} else {
			setNavbarLight();
		}
	}

	toggleNavbar();

	win.on('resize', function() {
		toggleNavbar();
	});

	/* Navbar Setting */
	function setNavbarLight() {
		$('.navbar').addClass('navbar-light');
	}

	function setNavbarTransparent() {
		$('.navbar').removeClass('navbar-light');
	}

	// Hide Collapsible Menu
	if($(window).width() < 1200) {
		$('.navbar li.menu-item-has-children > a').siblings('.sub-menu').slideDown();
		$('.navbar li.menu-item-has-children > a').siblings('.sub-menu').slideUp();
		$('.navbar li.menu-item-has-children > a').on("touch click", function(e) {
			e.preventDefault();
			$(this).siblings('.sub-menu').slideToggle();
			e.stopPropagation();
		});
	}

	$('#main-nav li a').addClass('nav-link');

	$('body').scrollspy({
		target: '#main-nav'
	});

	$('body').localScroll({
		duration: 2000,
		easing: 'easeInOutExpo',
		offset: 0
	});

	var wow = new WOW();

	wow.init();

	$(".owl-carousel").owlCarousel({

      loop: true,
		stagePadding: 30,
    	smartSpeed: 1000,
		autoplay: true,
		items: 1

	});

	/*----------------------/
	/* MAIN TOP SUPERSIZED
	/*---------------------*/

	if($('.main-top').length > 0) {
		if ($('[data-parallax-images]').length ) {
			var parallax_images = $('[data-parallax-images]').data('parallax-images');

			$.supersized({

				// Functionality
				autoplay: 1,				// Slideshow starts playing automatically
				slide_interval: 5000,		// Length between transitions
				transition: 1, 				// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed: 3000,		// Speed of transition

				// Components
				slide_links: 'blank',		// Individual links for each slide (Options: false, 'num', 'name', 'blank')
				thumb_links: 0,				// Individual thumb links for each slide
				slides:  parallax_images,
			});
		}

	} else {
		$('#supersized-loader, #supersized').hide();
	}

	/*----------------------/
	/* WORKS
	/*---------------------*/

	/* Init Isotope */

	var $container = $('.isotope');
	$(".work-item").hide();

	win.load(function() {
	  $container.isotope({
	   itemSelector: '.work-item'
		});
	});

	// Filter functions
	var filterFns = {
		// Show if number is greater than 50
		numberGreaterThan50: function() {
		  var number = $(this).find('.number').text();
		  return parseInt(number, 10) > 50;
		},
		// Show if name ends with -ium
		ium: function() {
		  var name = $(this).find('.name').text();
		  return name.match(/ium$/);
		}
	};

	// Bind filter button click
	$('.essential-projects-filter').on('click', 'a', function() {
		if($('.isotope')[0] && typeof essential_load_more_posts !== 'undefined') {
			if($(".essential-purchase").is(":visible")) {
			 	var filterValue = $(this).attr('data-filter') + ':nth-child(-n+' + totalPostsPerPage + ')';
			}else{
				var filterValue = $(this).attr('data-filter');
			}
		}
		// use filterFn if matches value
		filterValue = filterFns[ filterValue ] || filterValue;
		$container.isotope({ filter: filterValue });
	});

	// Change is-checked class on buttons
	$('.filter_group').each( function(i, buttonGroup) {
		var $buttonGroup = $(buttonGroup);
		$buttonGroup.on('click', 'a', function() {
		  $buttonGroup.find('.active').removeClass('active');
		  $(this).addClass('active');
		});
	});

	var originalTitle, currentItem;

	$('.isotope').magnificPopup({
		delegate: '.media-popup',
		type: 'image',
		gallery: {
		   enabled: false
		 },
		callbacks: {
			beforeOpen: function() {
				// modify item title to include description
				currentItem = $(this.items)[this.index];
				originalTitle = currentItem.title;
				currentItem.title = '<h3>' + originalTitle + '</h3><hr />' + '<p>' + $(currentItem).parents('.work-item').find('img').attr('alt') + '</p>';

				// adding animation
				this.st.mainClass = 'mfp-fade';
			},
			close: function() {
				currentItem.title = originalTitle;
			}
		}

	});

	if($('.isotope')[0] && typeof essential_load_more_posts !== 'undefined') {
	 // The number of posts to show
	 var totalPostsPerPage = parseInt(essential_load_more_posts.totalPostsPerPage);

	 // The number of total posts
	 var totalPosts = parseInt(essential_load_more_posts.totalPosts);

	 // Load more button
	 var loadMore = essential_load_more_posts.loadMore;

	 $(".isotope .work-item").slice(0, totalPostsPerPage).show();
	}

	// Button click
	$('.load-more').on('click', function (e) {
		$(this).html('Loading...');

		$(".isotope .work-item").slice(0, totalPosts).show();

		$container.isotope();

		$(".essential-purchase").fadeOut('fast');

		return false;
	});

	/*----------------------/
	/* SCROLL TO TOP
	/*---------------------*/

	if(win.width() > 992) {
		win.scroll(function() {
			if($(this).scrollTop() > 300) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});

		$('.back-to-top').on('click', function(e) {
			e.preventDefault();

			$('body, html').animate({
				scrollTop: 0
			}, 1500);
		});
	}

	if(!navigator.userAgent.match("Opera/")) {
		$('body').scrollspy({
			target: '#main-nav'
		});
	}else{
		$('#main-nav .nav li').removeClass('active');
	}

	/* wp */
	var counters = function() {
		$(".countTo").not('.animated').each(function(){
			if($(window).scrollTop() >= $(this).offset().top-$(window).height()*0.7 ) {
				$(this).addClass('animated').countTo();
			}
		});
	}

	$(window).on('scroll',function(){
		counters();
	});

	function essential_add_img_bg( img_sel, parent_sel){

	    if (!img_sel) {
	        console.info('no img selector');
	        return false;
	    }

	    var $parent, $neighbor, $imgDataHidden, $imgDataSibling, _this;

	    $(img_sel).each(function(){
	        _this = $(this);
	        $imgDataHidden = _this.data('s-hidden');
	        $imgDataSibling = _this.data('s-sibling');
	        $parent = _this.closest( parent_sel );
	        $parent = $parent.length ? $parent : _this.parent();

	        if ($imgDataSibling) {
	            $parent.addClass('s-back-sibling-switch');
	            $neighbor = _this.next();
	            $neighbor = $neighbor.length ? $neighbor : _this.next();
	            $neighbor.css( 'background-image' , 'url(' + this.src + ')' ).addClass('s-sibling-switch');
	        }
	        else {
	            $parent.css( 'background-image' , 'url(' + this.src + ')' ).addClass('s-back-switch');
	        }

	        if ($imgDataHidden) {
	            _this.css('visibility', 'hidden');
	        } else {
	            _this.hide();
	        }
	    });
	}

	/***********************************/
	/* BACKGROUND */
	/**********************************/
	//sets child image as a background
	function wpc_add_img_bg( img_sel, parent_sel){

	    if (!img_sel) {
	        console.info('no img selector');
	        return false;
	    }

	    var $parent, $neighbor, $imgDataHidden, $imgDataSibling, _this;

	    $(img_sel).each(function(){
	        _this = $(this);
	        $imgDataHidden = _this.data('s-hidden');
	        $imgDataSibling = _this.data('s-sibling');
	        $parent = _this.closest( parent_sel );
	        $parent = $parent.length ? $parent : _this.parent();

	        if ($imgDataSibling) {
	            $parent.addClass('s-back-sibling-switch');
	            $neighbor = _this.next();
	            $neighbor = $neighbor.length ? $neighbor : _this.next();
	            $neighbor.css( 'background-image' , 'url(' + this.src + ')' ).addClass('s-sibling-switch');
	        }
	        else {
	            $parent.css( 'background-image' , 'url(' + this.src + ')' ).addClass('s-back-switch');
	        }

	        if ($imgDataHidden) {
	            _this.css('visibility', 'hidden');
	        } else {
	            _this.hide();
	        }
	    });
	}


	if (typeof pageCalculations !== 'function') {

		var winW, winH, winS, pageCalculations, documentHeight, $html, latestKnownScrollY, lastKnownScrollY, onEvent = window.addEventListener;

		pageCalculations = function(func){

			winW = window.innerWidth;
            winH = window.innerHeight;
            winS = $(window).scrollTop();
            documentHeight = $(document).height(),
            $html = $('html');
            latestKnownScrollY = $(window).scrollTop(),
            lastKnownScrollY = latestKnownScrollY;

			if (!func) return;

			onEvent('load', func, true); // window onload
			onEvent('resize', func, true); // window resize
			//onEvent("orientationchange", func, false); // window orientationchange

		} // end pageCalculations

		pageCalculations(function(){
			pageCalculations();
		});

	}

	pageCalculations(function(){
		essential_add_img_bg('.s-img-switch');
		counters();
	});


	$(window).on('load resize orientationchange', function () {
		if($('.page404').length){
			page404();
		}
	})


	function page404() {
		if($(window).width() > 767){
			var bodyH = ($(window).height() - $('.section.social').outerHeight() - 10 - $('#footer').outerHeight() - $('.navbar').outerHeight());
			$('.not-founded.simple-article-block').css('height', bodyH);
		}else{
			var bodyH = ($(window).height() - $('.section.social').outerHeight() - $('#footer').outerHeight());
			$('.not-founded.simple-article-block').css('height', bodyH);
		}

	}

	if (typeof topPosition !== 'function' && typeof  pageCalculations === 'function') {


	        var selectorEl = '.admin-bar .navbar-fixed-top';

	        function setTopPosEl(px,winS){

	            // check scrollTop
	            px = winS ? (px - winS) : px;
	            // set Top Position
	            $(selectorEl).css({'top': px + 'px'});

	        }

	        function topPosition(){

	            // work from 601 px
	            if (winW > 601) {
	              ( winW < 769  && setTopPosEl(46) ) || setTopPosEl(32);
	            } else {
	            // work to 601 px
	              ( winS < 47 && setTopPosEl(46, winS) ) || setTopPosEl(0);
	            }

	        }

	        pageCalculations(function(){
	            topPosition();
	        });

	    }


});
