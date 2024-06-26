<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

get_header();
?>
<?php if ( is_category() ) : ?>

	<?php
	$blogito_catmeta        = get_term_meta( $cat );
	$blogito_cat_bg_color   = ( ! empty( $blogito_catmeta['bg_color'][0] ) ) ? '#' . $blogito_catmeta['bg_color'][0] : '';
	$blogito_cat_text_color = ( ! empty( $blogito_catmeta['text_color'][0] ) ) ? '#' . $blogito_catmeta['text_color'][0] : '';
	$blogito_catimage       = ( ! empty( $blogito_catmeta['image'][0] ) ) ? $blogito_catmeta['image'][0] : '';
	$blogito_catimgsrc      = wp_get_attachment_image_src( $blogito_catimage, 'full' );
	$blogito_catimgsrc_url  = ! empty( $blogito_catimgsrc[0] ) ? $blogito_catimgsrc[0] : '';
	?>
	<div class="row archive-blogito-page-intro-row">
		<div class="blogito-page-intro col-xs-12" style="<?php echo 'background:' . esc_attr( $blogito_cat_bg_color ) . ' url(' . esc_url( $blogito_catimgsrc_url ) . ') no-repeat center;color:' . esc_attr( $blogito_cat_text_color ) . ';'; ?>background-size:cover;">
		<h1><?php echo esc_html( single_cat_title( '', false ) ); ?></h1>
		<div class="row">
		<?php the_archive_description( '<div class="taxonomy-description col-md-8 col-md-offset-2">', '</div>' ); ?>
		</div>
		</div>
	</div>
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
			<?php if ( ! is_category() ) : ?>
		<div class="blogito-page-intro">
			<h1><?php the_archive_title(); ?></h1>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
		</div>
	<?php endif; ?>
	<main id="main" class="site-main row masonry-container" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content-home', $blogito_home_page_layout );
				?>

				<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	if ( ! empty( $blogito_home_page_layout ) ) {
		get_sidebar();
	}
	?>
</div><!-- .row -->
<?php get_footer(); ?>
