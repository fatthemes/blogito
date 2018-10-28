<?php
/**
 * The sidebar containing the top widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogito
 */

if ( ! is_active_sidebar( 'top-1' ) ) {
	return;
}
?>
<div class="row">
	<div id="top-widget" class="widget-area col-xs-12" role="complementary">
	<?php dynamic_sidebar( 'top-1' ); ?>
	</div><!-- #top-widget -->
</div>
