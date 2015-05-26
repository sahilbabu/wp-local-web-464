<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <!-- Basic Page Needs ================================================== -->
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title> <?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?> </title>
        <!-- Mobile Specific Metas ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Favicons
        ================================================== -->
        <?php $favor_icon = of_get_option('favicon_uploader'); ?>
        <link rel="shortcut icon" href="<?php
        if (!empty($favor_icon)) {
            echo esc_attr($favor_icon);
        } else {
            echo esc_attr(get_template_directory_uri() . '/img/favicon.png');
        }
        ?>" type="image/x-icon" />       
              <?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>    
              <?php
              if (!is_404()) {
                  $thumbnail_id = get_post_thumbnail_id();
                  if (!empty($thumbnail_id)) {
                      $thumbnail = wp_get_attachment_image_src($thumbnail_id, '440x280');
                      ?>
                <meta property="og:image" content="<?php echo esc_attr($thumbnail[0]) ?>" />		
                <?php
            }
        }
        wp_head();
        ?>                  	
        <!-- end head -->
    </head>
    <body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
        <?php
        if (of_get_option('full_or_boxed_layout') != 'full_image_option') {
            if (of_get_option('background_body_option') == 'big_image') {
                ?>
                <img alt="full screen background image" src="<?php echo esc_attr(of_get_option('background_large_image')); ?>" id="full-screen-background-image" />
                <?php
            }
        }
        ?>
        <div id="content_nav">
            <div id="nav">
                <?php
                $main_menu = array('theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'fallback_cb' => false, 'link_after' => '<span class="border-menu"></span>');
                wp_nav_menu($main_menu);
                ?>
            </div>
        </div>    
        <div id="sb-site" class="<?php
        if (of_get_option('full_or_boxed_layout') == 'full_image_option') {
            echo esc_attr("body_wraper_full");
        } else {
            echo esc_attr("body_wraper_box");
        }
        ?>">     			

            <!-- Start header -->
            <header class="header-wraper<?php
            if (of_get_option('theme_header_style') != 'theme_header_style_0') {
                echo " " . of_get_option('theme_header_style');
            }
            ?>">

                <div class="header_top_wrapper">
                    <div class="row">
                        <div class="six columns header-top-left-bar">

                            <?php if (!of_get_option('disable_newsticker') == 1) { ?>
                                <?php get_template_part('news-ticker'); ?>
                            <?php } ?>

                        </div>

                        <div class="six columns header-top-right-bar">

                            <a class="open toggle-lef sb-toggle-left navbar-left" href="#nav">
                                <div class="navicon-line"></div>
                                <div class="navicon-line"></div>
                                <div class="navicon-line"></div>
                            </a>
                            <?php if (!of_get_option('disable_top_search') == 1) { ?>
                                <div id="search_block_top">
                                    <form id="searchbox" action="<?php echo esc_url(home_url('/')); ?>" method="GET" role="search">
                                        <p>
                                            <input type="text" id="search_query_top" name="s" class="search_query ac_input" value="" placeholder="<?php esc_attr_e('Search here', 'jelly_text_main'); ?>">
                                            <button type="submit"> <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/search_form_icon_w.png" alt=""> </button>
                                        </p>
                                    </form>
                                    <span>Search</span>
                                    <div class="clearfix"></div>
                                </div>
                            <?php } ?>


                            <?php if (!of_get_option('disable_top_social_icons') == 1) { ?> 
                                <ul class="social-icons-list top-bar-social">
                                    <?php if (of_get_option('facebook') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('facebook')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/facebook.png" alt="<?php esc_attr_e('Facebook', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('google_plus') != '') { ?><li><a href="<?php echo esc_url(of_get_option('google_plus')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/google-plus.png" alt="<?php esc_attr_e('Google Plus', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('behance') != '') { ?><li><a href="<?php echo esc_url(of_get_option('behance')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/behance.png" alt="<?php esc_attr_e('Behance', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('vimeo') != '') { ?><li><a href="<?php echo esc_url(of_get_option('vimeo')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/vimeo.png" alt="<?php esc_attr_e('Vimeo', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('youtube') != '') { ?><li><a href="<?php echo esc_url(of_get_option('youtube')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/youtube.png" alt="<?php esc_attr_e('Youtube', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('instagram') != '') { ?><li><a href="<?php echo esc_url(of_get_option('instagram')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/instagram.png" alt="<?php _e('Instagram', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('linkedin') != '') { ?><li><a href="<?php echo esc_url(of_get_option('linkedin')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/link.png" alt="<?php esc_attr_e('linkedin', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('pinterest') != '') { ?><li><a href="<?php echo esc_url(of_get_option('pinterest')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/pin.png" alt="<?php esc_attr_e('Pinterest', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('twitter') != '') { ?><li><a href="<?php echo esc_url(of_get_option('twitter')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/twitter.png" alt="<?php esc_attr_e('Twitter', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('blogger') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('blogger')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/blogger.png" alt="<?php esc_attr_e('Blogger', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('deviantart') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('deviantart')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/d-art.png" alt="<?php esc_attr_e('Deviantart', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('dribble') != '') { ?><li><a href="<?php echo esc_url(of_get_option('dribble')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dribble.png" alt="<?php esc_attr_e('Dribble', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('dropbox') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('dropbox')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/dropbox.png" alt="<?php esc_attr_e('Dropbox', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('rss') != '') { ?><li><a href="<?php echo esc_url(of_get_option('rss')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/rss.png" alt="<?php esc_attr_e('RSS', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('skype') != '') { ?><li><a href="<?php echo esc_url(of_get_option('skype')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/skype.png" alt="<?php esc_attr_e('Skype', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('stumbleupon') != '') { ?><li><a href="<?php echo esc_url(of_get_option('stumbleupon')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/stumbleupon.png" alt="<?php esc_attr_e('Stumbleupon', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('wordpress') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('wordpress')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/wordpress.png" alt="<?php esc_attr_e('WordPress', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('yahoo') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('yahoo')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/yahoo.png" alt="<?php esc_attr_e('Yahoo', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('flickr') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('flickr')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/flickr.png" alt="<?php esc_attr_e('flickr', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                    <?php if (of_get_option('tumblr') != '') { ?> <li><a href="<?php echo esc_url(of_get_option('tumblr')); ?>" target="_blank"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/icons/tumblr.png" alt="<?php esc_attr_e('tumblr', 'jelly_text_main'); ?>"></a></li><?php } ?>
                                </ul>  
                            <?php } ?>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>



                <div class="header_main_wrapper"> 
                    <div class="row">
                        <div class="<?php
                        if (is_active_sidebar('banner-sidebar')) {
                            echo esc_attr('four columns header-top-left');
                        } else {
                            echo esc_attr('twelve columns logo-position');
                        }
                        ?>">

                            <!-- begin logo -->


                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo = of_get_option('logo_uploader'); ?>
                                <?php if (!empty($logo)): ?>   
                                    <img src="<?php echo esc_attr($logo); ?>" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" width="250"  height="70"/>
                                <?php else: ?>
                                    <img src="<?php echo esc_attr(get_template_directory_uri()); ?>/img/logo.png" alt="<?php bloginfo('description'); ?>" id="theme_logo_img" />
                                <?php endif; ?>
                            </a>

                            <!-- end logo -->
                        </div>
                        <?php if (is_active_sidebar('banner-sidebar')) { ?>
                            <div class="eight columns header-top-right">  
                                <?php dynamic_sidebar('banner-sidebar'); ?>
                            </div>
                        <?php } ?>    
                    </div>

                </div>


                <!-- end header, logo, top ads -->


                <!-- Start Main menu -->
                <div id="menu_wrapper" class="menu_wrapper <?php
                if (!of_get_option('disable_sticky_menu') == 1) {
                    echo esc_attr("menu_sticky");
                }
                ?>">
                    <div class="menu_border_top_full"></div>
                    <div class="row">
                        <div class="main_menu twelve columns"> 
                            <div class="menu_border_top"></div>
                            <!-- main menu -->

                            <div class="menu-primary-container main-menu">
                                <?php
                                $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'Main_Menu', 'container' => '', 'menu_class' => 'sf-menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after' => '<span class="border-menu"></span>');
                                wp_nav_menu($main_menu);
                                ?>
                                <?php if (!of_get_option('disable_random_post_link') == 1) { ?>
                                    <div class="random_post_link">
                                        <?php
                                        $random_post_header_link = get_posts(array('orderby' => 'rand', 'posts_per_page' => '1'));
                                        if (!empty($random_post_header_link)) {
                                            ?>  
                                            <a href="<?php echo get_permalink($random_post_header_link[0]->ID); ?>"><i class="fa fa-random"></i></a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </div>                             
                            <!-- end main menu -->


                        </div>

                    </div>   
                </div>



            </header>

