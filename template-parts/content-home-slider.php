<?php
/**
 * Template part for displaying header slider.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

$blogito_sticky_posts = get_option( 'sticky_posts' );
if ( ! empty( $blogito_sticky_posts ) ) :

	wp_enqueue_script( 'slick' );
	$blogito_args = array(
		'posts_per_page' => 10,
		'post__in' => $blogito_sticky_posts,
		'post_type' => 'post',
	);

	$blogito_the_slider = new WP_Query( $blogito_args );
	?>

	<div id="slider-container">
		<div class="featured-posts">
		<div class="blogito-featured-slider">
		<?php if ( $blogito_the_slider->have_posts() ) : ?>
			<?php
			while ( $blogito_the_slider->have_posts() ) :
				$blogito_the_slider->the_post();
				?>
				<div class="blogito-featured-slider-wrapper">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image" style="background:#000 url(<?php the_post_thumbnail_url( get_theme_mod( 'home_page_slider_img_size', 'full' ) ); ?>) no-repeat center;background-size: cover;"></div>
				<div class="blogito-featured-slider-title-wrapper">
					<div class="blogito-featured-slider-title">
						<?php if ( get_theme_mod( 'home_page_slider_clickable_images', 0 ) ) : ?>
						<a class="blogito-featured-slider-post-link" href="<?php the_permalink(); ?>" rel="bookmark"></a>
						<?php endif; ?>
					<span class="featured-category">
						<?php the_category( __( '<span> &#124; </span>', 'blogito' ) ); ?>
					</span>
					<h2 class="blogito-featured-slider-header"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
					<?php echo blogito_post_format_icon( $blogito_the_slider->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php else : ?>
				<div class="no-featured-image">
					<div class="blogito-featured-slider-title">
						<?php if ( get_theme_mod( 'home_page_slider_clickable_images', 0 ) ) : ?>
						<a class="blogito-featured-slider-post-link" href="<?php the_permalink(); ?>" rel="bookmark"></a>
						<?php endif; ?>
					<span class="featured-category">
						<?php the_category( __( '<span> &#124; </span>', 'blogito' ) ); ?>
					</span>
					<h2 class="blogito-featured-slider-header"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
				</div>
				<?php endif; ?>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		</div>
		</div>
	</div>
<?php endif; ?>
