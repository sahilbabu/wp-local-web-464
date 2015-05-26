<?php
/**
 * Gridsby Theme Customizer
 *
 * @package gridsby
 */
 
function gridsby_theme_customizer( $wp_customize ) {
	
	//allows donations
    class gridsby_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() { 
        ?>

        <?php
        }
    }	
	
	// Pro
    $wp_customize->add_section( 
        'gridsby_theme_info',
        array(
            'title' => __('Gridsby Pro', 'gridsby'),
            'priority' => 5, 
            'description' => __('Want to sell your photos? Need a little bit more customization for Gridsby? If you want to see what additional features <a href="http://modernthemes.net/wordpress-themes/gridsby-pro/" target="_blank">Gridsby Pro</a> has, check them all out right <a href="http://modernthemes.net/wordpress-themes/gridsby-pro/" target="_blank">here</a>. Gridsby Pro is only $15!</br></br>We do all we can do to make all our themes free for you. While we enjoy it, and it makes us happy to help out, a little appreciation can help us to keep theming.</strong><br/><br/> Please help support our mission and continued development with a donation of $5, $10, $20, or if you are feeling really kind $100..<br/><br/> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7LMGYAZW9C5GE" target="_blank" rel="nofollow"><img class="" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="Make a donation to ModernThemes" /></a>', 'gridsby' ),
        )
    );  
	 
    //Donations section 
    $wp_customize->add_setting('gridsby_help', array(
			'sanitize_callback' => 'gridsby_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new gridsby_Info( $wp_customize, 'gridsby_help', array(
        'section' => 'gridsby_theme_info', 
        'settings' => 'gridsby_help', 
        'priority' => 10
        ) )
    );
	
	// Fonts  
    $wp_customize->add_section(
        'gridsby_typography',
        array(
            'title' => __('Google Fonts', 'gridsby' ),  
            'priority' => 39,
        )
    );
	
    $font_choices = 
        array(
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'gridsby_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
            'description' => __('Select your desired font for the headings. Open Sans is the default Heading font.', 'gridsby'),
            'section' => 'gridsby_typography',
            'choices' => $font_choices
        )
    );
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'gridsby_sanitize_fonts',
        )
    );
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
            'description' => __( 'Select your desired font for the body. Open Sans is the default Body font.', 'gridsby' ), 
            'section' => 'gridsby_typography',  
            'choices' => $font_choices 
        ) 
    );

	// Colors
	$wp_customize->add_setting( 'gridsby_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_text_color', array(
        'label'	   => __( 'Text Color', 'gridsby' ),
        'section'  => 'colors',
        'settings' => 'gridsby_text_color',
		'priority' => 10 
    ))); 
	
    $wp_customize->add_setting( 'gridsby_link_color', array( 
        'default'     => '#404040',   
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_link_color', array(
        'label'	   => __( 'Link Color', 'gridsby' ), 
        'section'  => 'colors',
        'settings' => 'gridsby_link_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'gridsby_hover_color', array(
        'default'     => '#B0544F',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_hover_color', array(
        'label'	   => __( 'Hover Color', 'gridsby' ),
        'section'  => 'colors',
        'settings' => 'gridsby_hover_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'gridsby_site_title_color', array(
        'default'     => '#404040',  
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_site_title_color', array(
        'label'	   => __( 'Site Title Color', 'gridsby' ),  
        'section'  => 'colors',
        'settings' => 'gridsby_site_title_color', 
		'priority' => 50 
    )));
	
	$wp_customize->add_setting( 'gridsby_custom_color', array( 
        'default'     => '#000000', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_custom_color', array(
        'label'	   => __('Theme Color', 'gridsby' ),
        'section'  => 'colors',
        'settings' => 'gridsby_custom_color', 
		'priority' => 20
    ))); 
	
	$wp_customize->add_setting( 'gridsby_blockquote', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_blockquote', array(
        'label'	   => __( 'Blockquote Text', 'gridsby' ),
        'section'  => 'colors',
        'settings' => 'gridsby_blockquote', 
		'priority' => 55
    )));
	
	$wp_customize->add_setting( 'gridsby_blockquote_border', array(
        'default'     => '#666666', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_blockquote_border', array(
        'label'	   => __( 'Blockquote Accent Color', 'gridsby' ), 
        'section'  => 'colors',
        'settings' => 'gridsby_blockquote_border', 
		'priority' => 60
    )));
	
	$wp_customize->add_setting( 'gridsby_pag_nav_bg', array(
        'default'     => '#FFFFFF', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_pag_nav_bg', array(
        'label'	   => __( 'Page Navigation Background Color', 'gridsby' ),  
        'section'  => 'colors',
        'settings' => 'gridsby_pag_nav_bg', 
		'priority' => 65
    )));
	
	$wp_customize->add_setting( 'gridsby_pag_nav', array(
        'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_pag_nav', array(
        'label'	   => __( 'Page Navigation Link Color', 'gridsby' ), 
        'section'  => 'colors',
        'settings' => 'gridsby_pag_nav', 
		'priority' => 70
    )));
	
	$wp_customize->add_setting( 'gridsby_pag_nav_border', array(
        'default'     => '#e6e7e8', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_pag_nav_border', array(
        'label'	   => __( 'Page Navigation Border Color', 'gridsby' ), 
        'section'  => 'colors',
        'settings' => 'gridsby_pag_nav_border',
		'priority' => 75
    )));


    // Logo upload
    $wp_customize->add_section( 'gridsby_logo_section' , array(  
	    'title'       => __( 'Logo and Icons', 'gridsby' ),
	    'priority'    => 25,
	    'description' => __( 'Upload a logo to replace the default site name and description in the header. Also, upload your site favicon and Apple Icons.', 'gridsby' ),
	) );

	$wp_customize->add_setting( 'gridsby_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'gridsby_logo', array(
		'label'    => __( 'Logo', 'gridsby' ),
		'section'  => 'gridsby_logo_section', 
		'settings' => 'gridsby_logo',
		'priority' => 1,
	) ) ); 
	
	// Logo Width 
	
    $wp_customize->add_setting(
        'logo_size',
        array(
            'sanitize_callback' => 'absint',
			'default' => '145'
    ));
	
    $wp_customize->add_control( 'logo_size', array(  
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'gridsby_logo_section',
        'label'    => __( 'Change the width of the Logo in PX.', 'gridsby' ),
		'description'    => __( 'Only enter numeric value', 'gridsby' ),
	)); 
	
	//Favicon Upload
	$wp_customize->add_setting(
		'site_favicon',
		array(
			'default' => (get_stylesheet_directory_uri() . '/img/favicon.png'),
			'sanitize_callback' => 'esc_url_raw', 
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
               'label'          => __( 'Upload your favicon (16x16 pixels)', 'gridsby' ),
			   'type' 			=> 'image',
               'section'        => 'gridsby_logo_section',
               'settings'       => 'site_favicon',
               'priority' => 2,
            )
        )
    );
    //Apple touch icon 144
    $wp_customize->add_setting(
        'apple_touch_144',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_144',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (144x144 pixels)', 'gridsby' ),
               'type'           => 'image',
               'section'        => 'gridsby_logo_section',
               'settings'       => 'apple_touch_144',
               'priority'       => 11,
            )
        )
    );
    //Apple touch icon 114
    $wp_customize->add_setting(
        'apple_touch_114',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw', 
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_114',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (114x114 pixels)', 'gridsby' ),
               'type'           => 'image',
               'section'        => 'gridsby_logo_section',
               'settings'       => 'apple_touch_114',
               'priority'       => 12,
            )
        )
    );
    //Apple touch icon 72
    $wp_customize->add_setting(
        'apple_touch_72',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_72',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (72x72 pixels)', 'gridsby' ),
               'type'           => 'image',
               'section'        => 'gridsby_logo_section',
               'settings'       => 'apple_touch_72',
               'priority'       => 13,
            )
        )
    );
    //Apple touch icon 57
    $wp_customize->add_setting(
        'apple_touch_57',
        array(
            'default-image' => '',
			'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'apple_touch_57',
            array(
               'label'          => __( 'Upload your Apple Touch Icon (57x57 pixels)', 'gridsby' ), 
               'type'           => 'image',
               'section'        => 'gridsby_logo_section',
               'settings'       => 'apple_touch_57',
               'priority'       => 14,
            )
        )
    );
	
	// Social Panel
	$wp_customize->add_panel( 'social_panel', array(
    'priority'       => 26, 
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Social Media Section', 'gridsby' ),
    'description'    => __( 'Edit your home page social media icons', 'gridsby' ), 
	));
	
	// Social Section 
	$wp_customize->add_section( 'gridsby_settings', array(
    	'title'          => __( 'Social Media Icons', 'gridsby' ),
        'priority'       => 38,
		'panel' => 'social_panel',  
    ) ); 
	
	// Header Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Header Social Section', 'gridsby' ), 
        'section' => 'gridsby_settings',  
		'priority'   => 1 
    )); 
	
	// Footer Social Section 
	$wp_customize->add_setting('active_footer_social',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_footer_social', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Social Section', 'gridsby' ), 
        'section' => 'gridsby_settings',
		'priority'   => 1
    )); 
	
	// Social Icon Colors
	$wp_customize->add_setting( 'gridsby_social_color', array( 
        'default'     => '#404040', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_social_color', array(
        'label'	   => __( 'Social Icon Color', 'gridsby' ),
        'section'  => 'gridsby_settings',
        'settings' => 'gridsby_social_color', 
		'priority' => 1
    )));
	
	$wp_customize->add_setting( 'gridsby_social_color_hover', array( 
        'default'     => '#B0544F', 
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gridsby_social_color_hover', array(
        'label'	   => __( 'Social Icon Hover Color', 'gridsby' ), 
        'section'  => 'gridsby_settings',
        'settings' => 'gridsby_social_color_hover', 
		'priority' => 2
    )));
	
	// Facebook
	$wp_customize->add_setting( 'gridsby_fb',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_fb', array(
		'label'    => __( 'Facebook URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_fb',
		'priority'   => 2
	))); 
	
	// Twitter
	$wp_customize->add_setting( 'gridsby_twitter',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_twitter', array(
		'label'    => __( 'Twitter URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_twitter',
		'priority'   => 3
	))); 
	
	// LinkedIn
	$wp_customize->add_setting( 'gridsby_linked',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_linked', array(
		'label'    => __( 'LinkedIn URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_linked',
		'priority'   => 4
	)));
	
	// Google Plus
	$wp_customize->add_setting( 'gridsby_google',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_google', array(
		'label'    => __( 'Google Plus URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_google',
		'priority'   => 5
	)));
	
	// Instagram
	$wp_customize->add_setting( 'gridsby_instagram',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_instagram', array(
		'label'    => __( 'Instagram URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_instagram',
		'priority'   => 6 
	)));
	
	// Flickr
	$wp_customize->add_setting( 'gridsby_flickr',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_flickr', array(
		'label'    => __( 'Flickr URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_flickr',
		'priority'   => 7
	)));
	
	// Pinterest
	$wp_customize->add_setting( 'gridsby_pinterest',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_pinterest', array(
		'label'    => __( 'Pinterest URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_pinterest',
		'priority'   => 8
	)));
	
	// Youtube
	$wp_customize->add_setting( 'gridsby_youtube',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_youtube', array(
		'label'    => __( 'YouTube URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_youtube',  
		'priority'   => 9
	)));
	
	// Vimeo
	$wp_customize->add_setting( 'gridsby_vimeo',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_vimeo', array(
		'label'    => __( 'Vimeo URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_vimeo',
		'priority'   => 10
	)));
	
	// Tumblr
	$wp_customize->add_setting( 'gridsby_tumblr',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_tumblr', array(
		'label'    => __( 'Tumblr URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_tumblr', 
		'priority'   => 11 
	)));
	
	// Dribbble
	$wp_customize->add_setting( 'gridsby_dribbble',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_dribbble', array(
		'label'    => __( 'Dribbble URL:', 'gridsby' ),
		'section'  => 'gridsby_settings',
		'settings' => 'gridsby_dribbble',
		'priority'   => 12
	)));
	
	// RSS
	$wp_customize->add_setting( 'gridsby_rss',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_rss', array(
		'label'    => __( 'RSS URL:', 'gridsby' ),
		'section'  => 'gridsby_settings', 
		'settings' => 'gridsby_rss',
		'priority'   => 13 
	)));
	
	
	//Selling
	$wp_customize->add_section( 'gridsby_selling_section', array(
		'title'          => __( 'Photo Post Method', 'gridsby' ), 
		'priority'       => 28,
	)); 
	
	//do you like a traditional permalink?
	$wp_customize->add_setting( 'gridsby_post_link_method', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'gridsby_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_post_link_method', array(
		'description'    => __( 'If you do not want the default animated lightbox effect, you can change to link directly to the post.', 'gridsby' ),
		'section'  => 'gridsby_selling_section', 
		'settings' => 'gridsby_post_link_method',
		'type'     => 'radio', 
		'choices'  => array(
			'option1' => __( 'Animated Lightbox', 'gridsby' ),
			'option2' => __( 'Direct Link to Post', 'gridsby' ),
			),
	)));
	
	// Add Photo Posts
	$wp_customize->add_section( 'gridsby_photo_posts' , array(
    	'title' => __( 'Photo Post Options', 'gridsby' ),
    	'priority' => 29, 
    	'description' => __( 'Customize your photo posts options', 'gridsby' )
	));
	
	// Which option
	$wp_customize->add_setting( 'gridsby_post_time_method', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'gridsby_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_post_time_method', array(
		'description'    => __( 'Select to display your posts in ascending or descending order.', 'gridsby' ),
		'section'  => 'gridsby_photo_posts',
		'settings' => 'gridsby_post_time_method',
		'type'     => 'radio', 
		'priority'   => 27, 
		'choices'  => array(
			'option1' => __( 'Ascending', 'gridsby' ),
			'option2' => __( 'Descending', 'gridsby' ), 
			),
	)));  
	
	// Home Panel
	$wp_customize->add_panel( 'home_panel', array(
    'priority'       => 30, 
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Section', 'gridsby' ), 
    'description'    => __( 'Edit your home page settings', 'gridsby' ),
	));
	
	// Home Section
	$wp_customize->add_section( 'gridsby_home_section', array(
		'title'          => __( 'Home Section', 'gridsby' ),
		'priority'       => 10,
		'description' => __( 'Customize your Gridsby home page.', 'gridsby' ),
		'panel' => 'home_panel', 
	));
	
	// hide section
	$wp_customize->add_setting('active_home_gallery',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_home_gallery', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Gallery Section', 'gridsby' ),
        'section' => 'gridsby_home_section', 
		'priority'   => 10
    ));
	
	// hide section
	$wp_customize->add_setting('active_home_blog',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_home_blog', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Blog Section', 'gridsby' ),
        'section' => 'gridsby_home_section',  
		'priority'   => 20
    ));
	
	// Button Text
	$wp_customize->add_setting( 'gridsby_view_all_text', 
	array(
		'sanitize_callback' => 'gridsby_sanitize_text',	 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_view_all_text', array(
    'label' => __( 'View More Button Text', 'gridsby' ),  
    'section' => 'gridsby_home_section',
    'settings' => 'gridsby_view_all_text',  
	'priority'   => 30
	)));
	
	// Button Page Drop Downs 
	$wp_customize->add_setting('gallery_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'gridsby_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gallery_button_url', array( 
    	'label' => __( 'Gallery Button URL', 'gridsby' ), 
    	'section' => 'gridsby_home_section',  
		'type' => 'dropdown-pages',
    	'settings' => 'gallery_button_url', 
		'priority'   => 40 
	)));
	
	// Button Text
	$wp_customize->add_setting( 'gridsby_blog_text', 
	array(
		'sanitize_callback' => 'gridsby_sanitize_text',	 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_blog_text', array(
    'label' => __( 'Blog Title', 'gridsby' ),  
    'section' => 'gridsby_home_section', 
    'settings' => 'gridsby_blog_text',  
	'priority'   => 40 
	)));
	
	// Widget Panel
	$wp_customize->add_panel( 'widget_panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Home Widget Section', 'gridsby' ),
    'description'    => __( 'Edit your home page widget settings', 'gridsby' ),
	));
	
	// Home Widget Section
	$wp_customize->add_section( 'gridsby_widget_section', array(
		'title'          => __( 'Home Widget Section', 'gridsby' ),
		'priority'       => 10,
		'description' => __( 'Customize the home widget area. The main body of the widget area can be edited under the Widgets section.', 'gridsby' ),
		'panel' => 'widget_panel', 
	));
	
	// hide section
	$wp_customize->add_setting('active_home_widget',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_checkbox',
	));
	
	$wp_customize->add_control( 
    'active_home_widget', 
    array(
        'type' => 'checkbox',
        'label' => __( 'Hide Widget Section', 'gridsby' ),
        'section' => 'gridsby_widget_section', 
		'priority'   => 10
    ));
	
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'gridsby_widget_columns', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'gridsby_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_widget_columns', array(
		'label'    => __( 'Number of Widget Columns', 'gridsby' ),
		'description'    => __( 'Select the number of widget columns to use. 1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content.', 'gridsby' ),
		'section'  => 'gridsby_widget_section', 
		'settings' => 'gridsby_widget_columns',
		'type'     => 'radio',
		'priority'   => 20,  
		'choices'  => array(
			'option1' => __( '1 Column', 'gridsby' ),
			'option2' => __( '2 Columns', 'gridsby' ), 
			'option3' => __( '3 Columns', 'gridsby' ),
			'option4' => __( '4 Columns', 'gridsby' ),
			),
	)));
	
	// Widget Image
	$wp_customize->add_setting( 'widget_bg_image', array(
		'default' => (get_stylesheet_directory_uri( 'stylesheet_directory') . '/img/cta-bg.jpg'),      
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'widget_bg_image', array( 
		'label'    => __( 'Background Image', 'gridsby' ),
		'section'  => 'gridsby_widget_section',  
		'settings' => 'widget_bg_image',  
		'priority'   => 30
	)));
	
	// Widget Text
	$wp_customize->add_setting( 'widget_button_text',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text', 
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'widget_button_text', array(
		'label'    => __( 'Widget Button Text', 'gridsby' ),
		'section'  => 'gridsby_widget_section', 
		'settings' => 'widget_button_text',
		'priority'   => 40
	))); 
	
	// Page Drop Downs 
	$wp_customize->add_setting('widget_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'gridsby_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'widget_button_url', array( 
    	'label' => __( 'Widget Button Page Link', 'gridsby' ), 
    	'section' => 'gridsby_widget_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'widget_button_url',
		'priority'   => 50
	)));
	
	// Page URL
	$wp_customize->add_setting( 'page_url_text',
	    array(
	        'sanitize_callback' => 'gridsby_sanitize_text',
	));  

	$wp_customize->add_control( 'page_url_text', array(
		'type'     => 'url',
		'label'    => __( 'External URL Option', 'gridsby' ),
		'description' => __( 'If you use an external URL, leave the Widget Button Link above empty. Must include http:// before any URL.', 'gridsby' ),
		'section'  => 'gridsby_widget_section',  
		'settings' => 'page_url_text',
		'priority'   => 60 
	));
	      
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => __( 'Footer', 'gridsby' ),
    	'priority' => 32,
    	'description' => __( 'Customize your footer area', 'gridsby' )
	) );

	// Footer Phone 
	$wp_customize->add_setting( 'gridsby_footer_phone' , 
	array( 
		'sanitize_callback' => 'gridsby_sanitize_text', 
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_footer_phone', array(
    'label' => __( 'Footer Phone Number', 'gridsby' ),
    'section' => 'footer-custom',
    'settings' => 'gridsby_footer_phone',  
	'priority'   => 3
	) ) ); 
	
	// Footer Contact
	$wp_customize->add_setting( 'gridsby_footer_contact' , 
	array(
		'sanitize_callback' => 'gridsby_sanitize_text', 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_footer_contact', array(
    'label' => __( 'Footer Email', 'gridsby' ), 
    'section' => 'footer-custom',
    'settings' => 'gridsby_footer_contact',
	'priority'   => 5
	) ) );
	
	// Footer Byline Text 
	$wp_customize->add_setting( 'gridsby_footerid',  
	array( 
		'sanitize_callback' => 'gridsby_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_footerid', array(
    'label' => __( 'Footer Byline Text', 'gridsby' ),
    'section' => 'footer-custom',
    'settings' => 'gridsby_footerid',
	'priority'   => 6 
	)));

	// Choose excerpt or full content on blog
    $wp_customize->add_section( 'gridsby_layout_section' , array( 
	    'title'       => __( 'Blog Layout', 'gridsby' ),
	    'priority'    => 45, 
	    'description' => __( 'Change how gridsby displays posts', 'gridsby' ),
	));

	$wp_customize->add_setting( 'gridsby_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'gridsby_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_post_content', array(
		'label'    => __( 'Post content', 'gridsby' ),
		'section'  => 'gridsby_layout_section',
		'settings' => 'gridsby_post_content',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => 'Excerpts',
			'option2' => 'Full content',
			),
	)));
	
	//Excerpt
    $wp_customize->add_setting(
        'exc_length',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '30',
    ));
	
    $wp_customize->add_control( 'exc_length', array( 
        'type'        => 'number',
        'priority'    => 2, 
        'section'     => 'gridsby_layout_section',
        'label'       => __('Excerpt length', 'gridsby'),
        'description' => __('Choose your excerpt length here. Default: 30 words', 'gridsby'),
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 5,
            'style' => 'padding: 15px;',
        ), 
	));
	
	// Read More Text 
	$wp_customize->add_setting( 'gridsby_read_more',  
	array(
		'default' => __( 'Read More', 'gridsby' ), 
		'sanitize_callback' => 'gridsby_sanitize_text',
	)); 
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'gridsby_read_more', array(
    'label' => __( 'Read More Text', 'gridsby' ),
    'section'     => 'gridsby_layout_section',
    'settings' => 'gridsby_read_more',
	'priority'   => 6 
	)));
   

	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage'; 
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 10;
	$wp_customize->get_section('nav')->priority = 11; 
	 

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'gridsby_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
 

}
add_action('customize_register', 'gridsby_theme_customizer');


/**
 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 1.7
 */
function gridsby_sanitize_hex_color( $color ) {
	if ( '#FF0000' === $color ) 
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}

/**
 * Sanitizes our post content value (either excerpts or full post content).
 *
 * @since 1.7
 */
function gridsby_sanitize_index_content( $content ) {
	if ( 'option2' == $content ) {
		return 'option2';
	} else {
		return 'option1';
	}
}

//Checkboxes
function gridsby_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//gridsby sanitize widget content
function gridsby_sanitize_widget_content( $input ) {
    $valid = array(
        'option1' => '1 Column', 
		'option2' => '2 Columns',
		'option3' => '3 Columns',
		'option4' => '4 Columns',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
} 

//Integers
function gridsby_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function gridsby_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//Sanitizes Fonts 
function gridsby_sanitize_fonts( $input ) {  
    $valid = array(
            'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Montserrat:400,700' => 'Montserrat',
            'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Oswald:400,700' => 'Oswald',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function gridsby_no_sanitize( $input ) {
}

/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function gridsby_add_customizer_css() {
	
	?>
	<!-- gridsby customizer CSS -->
	<style>
	
		<?php if ( get_theme_mod( 'gridsby_link_color' ) ) : ?>
		a, .widget-area ul a, .entry-content a, .site-info a {
			color: <?php echo esc_attr( get_theme_mod( 'gridsby_link_color' ), '#404040' ) ?>; 
		} 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_hover_color' ) ) : ?>
		a:hover {
			color: <?php echo esc_attr( get_theme_mod( 'gridsby_hover_color', '#B0544F' )) ?>; 
		}
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_hover_color' ) ) : ?>
		.main-navigation li:hover > a, a:hover { color: <?php echo esc_attr( get_theme_mod( 'gridsby_hover_color', '#B0544F' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_social_color' ) ) : ?>
		.social-media-icons .fa { color: <?php echo esc_attr( get_theme_mod( 'gridsby_social_color', '#404040' )) ?>; 
		-o-transition:.5s;
  		-ms-transition:.5s;
  		-moz-transition:.5s;
  		-webkit-transition:.5s;
  		transition:.5s;  }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_social_color_hover' ) ) : ?>
		.social-media-icons .fa:hover { color: <?php echo esc_attr( get_theme_mod( 'gridsby_social_color_hover', '#B0544F' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		.home-entry-title:after, .member-entry-title:after, .works-entry-title:after, .client-entry-title:after, .home-news h5:after, .home-team h5:after, .home-cta h6:after, .footer-contact h5:after, .member h5:after { border-color: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		.main-navigation ul ul li, blockquote { border-color: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?>; }
		<?php endif; ?>
		 
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		.share-button label { background: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?> !important; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		button, input[type="button"], input[type="reset"], input[type="submit"], .share-button label { border-color: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'gridsby_custom_color' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo esc_attr( get_theme_mod( 'gridsby_custom_color', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_site_title_color' ) ) : ?>
		h1.site-title a, .site-description { color: <?php echo esc_attr( get_theme_mod( 'gridsby_site_title_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_text_color' ) ) : ?>
		body, select, textarea, div.show p, .dummy-title { color: <?php echo esc_attr( get_theme_mod( 'gridsby_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_blockquote' ) ) : ?>
		blockquote { color: <?php echo esc_attr( get_theme_mod( 'gridsby_blockquote' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_blockquote_border' ) ) : ?>
		blockquote { border-color:<?php echo esc_attr( get_theme_mod( 'gridsby_blockquote_border' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_entry' ) ) : ?>
		.entry-header .entry-title, .featured-img-header .entry-title { color: <?php echo esc_attr( get_theme_mod( 'gridsby_entry' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_pag_nav' ) ) : ?>
		.comment-navigation .nav-previous a, .paging-navigation .nav-previous a, .post-navigation .nav-previous a, .posts-navigation .nav-previous a, .comment-navigation .nav-next a, .paging-navigation .nav-next a, .post-navigation .nav-next a, .posts-navigation .nav-next a { color: <?php echo esc_attr( get_theme_mod( 'gridsby_pag_nav' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'gridsby_pag_nav_bg' ) ) : ?>
		.comment-navigation .nav-previous, .paging-navigation .nav-previous, .post-navigation .nav-previous, .posts-navigation .nav-previous, .comment-navigation .nav-next, .paging-navigation .nav-next, .post-navigation .nav-next, .posts-navigation .nav-next { background: <?php echo esc_attr( get_theme_mod( 'gridsby_pag_nav_bg' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'gridsby_pag_nav_border' ) ) : ?>
		.comment-navigation .nav-previous, .paging-navigation .nav-previous, .post-navigation .nav-previous, .posts-navigation .nav-previous, .comment-navigation .nav-next, .paging-navigation .nav-next, .post-navigation .nav-next, .posts-navigation .nav-next { border-color: <?php echo esc_attr( get_theme_mod( 'gridsby_pag_nav_border' )) ?>; }
		<?php endif; ?>
		  
	</style>
    
<?php } 
add_action( 'wp_head', 'gridsby_add_customizer_css' );  
