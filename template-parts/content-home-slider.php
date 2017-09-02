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

	$args = array(
		'posts_per_page' => 10,
		'post__in' => $blogito_sticky_posts,
		'post_type' => 'post',
	);

	$the_slider = new WP_Query( $args );
	?>

	<div id="slider-container">
		<div class="featured-posts">
		<div class="blogito-featured-slider">
		<?php if ( $the_slider->have_posts() ) : ?>
			<?php
			while ( $the_slider->have_posts() ) :
			$the_slider->the_post();
			?>
				<div class="blogito-featured-slider-wrapper">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="featured-image" style="background:#000 url(<?php the_post_thumbnail_url( get_theme_mod( 'home_page_slider_img_size', 'full' ) ); ?>) no-repeat center;background-size: cover;"></div>
				<div class="blogito-featured-slider-title-wrapper">
					<div class="blogito-featured-slider-title">
					<span class="featured-category">
						<?php
						echo wp_kses(
							get_the_category_list( __( '<span> &#124; </span>', 'blogito' ) ), array(
								'a' => array(
									'href' => array(),
								),
								'span' => '',
							)
						);
						?>
					</span>
					<h2 class="blogito-featured-slider-header"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h2>
					</div>
					<?php echo blogito_post_format_icon( $the_slider->ID ); // WPCS: XSS OK. ?>
				</div>
				<?php else : ?>
				<div class="no-featured-image">
					<div class="blogito-featured-slider-title">
					<span class="featured-category">
						<?php
						echo wp_kses(
							get_the_category_list( __( '<span> &#124; </span>', 'blogito' ) ), array(
								'a' => array(
									'href' => array(),
								),
								'span' => '',
							)
						);
						?>
					</span>
					<h2 class="blogito-featured-slider-header"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h2>
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
