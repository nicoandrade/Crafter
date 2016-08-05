<?php
/**
 * The template for displaying the Front Page.
 *
 * The front-page.php template file is used on the site's front page
 * regardless of whether 'Settings > Reading ->Front page displays' is set to "A static page" or "Your latest posts,"
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crafter
 */

get_header(); ?>
	
	<main id="main" class="site-main" role="main">

		<?php
		$default_order = array( "welcome", "services", "about", "video", "bullet-points", "pricing", "clients", "testimonials", "blog" );
		$sections_order = get_option( 'crafter_sortable_items', $default_order );

		foreach ( $sections_order as $key => $value ) {
			$value = str_replace( 'crafter_', '', $value );
			$value = str_replace( '_section', '', $value );
			$value = str_replace( '_', '-', $value );
			get_template_part( 'template-parts/section-'. $value, 'front-page' );
		}
		?>


	</main><!-- #main -->


<?php get_footer(); ?>
