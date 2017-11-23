<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blogito
 */

?>

</div><!-- #content -->

<div id="left-sidebar" class="left-sidebar-area">
	<div class="left-sidebar-content">
	<div class="left-header">
		<div class="left-logo">
		<?php
		if ( has_custom_logo() ) :
			the_custom_logo();
		else :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>
		<button class="left-sidebar-close" title="<?php esc_attr_e( 'Close', 'blogito' ); ?>"><svg><line stroke-miterlimit="10" x1="0.354" y1="0.354" x2="14.354" y2="14.354"/><line stroke-miterlimit="10" x1="14.354" y1="0.354" x2="0.354" y2="14.354"/></svg></button>
		</div>
	</div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
			)
		);
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'menu_id' => 'social-menu',
				'container_class' => 'social-menu-container',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
			)
		);
		?>
	</nav><!-- #site-navigation -->
	<?php get_sidebar( 'left' ); ?>
	<div class="site-info">
		<?php echo wp_kses_post( get_theme_mod( 'footer_text', '<p>&copy; 2016 ' . get_bloginfo( 'name' ) . '</p>' ) ); ?>
	</div><!-- .site-info -->
	</div>
</div>
<div class="left-sidebar-bg">
</div><!-- .left-sidebar-bg -->
<?php get_sidebar( 'bottom' ); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
	<?php
	if ( has_custom_logo() ) {
		the_custom_logo();
	}
	$blogito_dafault_footer_text = '<p>&copy; ' . date_i18n( __( 'Y', 'blogito' ) ) . ' ' . get_bloginfo( 'name' ) . '</p><p><a href="https://wordpress.org/">' .
		// translators: WordPress.
		sprintf( esc_html__( 'Proudly powered by %s', 'blogito' ), 'WordPress' ) . '</a><span class="sep"> | </span>' .
		// translators: theme name and theme author.
		sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'blogito' ), 'Blogito', '<a href="https://fatthemes.com/" rel="designer">Fat Themes</a>' ) . '</p>';
	echo wp_kses_post( get_theme_mod( 'footer_text', $blogito_dafault_footer_text ) );
	?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
