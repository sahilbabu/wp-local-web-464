<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Tribbiani
 */
?>
	<div id="footer-sidebars" class="widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
			<div class="footer-container">		
			<?php dynamic_sidebar( 'sidebar-footer' )  ?>
			</div>
	</div><!-- #footer-sidebars -->
