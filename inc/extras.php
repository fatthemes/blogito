<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blogito
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogito_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_theme_mod( 'blogito_reading_typography', 0 ) ) {
		$classes[] = 'blogito-reading';
	}

	if ( get_theme_mod( 'blogito_wide_align', 0 ) ) {
		$classes[] = 'blogito-wide-align';

		if ( is_single() && ! get_theme_mod( 'single_post_sidebar', 1 ) ) {
			$classes[] = 'blogito-no-sidebar';
		}
	}

	if ( get_theme_mod( 'blogito_card_hover', 0 ) ) {
		$classes[] = 'blogito-card-hover';
	}

	if ( ! get_theme_mod( 'blogito_header_hide_on_scroll', 1 ) ) {
		$classes[] = 'blogito-header-static';
	}

	return $classes;
}

add_filter( 'body_class', 'blogito_body_classes' );

/**
 * Prints the back-to-top button and reading progress bar when their options are on.
 */
function blogito_footer_extras() {
	if ( get_theme_mod( 'blogito_back_to_top', 0 ) ) {
		?>
		<button type="button" class="blogito-back-to-top" hidden><span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'blogito' ); ?></span><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M12 7.6l-7.3 7.3 1.4 1.4 5.9-5.9 5.9 5.9 1.4-1.4z"></path></svg></button>
		<?php
	}

	if ( get_theme_mod( 'blogito_progress_bar', 0 ) && is_single() ) {
		?>
		<div class="blogito-progress" aria-hidden="true"><span class="blogito-progress-bar" style="background-color: <?php echo esc_attr( get_theme_mod( 'button_color', '#7d7250' ) ); ?>;"></span></div>
		<?php
	}
}

add_action( 'wp_footer', 'blogito_footer_extras' );

/**
 * Turns on the new-activation defaults for Reading & Extras settings that were never saved.
 */
function blogito_set_new_activation_defaults() {
	$blogito_mods = get_theme_mods();

	// Known limit: a returning Blogito user who never saved these settings gets these defaults too.
	foreach ( array( 'blogito_reading_typography', 'blogito_author_box', 'blogito_wide_align', 'blogito_back_to_top', 'blogito_card_hover' ) as $blogito_mod ) {
		if ( ! is_array( $blogito_mods ) || ! array_key_exists( $blogito_mod, $blogito_mods ) ) {
			set_theme_mod( $blogito_mod, true );
		}
	}
}

add_action( 'after_switch_theme', 'blogito_set_new_activation_defaults' );
