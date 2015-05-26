<?php
/**
 * Tribbiani functions and definitions
 *
 * @package Tribbiani
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'tribbiani_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function tribbiani_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Tribbiani, use a find and replace
	 * to change 'tribbiani' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tribbiani', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Thumbnail for Homepage Screens. Cropped.
	add_image_size('homepage-thumb', 350, 220, true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'top' => __( 'Primary Menu', 'tribbiani' )
		) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'tribbiani_custom_background_args', array(
		'default-color' => '000000',
		'default-image' => '',
	) ) );
}
endif; // tribbiani_setup
add_action( 'after_setup_theme', 'tribbiani_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function tribbiani_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tribbiani' ),
		'id'            => 'sidebar-aside',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer', 'tribbiani' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	
}
add_action( 'widgets_init', 'tribbiani_widgets_init' );

if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

/**
 * Enqueue scripts and styles
 */
function tribbiani_scripts() {

	wp_enqueue_style( 'tribbiani-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,300,700|Yanone+Kaffeesatz:400,300,700|Alike');
	
	wp_enqueue_style( 'tribbiani-style', get_stylesheet_uri(), array('tribbiani-fonts') );
	
	wp_enqueue_script( 'tribbiani-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'tribbiani-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_style( 'tribbiani-nivo-slider-default-theme', get_template_directory_uri()."/css/nivo/themes/default/default.css" );
	
	wp_enqueue_style( 'tribbiani-nivo-slider-style', get_template_directory_uri()."/css/nivo/nivo.css" );
	
	wp_enqueue_script('tribbiani-timeago', get_template_directory_uri() . '/js/jquery.timeago.js', array('jquery') );
	
	wp_enqueue_script( 'tribbiani-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	
	wp_enqueue_script( 'tribbiani-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery','tribbiani-nivo-slider','tribbiani-imagesloaded','tribbiani-timeago') );
	
	wp_enqueue_script( 'tribbiani-imagesloaded', get_template_directory_uri() . '/js/imagesLoaded.js', array('jquery', 'jquery-masonry') );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'tribbiani-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'tribbiani_scripts' );

/**
 * Function to Display BreadCrumbs
 */
function tribbiani_breadcrumbs() {
 
        global $post;
 
        if (!is_home()) {
 
            echo "<a href='";
            echo esc_url( home_url( '/' ) );
            echo "'>";
            echo bloginfo( 'name' );
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo " > ";
                $cats = get_the_category( $post->ID );
 
                foreach ( $cats as $cat ){
                    echo $cat->cat_name;
                    echo " > ";
                }
                if (is_single()) {
                    the_title();
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );
 
                    foreach ( $anc as $ancestor ) {
                        $output = " > <a href=".$anc_link.">".get_the_title($ancestor)."</a> > ";
                    }
 
                    echo $output;
                    the_title();
 
                } else {
                    echo ' > ';
                    echo the_title();
                }
            }
        }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"Archive: "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"Archive: "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"Archive: "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"Author's archive: "; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
    elseif (is_search()) {echo"Search results: "; }
}
/**
 * Implement the Custom Header feature.
 */
function tribbiani_pagination() {
global $wp_query;
$big = 12345678;
$page_format = paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages,
    'type'  => 'array'
) );
if( is_array($page_format) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div><ul>';
            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
            foreach ( $page_format as $page ) {
                    echo "<li>$page</li>";
            }
           echo '</ul></div>';
}
}
function newp_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('headcode1', true) != 1) ) {
	echo of_get_option('headcode1', true);
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
}
add_action('wp_head', 'newp_custom_head_codes');
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
