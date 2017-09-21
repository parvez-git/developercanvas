<?php
/**
 * The template for displaying search results pages
 * @package developercanvas
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main container">
			<div class="col-md-8">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header-search">
					<h1 class="page-title"><?php
						printf( esc_html__( 'Search Results for: %s', 'developercanvas' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
				</header><!-- .page-header -->

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'search' );

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
	</section><!-- #primary -->

<?php
get_footer();
