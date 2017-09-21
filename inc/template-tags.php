<?php
/**
 * Custom template tags for this theme
 * @package developercanvas
 */

if ( ! function_exists( 'developercanvas_posted_on' ) ) :

	function developercanvas_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'developercanvas' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'developercanvas' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'developercanvas_entry_footer' ) ) :

	function developercanvas_entry_footer() {

		if ( 'post' === get_post_type() ) {

			$categories_list = get_the_category_list( esc_html__( ', ', 'developercanvas' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'developercanvas' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'developercanvas' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( ' Tagged %1$s', 'developercanvas' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo ' <span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'developercanvas' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( ' Edit <span class="screen-reader-text">%s</span>', 'developercanvas' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'developercanvas_posted_in_custom_post' ) ) :

	function developercanvas_posted_in_custom_post(){

		if ( 'devcan_projects' === get_post_type() ) {

			$terms = get_the_terms( get_the_ID() , 'devcan_projects_category' );
			if(is_array($terms)){
				echo 'Posted in ';
				foreach ( $terms as $key=>$term ) {
					if ($key != 0) echo ', ';
					echo '<a href="'.esc_url( get_category_link($term->term_id) ).'">'.$term->name.'</a>';
				}
			}


		}

	}

endif;
