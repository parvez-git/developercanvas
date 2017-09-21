<?php
/**
 * Template part for displaying posts
 * @package developercanvas
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail()): ?>

    <?php if ('post' === get_post_type()): ?>
  		<div class="entry-post-thumbnail">
  			<?php the_post_thumbnail(); ?>
  		</div>
    <?php elseif ('devcan_projects' === get_post_type() && !is_singular()): ?>
      <div class="devcan-projects-thumbnail" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full', false, '' )[0]; ?>');"></div>
    <?php elseif ('devcan_projects' === get_post_type() && is_singular() ): ?>
      <div class="entry-post-thumbnail">
        <?php the_post_thumbnail(); ?>
      </div>
  	<?php endif; ?>

	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
  		<div class="entry-meta">
  			<?php developercanvas_posted_on(); ?>
        <?php developercanvas_entry_footer(); ?>
  		</div><!-- .entry-meta -->
    <?php elseif ( 'devcan_projects' === get_post_type() ): ?>
      <div class="entry-meta">
        <?php developercanvas_posted_on(); ?>
        <?php developercanvas_posted_in_custom_post(); ?>
      </div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
      if ( is_singular() ) :
  			the_content( sprintf(
  				wp_kses(
  					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'developercanvas' ),
  					array(
  						'span' => array(
  							'class' => array(),
  						),
  					)
  				),
  				get_the_title()
  			) );

  			wp_link_pages( array(
  				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'developercanvas' ),
  				'after'  => '</div>',
  			) );

      else:
        the_excerpt();
      endif;
		?>
	</div><!-- .entry-content -->

	<?php if ( !is_singular() ) : ?>
		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>">continuous reading &rarr;</a>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
