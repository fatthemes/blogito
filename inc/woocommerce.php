<?php
/**
 * WooCommerce compatibility. Only loaded when WooCommerce is active.
 *
 * @link https://woocommerce.com/
 *
 * @package blogito
 */

/**
 * Declares WooCommerce support and the product gallery features.
 */
function blogito_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'blogito_woocommerce_setup' );

/**
 * Registers the Shop Sidebar widget area.
 */
function blogito_woocommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Sidebar', 'blogito' ),
			'id'            => 'blogito-shop-sidebar',
			'description'   => esc_html__( 'Appears beside the products on the shop page and product category and tag pages. Leave empty for a full width shop.', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title"><span>',
			'after_title'   => '</span></h2>',
		)
	);
}
add_action( 'widgets_init', 'blogito_woocommerce_widgets_init' );

/**
 * Whether the current shop page shows the Shop Sidebar.
 *
 * @return bool
 */
function blogito_woocommerce_has_sidebar() {
	return ! is_product() && get_theme_mod( 'blogito_woocommerce_sidebar', 1 ) && is_active_sidebar( 'blogito-shop-sidebar' );
}

/**
 * Drops the blog's masonry and infinite scroll scripts from shop pages and loads the sticky sidebar for the Shop Sidebar.
 */
function blogito_woocommerce_scripts() {
	if ( is_woocommerce() ) {
		wp_dequeue_script( 'infinite-scroll' );
		wp_dequeue_script( 'images-loaded' );
	}

	if ( is_woocommerce() && get_theme_mod( 'sticky_sidebar', 1 ) && blogito_woocommerce_has_sidebar() ) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array( 'jquery' ), '1.2.2', true );
	}
}
add_action( 'wp_enqueue_scripts', 'blogito_woocommerce_scripts', 20 );

if ( ! function_exists( 'blogito_woocommerce_cart_link' ) ) :

	/**
	 * Displays the header cart link with the number of items in the cart.
	 */
	function blogito_woocommerce_cart_link() {
		if ( ! WC()->cart ) {
			return;
		}

		$count = WC()->cart->get_cart_contents_count();
		?>
		<a class="blogito-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24"><path d="M5 8h14l-1 13H6z M9 10V6a3 3 0 0 1 6 0v4"></path></svg>
		<?php if ( $count > 0 ) : ?>
			<span class="blogito-cart-count" aria-hidden="true"><?php echo esc_html( number_format_i18n( $count ) ); ?></span>
		<?php endif; ?>
		<span class="screen-reader-text">
		<?php
		/* translators: %s: number of items in the cart. */
		echo esc_html( sprintf( _n( 'Cart, %s item', 'Cart, %s items', $count, 'blogito' ), number_format_i18n( $count ) ) );
		?>
		</span></a>
		<?php
	}

endif;

/**
 * Refreshes the header cart link after products are added to the cart with AJAX.
 *
 * @param array $fragments HTML fragments keyed by selector.
 * @return array
 */
function blogito_woocommerce_cart_link_fragment( $fragments ) {
	if ( ! WC()->cart ) {
		return $fragments;
	}

	ob_start();
	blogito_woocommerce_cart_link();
	$fragments['a.blogito-cart-link'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'blogito_woocommerce_cart_link_fragment' );

/**
 * Colours the header cart link and shop buttons, badges and accents with the Customizer button colour.
 */
function blogito_woocommerce_inline_css() {
	$button_color = esc_attr( get_theme_mod( 'button_color', '#7d7250' ) );
	$buttons      = '.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.wp-block-woocommerce-cart .wc-block-components-button.wc-block-components-button:not(.is-link),.wp-block-woocommerce-checkout .wc-block-components-button.wc-block-components-button:not(.is-link),.wc-block-mini-cart__footer .wc-block-components-button.wc-block-components-button:not(.is-link)';
	$css          = '.blogito-cart-link:hover,.blogito-cart-link:focus-visible{background-color:' . $button_color . ';}';
	$css         .= $buttons . ',.woocommerce span.onsale,.woocommerce ul.products li.product .onsale{border-color:' . $button_color . ';background-color:' . $button_color . ';}';
	$css         .= str_replace( ',', ':hover,', $buttons ) . ':hover{background-color:transparent;color:' . $button_color . ';}';
	$css         .= '.woocommerce .star-rating span::before,.woocommerce p.stars a{color:' . $button_color . ';}';
	$css         .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{border-bottom-color:' . $button_color . ';}';
	$css         .= '.woocommerce-message{border-top-color:' . $button_color . ';}';
	$css         .= '.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a{color:' . $button_color . ';}';

	wp_add_inline_style( 'blogito-style', $css );
}
add_action( 'wp_enqueue_scripts', 'blogito_woocommerce_inline_css', 20 );

/**
 * Hides the shop page title when turned off in the Customizer.
 *
 * @param bool $show Whether to show the title.
 * @return bool
 */
function blogito_woocommerce_show_page_title( $show ) {
	return $show && get_theme_mod( 'blogito_woocommerce_show_page_title', 1 );
}
add_filter( 'woocommerce_show_page_title', 'blogito_woocommerce_show_page_title' );

/**
 * Adds the WooCommerce (Blogito) Customizer section.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogito_woocommerce_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'blogito_woocommerce',
		array(
			'title'       => esc_html__( 'WooCommerce (Blogito)', 'blogito' ),
			'priority'    => 1038,
			'description' => esc_html__( 'Shop layout options from the Blogito theme.', 'blogito' ),
		)
	);

	$wp_customize->add_setting(
		'blogito_woocommerce_sidebar',
		array(
			'default'           => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'blogito_woocommerce_sidebar',
		array(
			'label'       => esc_html__( 'Show the Shop Sidebar', 'blogito' ),
			'description' => esc_html__( 'Shows the Shop Sidebar widget area on the shop page and product category and tag pages, when it has widgets.', 'blogito' ),
			'section'     => 'blogito_woocommerce',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'blogito_woocommerce_show_page_title',
		array(
			'default'           => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'blogito_woocommerce_show_page_title',
		array(
			'label'       => esc_html__( 'Show the shop page title', 'blogito' ),
			'description' => esc_html__( 'Shows the title above the products on the shop page and product category and tag pages.', 'blogito' ),
			'section'     => 'blogito_woocommerce',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'blogito_woocommerce_customize_register' );
