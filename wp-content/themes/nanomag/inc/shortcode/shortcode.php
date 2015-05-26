<?php 

/* =====================================================
 *                      Quote
 * =================================================== */
add_shortcode('quote', 'jellywp_quote');
function jellywp_quote($atts, $content)
{
    return '<blockquote class="quote_content"><span>'.$content.'</span></blockquote>';
}


/* =======================================================
 *					Audio
 * ======================================================= */
add_shortcode('audio_mp3', 'jellywp_audio');
function jellywp_audio($atts)
{
	extract( shortcode_atts(array('url'=>''), $atts));   
    return '<audio  src="'.$url.'" type="audio/mp3" controls="controls"></audio>';
}


/* ======================================================
 *					Youtube
 * ===================================================== */
 add_shortcode('youtube', 'jellywp_youtube');
 function jellywp_youtube($attr)
{
     extract( shortcode_atts(array('url'=>'','width'=>'500', 'height' => '300'), $attr));
	 $url_string = parse_url($url, PHP_URL_QUERY);
  parse_str($url_string, $args);
  $url_string= isset($args['v']) ? $args['v'] : false;
     return '<div class="embed_wrapper"><div class="video_wrapper"><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$url_string.'" frameborder="0" allowfullscreen></iframe></div></div>' ;   
}


/* ===================================================
 *                    Button Link
 * ================================================== */
	add_shortcode('button_link', 'jellywp_button_shortcode');
	function jellywp_button_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("size" => 'large', "src"=> '#', 'target'=>'_self'), $atts) );		
		return '<a href="' . $src . '" target="' . $target . '" class="' . $size . ' btn default">' . $content . '</a>';
	}	

/*=================================================================== 
 *                           Slider
  ==================================================================*/

function jellywp_image_items($att, $content = null)
{
    extract( shortcode_atts( array('link' => '#', 'source'=>'#'), $att ) );	
    return '<div class="item_slide"><a class="feature-link" href="'.strip_tags($link).'"><img src="'.strip_tags($source).'" /></a><div class="item_slide_caption shortcode_slider"><h1>'.$content.'</h1></div></div>';
}
add_shortcode('image_items', 'jellywp_image_items');

function jellywp_image_wrapper( $att, $content = null)
{
 return  '<div class="owl_slider slider-large content-sliders owl-carousel builder_slider">'.do_shortcode(strip_tags($content))."</div>";
}
add_shortcode('image_slider', 'jellywp_image_wrapper');

/* ======================================================
 *					Vimeo
 * ===================================================== */
add_shortcode('vimeo', 'jellywp_vimeo');
 function jellywp_vimeo($attr)
{
     extract( shortcode_atts(array('url'=>'','width'=>'500', 'height' => '300'), $attr));
	 preg_match('/https?:\/\/vimeo.com\/(\d+)$/', $url, $id);
     return '<div class="embed_wrapper"><div class="video_wrapper"><iframe src="http://player.vimeo.com/video/'.$id[1].'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>' ;  
}
	
/* ===================================================
 *                    Tab
 * ================================================== */
	// shortcode for tab
	$jellywp_tab_array = array();
	add_shortcode('tab', 'jellywp_tab_shortcode');
	function jellywp_tab_shortcode( $atts, $content = null ){
		global $jellywp_tab_array;
		$jellywp_tab_array = array();
		
		do_shortcode($content);
		
		$num = sizeOf($jellywp_tab_array);
		$tab = '<div id="tabs" class="content-wrap-tab">';
		
		// tab title
		$tab = $tab . '<ul class="tabs1">';
		for($i=0; $i<$num; $i++){
			$active = ( $i == 0 )? 'class="active" ' : '';
		
			$tab = $tab . '<li '.$active.'><a class="title" href="#tabs-' . $i  . '" ';
			$tab = $tab . '>' . $jellywp_tab_array[$i]["title"] . '</a></li>';
		}				
		$tab = $tab . '</ul>';
		
		// tab content

		$tab = $tab . '<div class="tab-container tabs-1">';
		for($i=0; $i<$num; $i++){
			//$active = ( $i == 0 )? 'class="active" ' : '';

			$tab = $tab . '<div id="tabs-' . $i . '" class="tab-content1" ';
			$tab = $tab . '>' . $jellywp_tab_array[$i]["content"] . '</div>';
		}
		$tab = $tab . "</div>"; // jellywp-tab-content
		
		$tab = $tab . "</div>"; // jellywp-tab

		return $tab;
	}
	add_shortcode('tab_item', 'jellywp_tab_item_shortcode');
	function jellywp_tab_item_shortcode( $atts, $content = null ){
		extract( shortcode_atts(array("title" => ''), $atts) );
		
		global $jellywp_tab_array;

		$jellywp_tab_array[] = array("title" => $title , "content" => do_shortcode($content));
	}	


add_action('init',  'jellywp_add_button');
function jellywp_add_button()
{
    if(current_user_can('edit_posts') && current_user_can('edit_pages'))
    {
         add_filter('mce_external_plugins', 'jellywp_add_plugin');  
         add_filter('mce_buttons_3', 'jellywp_register_button');  
    }
        
}

function jellywp_register_button($buttons)
{
    array_push($buttons, 'quote', 'youtube', 'vimeo', 'audio_mp3', 'tab', 'button_link', 'image_slider');
    return $buttons;
}

function jellywp_add_plugin($plugin_array)
{
    $plugin_array['tab']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['youtube']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['vimeo']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['audio'] = get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['button_link']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['quote']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
	$plugin_array['image_slider']=  get_template_directory_uri().'/inc/shortcode/shortcode.js';
    return $plugin_array;  
}
add_editor_style('css/custom-editor-style.css');
?>
