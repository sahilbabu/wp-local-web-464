<?php 


// admin area styling
function gridsby_custom_admin_colors() { 
   echo '<style type="text/css">

body {
	margin: 0px;
}


.grid {
	width: 100%;
	max-width: 1240px;
	min-width: 755px;
	margin: 0 auto;
	overflow: hidden;
}

.grid:after {
	content: "";
	display: table;
	clear: both;
}

.grid-pad {
	padding-top: 20px;
	padding-left: 0px; /* grid-space to left */
	padding-right: 0px; /* grid-space to right: (grid-space-left - column-space) e.g. 20px-20px=0 */
}

.col-1-4 {
	float: left;
	padding-right: 2%; 
	width: 23%;  
	text-align: center;
}

.col-1-3 {
	float: left;
	padding-right: 2%;
	width: 31.333%;
	text-align: center;
	}
	
.fa { 
	font-size: 30px;
	color: #1cbda2;
}

.senswp .fa { font-size: 30px !important; }

.col-1-4 h4 {
	font-size: 16px;
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"] {
	border: 2px solid;
	border-color: #1cbda2;
	border-radius: 4px;
	background: #1cbda2;
	box-shadow: none;
	font-size: 13px;
	line-height: 1;
	font-weight: 400;
	padding: 0.7em 1.5em 0.7em;
	text-shadow: none;
	color: #fff;
	cursor: pointer;
}

button:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover {
	border-color: #1cbda2;
}

button:focus,
input[type="button"]:focus,
input[type="reset"]:focus,
input[type="submit"]:focus,
button:active,
input[type="button"]:active,
input[type="reset"]:active,
input[type="submit"]:active {
	border-color: #1cbda2;
}

button.pro {
	font-size: 24px;
	padding: 1.25em 2em;
	text-align: center;
	margin: 20px auto 0;
	display: block;
}

a { 
	text-decoration: none;
}

.custom-box {
    border: 1px solid #dadada;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 30px;
    overflow: hidden;
    position: relative;
    width: 100%;
}
.custom-box:before {
    content: "";
    display: block;
    padding-top: 90%;
}
.home-collection {
    background: none repeat scroll 0 0 #fff;
}
.custom-content {
    bottom: 0;
    color: white;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
}
.custom-content div {
    display: table;
    height: 100%;
    width: 100%;
}
.custom-content span {
    color: #999;
    display: table-cell;
    padding: 20px;
    text-align: center;
    vertical-align: middle;
}
.custom-content span > .fa {
    color: #404040;
    display: block;
    font-size: 50px;
    margin: 0 auto;
    padding: 0 0 20px;
    transition: all 0.2s ease-in-out 0s;
}
.custom-content:hover .fa {
    color: #1cbda2;
    font-size: 58px;
    transition: all 0.2s ease-in-out 0s;
}
.custom-content span > h5 {
    color: #404040;
	font-size: 18px;
	line-height: 20px;
	margin: 0;
}
.custom-content span > p {
    font-size: 15px;
    margin-bottom: 0;
}

@media handheld, only screen and (max-width: 800px) {
	.grid {
		width: 100%;
		min-width: 0;
		margin-left: 0px;
		margin-right: 0px;
		padding-left: 0px; /* grid-space to left */
		padding-right: 10px; /* grid-space to right: (grid-space-left - column-space) e.g. 20px-10px=10px */ 
	}
	
	.col-1-4 {
		float: none;
		padding-right: 0px;
		width: 100%;
		text-align: center;
	}
	
	.col-1-3 {
		float: none;
		padding-right: 0px;
		width: 100%;
		text-align: center; 
	}
}

}

         
			
         </style>';
}

add_action('admin_head', 'gridsby_custom_admin_colors'); 

     
    add_action('admin_menu', 'gridsby_setup_menu'); 
     
    function gridsby_setup_menu(){
            add_theme_page( __( 'Gridsby Theme Details', 'gridsby' ), __( 'Gridsby Theme Details', 'gridsby' ), 'manage_options', 'gridsby-setup', 'gridsby_init' );
    } 
     
 	function gridsby_init(){
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">';
		printf( __('Thank you for using Gridsby!', 'gridsby' ));
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf( __('Gridsby Theme Setup', 'gridsby' ));
        echo '</h2>';
		
		echo '<p>';
		printf( __('We created a quick theme setup video to help you get started with Gridsby. Watch the video with the link below', 'gridsby' )); 
		echo '</p>'; 
		
		echo '<a href="//modernthemes.net/documentation/gridsby-documentation/gridsby-theme-setup/" target="_blank"><button>';
		printf( __('View Video', 'gridsby' )); 
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( __('Documentation', 'gridsby' ));
        echo "</h2>";  
		
		echo '<p>';
		printf( __('Check out our Gridsby documentation to learn how to use Gridsby and for tutorials on theme functions. Click the link below.', 'gridsby' ));  
		echo "</p>";
		
		echo '<a href="//modernthemes.net/documentation/gridsby-documentation/" target="_blank"><button>';
		printf( __('Read Docs', 'gridsby' ));
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( __('About ModernThemes', 'gridsby' ));
        echo '</h2>';  
		
		echo '<p>';
		printf( __('Want to learn more about ModernThemes? Let us help you at modernthemes.net.', 'gridsby' )); 
		echo '</p>'; 
		
		echo '<a href="//modernthemes.net/our-company/" target="_blank"><button>'; 
		printf( __('About Us', 'gridsby' ));
		echo '</button></a></div></div>';
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( __('Want more features? Go Pro.', 'gridsby' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>';
		printf( __('Sell Your Photos', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Make your website a powerful eCommerce machine. Gridsby Pro includes Easy Digital Downloads to turn photos into profit.', 'gridsby' ));
		echo '</p></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
        printf( __('More Theme Options', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __('Control more options of your website including scroll animations and hover effects for your photos, as well as a home page slider template.', 'gridsby' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>';
		printf( __('Home Gallery Options', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Control the number of photos in your home page gallery. You can put up to 200 photos right on your front page for greater visbility.', 'gridsby' ));
		echo '</p></div> ';
            
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
		printf( __( 'Footer Widget Areas', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Want more content for your footer? Gridsby Pro has three footer widget areas to populate with any content you want.', 'gridsby' ));
		echo '</p></div></div>';
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-th-list"></i><h4>';
		printf( __( 'More Sidebars', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Sometimes you need different sidebars for different pages. We got you covered, offering up to 5 different sidebars.', 'gridsby' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( __( 'Access an additional 65 Google fonts with Gridsby Pro right in the back-end of the WordPress customizer.', 'gridsby' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( __( 'PSD Files', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'gridsby' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( __( 'Free Support', 'gridsby' ));
		echo '</h4>';
		
        echo '<p>';
		printf( __( 'Call on us to help you out. Premium themes come with free support that goes directly to our support staff.', 'gridsby' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="//modernthemes.net/wordpress-themes/gridsby-pro/" target="_blank"><button class="pro">';
		printf( __( 'View Pro Version', 'gridsby' )); 
		echo '</button></a></div></div>'; 
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( __( 'Want more themes? Check out our collections.', 'gridsby' )); 
		echo '</h1></div>';
		
        echo '<a href="//modernthemes.net/theme-collections/blog-magazine-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-book"></i><h5>';
		printf( __( 'Blog & Magazine', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/business-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-users"></i><h5>';
		printf( __( 'Business', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>'; 
		
        echo '<a href="//modernthemes.net/theme-collections/creative-portfolio-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-pencil-square-o"></i><h5>';
		printf( __( 'Creative & Portfolio', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		 
        echo '<a href="//modernthemes.net/theme-collections/ecommerce-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-shopping-cart"></i><h5>';
		printf( __( 'eCommerce', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		 
        echo '<a href="//modernthemes.net/theme-collections/education-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-graduation-cap"></i><h5>';
		printf( __( 'Education', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/fitness-sport-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-soccer-ball-o"></i><h5>';
		printf( __( 'Fitness & Sports', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/restaurant-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-cutlery"></i><h5>';
		printf( __( 'Food & Restaurant', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>'; 
            
        echo '<a href="//modernthemes.net/theme-collections/health-beauty-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-smile-o"></i><h5>'; 
		printf( __( 'Health & Beauty', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>'; 
            
        echo '<a href="//modernthemes.net/theme-collections/hotel-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-building-o"></i><h5>';
		printf( __( 'Hotel', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>'; 
		
        echo '<a href="//modernthemes.net/theme-collections/medical-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-stethoscope"></i><h5>';
		printf( __( 'Medical', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/music-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-music"></i><h5>'; 
		printf( __( 'Music', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
            
        echo '<a href="//modernthemes.net/theme-collections/photography-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-camera"></i><h5>';
		printf( __( 'Photography', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/real-estate-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-home"></i><h5>';
		printf( __( 'Real Estate', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
              
        echo '<a href="//modernthemes.net/theme-collections/travel-wordpress-themes/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-send-o"></i><h5>';
		printf( __( 'Travel', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		
        echo '<a href="//modernthemes.net/theme-collections/one-page/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-list-alt"></i><h5>';
		printf( __( 'One Page', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a>';
		 
        echo '<a href="//modernthemes.net/theme-collections/niche/" target="_blank"><div class="col-1-4 med-break"><div class="custom-box"><div class="custom-content home-collection"><div><span><i class="fa fa-thumb-tack"></i><h5>';
		printf( __( 'Niche Markets', 'gridsby' ));
		echo '</h5></span></div></div></div></div></a></div>';
		 	 
    }
?>