<?php
/**
 * The sidebar containing the menu social widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogito
 */

if ( ! is_active_sidebar( 'menu-social-1' ) ) {
	return;
}
?>
<div id="menu-social-widget" class="widget-area menu-social-widget" role="complementary">
	<?php dynamic_sidebar( 'menu-social-1' ); ?>
</div><!-- #menu-social-widget -->
