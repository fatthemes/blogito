<?php
/**
 * Page walker used by the Top menu fallback.
 *
 * @see blogito_top_menu_fallback()
 *
 * @package blogito
 */

/**
 * Outputs pages with the same submenu markup as wp_nav_menu().
 */
class Blogito_Walker_Menu_Fallback extends Walker_Page {

	/**
	 * Outputs the beginning of a submenu.
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Depth of page.
	 * @param array  $args   Arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n{$indent}<ul class=\"sub-menu\">\n";
	}

	/**
	 * Outputs the beginning of a page element.
	 *
	 * @param string  $output            Used to append additional content (passed by reference).
	 * @param WP_Post $data_object       Page data object.
	 * @param int     $depth             Depth of page.
	 * @param array   $args              Arguments.
	 * @param int     $current_object_id ID of the current page.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		parent::start_el( $output, $data_object, $depth, $args, $current_object_id );

		// Same expand toggle as blogito_submenu_span() adds to wp_nav_menu() items.
		if ( isset( $args['pages_with_children'][ $data_object->ID ] ) && ( empty( $args['depth'] ) || $depth + 1 < $args['depth'] ) ) {
			$output .= blogito_get_submenu_toggle();
		}
	}
}
