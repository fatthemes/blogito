<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

get_header();
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'template-parts/content', 'home-slider' ); ?>
<?php endif; ?>

<?php get_sidebar( 'top' ); ?>
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
			<?php if ( get_theme_mod( 'home_page_latest_posts_text', 1 ) ) : ?>
		<div class="blogito-page-intro">
			<h2><span><?php echo esc_html__( 'Latest Posts', 'blogito' ); ?></span></h2>
			<p id="today-date"></p>
		</div>
	<?php endif; ?>
	<main id="main" class="site-main row masonry-container" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				if ( ! is_sticky() ) :
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content-home', $blogito_home_page_layout );
					?>
				<?php endif; ?>
			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->

	<?php
	if ( '' === get_theme_mod( 'pagination', 'infinite' ) ) {
		the_posts_pagination();
	} else {
		the_posts_navigation();
	}
	?>
	</div><!-- #primary -->

	<?php
	if ( ! empty( $blogito_home_page_layout ) ) {
		get_sidebar();
	}
	?>
</div><!-- .row -->
<?php get_footer(); ?>
