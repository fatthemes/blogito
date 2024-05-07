<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogito
 */

?>

<div class=" col-xs-12 col-md-6 col-lg-4 masonry">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php the_post_thumbnail( 'medium' ); ?>
			</a>
		</div>
	<?php endif; ?>
	<?php echo esc_html( blogito_post_format_icon( get_the_ID() ) ); ?>
	<header class="entry-header">
		<div class="blog-category-list">
		<?php the_category( __( '<span> &#124; </span>', 'blogito' ) ); ?>
		</div>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->
	<?php if ( get_theme_mod( 'home_page_display_content', 1 ) ) : ?>
		<div class="entry-content">
		<?php blogito_content(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			<a href="<?php the_permalink(); ?>"><button><?php esc_html_e( 'Read more ', 'blogito' ); ?><span class="screen-reader-text"><?php the_title(); ?></span></button></a>
		</div>
	<?php endif; ?>
	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
		<?php blogito_posted_on() . blogito_entry_footer(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
	</article><!-- #post-## -->
</div>
