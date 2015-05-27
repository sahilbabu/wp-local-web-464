<?php

/**
 * Plugin Name: Image scraping cron 
 * Description: Image scraping functions in WordPress
 * Version: 1.0
 * Author: Mudassar Ali
 * License: GPL2
 */
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

define('SAHIL_PLUGIN_ROOT_DIR', rtrim(plugin_dir_path(__FILE__), '/'));
require_once( SAHIL_PLUGIN_ROOT_DIR . '/lib/zebra_image/Zebra_Image.php' );
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

// Add a new submenu under DASHBOARD
function image_scraping_cron_menu() {

    // using a wrapper function (easy, but not good for adding JS later - hence not used)
    // add_dashboard_page('Plugin Starter', 'Plugin Starter', 'administrator', 'pluginStarter', 'pluginStarter');
    // using array - same outcome, and can call JS with it
    // explained here: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
    // and here: http://pippinsplugins.com/loading-scripts-correctly-in-the-wordpress-admin/
    global $scraping_cron_admin_page;
    $scraping_cron_admin_page = add_submenu_page('index.php', __('Image scraping cron', 'image-scraping-cron'), __('Image scraping cron', 'image-scraping-cron'), 'manage_options', 'imageScrapingCron', 'imageScrapingCron');
}

add_action('admin_menu', 'image_scraping_cron_menu');

// register our JS file
function image_scraping_cron_admin_init() {
    wp_register_script('custom-script-cron', plugins_url('/image-scraping-cron.js', __FILE__));
}

add_action('admin_init', 'image_scraping_cron_admin_init');

// now load the scripts we need
function scraping_cron_admin_scripts($hook) {

    global $scraping_cron_admin_page;
    if ($hook != $scraping_cron_admin_page) {
        return;
    }
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('custom-script-cron');
}

// and make sure it loads with our custom script
add_action('admin_enqueue_scripts', 'scraping_cron_admin_scripts');

// link some styles to the admin page
$starterstyles = plugins_url('image-scraping-cron.css', __FILE__);
wp_enqueue_style('imagescrapingstyles', $starterstyles);

// add frontend js and script 

function add_frontend_js_css() {
// register our JS file
    wp_register_script('custom-script-masnory', plugins_url('/js/masonry.pkgd.min.js', __FILE__), array(), FALSE, TRUE);
    wp_register_script('custom-script-lazyload', plugins_url('/js/jquery.lazyload.min.js', __FILE__), array(), FALSE, TRUE);
    wp_register_script('custom-script-imagesloaded', plugins_url('/js/imagesloaded.pkgd.min.js', __FILE__), array(), FALSE, TRUE);
    wp_register_script('custom-script-footerscript', plugins_url('/js/footerscript.js', __FILE__), array(), FALSE, TRUE);
    // now load the scripts we need
    wp_enqueue_script('custom-script-masnory');
    wp_enqueue_script('custom-script-lazyload');
    wp_enqueue_script('custom-script-imagesloaded');
    wp_enqueue_script('custom-script-footerscript');
    wp_enqueue_script('jquery-ui-dialog');
}

// and make sure it loads with our custom script
add_action('wp_enqueue_scripts', 'add_frontend_js_css');

add_action('init', 'myplugin_load');

function myplugin_load() {
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-dialog');
}

////////////////////////////////////////////
/*         CRON DEMO STARTS HERE          */
/////////////////////////////////////////////
// unschedule event upon plugin deactivation
function imagecronstarter_deactivate() {
    // find out when the last event was scheduled
    $timestamp = wp_next_scheduled('image_scraping_cron_job');
    // unschedule previous event if any
    wp_clear_scheduled_hook('image_scraping_cron_job');
    wp_unschedule_event($timestamp, 'image_scraping_cron_job');
    // do_action( 'reset_posts_table' );
}

register_deactivation_hook(__FILE__, 'imagecronstarter_deactivate');

// create a scheduled event (if it does not exist already)
function imagecronstarter_activation() {
    //  do_action( 'alter_posts_table' );
    if (!wp_next_scheduled('image_scraping_cron_job')) {
        //  wp_schedule_event(time(), 'everyminute', 'image_scraping_cron_job');
        // wp_schedule_event(time(), 'twicedaily', 'image_scraping_cron_job');
        // wp_schedule_event( time(), 'ten', 'image_scraping_cron_job');
        // wp_schedule_event(time(), 'daily', 'image_scraping_cron_job');
        wp_schedule_event(time(), 'image_cron_fourhour', 'image_scraping_cron_job');
    }
}

function alter_posts_table() {
    global $wpdb;
    $sql = "ALTER TABLE wp_posts ADD COLUMN external_images TEXT NULL AFTER comment_count";
    // $wpdb->query($sql);
    // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // dbDelta( $sql );
}

function reset_posts_table() {
    global $wpdb;
    $sql = "ALTER TABLE wp_posts DROP COLUMN external_images";
    //$wpdb->query($sql);
    // require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //  dbDelta( $sql );
}

// and make sure it's called whenever WordPress loads
add_action('wp', 'imagecronstarter_activation');

// CUSTOM INTERVALS
// by default we only have hourly, twicedaily and daily as intervals 
// to add your own, use something like this - the example adds 'weekly'
// http://codex.wordpress.org/Function_Reference/wp_get_schedules

function image_cron_add_weekly($schedules) {
    // Adds once weekly to the existing schedules.
    $schedules['weekly'] = array(
        'interval' => 604800,
        'display' => __('Once Weekly')
    );
    return $schedules;
}

add_filter('cron_schedules', 'image_cron_add_weekly');

// add another interval
function image_cron_add_minute($schedules) {
    // Adds once every minute to the existing schedules.
    $schedules['everyminute'] = array(
        'interval' => 60,
        'display' => __('Once Every Minute')
    );
    return $schedules;
}

add_filter('cron_schedules', 'image_cron_add_minute');

// Add custom cron interval
add_filter('cron_schedules', 'image_cron_fourhour', 240, 1);

function image_cron_fourhour($schedules) {
    // $schedules stores all recurrence schedules within WordPress
    $schedules['every_four_hours'] = array(
        'interval' => 60 * 60 * 4, // Number of seconds, 600 in 10 minutes
        'display' => __('Once Every 4 hours')
    );

    // Return our newly added schedule to be merged into the others
    return (array) $schedules;
}

// here's the function we'd like to call with our cron job
function image_cron_repeat_function() {
    $cron_limit_h = 4;
    $cron_limit_m = $cron_limit_h * 60 - 10;
    // $cron_limit_m = 2;
    $termination_time = TRUE;
    $cron_time = 'Cron start at time :' . date("F j, Y, g:i a");
    $time_start = microtime(true);
    $keyword_value = get_option('keyword_value');
    $tag_array = preg_split('/$\R?^/m', $keyword_value);
    // $tag_array = explode(',', $keyword_value);
    $pre_save = array();
    $cron_image_limit = get_option('cron_image_limit');
    $time_end = '';
    $execution_time = 0;
    foreach ($tag_array as $key => $val) {
        $pre_save[] = $val;
        $tag_cat = explode(':', $val);
        $title = remove_extra_slashes($tag_cat[0]);
        $cat = $tag_cat[1];
        $tag = $tag_cat[2];
        $tags = explode('|', $tag);
        $img_array = array();
        // duplicate check
        if (null == get_page_by_title($title, OBJECT, 'post') && $termination_time) {
            for ($i = 0; $i < $cron_image_limit; $i++) {
                $start = $i * 8;
                $result = open_url($title, $start);
                if (isset($result->responseData->results) && count($result->responseData->results)) {
                    foreach ($result->responseData->results as $value) {
                        if (image_url_exists($value->url)) {
                            $obj = new stdClass;
                            $obj->title = senitize_title($value->contentNoFormatting);
                            $obj->content = $value->titleNoFormatting;
                            $obj->width = $value->width;
                            $obj->height = $value->height;
                            $obj->url = $value->url;
                            $obj->link_slug = make_url_slug($obj->title);
                            $img_array[$obj->link_slug] = $obj;
                        }
                    }
                }
            }
            $post_id = add_post_using_scrap($img_array, $cat, $title, $tags);
            if ($post_id) {
                sleep(30);
            }
        }
        unset($tag_array[$key]);
        update_option('keyword_done', implode(PHP_EOL, $pre_save));
        update_option('keyword_value', implode(PHP_EOL, $tag_array));
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start) / 60;
        $execution_time = round($execution_time);
        if ($execution_time >= $cron_limit_m) {
            $termination_time = FALSE;
            break;
        }
    }
    // unset($tag_array);
    $time_end = microtime(true);
    $execution_time = ($time_end - $time_start) / 60;
    $cron_time .= '<br/><b>Total Execution Time:</b> ' . $execution_time . ' Mins';
    $cron_time .= '<br/> Cron end at time :' . date("F j, Y, g:i a");
    
    if (get_option('img_cron_run_time')) {
        update_option('img_cron_run_time', $cron_time);
    } else {
        add_option('img_cron_run_time', $cron_time);
    }
}

function image_url_exists($url) {
    $status = FALSE;
    // for help only status
    $other_status = array('HTTP/1.1 403 Forbidden', 'HTTP/1.1 404 File Not Found', 'HTTP/1.1 503 SERVICE UNAVAILABLE');
    $valid_staus = array('HTTP/1.1 200 OK', 'HTTP/1.1 302 Found', 'HTTP/1.1 301 Moved Permanently');
    $array = get_headers($url);
    $string = $array[0];
    // if (strpos($string, "200") || strpos($string, "302")) {
    if (strpos($string, "200")) {
        $status = TRUE;
    }
    return $status;
}

function senitize_title($str) {
    $newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $str = rtrim($newstr, '\/');
    $str = preg_replace('/[^a-zA-Z]/i', ' ', $str);
    $str = trim($str);
    $str = preg_replace('/\s+/', ' ', $str);
    return $str;
}

function make_url_slug($str) {
    $newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $str = rtrim($newstr, '\/');
    #convert case to lower
    $str = strtolower($str);
    #remove special characters
    $str = preg_replace('/[^a-zA-Z]/i', ' ', $str);
    #remove white space characters from both side
    $str = trim($str);
    #remove double or more space repeats between words chunk
    $str = preg_replace('/\s+/', ' ', $str);
    #fill spaces with hyphens
    $str = preg_replace('/\s+/', '-', $str);
    return $str;
}

/**
 * Remove extra slashes from string
 * 
 * @param type $str
 * @return type
 */
function remove_extra_slashes($str) {
    $str = trim($str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('/', '', $str);
    return $str;
}

/**
 * Remove extra slashes from multi-dimensional array
 * 
 * @example path $array = array("f\\'oo", "b\\'ar", array("fo\\'o", "b\\'ar"));
 * $array = stripslashes_deep($array);
 * 
 * @param type $value
 * @return type
 */
//function stripslashes_deep($value) {
//    $value = is_array($value) ?
//            array_map('stripslashes_deep', $value) :
//            stripslashes($value);
//    return $value;
//}

// hook that function onto our scheduled event:
add_action('image_scraping_cron_job', 'image_cron_repeat_function');

function open_url($tag, $start) {
    // $tag = urlencode($tag);
    $tag = str_replace(" ", "%20", $tag);
    // $full_url = 'http://ajax.googleapis.com/ajax/services/search/images?v=1.0&rsz=8&imgsz=small|medium|large&start=' . $start . '&q=' . trim($tag);
    // $full_url = 'http://ajax.googleapis.com/ajax/services/search/images?v=1.0&rsz=8&imgsz=large&start=' . $start . '&q=' . trim($tag);
    // $full_url = 'http://ajax.googleapis.com/ajax/services/search/images?v=1.0&rsz=8&start=' . $start . '&q=' . trim($tag);
    $full_url = 'https://ajax.googleapis.com/ajax/services/search/images?v=1.0&rsz=8&restrict=&start=' . $start . '&as_filetype=&imgtype=&imgsz=&imgc=&safe=&imgcolor=&q=' . $tag;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $full_url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_REFERER, 'http://localhost');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.97 Safari/537.11");
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    //  $json = utf8_decode(curl_exec($curl));
    $json = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($json);
    return $data;
}

function add_post_using_scrap($post_data, $term, $post_title, $tags) {
    $post_id = NULL;
    // if (null == get_page_by_title($post_title, OBJECT, 'post')) {
    // global $user_ID;
    $images = json_encode($post_data);
    $user_ID = 1;
    $post_category = get_term_category($term);
    $new_post = array(
        'post_title' => $post_title,
       // 'post_name' => $slug,
        'post_content' => '',
        'post_status' => 'publish',
        'post_date' => date('Y-m-d H:i:s'),
        'post_author' => $user_ID,
        'post_type' => 'post',
        'post_category' => array($post_category)
    );

    $post_id = wp_insert_post($new_post);
    // Adding post meta title , descreiption 
    // add_post_meta($post_id, 'title', $post_title . ' | ' . wp_title());
    add_post_meta($post_id, 'title', $post_title);
    add_post_meta($post_id, '_yoast_wpseo_metadesc', "images gallery for " . $post_title);

    // get post again 
    $post = get_post($post_id);
    $slug = $post->post_name;

    add_post_meta($post_id, 'external_images', $images);
    if (!empty($tags)) {
        wp_set_post_tags($post_id, $tags, true);
    }
    $html_content = generate_content_html($post_data, $post_title, $post_id, $slug);
    $current_post = array(
        'ID' => $post_id,
        'post_content' => $html_content,
    );
    wp_update_post($current_post);
    return $post_id;
    //  }
}

function generate_content_html($post_data, $post_title, $post_id, $slug) {
    $post_content = '';
    $cnt = 0;
    $fisrt_image = $image_alt = '';
    $post_content = '<div id="mansoryContainer">';
    foreach ($post_data as $key => $val) {
        $blog_url = get_bloginfo('url');
        $alt = $post_title . ' ' . $val->title;
        $link_slug = $val->link_slug;
        $w = get_option('width');
        $h = get_option('height');
        //  $attachement_id = get_option('attachement_id');
        $class = get_option('custom_class');
        // $url = $url . '/?' . $attachement_id . '=' . $key . '&post_id=' . $post_id;
        $url = $blog_url . '/image/' . $slug . '/' . $link_slug;
        $post_content .= '<div class="mansoryItem"><a  href="' . $url . '" rel="attachment "><img title="' . $val->title . '" src="' . $val->url . '" alt="' . $alt . '" width="' . $w . '" height="' . $h . '" class="content-image ' . $class . '" /></a></div>';
        //    $post_content .= '<div class="mansoryItem"><a  href="' . $url . '" rel="attachment "><img title="' . $val->title . '" src="' . $val->url . '" alt="' . $alt . '"  class="content-image ' . $class . '" /></a></div>';
        //    $post_content .= '<div class="mansoryItem"><a  href="' . $url . '" rel="attachment "><img title="' . $val->title . '" src="'.$blog_url.'/timthumb.php?src='.$val->url.'&w=200" alt="' . $alt . '"  class="content-image ' . $class . '" /></a></div>';
        if ($cnt == 0) {
            $fisrt_image = $val->url;
            $image_alt = $alt;
        } else {
            $last_image = $val->url;
            $last_alt = $alt;
        }
        $cnt ++;
    }
    $post_content .= '</div>';
    if (getimagesize($fisrt_image) !== false) {
        resized_featured_image_via_url($fisrt_image, $post_id, $alt);
    } else {
        resized_featured_image_via_url($last_image, $post_id, $last_alt);
    }

    // adding featured image 
    // add_post_meta($post_id, '_nelioefi_url', $fisrt_image);
    // add_post_meta($post_id, '_nelioefi_alt', $image_alt);

    return $post_content;
}

/**
 * Make and resize post feature image 
 * 
 * @param type $image_url
 * @param type $post_id
 * @param type $post_title
 * @param type $desc
 * @return boolean
 */

function resized_featured_image_via_url($image_url, $post_id, $post_title = "title", $desc = "img dsc") {
    $upload_dir = wp_upload_dir();
    $url = $image_url;
    $tmp = download_url($url);
    $width_img = 400;
    $height_img = 260;
    $filetype = wp_check_filetype(basename($url), null);
    $supposed_name = make_url_slug($post_title) . '.' . $filetype['ext'];
    $image = new Zebra_Image();
    $image->source_path = $tmp;
    $image->target_path = $upload_dir['path'] . '/' . $supposed_name;
    $resized = $upload_dir['url'] . '/' . $supposed_name;
//    $image->target_path = $upload_dir['path'] . '/' . basename($url);
//    $resized = $upload_dir['url'] . '/' . basename($url);
    $image->jpeg_quality = 60;
    $image->preserve_aspect_ratio = true;
    $image->enlarge_smaller_images = true;
    $image->preserve_time = true;
    if ($image->resize($width_img, $height_img, ZEBRA_IMAGE_CROP_CENTER)) {
        $filename = $resized;
        $wp_filetype = wp_check_filetype(basename($filename), null);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            // 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
            'post_title' => $post_title,
            'post_content' => $desc,
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment($attachment, $filename, $post_id);
        add_post_meta($post_id, '_thumbnail_id', $attach_id, true);
        return $attach_id;
    } else {
        return FALSE;
    }
}

function make_featured_image_via_url($image_url, $post_id, $post_title = "", $desc = "") {
    $url = $image_url;
    $tmp = download_url($url);
    $file_array = array(
        'name' => basename($url),
        'tmp_name' => $tmp
    );
    $id = media_handle_sideload($file_array, $post_id, $desc);
    $filename = wp_get_attachment_url($id);
    $wp_filetype = wp_check_filetype(basename($filename), null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        // 'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_title' => $post_title,
        'post_content' => $desc,
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $filename, $post_id);
    add_post_meta($post_id, '_thumbnail_id', $attach_id, true);
    return $attach_id;
}

function get_term_category($term) {
    // Get term by name ''news'' in Categories taxonomy.
    $category = get_term_by('name', $term, 'category');

//  Get term by name ''news'' in Tags taxonomy.
//   $tag = get_term_by('name', 'news', 'post_tag');
//  Get term by name ''news'' in Custom taxonomy.
//   $term = get_term_by('name', 'news', 'my_custom_taxonomy');
//  Get term by name ''Default Menu'' from theme's nav menus.
// (Alternative to using wp_get_nav_menu_items)
//  $menu = get_term_by('name', 'Default Menu', 'nav_menu');
    return isset($category->term_id) ? $category->term_id : 0;
}

////////////////////////////////////////////
// here's the code for the actual admin page
function imageScrapingCron() {
    // print_r( get_post_meta( 292, 'external_images' )); die();
    if (isset($_POST['submit'])) {
        $keyword_value = $_POST['keyword_img'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $attachement_id = $_POST['attachement_id'];
        $custom_class = $_POST['custom_class'];
        $lp_limit = $_POST['cron_image_limit'];
        if ($keyword_value) {
            // The option already exists, so we just update it.
            update_option('keyword_value', $keyword_value);
        } else {
            add_option('keyword_value', $keyword_value);
        }
        if ($width && $height) {
            update_option('width', $width);
            update_option('height', $height);
        } else {
            add_option('width', $width);
            add_option('height', $height);
        }
        if ($attachement_id) {
            update_option('attachement_id', $attachement_id);
        } else {
            add_option('attachement_id', $attachement_id);
        }
        if ($custom_class) {
            update_option('custom_class', $custom_class);
        } else {
            add_option('custom_class', $custom_class);
        }
//        if (get_option('keyword_done')) {
//            update_option('keyword_done', $keyword_done);
//        } else {
//            add_option('keyword_done', $keyword_done);
//        }
        if (get_option('cron_image_limit')) {
            update_option('cron_image_limit', $lp_limit);
        } else {
            add_option('cron_image_limit', $lp_limit);
        }
    }
    $keyword_value = get_option('keyword_value');
    $width = get_option('width');
    $height = get_option('height');
    $attachement_id = get_option('attachement_id');
    $custom_class = get_option('custom_class');
    $keyword_done = get_option('keyword_done');
    $cron_image_limit = get_option('cron_image_limit');
    $img_cron_run_time = get_option('img_cron_run_time');
    $img_cron_run_time = $img_cron_run_time . "<br/> The current server time: " . date("F j, Y, g:i a");
    // check that the user has the required capability 
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient privileges to access this page. Sorry!'));
    }
    ///////////////////////////////////////
    // MAIN AMDIN CONTENT SECTION
    ///////////////////////////////////////
    // display heading with icon WP style
    ?>
    <div class="wrap">
        <div id="icon-index" class="icon32"><br></div>
        <h2>Image scraping cron</h2>
    <?php
    // let's create jQuery UI Tabs, as demonstrated in the standalone version 
    // or at http://jqueryui.com/tabs/#default

    echo '<p>Add key word to scrapp</p>';
    ?>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Key word tab</a></li>
                <li><a href="#tabs-2">Results Done</a></li>
                <li><a href="#tabs-3">Last time of cron run</a></li>
            </ul>
            <div id="tabs-1">
                <h3>Add keyword</h3>
                <form action="<?php echo site_url('/wp-admin/admin.php?page=imageScrapingCron'); ?>" method="post">
                    <table class="form-table">
                        <tbody>
                            <tr valign="top">
                                <td colspan="2"> 
                                    <textarea name="keyword_img" id="keyword_img" class="large-text code" rows="12"><?php echo $keyword_value; ?></textarea>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td colspan="2">
                                    <p>
                                        The possible values this field can contain. Enter one value per line, in the format key|label.
                                        <br/>
                                        <b>like:</b> <br/>
                                        post title :category:tag|tag2|tag3<br/>
                                        post title :category:tag|tag2|tag3

                                    </p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td> Post Thumbnail size (width X height)</td>
                                <td> <input type="text" name="width" id="width" value="<?php echo $width; ?>" size="10" /> X <input type="text" name="height" id="height" value="<?php echo $height; ?>" size="10" /></td>
                            </tr>
                            <tr valign="top">
                                <td> Attachment custom key </td>
                                <td> <input type="text" name="attachement_id" id="attachement_id" value="<?php echo $attachement_id; ?>"  /></td>
                            </tr>
                            <tr valign="top">
                                <td> Custom class </td>
                                <td> <input type="text" name="custom_class" id="custom_class" value="<?php echo $custom_class; ?>"  /></td>
                            </tr>
                            <tr valign="top">
                                <td> Loop limit  (limit x 8) 2x8 = 16 </td>
                                <td> <input type="text" name="cron_image_limit" id="loop_limit" value="<?php echo $cron_image_limit; ?>"  /></td>
                            </tr>
                        </tbody></table>


                    <p class="submit">
                        <input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit">
                    </p>
                </form>
            </div>
            <div id="tabs-2">
                <h3>Keywords which scaping done</h3>
                <textarea name="keyword_img" id="keyword_img" class="large-text code" rows="12" readonly><?php echo $keyword_done; ?></textarea>
            </div>
            <div id="tabs-3">
                <h3>Last time of cron run</h3>
                <p>
    <?php echo $img_cron_run_time; ?>  
                </p>
            </div>
        </div> <!-- end of tabs wrap -->

    </div> <!-- end of main wrap -->
    <?php
}

// end of main function
?>
