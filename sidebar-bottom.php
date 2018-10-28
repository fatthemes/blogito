<?php
/**
 * The sidebar containing the bottom widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogito
 */

if ( ! is_active_sidebar( 'bottom-1' ) ) {
	return;
}
?>
<div id="bottom-widget" class="widget-area container<?php echo esc_attr( get_theme_mod( 'bottom_widget_area_width', '' ) ); ?>" role="complementary">
	<div class="row">
	<?php dynamic_sidebar( 'bottom-1' ); ?>
	</div>
</div><!-- #bottom-widget -->
