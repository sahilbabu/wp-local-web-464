<?php
/**
 * Template Name: Gallery Page 
 *
 * @package gridsby
 */

get_header(); ?>

<div class="grid grid-pad">
	<div class="col-9-12 content-wrapper">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
    
                <section class="grid3d horizontal" id="grid3d">
				<div class="grid-wrap">
					
                    <div id="gallery-container" class="gridsby infinite-scroll">
                    	<?php
							global $post;
							
							if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_time_method' ) ) ) :  
    						$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC' ); 
							else :
							$args = array( 'post_type' => 'post', 'posts_per_page' => -1 ); 
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
					</div><!-- gallery-container --> 
				
                </div><!-- /grid-wrap -->
				
                <div class="content"> 
                        <?php
							global $post;
							
							if ( 'option1' == gridsby_sanitize_index_content( get_theme_mod( 'gridsby_post_time_method' ) ) ) :  
    						$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'order' => 'ASC' );
							else :
							$args = array( 'post_type' => 'post', 'posts_per_page' => -1 ); 
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
                            
                            <?php  } ?> 
                            
						<?php endforeach; ?>
                        
					<span class="loading"></span>
					<span class="icon close-content"><i class="fa fa-close"></i></span>
				</div><!-- content -->
			</section><!-- grid3d --> 
    
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
