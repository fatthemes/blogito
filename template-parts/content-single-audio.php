<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-xs-12' ); ?>>

	<div class="category-list">
	<?php
	if ( is_attachment() ) :
		echo esc_html__( 'Attachment page', 'blogito' );
	else :
		echo wp_kses(
			get_the_category_list( ' &#124; ' ), array(
				'a' => array(
					'href' => array(),
				),
			)
		);
	endif;
	?>
	</div>

	<header class="entry-header row">

	<?php the_title( '<h1 class="entry-title col-xs-12">', '</h1>' ); ?>
	<div class="entry-meta  col-xs-12">
		<?php blogito_posted_on(); ?>
	</div>
	<!-- .entry-meta -->

	</header>
	<!-- .entry-header -->
	<div class="featured-media row">
	<div class="single-featured-image col-xs-12">
		<?php
		$featured_audio = hybrid_media_grabber(
			array(
				'type' => 'audio',
			)
		);
		if ( ! empty( $featured_audio ) ) {
		echo $featured_audio; // WPCS: XSS OK.
		} elseif ( has_post_thumbnail() && get_theme_mod( 'single_post_show_featured_image', 1 ) ) {
		the_post_thumbnail();
		}
		?>
	</div>
	</div>
	<div class="row">

	<div class="entry-content col-xs-12 col-lg-10 col-lg-push-2">
		<?php blogito_media_content(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogito' ),
				'after' => '</div>',
			)
		);
		?>
	</div>
	<!-- .entry-content -->

	<footer class="entry-footer col-xs-12">
		<?php blogito_entry_footer(); ?>
	</footer>
	<!-- .entry-footer -->

	</div>
	<!-- .row -->

</article>
<!-- #post-## -->
