<?php
/**
 * The template for displaying WooCommerce shop, product archive and product pages.
 *
 * @link https://woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package blogito
 */

get_header();

$blogito_shop_sidebar = blogito_woocommerce_has_sidebar();
?>
<div class="row">
	<div id="primary" class="content-area <?php echo esc_attr( $blogito_shop_sidebar ? 'col-lg-8' : 'col-lg-12' ); ?>">
	<main id="main" class="site-main" role="main">

		<?php woocommerce_content(); ?>

	</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	if ( $blogito_shop_sidebar ) {
		get_sidebar( 'shop' );
	}
	?>
</div><!-- .row -->
<?php
get_footer();
