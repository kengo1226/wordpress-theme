<?php
/**
 * testsite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package testsite
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function testsite_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on testsite, use a find and replace
		* to change 'testsite' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'testsite', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'testsite' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'testsite_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'testsite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function testsite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'testsite_content_width', 640 );
}
add_action( 'after_setup_theme', 'testsite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function testsite_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'testsite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'testsite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'testsite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function testsite_scripts() {
	wp_enqueue_style( 'testsite-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'testsite-style', 'rtl', 'replace' );

	wp_enqueue_script( 'testsite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testsite_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// お知らせのカスタム投稿作成
function create_post_type_news(){
	register_post_type( 
	'news',
	array(
	'labels' => array(
	'name' => 'お知らせ'
	),
	'public' => true,
	'has_archive' => true,
	'supports' => array('title','editor','thumbnail','author'),
	'show_in_rest' => true,
	)
	);
}
add_action( 'init', 'create_post_type_news' );

// お知らせ一覧を表示する
function shortcode_news_list() {
	global $post;
	$args = array(
	 'posts_per_page' => 3,  // 一覧に表示させる件数
	 'post_type' => 'news',  // お知らせのスラッグ
	 'post_status' => 'publish'
	);
	$the_query = new WP_Query( $args );
	// お知らせ一覧用HTMLコード作成
	if ( $the_query->have_posts() ) {
	 $html .= '<ul>';
	 while ( $the_query->have_posts() ) :
	 $the_query->the_post();
	 $url = get_permalink();
	 $title = get_the_title();
	 $date = get_the_date('Y/m/d');
	 $html .= '<li>';
	 $html .= '<a href="'.$url.'">';
	 $html .= '<p class="news_date">'.$date.'</p>';
	 $html .= '<h3 class="news_title">'.$title.'</h3>';
	 $html .= '</a></li>';
	 endwhile;
	 $html .= '</ul>';
	}
	return $html;
   }
   add_shortcode("news_list", "shortcode_news_list");
