<?php
/**
 * Register custom-post-type for service and portfolio
 * @package developercanvas
 */

function devcan_register_custom_post_init(){

  register_post_type('devcan_service',
     [
         'labels'      => [
             'name'          => __('Services', 'developercanvas'),
             'singular_name' => __('Service', 'developercanvas'),
             'add_new_item'  => __('Add New Service', 'developercanvas'),
         ],
         'public'      => true,
         'has_archive' => true,
         'rewrite'     => ['slug' => 'services'],
         'supports'    => array('title'),
         'menu_icon'   => 'dashicons-admin-generic',
     ]
  );

}
add_action('init','devcan_register_custom_post_init');


function devcan_register_custom_portfolio_post_init(){

  register_post_type('devcan_projects',
     [
         'labels'      => [
             'name'          => __('Projects', 'developercanvas'),
             'singular_name' => __('Project', 'developercanvas'),
             'add_new_item'  => __('Add New Project', 'developercanvas'),
         ],
         'public'      => true,
         'has_archive' => true,
         'rewrite'     => ['slug' => 'devcan-projects'],
         'supports'    => array('title', 'editor', 'thumbnail'),
         'menu_icon'   => 'dashicons-layout',
         'taxonomies'  => array( 'devcan_projects_category', 'post_tag' ),
     ]
  );

}
add_action('init','devcan_register_custom_portfolio_post_init');

function devcan_register_portfolio_taxonomy_init() {
    register_taxonomy(
        'devcan_projects_category',
        'devcan_projects',
        array(
            'label'         => __( 'Project Category', 'developercanvas' ),
            'public'        => true,
            'rewrite'       => ['slug' => 'projects-category'],
            'hierarchical'  => true,
        )
    );
}
add_action('init','devcan_register_portfolio_taxonomy_init');


function devcan_project_url_custom_meta() {
    add_meta_box(
      'devcan_project_url_meta',
      __( 'Project Live Site URL:', 'developercanvas' ),
      'devcan_project_url_meta_callback',
      'devcan_projects'
    );
}
add_action( 'add_meta_boxes', 'devcan_project_url_custom_meta' );


function devcan_project_url_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'devcan_nonce' );
  $project_url = get_post_meta( $post->ID );
  ?>
    <input type="text" name="devcan-projects-url" value="<?php if ( isset ( $project_url['devcan-projects-url'] ) ) echo $project_url['devcan-projects-url'][0]; ?>" class="widefat"/>
  <?php
}

function devcan_project_url_meta_save( $post_id ) {

    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'devcan_nonce' ] ) && wp_verify_nonce( $_POST[ 'devcan_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if( isset( $_POST[ 'devcan-projects-url' ] ) ) {
        update_post_meta( $post_id, 'devcan-projects-url', sanitize_text_field( $_POST[ 'devcan-projects-url' ] ) );
    }

}
add_action( 'save_post', 'devcan_project_url_meta_save' );
