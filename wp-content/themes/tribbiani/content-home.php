<?php
/**
 * @package Tribbiani
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("homepage-article"); ?>>
	<header class="entry-header">
	
		<?php if (has_post_thumbnail()) : ?>	
		<div class="featured-image-container">
			<a href="<?php the_permalink(); ?>" title='<?php the_title(); ?>' rel="bookmark"> <?php the_post_thumbnail('homepage-thumb'); ?></a>
		</div>	
		<?php endif; ?>
		
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php tribbiani_posted_on(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( '0', 'tribbiani' ), __( '1', 'tribbiani' ), __( '%', 'tribbiani' ) ); ?></span>
		<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

		
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

	</header><!-- .entry-header -->

</article><!-- #post-## -->
