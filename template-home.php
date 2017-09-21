<?php
/**
 * Template Name: Home Template
 *
 * The template for displaying Home
 * @package developercanvas
 */

get_header(); ?>

	<div id="primary" class="content-area-home">
		<main id="main" class="site-main">

      <section id="home">
	      <div class="container hero-content">
	        <h1>Hello, I'm Parvez Alam, a web developer from Bangladesh. I design and develop simple, beautiful and usable websites <span id="planguage"></span></h1>
	      </div>
      </section>

      <section id="services">
        <div class="container">
          <h2 class="section-title text-center">My Services</h2>
          <div class="row">
            <?php
            $args = array(
              'post_type'       => 'devcan_service',
              'posts_per_page'  => -1
            );

            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    the_title('<div class="col-md-4 col-sm-6"><h3>','</h3></div>');
                endwhile; wp_reset_postdata();
            endif;
            ?>
          </div>
        </div>
      </section>


      <section id="portfolio">
        <div class="container-fluid">
          <h2 class="section-title text-center">Latest Projects</h2>

          <div class="grid">
            <?php
            $args = array(
              'post_type'       => 'devcan_projects',
              'order'           => 'ASC',
              'posts_per_page'  => -1
            );

            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                  if (has_post_thumbnail()) :
										$meta_url = get_post_meta( get_the_ID(), 'devcan-projects-url', true );
										$terms = get_the_terms( get_the_ID() , 'devcan_projects_category' );
            			?>
                    <div class="grid-item">
                      <?php the_post_thumbnail(); ?>
                      <div class="overlay">
                        <div class="grid-item-content">
                          <div class="grid-item-icon" id="lightgallery">
                            <a href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="fresco" data-fresco-caption="<?php the_title(); ?>" data-fresco-group-options="ui: 'inside'" data-fresco-group="portfolio"><i class="icon-zoom-in"></i></a>
														<?php if( !empty( $meta_url ) ) : ?>
															<a href="<?php echo $meta_url; ?>" target="_blank"><i class="icon-link"></i></a>
													  <?php endif; ?>
                          </div>
                          <h2 class="grid-item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
													<?php
														if(is_array($terms)){
															foreach ( $terms as $term ) {
																 echo '<a href="'.esc_url( get_category_link($term->term_id) ).'" class="project-cat">'.$term->name.'</a>';
															}
														}
													?>
                        </div>
                      </div>
                    </div>

                    <?php
                  endif;
                endwhile; wp_reset_postdata();
            endif;
            ?>
          </div>

        </div>
      </section>

      <section id="contact">
				<div class="container">
					<div class="contact-us">
						<h4>JUST WANNA SAY HI?</h4>
						<p class="description">You can email me directly or connect with me through my social networks.</p>
						<a href="mailto:parvez@developercanvas.com">parvez@developercanvas.com</a>
					</div>
				</div>
      </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
