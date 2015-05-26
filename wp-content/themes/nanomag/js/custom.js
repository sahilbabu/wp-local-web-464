jQuery(document).ready(function ($) {
"use strict";

//////////////////////////////////////////////////////////////////////////
//              Review
//////////////////////////////////////////////////////////////////////////
$(".post_review_bar").knob();

//////////////////////////////////////////////////////////////////////////
//              Scroll box
//////////////////////////////////////////////////////////////////////////
$('.scroll_list_post').slimScroll({color: '#FFF', size: '7px', height: 'auto', alwaysVisible: true});

//////////////////////////////////////////////////////////////////////////
//				Infinite Scroll
//////////////////////////////////////////////////////////////////////////
 var $container = $('#content_masonry');
  $container.infinitescroll({
    navSelector  : "div.pagination-more",            
    nextSelector : "div.more-previous a",                   
    itemSelector : "#content_masonry div.loop-post-content",
	 loading: {
          msgText: "",
          finishedMsg: '<span>No more posts to load.</span> <style type="text/css">.pagination-more{ display:none !important;}</style>'
        }
		},

      function( newElements ) {
jQuery().waypoint && (jQuery(".appear_animation").waypoint(function () {
        if (!jQuery(this).hasClass("animate_css_stlye animate_start")) {
            var e = jQuery(this);
            setTimeout(function () {
                e.addClass("animate_css_stlye animate_start")
            }, 20)
        }
    }, {
        offset: "85%",
        triggerOnce: !0
    }));

$(".post_review_bar").knob();
  });  

    jQuery(window).unbind('.infscr');
	jQuery('div.more-previous a').click(function(){jQuery('#content_masonry').infinitescroll('retrieve');
	return false;
	});

//Grid more

 var $container = $('#content_masonry_grid');
  $container.infinitescroll({
    navSelector  : "div.pagination-more-grid",            
    nextSelector : "div.more-previous-grid a",                   
    itemSelector : "#content_masonry_grid div.medium-two-columns",
     loading: {
          msgText: "",
          finishedMsg: '<span>No more posts to load.</span> <style type="text/css">.pagination-more-grid{ display:none !important;}</style>'
        }
        },

      function( newElements ) {
jQuery().waypoint && (jQuery(".appear_animation").waypoint(function () {
        if (!jQuery(this).hasClass("animate_css_stlye animate_start")) {
            var e = jQuery(this);
            setTimeout(function () {
                e.addClass("animate_css_stlye animate_start")
            }, 20)
        }
    }, {
        offset: "85%",
        triggerOnce: !0
    }));

$(".post_review_bar").knob();
$( ".new_div_clear" ).after( '<div class="clearfix"></div>' );
  });  

    jQuery(window).unbind('.infscr');
    jQuery('div.more-previous-grid a').click(function(){jQuery('#content_masonry_grid').infinitescroll('retrieve');
    return false;
    });
	
//////////////////////////////////////////////////////////////////////////
//				Mobile menu
//////////////////////////////////////////////////////////////////////////
		
	  $(".open").pageslide()
//////////////////////////////////////////////////////////////////////////
//				Ticker
//////////////////////////////////////////////////////////////////////////
	  
    var marquee = jQuery("#mycrawler"); 
	var time_multiplier = 18;
	var current;
	
	marquee.hover(function(){
		current.pause();
	}, function(){
		current.resume();
	})
	
    var reset = function() {
		current = jQuery(this);
		var item_width = jQuery(this).outerWidth();
		
		var time = time_multiplier * jQuery(this).outerWidth(); 
        jQuery(this).animate({ 'margin-left': -item_width }, time, 'linear', function(){
			var clone_item = jQuery(this).clone();
			clone_item.css({ 'margin-left': '0' });
			marquee.append(clone_item);
	
			jQuery(this).remove();
			reset.call(marquee.children().filter(':first'));
		});	
    };
	
    reset.call(marquee.children().filter(':first'));
	
	
//////////////////////////////////////////////////////////////////////////	
// Menu
//////////////////////////////////////////////////////////////////////////
	
    var mainmenu = $('#menu-top, #mainmenu').superfish({
        delay: 400,
        animation: {
            opacity: 'show'
        },
        speed: 'fast',
        autoArrows: false
    });		    
	
//////////////////////////////////////////////////////////////////////////
//				Audio / Video
//////////////////////////////////////////////////////////////////////////
	
	$('audio').mediaelementplayer({
			audioWidth: '100%'
		});  


//////////////////////////////////////////////////////////////////////////
//				Slider
//////////////////////////////////////////////////////////////////////////
	
        $(".slider-large, .slider-medium").owlCarousel({
		  autoPlay: 8000,
          slideSpeed : 500,
          paginationSpeed : 500,
          singleItem : true,
		  navigation: true,
		  pagination: false,
		  stopOnHover: true,
          autoHeight : true
        });	

        $(".slider-large-widget").owlCarousel({
          slideSpeed : 500,
          paginationSpeed : 500,
          singleItem : true,
          navigation: true,
          pagination: false,
          stopOnHover: true,
          autoHeight : true
        }); 		
        
//////////////////////////////////////////////////////////////////////////
//              Carousel
//////////////////////////////////////////////////////////////////////////

 $(".owl_carousel").owlCarousel({
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsMobile : [767,1],
        pagination: false,
        navigation: true,
        autoHeight: true
      });

 $(".owl_carousel_builder").owlCarousel({
        items : 3,
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,3],
        itemsMobile : [767,1],
        pagination: false,
        navigation: true    
      });   

//////////////////////////////////////////////////////////////////////////
//              Carousel vertical
//////////////////////////////////////////////////////////////////////////
 $('.slider8').bxSlider({
    mode: 'vertical',
    minSlides: 4,
    slideMargin: 10,
    infiniteLoop: true,
    pager: false
  });
//////////////////////////////////////////////////////////////////////////
//				Add class
//////////////////////////////////////////////////////////////////////////

jQuery().waypoint && (jQuery(".appear_animation").waypoint(function () {
        if (!jQuery(this).hasClass("animate_css_stlye animate_start")) {
            var e = jQuery(this);
            setTimeout(function () {
                e.addClass("animate_css_stlye animate_start")
            }, 20)
        }
    }, {
        offset: "85%",
        triggerOnce: !0
    }));
	
jQuery().waypoint && (jQuery(" .reviewbox").waypoint(function () {
        if (!jQuery(this).hasClass("animation_bar_width")) {
            var e = jQuery(this);
            setTimeout(function () {
                e.addClass("animation_bar_width")
            }, 20)
        }
    }, {
        offset: "85%",
        triggerOnce: !0
    }));	
		
//////////////////////////////////////////////////////////////////////////
//				Tab
//////////////////////////////////////////////////////////////////////////	
	
    var $tabsNav = $('.tabs'),
        $tabsNavLis = $tabsNav.children('li');
    $tabsNav.each(function () {
        var $this = $(this);
        $this.next().children('.tab-content').stop(true, true).hide()
            .first().show();
       $this.children('li').first().addClass('active').stop(true, true).show();
    });
    $tabsNavLis.on('click', function (e) {
        var $this = $(this);
        $this.siblings().removeClass('active').end()
            .addClass('active');
        $this.parent().next().children('.tab-content').stop(true, true).hide()
            .siblings($this.find('a').attr('href')).fadeIn();
        e.preventDefault();
    });
	
    var $tabsNav = $('.tabs1'),
        $tabsNavLis = $tabsNav.children('li');
    $tabsNav.each(function () {
        var $this = $(this);
        $this.next().children('.tab-content1').stop(true, true).hide()
            .first().show();
       $this.children('li').first().addClass('active').stop(true, true).show();
    });
    $tabsNavLis.on('click', function (e) {
        var $this = $(this);
        $this.siblings().removeClass('active').end()
            .addClass('active');
        $this.parent().next().children('.tab-content1').stop(true, true).hide()
            .siblings($this.find('a').attr('href')).fadeIn();
        e.preventDefault();
    });	
	
	
	    var $tabsNav = $('.hover_tab_post_large'),
        $tabsNavLis = $tabsNav.children('li');
    $tabsNav.each(function () {
        var $this = $(this);
        $this.next().children('.tab-content').stop(true, true).hide()
            .first().show();
       $this.children('li').first().addClass('active').stop(true, true).show();
    });
    $tabsNavLis.on('hover', function (e) {
        var $this = $(this);
        $this.siblings().removeClass('active').end()
            .addClass('active');
        $this.parent().next().children('.tab-content').stop(true, true).hide()
            .siblings($this.find('a').attr('rel')).fadeIn();
        e.preventDefault();
    });



//////////////////////////////////////////////////////////////////////////
//				Go to top
//////////////////////////////////////////////////////////////////////////

	jQuery(window).scroll(function () {
		if (jQuery(this).scrollTop() > 500) {
			jQuery("#go-top").fadeIn();
		} else {
			jQuery("#go-top").fadeOut();
		}
	});
	$("#go-top").click(function () {
		jQuery("body,html").animate({ scrollTop: 0 }, 800 );
		return false;
	});		

//////////////////////////////////////////////////////////////////////////
//				Video responsive
//////////////////////////////////////////////////////////////////////////

fluidvids.init({
      selector: 'iframe',
      players: ['www.youtube.com', 'player.vimeo.com']
    });

//////////////////////////////////////////////////////////////////////////
//				Sticky
//////////////////////////////////////////////////////////////////////////	

$(".menu_sticky").sticky({topSpacing:0});
$(".image-flickr-widget a, .twitter_widget_feed a").attr('target','_blank');	

});




