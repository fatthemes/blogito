<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package blogito
 */

if ( ! function_exists( 'blogito_jetpack_setup' ) ) :

	/**
	 * Add theme support for Infinite Scroll.
	 * See: https://jetpack.me/support/infinite-scroll/
	 */
	function blogito_jetpack_setup() {
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'render' => 'blogito_infinite_scroll_render',
			'footer' => false,
		)
	);
	}

	add_action( 'after_setup_theme', 'blogito_jetpack_setup' );
endif;

if ( ! function_exists( 'blogito_infinite_scroll_render' ) ) :

	/**
	 * Custom render function for Infinite Scroll.
	 */
	function blogito_infinite_scroll_render() {
	while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content-home', get_theme_mod( 'home_page_layout', 'classic' ) );
	}
	}

endif;
