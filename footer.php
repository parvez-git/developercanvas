<?php
/**
 * The template for displaying the footer
 * @package developercanvas
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container site-info">

			<div class="socials">
				<?php if( get_theme_mod( 'socials_url_facebook' ) != '' ) { ?>
					<a id="social-facebook" href="<?php echo get_theme_mod( 'socials_url_facebook' ); ?>" target="_blank"><i class="icon-facebook"></i></a>
				<?php } if( get_theme_mod( 'socials_url_twitter' ) != '') { ?>
					<a id="social-twitter" href="<?php echo get_theme_mod( 'socials_url_twitter' ); ?>" target="_blank"><i class="icon-twitter"></i></a>
				<?php } if( get_theme_mod( 'socials_url_youtube' ) != '') { ?>
					<a id="social-youtube" href="<?php echo get_theme_mod( 'socials_url_youtube' ); ?>" target="_blank"><i class="icon-youtube"></i></a>
				<?php } if( get_theme_mod( 'socials_url_linkedin' ) != '') { ?>
					<a id="social-linkedin" href="<?php echo get_theme_mod( 'socials_url_linkedin' ); ?>" target="_blank"><i class="icon-linkedin"></i></a>
				<?php } if( get_theme_mod( 'socials_url_github' ) != '') { ?>
					<a id="social-github" href="<?php echo get_theme_mod( 'socials_url_github' ); ?>" target="_blank"><i class="icon-github-circled"></i></a>
				<?php }  ?>
			</div>

			<div class="copyright">
				<a href="<?php echo esc_url( __( 'https://developercanvas.com/', 'developercanvas' ) ); ?>"><?php
					printf( esc_html__( '&copy; Copyright 2017 Developer Canvas.', 'developercanvas' ), 'developercanvas' );
				?></a>
			</div><!-- .copyright -->
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
