<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tribbiani
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
    
    <div id="footer-container">
      <?php if ( of_get_option('credit1', true) == 0 ) { ?>
		<div class="site-info">
			<?php do_action( 'tribbiani_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'newp' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'tribbiani' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme by %1$s', 'tribbiani' ), '<a href="http://rohitink.com" rel="designer">Rohit Tripathi</a>' ); ?>
		</div><!-- .site-info -->
      <?php } //endif ?>  
        <div id="footertext">
        	<?php
			if ( (function_exists( 'of_get_option' ) && (of_get_option('footertext2', true) != 1) ) ) {
			 	echo of_get_option('footertext2', true); } ?>
        </div>    
        
        </div><!--#footer-container-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php		
	if ( (function_exists( 'of_get_option' ) && (of_get_option('footercode1', true) != 1) ) ) {
			 	echo of_get_option('footercode1', true); } ?>
<?php wp_footer(); ?>

</body>
</html>