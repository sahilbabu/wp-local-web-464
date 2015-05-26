<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Tribbiani
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'tribbiani_before' ); ?>
	
	<nav id="top-navigation" class="top-navigation" role="navigation">
		<div class="nav-wrapper">
			<h1 class="menu-toggle"><?php _e( 'Menu', 'tribbiani' ); ?></h1>
			<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'tribbiani' ); ?>"><?php _e( 'Skip to content', 'tribbiani' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
		</div>	<!-- .nav-wrapper-->
	</nav><!-- #top-navigation -->
	
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
<?php if((of_get_option('logo1', true) != "") && (of_get_option('logo1', true) != 1) ) { ?>
			<h1 class="site-title logo-container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
      <?php
			echo "<img class='main_logo' src='".of_get_option('logo1', true)."' title='".esc_attr(get_bloginfo( 'name','display' ) )."'></a></h1>";	
			}
		else { ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> 
			<h2 class="site-description"> <?php bloginfo( 'description' ); ?></h2>
		<?php	
		}
		?>
		</div>
        
        
        <div id="social_icons">
		    <?php if ( of_get_option('facebook', true) != "") { ?>
			 <a href="<?php echo of_get_option('facebook', true); ?>" title="Facebook" ><img src="<?php echo get_template_directory_uri()."/images/facebook.png"; ?>"></a>
             <?php } ?>
            <?php if ( of_get_option('twitter', true) != "") { ?>
			 <a href="http://twitter.com/<?php echo of_get_option('twitter', true); ?>" title="Twitter" ><img src="<?php echo get_template_directory_uri()."/images/twitter.png"; ?>"></a>
             <?php } ?>
             <?php if ( of_get_option('google', true) != "") { ?>
			 <a href="<?php echo of_get_option('google', true); ?>" title="Google Plus" ><img src="<?php echo get_template_directory_uri()."/images/google.png"; ?>"></a>
             <?php } ?>
             <?php if ( of_get_option('feedburner', true) != "") { ?>
			 <a href="<?php echo of_get_option('feedburner', true); ?>" title="RSS Feeds" ><img src="<?php echo get_template_directory_uri()."/images/rss.png"; ?>"></a>
             <?php } ?>
             <?php if ( of_get_option('instagram', true) != "") { ?>
			 <a href="<?php echo of_get_option('instagram', true); ?>" title="Instagram" ><img src="<?php echo get_template_directory_uri()."/images/instagram.png"; ?>"></a>
             <?php } ?>
             <?php if ( of_get_option('flickr', true) != "") { ?>
			 <a href="<?php echo of_get_option('flickr', true); ?>" title="Flickr" ><img src="<?php echo get_template_directory_uri()."/images/flickr.png"; ?>"></a>
             <?php } ?>
            </div>	

	</header><!-- #masthead -->

	<div id="content" class="site-content">
	<?php
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slidetitle5',true) !=1) ) {
	if ( ( of_get_option('slider_enabled') != 0 ) && ( (is_home() == true) || (is_front_page() == true) ) )  
		{ ?>
	<div class="slider-wrapper theme-default"> 
    	<div class="ribbon"></div>    
    		<div id="slider" class="nivoSlider">
    			<?php
		  		$slider_flag = false;
		  		for ($i=1;$i<6;$i++) {
		  			$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
					if ( of_get_option('slide'.$i, true) != "" ) {
						echo "<a href='".of_get_option('slideurl'.$i, true)."'><img src='".of_get_option('slide'.$i, true)."' title='".$caption."'></a>"; 
						$slider_flag = true;
					}
				}
				?>  
    		</div><!--#slider-->
    		<?php for ($i=1;$i<6;$i++) {
    				$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
    				if ($caption != "")
    				{
	    				echo "<div id='caption_".$i."' class='nivo-html-caption'>";
	    				echo "<a href='".of_get_option('slideurl'.$i, true)."'><div class='slide-title'>".of_get_option('slidetitle'.$i, true)."</div></a>";
	    				echo "<div class='slide-description'>".of_get_option('slidedesc'.$i, true)."</div>";
	    				echo "</div>";
    				}
    			}	
    	    
			?>
    </div>	
	<?php 
			}
		}
		?>