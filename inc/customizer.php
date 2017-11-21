<?php
/**
 * Blogito Theme Customizer.
 *
 * @package blogito
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogito_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting(
		'home_page_bg_color', array(
			'type' => 'theme_mod',
			'default' => '#f5f5f5',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'home_page_bg_color', array(
			'label' => esc_html__( 'Home/Archive Background Color', 'blogito' ),
			'section' => 'colors',
		)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_1', array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'sidebar_bg_color_1', array(
			'label' => esc_html__( 'Sidebar Background Color 1', 'blogito' ),
			'section' => 'colors',
			'priority' => 110,
		)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_2', array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'sidebar_bg_color_2', array(
			'label' => esc_html__( 'Sidebar Background Color 2', 'blogito' ),
			'section' => 'colors',
			'priority' => 120,
		)
		)
	);

	$wp_customize->add_setting(
		'sidebar_bg_color_3', array(
			'type' => 'theme_mod',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'sidebar_bg_color_3', array(
			'label' => esc_html__( 'Sidebar Background Color 3', 'blogito' ),
			'section' => 'colors',
			'priority' => 130,
		)
		)
	);

	$wp_customize->add_setting(
		'button_color', array(
			'type' => 'theme_mod',
			'default' => '#a0946b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize, 'button_color', array(
			'label' => esc_html__( 'Buttons color', 'blogito' ),
			'section' => 'colors',
			'priority' => 140,
		)
		)
	);

	$wp_customize->add_setting(
		'header_display', array(
			'default' => 'front',
			'sanitize_callback' => 'blogito_sanitize_select_header_display',
		)
	);

	$wp_customize->add_control(
		'header_display', array(
			'label' => esc_html__( 'Display Header', 'blogito' ),
			'section' => 'static_front_page',
			'priority' => 10,
			'type' => 'select',
			'choices' => array(
				'front' => esc_html__( 'On Front Page', 'blogito' ),
				'always' => esc_html__( 'Always', 'blogito' ),
				'' => esc_html__( 'Never', 'blogito' ),
			),
		)
	);

	// Section Homepage Settings.
	$wp_customize->add_setting(
		'home_page_layout', array(
			'default' => 'classic',
			'sanitize_callback' => 'blogito_sanitize_select_home_page_layout',
		)
	);

	$wp_customize->add_control(
		'home_page_layout', array(
			'label' => esc_html__( 'Blog Home Page Layout', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'select',
			'choices' => array(
				'masonry' => esc_html__( 'Masonry + Sidebar', 'blogito' ),
				'list' => esc_html__( 'List + Sidebar', 'blogito' ),
				'' => esc_html__( 'Masonry (No Sidebar)', 'blogito' ),
				'classic' => esc_html__( 'Classic (One Column)', 'blogito' ),
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_img_number', array(
			'default' => 2,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_img_number', array(
			'label' => esc_html__( 'Number of Images to Show in Slider', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 2,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_height', array(
			'default' => 500,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_height', array(
			'label' => esc_html__( 'Height of Home Page Slider', 'blogito' ),
			'section' => 'static_front_page',
			'description' => esc_html__( '(in pixels)', 'blogito' ),
			'type' => 'number',
			'input_attrs' => array(
				'min' => 100,
				'max' => 1000,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'home_page_slider_img_size', array(
			'default' => 'full',
			'sanitize_callback' => 'blogito_sanitize_select_home_page_slider_img_size',
		)
	);

	$wp_customize->add_control(
		'home_page_slider_img_size', array(
			'label' => esc_html__( 'Slider Image Size', 'blogito' ),
			'section' => 'static_front_page',
			'description' => esc_html__( 'From >Settings>Media', 'blogito' ),
			'type' => 'select',
			'choices' => array(
				'thumbnail' => esc_html__( 'Thumbnail', 'blogito' ),
				'medium' => esc_html__( 'Medium', 'blogito' ),
				'large' => esc_html__( 'Large', 'blogito' ),
				'full' => esc_html__( 'Full', 'blogito' ),
			),
		)
	);

	$wp_customize->add_setting(
		 'home_page_slider_play_speed', array(
			 'default'        => 0,
			 'sanitize_callback' => 'absint',
		 )
		);

	$wp_customize->add_control(
		 'home_page_slider_play_speed', array(
			 'label'   => esc_html__( 'Sliding speed of Home Page Slider (in ms)', 'blogito' ),
			 'section' => 'static_front_page',
			 'description'    => esc_html__( '0 to disable autoplay', 'blogito' ),
			 'type'    => 'number',
			 'input_attrs' => array(
				 'min'   => 0,
				 'max'   => 10000,
				 'step'  => 100,
			 ),
		 )
		);

	$wp_customize->add_setting(
		'home_page_latest_posts_text', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_latest_posts_text', array(
			'label' => esc_html__( 'Enable Latest Posts Text', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'home_page_display_content', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'home_page_display_content', array(
			'label' => esc_html__( 'Display Content on Home and Archive Pages.', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'hide_title_on_home_archive', array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'hide_title_on_home_archive', array(
			'label' => esc_html__( 'Hide Titles On Home Page/Archive Pages', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'hide_meta_on_home_archive', array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'hide_meta_on_home_archive', array(
			'label' => esc_html__( 'Hide Meta On Home Page/Archive Pages', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'pagination', array(
			'default' => 'infinite',
			'sanitize_callback' => 'blogito_sanitize_pagination',
		)
	);

	$wp_customize->add_control(
		'pagination', array(
			'label' => esc_html__( 'Pagination Style', 'blogito' ),
			'section' => 'static_front_page',
			'type' => 'select',
			'choices' => array(
				'ajax' => esc_html__( 'Load More Button', 'blogito' ),
				'infinite' => esc_html__( 'Infinite Scrolling', 'blogito' ),
				'' => esc_html__( 'Page Numbers', 'blogito' ),
			),
		)
	);

	// Section Single Page.
	$wp_customize->add_section(
		'single_page', array(
			'title' => esc_html__( 'Single Post', 'blogito' ),
			'priority' => 1010,
			'description' => esc_html__( 'Single Post Settings', 'blogito' ),
		)
	);

	$wp_customize->add_setting(
		'single_post_sidebar', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_sidebar', array(
			'label' => esc_html__( 'Show Sidebar', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_post_show_featured_image', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_show_featured_image', array(
			'label' => esc_html__( 'Show Featured Images In Standard Posts', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_show', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_show', array(
			'label' => esc_html__( 'Show Related Posts.', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_title', array(
			'default' => esc_html__( 'You May Also Like', 'blogito' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_title', array(
			'label' => esc_html__( 'Related Posts Header Text', 'blogito' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation', array(
			'label' => esc_html__( 'Enable Single Post Navigation', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_page_related_posts_by_tag_or_cat', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_page_related_posts_by_tag_or_cat', array(
			'label' => esc_html__( 'Show Related Posts By Categories (Else by Tags).', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_next_label', array(
			'default' => esc_html__( 'Next Article', 'blogito' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_next_label', array(
			'label' => esc_html__( 'Single Post Navigation Next Post Label', 'blogito' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_previous_label', array(
			'default' => esc_html__( 'Previous Article', 'blogito' ),
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_previous_label', array(
			'label' => esc_html__( 'Single Post Navigation Previous Post Label', 'blogito' ),
			'section' => 'single_page',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'single_post_navigation_only_category', array(
			'default' => 0,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'single_post_navigation_only_category', array(
			'label' => esc_html__( 'Navigate Only In The Same Category', 'blogito' ),
			'section' => 'single_page',
			'type' => 'checkbox',
		)
	);

	// Footer.
	$wp_customize->add_section(
		'footer', array(
			'title' => esc_html__( 'Footer', 'blogito' ),
			'priority' => 1030,
		)
	);

	$wp_customize->add_setting(
		'bottom_widget_area_width', array(
			'default' => '',
			'sanitize_callback' => 'blogito_sanitize_bottom_widget_area_width',
		)
	);

	$wp_customize->add_control(
		'bottom_widget_area_width', array(
			'label' => esc_html__( 'Bottom Widget Area Width', 'blogito' ),
			'section' => 'footer',
			'type' => 'select',
			'choices' => array(
				'' => esc_html__( 'Container (Boxed)', 'blogito' ),
				'-fluid' => esc_html__( 'Full Width', 'blogito' ),
			),
		)
	);

	// Section - "other settings".
	$wp_customize->add_section(
		'other_settings', array(
			'title' => esc_html__( 'Advanced', 'blogito' ),
			'priority' => 1040,
			'description' => esc_html__( 'Advanced Settings', 'blogito' ),
		)
	);

	$wp_customize->add_setting(
		'show_top_menu_width', array(
			'default' => 978,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'show_top_menu_width', array(
			'label' => esc_html__( 'When to Hide/Show Top Menu (in px)', 'blogito' ),
			'section' => 'other_settings',
			'type' => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 1200,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'sticky_sidebar', array(
			'default' => 1,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'sticky_sidebar', array(
			'label' => esc_html__( 'Enable Sticky Sidebar', 'blogito' ),
			'section' => 'other_settings',
			'type' => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'gallery_class', array(
			'default' => '.gallery',
			'sanitize_callback' => 'blogito_sanitize_gallery_class',
		)
	);

	$wp_customize->add_control(
		'gallery_class', array(
			'label' => esc_html__( 'Gallery Options', 'blogito' ),
			'section' => 'other_settings',
			'type' => 'select',
			'choices' => array(
				'.gallery' => esc_html__( 'Gallery Styling For All Posts', 'blogito' ),
				'.format-gallery .gallery' => esc_html__( 'Gallery Styling Only For Gallery Post Type', 'blogito' ),
				'' => esc_html__( 'Disable Styling For All Galleries', 'blogito' ),
			),
		)
	);
}

add_action( 'customize_register', 'blogito_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogito_customize_preview_js() {
	wp_enqueue_script( 'blogito_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'blogito_customize_preview_js' );

/**
 * Sanitize select home_page_layout
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_select_home_page_layout( $value ) {
	if ( in_array( $value, array( '', 'list', 'masonry', 'classic' ), true ) ) {
	return $value;
	}
}

/**
 * Sanitize select pagination
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_pagination( $value ) {
	if ( in_array( $value, array( 'ajax', 'infinite', '' ), true ) ) {
	return $value;
	}
}

/**
 * Sanitize select image size.
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_select_home_page_slider_img_size( $value ) {
	if ( in_array( $value, array( 'thumbnail', 'medium', 'large', 'full' ), true ) ) {
	return $value;
	} else {
	return 'full';
	}
}

/**
 * Sanitize select container class.
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_bottom_widget_area_width( $value ) {
	if ( in_array( $value, array( '-fluid', '' ), true ) ) {
	return $value;
	}
}

/**
 * Sanitize select header display options.
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_select_header_display( $value ) {
	if ( in_array( $value, array( 'front', 'always', '' ), true ) ) {
	return $value;
	}
}

/**
 * Sanitize select gallery options.
 *
 * @param type $value user input.
 * @return type
 */
function blogito_sanitize_gallery_class( $value ) {
	if ( in_array( $value, array( '.gallery', '.format-gallery .gallery', '' ), true ) ) {
	return $value;
	}
}
