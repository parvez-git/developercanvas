<?php
/**
 * The sidebar containing the main widget area
 * @package developercanvas
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php
		if ('devcan_projects' === get_post_type()) {
			dynamic_sidebar( 'sidebar-2' );
		}else{
			dynamic_sidebar( 'sidebar-1' );
		}
	?>
</aside><!-- #secondary -->
