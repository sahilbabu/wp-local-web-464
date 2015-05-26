<?php
/** بسم الله الرحمن الرحيم **
 * 
 * Plugin Name: Aqua Page Builder
 * Plugin URI: http://aquagraphite.com/page-builder
 * Description: Fast, lightweight and intuitive drag-and-drop page builder.
 * Version: 1.1.4
 * Author: Syamil MJ
 * Author URI: http://aquagraphite.com
 * Domain Path: /languages/
 * Text Domain: aqpb-l10n
 *
 */
 
/**
 * Copyright (c) 2014 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions
if(!defined('AQPB_VERSION')) define( 'AQPB_VERSION', '1.1.4' );
if(!defined('AQPB_PATH')) define( 'AQPB_PATH', get_template_directory() . '/inc/addon/aqua-page-builder-master/');
if(!defined('HOME_PATH')) define( 'HOME_PATH', get_template_directory() . '/inc/new_builder/');
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', get_template_directory_uri() . '/inc/addon/aqua-page-builder-master/');


//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//some default blocks
require_once(HOME_PATH . 'home_slider.php');
require_once(HOME_PATH . 'home_carousel.php');
require_once(HOME_PATH . 'home_main_post_below_list.php');
require_once(HOME_PATH . 'home_large_main_post_below_list.php');
require_once(HOME_PATH . 'home_list_medium.php');
require_once(HOME_PATH . 'home_list_medium_load_more.php');
require_once(HOME_PATH . 'home_grid_medium_load_more.php');
require_once(HOME_PATH . 'home_grid_medium.php');
require_once(HOME_PATH . 'home_grid_small.php');
require_once(HOME_PATH . 'home_two_columns_post.php');
require_once(HOME_PATH . 'home_two_columns_post_list.php');
require_once(HOME_PATH . 'home_main_post_right_list.php');
require_once(HOME_PATH . 'home_main_post_right_list_scroll.php');
require_once(HOME_PATH . 'home_main_post_right_list_text.php');
require_once(AQPB_PATH . 'blocks/aq-text-block.php');
require_once(AQPB_PATH . 'blocks/aq-column-block.php');
require_once(AQPB_PATH . 'blocks/aq-clear-block.php');
require_once(AQPB_PATH . 'blocks/aq-widgets-block.php');
require_once(AQPB_PATH . 'blocks/aq-alert-block.php');
require_once(AQPB_PATH . 'blocks/aq-tabs-block.php');


//register default blocks
aq_register_block('home_post_slider');
aq_register_block('home_carousel_post');
aq_register_block('home_post_right_list');
aq_register_block('home_main_post_right_list_scroll');
aq_register_block('home_post_right_list_text');
aq_register_block('home_post_below_list');
aq_register_block('home_large_post_below_list');
aq_register_block('home_post_list_medium');
aq_register_block('home_post_list_medium_load_more');
aq_register_block('home_post_grid_medium_load_more');
aq_register_block('home_post_grid_medium');
aq_register_block('home_post_grid_small');
aq_register_block('home_post_two_columns');
aq_register_block('home_post_two_columns_list');
aq_register_block('AQ_Text_Block');
aq_register_block('AQ_Column_Block');
aq_register_block('AQ_Clear_Block');
aq_register_block('AQ_Widgets_Block');
aq_register_block('AQ_Alert_Block');
aq_register_block('AQ_Tabs_Block');


//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
