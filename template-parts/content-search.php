<?php
/**
 * Template part for displaying results in search pages
 * @package developercanvas
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail()): ?>

		<?php if ('post' === get_post_type()): ?>
			<div class="entry-post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php elseif ('devcan_projects' === get_post_type()): ?>
			<div class="devcan-projects-thumbnail" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false, '' )[0]; ?>');"></div>
		<?php endif; ?>

	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php developercanvas_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php elseif ( 'devcan_projects' === get_post_type() ): ?>
			<div class="entry-meta">
				<?php developercanvas_posted_on(); ?>
				<?php developercanvas_posted_in_custom_post(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php developercanvas_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
