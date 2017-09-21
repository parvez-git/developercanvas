<?php
/*
	Projects Posts Widget
*/
class DevCan_Project_Posts_Widget extends WP_Widget {

	// setup the widget name, description, etc...
	public function __construct() {

		$widget_ops = array(
			'classname'    => 'devcan-project-posts-widget',
			'description'  => 'Project Posts Widget',
		);
		parent::__construct( 'devcan_project_posts', 'DevCan Project Posts', $widget_ops );

	}

	// back-end display of widget
	public function form( $instance ) {

		$title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Project Posts' );
		$tot = ( !empty( $instance[ 'tot' ] ) ? absint( $instance[ 'tot' ] ) : 4 );

		$output = '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
		$output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"';
		$output .= '</p>';

		$output .= '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts:</label>';
		$output .= '<input type="number" class="widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) ) . '" value="' . esc_attr( $tot ) . '"';
		$output .= '</p>';

		echo $output;

	}

	// update widget
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'tot' ] = ( !empty( $new_instance[ 'tot' ] ) ? absint( strip_tags( $new_instance[ 'tot' ] ) ) : 0 );

		return $instance;

	}

	// front-end display of widget
	public function widget( $args, $instance ) {

		$tot = absint( $instance[ 'tot' ] );

		$posts_args = array(
			'post_type'			=> 'devcan_projects',
			'posts_per_page'=> $tot,
			'order'				  => 'DESC'
		);

		$posts_query = new WP_Query( $posts_args );

		echo $args[ 'before_widget' ];

		if( !empty( $instance[ 'title' ] ) ):

			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];

		endif;

		if( $posts_query->have_posts() ):

			echo '<ul>';

				while( $posts_query->have_posts() ): $posts_query->the_post();

					$ppost = '<li>';
					$ppost .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>';
					$ppost .= '</li>';
					echo $ppost;

				endwhile;

			echo '</ul>';

		endif;

		echo $args[ 'after_widget' ];

	}

}

/*
	Projects Categories Widget
*/
class DevCan_Project_Category_Widget extends WP_Widget {

	// setup the widget name, description, etc...
	public function __construct() {

		$widget_ops = array(
			'classname'    => 'devcan-project-categories-widget',
			'description'  => 'Project Categories Widget',
		);
		parent::__construct( 'devcan_project_categories', 'DevCan Project Categories', $widget_ops );

	}

	// back-end display of widget
	public function form( $instance ) {

		$title = ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Project Categories' );

		$output = '<p>';
		$output .= '<label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title:</label>';
		$output .= '<input type="text" class="widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $title ) . '"';
		$output .= '</p>';

		echo $output;

	}

	// update widget
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ] ) ? strip_tags( $new_instance[ 'title' ] ) : '' );

		return $instance;

	}

	// front-end display of widget
	public function widget( $args, $instance ) {

		echo $args[ 'before_widget' ];

		if( !empty( $instance[ 'title' ] ) ):

			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];

		endif;


    $categories = get_categories( array(
        'orderby' => 'name',
        'parent'  => 0,
        'taxonomy'=> 'devcan_projects_category'
    ) );

    echo '<ul>';

    foreach ( $categories as $category ) {
        printf( '<li><a href="%1$s">%2$s</a></li>',
            esc_url( get_category_link( $category->term_id ) ),
            esc_html( $category->name )
        );
    }
    echo '</ul>';


		echo $args[ 'after_widget' ];

	}

}

add_action( 'widgets_init', function() {
	register_widget( 'DevCan_Project_Posts_Widget' );
	register_widget( 'DevCan_Project_Category_Widget' );
} );
