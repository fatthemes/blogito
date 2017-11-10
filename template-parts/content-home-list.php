<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

?>

<div class="col-md-12 masonry">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'blogito-list' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="featured-image col-xs-12 col-lg-6">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail( 'medium' ); ?>
			</a>
		<?php echo blogito_post_format_icon( get_the_ID() ); // WPCS: XSS OK. ?>
		</div>
		<div class="blogito-list-content col-xs-12 col-lg-6">
			<header class="entry-header">
			<div class="blog-category-list">
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
			</div>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<!-- .title-meta-wrapper -->
			</header>
			<!-- .entry-header -->
		<?php if ( get_theme_mod( 'home_page_display_content', 1 ) ) : ?>
			<div class="entry-content">
			<?php blogito_content(); ?>
			</div>
		<?php else : ?>
			<div class="entry-content">
			<a href="<?php the_permalink(); ?>"><button><?php esc_html_e( 'Read more ', 'blogito' ); ?><span class="screen-reader-text"><?php the_title(); ?></span></button></a>
			</div>
		<?php endif; ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
			<?php blogito_posted_on() . blogito_entry_footer(); ?>
			</div>
			<!-- .entry-meta -->
		<?php endif; ?>
		</div>

	<?php else : ?>

		<div class="blogito-list-content col-xs-12">
			<header class="entry-header">
			<div class="title-meta-wrapper">
			<?php echo blogito_post_format_icon( get_the_ID() ); // WPCS: XSS OK. ?>
				<div class="blog-category-list">
				<?php
				echo wp_kses(
					get_the_category_list( __( ' &#124; ', 'blogito' ) ), array(
						'a' => array(
							'href' => array(),
						),
					)
				);
				?>
				</div>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div>
			<!-- .title-meta-wrapper -->
			</header>
			<!-- .entry-header -->
		<?php if ( get_theme_mod( 'home_page_display_content', 1 ) ) : ?>
			<div class="entry-content">
			<?php blogito_content(); ?>
			</div>
		<?php else : ?>
			<div class="entry-content">
			<a href="<?php the_permalink(); ?>"><button><?php esc_html__( 'Read more', 'blogito' ); ?> <span class="screen-reader-text"><?php the_title(); ?></span></button></a>
			</div>
		<?php endif; ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
			<?php blogito_posted_on() . blogito_entry_footer(); ?>
			</div>
			<!-- .entry-meta -->
		<?php endif; ?>
		</div>
	<?php endif; ?>
	</article>
	<!-- #post-## -->
</div>
