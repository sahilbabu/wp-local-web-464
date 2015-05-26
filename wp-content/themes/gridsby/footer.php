<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package gridsby
 */
?>

	</section><!-- #content --> 

	<footer id="colophon" class="site-footer" role="contentinfo">
		
        <div class="site-info"> 
        
        <?php if( get_theme_mod( 'active_footer_social' ) == '') : ?> 
        	 
                        	<ul class='social-media-icons'> 
                            	<?php if ( get_theme_mod( 'gridsby_fb' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_fb' )); ?>">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_twitter' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_twitter' )); ?>">
                                    <i class="fa fa-twitter"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_linked' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_linked' )); ?>">
                                    <i class="fa fa-linkedin"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_google' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_google' )); ?>">
                                    <i class="fa fa-google-plus"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_instagram' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_instagram' )); ?>">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_flickr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_flickr' )); ?>">
                                    <i class="fa fa-flickr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_pinterest' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_pinterest' )); ?>">
                                    <i class="fa fa-pinterest"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_youtube' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_youtube' )); ?>">
                                    <i class="fa fa-youtube"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_vimeo' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_vimeo' )); ?>">
                                    <i class="fa fa-vimeo-square"></i>
                                    </a>
                                    </li> 
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_tumblr' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_tumblr' )); ?>">
                                    <i class="fa fa-tumblr"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_dribbble' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_dribbble' )); ?>">
                                    <i class="fa fa-dribbble"></i>
                                    </a>
                                    </li>
								<?php endif; ?>
                                <?php if ( get_theme_mod( 'gridsby_rss' ) ) : ?>
                                	<li>
                                    <a href="<?php echo esc_url( get_theme_mod( 'gridsby_rss' )); ?>">
                                    <i class="fa fa-rss"></i>
                                    </a>
                                    </li>   
								<?php endif; ?>
                        	</ul>
          
			<?php else : ?>  
			<?php endif; ?>
			<?php // end if ?> 
        
		<?php if ( get_theme_mod( 'gridsby_footer_phone' ) ) : ?> 
        	<h3 class="phone"><?php echo esc_html( get_theme_mod( 'gridsby_footer_phone' )); ?></h3>
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'gridsby_footer_contact' ) ) : ?>
        	<h3 class="email"><a href="mailto:<?php echo esc_html( get_theme_mod( 'gridsby_footer_contact' )); ?>" target="_blank"><?php echo esc_html( get_theme_mod( 'gridsby_footer_contact' )); ?></h3></a>
        <?php endif; ?> 
			
		<?php if ( get_theme_mod( 'gridsby_footerid' ) ) : ?>     
        	<?php echo esc_html( get_theme_mod( 'gridsby_footerid' )); ?>  
		<?php else : ?>  
    		<?php  printf( __( 'Theme: %1$s by %2$s', 'gridsby' ), 'gridsby', '<a href="http://modernthemes.net" rel="designer">modernthemes.net</a>' ); ?> 
		<?php endif; ?> 
		
        </div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
