<?php
/**
 * UNAM functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UNAM
 */

if ( ! function_exists( 'unam_fes_a_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function unam_fes_a_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on UNAM, use a find and replace
	 * to change 'unam-fes-a' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'unam-fes-a', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	
	//Agregue función para el tipo de post, no venia en esta versión pero la agrego para seguir con el tutorial de manera correcta
	add_theme_support( 'post-formats' , array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
	) );

	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	/* Sí existen varios menús aquí se agregan
	se copia la linea de abajo y que quede adentro de del array,
	se pone un nombre nuevo y un nombre que podamos entender. */
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'unam-fes-a' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature. //En caso de no querer que puedan cambiar el fondo hay que quitar esta función
	add_theme_support( 'custom-background', apply_filters( 'unam_fes_a_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'unam_fes_a_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function unam_fes_a_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'unam_fes_a_content_width', 640 );
}
add_action( 'after_setup_theme', 'unam_fes_a_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function unam_fes_a_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'unam-fes-a' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'unam-fes-a' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'unam_fes_a_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function unam_fes_a_scripts() {
	wp_enqueue_style( 'unam-fes-a-style', get_stylesheet_uri() );

	//Agregamos Font desde Google Fonts
	wp_enqueue_style( 'unam-fes-a-google-fonts','https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,700,700i|Merriweather:400,400i,700,700i');
	/* Ver video 04_XR15_localfont.mp4 para el host en la página para las fuentes*/
	
	wp_enqueue_script( 'unam-fes-a-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'unam-fes-a-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'unam_fes_a_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
