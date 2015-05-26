<?php
/**
Template Name: Home Page
 *
 * @package gridsby
 */

get_header(); ?>

	<div class="container home-grid"> 
			<!-- Top Navigation -->
            
    <section class="grid3d horizontal" id="grid3d">
		<div class="grid-wrap">
	    	<div id="gallery-container" class="gridsby infinite-scroll"> 
            
            		<?php if( get_theme_mod( 'active_home_gallery' ) == '') : ?> 
                    
                    	<?php
							global $post;
							
							if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_time_method' ) ) ) :  
    						$args = array( 'post_type' => 'post', 'posts_per_page' => 20, 'order' => 'ASC', 'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image',
    								))); 
							else :
							$args = array( 'post_type' => 'post', 'posts_per_page' => 20, 'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image',
    								)));  
							endif;
							
							$myposts = get_posts( $args );
							foreach( $myposts as $post ) :	setup_postdata($post); ?>
                            
                        <?php if ( has_post_format( 'image' )) { ?>
                        
                        	<?php if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_link_method' ) ) ) : ?> 

      							<figure class="gallery-image">
									<?php the_post_thumbnail('gridsby-gallery-thumb'); ?> 
                            	</figure><!-- gallery-image --> 
                                
                           <?php else : ?>
                                
                                <a href="<?php the_permalink(); ?>">
                                	<figure class="gallery-image">
										<?php the_post_thumbnail('gridsby-gallery-thumb'); ?> 
                            		</figure><!-- gallery-image -->
                                </a>
                                
                           <?php endif; ?>

  						<?php } ?> 
        
						<?php endforeach; ?>
                        
                    <?php else : ?>  
					<?php endif; ?> 
					<?php // end if ?>     
                        
					</div><!-- gallery-container -->
                </div><!-- /grid-wrap -->
				
                <div class="content">
                        <?php
							global $post;
							
							if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_time_method' ) ) ) :  
    						$args = array( 'post_type' => 'post', 'posts_per_page' => 20, 'order' => 'ASC', 'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image',
    								))); 
							else :
							$args = array( 'post_type' => 'post', 'posts_per_page' => 20, 'tax_query' => 				
								array(
									array(
      								'taxonomy' => 'post_format',
      								'field' => 'slug',
      								'terms' => 'post-format-image',
    								))); 
							endif; 
						
							$myposts = get_posts( $args );  
							foreach( $myposts as $post ) :	setup_postdata($post); ?>
                            
                            <?php if ( has_post_format( 'image' )) { ?>
                            
                            	<?php if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_link_method' ) ) ) : ?>
            
                            		<div>
										<div class="dummy-img"><?php the_post_thumbnail('gridsby-gallery-full'); ?></div> 
                            			<h2 class="dummy-title"><?php the_title(); ?><div class='share-button share-button-left'></div></h2>
										<?php the_content(); ?>
									</div>
                            
                            	<?php else : ?> 
							<?php endif; ?>
                            
                            <?php } ?> 
             
						<?php endforeach; ?>
                        
					<span class="loading"></span>
					<span class="icon close-content"><i class="fa fa-close"></i></span>
                          
			</div><!-- content -->
		</section><!-- grid3d -->
    
	</div><!-- /container -->
    
    <div class="grid grid-pad">
    	<div class="col-1-1">
        
        	<?php if ( get_theme_mod( 'gridsby_view_all_text' ) ) : ?>
    			<a href="<?php echo esc_url( get_page_link(get_theme_mod('gallery_button_url')))?>"><button class="photo-archive"><?php echo esc_html( get_theme_mod( 'gridsby_view_all_text' )); ?></button></a> 
            <?php endif; ?>
            
        </div>
    </div>
    

    <?php if( get_theme_mod( 'active_home_widget' ) == '') : ?>
    
    <section id="home-page-cta" style="background: url(<?php echo esc_url( get_theme_mod( 'widget_bg_image', __( (get_stylesheet_directory_uri( 'stylesheet_directory') . '/img/cta-bg.jpg'), 'gridsby' )) ); ?>) no-repeat;"> 
        <div class="grid grid-pad">
            <div class="col-1-1">
            
            
            <?php $widget_columns = get_theme_mod( 'gridsby_widget_columns' );
    			if( $widget_columns != '' ) {
        		switch ( $widget_columns ) { 
            	case 'option1':
                	// Do nothing. all services are displayed. 
                	break;
            	case 'option2':
                	echo '<style type="text/css">';
                	echo '.gridsby-home-widget-area .widget { width: 50%; float:left; padding-right: 30px; }';
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.gridsby-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}';
					echo '</style>';
                	break;
            	case 'option3': 
                	echo '<style type="text/css">';
                	echo '.gridsby-home-widget-area .widget { width: 33.33%; float:left; padding-right: 30px; }';
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.gridsby-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}';
					echo '</style>';
                	break;
				case 'option4':
                	echo '<style type="text/css">';
                	echo '.gridsby-home-widget-area .widget { width: 25%; float:left; padding-right: 30px; }'; 
					echo '@media handheld, only screen and (max-width: 767px) {';
					echo '.gridsby-home-widget-area .widget { width: 100%; float:none; padding-right: 0px; }';
                	echo '}'; 
					echo '</style>';
                	break;
        			}
    				} 
			?>
            
            	<div class="gridsby-home-widget-area"> 
            
            	<?php if ( is_active_sidebar('home-widget') ) : ?>
    				<?php dynamic_sidebar('home-widget'); ?>    
    		 	<?php endif; ?>
                    
                <?php if ( get_theme_mod( 'widget_button_text' ) ) : ?> 
                
                <div class="col-1-1">
   
                	<?php if ( get_theme_mod( 'widget_button_url' ) ) : ?>
                    	<a href="<?php echo esc_url( get_page_link(get_theme_mod('widget_button_url'))) ?>">
					<?php endif; ?>
       
                    <?php if ( get_theme_mod( 'page_url_text' ) ) : ?>
    					<a href="<?php echo esc_url( get_theme_mod('page_url_text')) ?>" target="_blank">   
					<?php endif; ?>
                     
                    <button class="outline"><?php echo esc_html( get_theme_mod( 'widget_button_text' )); ?></button></a>
                    
                </div>
                     
     			<?php endif; ?>
                
                </div> 
                
                
            </div>
        </div>
    </section>
    
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>
    
    <?php if( get_theme_mod( 'active_home_blog' ) == '') : ?>
    
    <section id="home-blog">
    	<div class="grid grid-pad">
        	<div class="col-1-1">
            
            	<?php if ( get_theme_mod( 'gridsby_blog_text' ) ) : ?>
            		<h2><?php echo esc_html( get_theme_mod( 'gridsby_blog_text' )); ?></h2>
                <?php endif; ?>
                
            </div>
        </div>
    	<div class="grid grid-pad">
    
						<?php
							global $post;
							$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'tax_query' => array(
    									array(
      									'taxonomy' => 'post_format',
      									'field' => 'slug',
      									'terms' => 'post-format-image', 
      									'operator' => 'NOT IN'
    									)
  										));
							$myposts = get_posts( $args ); 
							foreach( $myposts as $post ) :	setup_postdata($post); ?>
				
                			<div class="col-1-3">
                            	<div class="blog-post">
									<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); $url = $thumb['0']; ?>
                                    <div class="blog-post-thumbnail" style="background-image: url('<?php echo $url?>')"></div>
                                    <a href="<?php the_permalink(); ?>">
                                    <div class="blog-post-content">
                                        <div class="content-container">
                                            <p class="date"><?php the_time( get_option( 'date_format' ) ); ?></p>
                                            <h4><?php the_title(); ?></h4>
                                            <p><?php $content = get_the_content(); $trimmed_content = wp_trim_words( $content, 15, '...' ); echo $trimmed_content; ?></p>
                                        </div>
                                    </div>
                                    </a>
                                </div>
        					</div>
                	
						<?php endforeach; ?>
    	</div>
    </section>
    
    <?php else : ?>  
	<?php endif; ?>
	<?php // end if ?>

<?php get_footer(); ?>
