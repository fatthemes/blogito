<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package blogito
 */

get_header();
?>
<div class="row">
	<div id="primary" class="content-area
	<?php
	$blogito_home_page_layout = get_theme_mod( 'home_page_layout', 'classic' );
	echo ( empty( $blogito_home_page_layout ) ) ? ' col-md-12' : ' col-lg-8';
	if ( ! empty( $blogito_home_page_layout ) && ! is_active_sidebar( 'sidebar-1' ) ) :
	echo ' col-lg-push-2';
	endif;
	?>
	 ">

	<div class="blogito-page-intro">
		<h1><?php echo esc_html__( 'Error 404', 'blogito' ); ?></h1>
	</div>

	<main id="main" class="site-main" role="main">
		<section class="error-404 not-found">
		<div class="blogito-404">
			<h1><?php esc_html_e( '404', 'blogito' ); ?></h1>
		</div>
		<div class="page-content">
			<p><?php printf( '<span class="lead">%s</span><br/>%s', esc_html__( 'It looks like nothing was found at this location.', 'blogito' ), esc_html__( 'Maybe try a search?', 'blogito' ) ); ?></p>

			<?php get_search_form(); ?>

		</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

	</div><!-- #primary -->

	<?php
	if ( ! empty( $blogito_home_page_layout ) ) {
	get_sidebar();
	}
	?>
</div><!-- .row -->
<?php get_footer(); ?>
