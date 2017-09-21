<?php
/**
 * The template for displaying archive pages
 * @package developercanvas
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container">
			<div class="col-md-8">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header-archive">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php

					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				</div>

				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
