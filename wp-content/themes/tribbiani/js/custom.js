	jQuery(document).ready(function() {
		//Set up the Slider 
        jQuery('#slider').nivoSlider({effect:'boxRandom',pauseTime:4500});

	var $container = jQuery('#masonry');
		// initialize
		$container.imagesLoaded( function() {	
			$container.masonry({
			  columnWidth: 366,
			  itemSelector: '.homepage-article'
			});
	});
	
	
	var $footer = jQuery('.footer-container');
		// initialize
		$footer.imagesLoaded( function() {	
			$footer.masonry({
			  columnWidth: 365,
			  itemSelector: '.widget-footer'
			});
		});	
	
	jQuery("time.entry-date").timeago();
	
    });
    	
	
	