<?php
/**
 * Blogito Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package blogito
 */

if ( ! function_exists( 'blogito_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blogito_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blogito, use a find and replace
	 * to change 'blogito' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'blogito', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Left Menu', 'blogito' ),
			'top' => esc_html__( 'Top Menu', 'blogito' ),
			'social' => esc_html__( 'Social Menu', 'blogito' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support(
		'post-formats', array(
			'audio',
			'video',
			'gallery',
		)
	);

	// Enable support for Custom Header.
	add_theme_support( 'custom-header' );

	// Enable support for Site Logo.
	add_theme_support( 'custom-logo' );
	}

endif; // End of blogito_setup.
add_action( 'after_setup_theme', 'blogito_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogito_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogito_content_width', 874 );
}

add_action( 'after_setup_theme', 'blogito_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogito_widgets_init() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Right Sidebar', 'blogito' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Right Sidebar Widget Area', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title' => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name' => esc_html__( 'Left Sidebar', 'blogito' ),
			'id' => 'sidebar-2',
			'description' => esc_html__( 'Right Sidebar Widget Area', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title' => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name' => esc_html__( 'Top', 'blogito' ),
			'id' => 'top-1',
			'description' => esc_html__( 'Top Widget Area. Above the content - on home and archive pages', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title' => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name' => esc_html__( 'Bottom (Instagram Feed)', 'blogito' ),
			'id' => 'bottom-1',
			'description' => esc_html__( 'Instagram Widget Area. Below the content.', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget col-xs-12 %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title' => '</span></h2>',
		)
	);

	register_sidebar(
		array(
			'name' => esc_html__( 'Social Menu', 'blogito' ),
			'id' => 'menu-social-1',
			'description' => esc_html__( 'Menu Social Widget Area.', 'blogito' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title"><span>',
			'after_title' => '</span></h2>',
		)
	);
}

add_action( 'widgets_init', 'blogito_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blogito_scripts() {

	wp_enqueue_style( 'blogito-style', get_stylesheet_uri() );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/slick/slick.min.js', array( 'jquery' ), '20150828', true );

	if ( ! is_singular() && ! is_404() && have_posts() ) {

	wp_enqueue_script( 'images-loaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.0', true );

	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery', 'masonry', 'images-loaded' ), '2.1.0', true );
	}

	if ( get_theme_mod( 'sticky_sidebar', 1 ) && is_active_sidebar( 'sidebar-1' ) ) {
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.min.js', array( 'jquery' ), '1.2.2', true );
	}

	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '20150829', true );

	wp_enqueue_script( 'blogito-scripts', get_template_directory_uri() . '/js/blogito.min.js', array( 'jquery', 'jquery-effects-core', 'jquery-effects-slide' ), '20160908', true );

	wp_enqueue_script( 'blogito-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	// Preparing to pass variables to js -> load more posts via ajax call.
	global $wp_query;
	$blogito_ajax_max_pages = $wp_query->max_num_pages;
	$blogito_ajax_paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	$blogito_pagination = get_theme_mod( 'pagination', 'infinite' );
	$blogito_home_page_slider_play_speed = get_theme_mod( 'home_page_slider_play_speed', 0 );
	$blogito_home_page_slider_autoplay = ( 0 == $blogito_home_page_slider_play_speed ) ? false : true;

	// Passing theme options to blogito.js.
	wp_localize_script(
		'blogito-scripts', 'blogito', array(
			'home_page_slider_img_number' => get_theme_mod( 'home_page_slider_img_number', 2 ),
			'home_page_slider_play_speed' => $blogito_home_page_slider_play_speed,
			'home_page_slider_autoplay' => $blogito_home_page_slider_autoplay,
			'loadMoreText' => esc_html__( 'Load more posts', 'blogito' ),
			'loadingText' => esc_html__( ' ', 'blogito' ),
			'noMorePostsText' => esc_html__( 'No More Posts', 'blogito' ),
			'expandText' => esc_html__( 'Expand', 'blogito' ),
			'closeText' => esc_html__( 'Close', 'blogito' ),
			'startPage' => $blogito_ajax_paged,
			'maxPages' => $blogito_ajax_max_pages,
			'nextLink' => next_posts( $blogito_ajax_max_pages, false ),
			'pagination' => $blogito_pagination,
			'getTemplateDirectoryUri' => esc_url( get_template_directory_uri() ),
			'months' => blogito_months(),
			'days' => blogito_days(),
			'galleryClass' => get_theme_mod( 'gallery_class', '.gallery' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'blogito_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Hybrid Media Grabber for getting media from posts.
 */
require get_template_directory() . '/inc/class-media-grabber.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Some meta fields for category styling.
 */
require get_template_directory() . '/inc/class-meta-for-categories.php';

/**
 * Load TGMPA recommended plugins.
 */
require_once get_template_directory() . '/inc/tgmpa-plugins.php';
