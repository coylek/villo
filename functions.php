<?php

/**
 * villoz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package villoz
 */

if (!defined('VILLOZ_VERSION')) {
    // Replace the version number of the theme on each release.
    define('VILLOZ_VERSION', '1.2');
}

if (!function_exists('villoz_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function villoz_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on villoz, use a find and replace
		 * to change 'villoz' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('villoz', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        // Set post thumbnail size.
        set_post_thumbnail_size(770, 428, true);

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'villoz'),
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


        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

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
endif;
add_action('after_setup_theme', 'villoz_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function villoz_content_width()
{
    $GLOBALS['content_width'] = apply_filters('villoz_content_width', 640);
}
add_action('after_setup_theme', 'villoz_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function villoz_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'villoz'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'villoz'),
            'before_widget' => '<section id="%1$s" class="sidebar__single widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<div class="title"><h2>',
            'after_title'   => '</h2></div>',
        )
    );

    if (class_exists('WooCommerce')) {
        register_sidebar(
            array(
                'name'          => esc_html__('Shop Sidebar', 'villoz'),
                'id'            => 'shop',
                'description'   => esc_html__('Add widgets here.', 'villoz'),
                'before_widget' => '<section id="%1$s" class="shop-category product__sidebar-single widget sidebar__single %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3 class="product__sidebar-title">',
                'after_title'   => '</h3>',
            )
        );
    }
}
add_action('widgets_init', 'villoz_widgets_init');

// google font process

function villoz_fonts_url()
{
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Google font: on or off', 'villoz')) {
        $font_url = add_query_arg('family', urlencode('Plus Jakarta Sans:400,400i,500,500i,600,600i,700,700i,800&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }

    return esc_url_raw($font_url);
}


/**
 * Enqueue scripts and styles.
 */
function villoz_scripts()
{
    wp_enqueue_style('villoz-fonts', villoz_fonts_url(), array(), null);
    wp_enqueue_style('flaticons', get_template_directory_uri() . '/assets/vendors/flaticons/css/flaticon.css', array(), '1.1');
    wp_enqueue_style('villoz-icons', get_template_directory_uri() . '/assets/vendors/villoz-icons/style.css', array(), '1.1');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/css/bootstrap.min.css', array(), '5.0.0');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/vendors/fontawesome/css/all.min.css', array(), '5.15.1');
    wp_enqueue_style('villoz-style', get_stylesheet_uri(), array(), time());
    wp_style_add_data('villoz-style', 'rtl', 'replace');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/js/bootstrap.min.js', array('jquery'), '5.0.0', true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/vendors/isotope/isotope.js', array('jquery'), '2.1.1', true);
    wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/assets/vendors/imagesloaded/imagesloaded.pkgd.min.js', array('jquery'), '4.1.4', true);
    wp_enqueue_script('villoz-theme', get_template_directory_uri() . '/assets/js/villoz-theme.js', array('jquery'), time(), true);



    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    $villoz_get_dark_mode_status = get_theme_mod('villoz_dark_mode', false);

    if (is_page()) {
        $villoz_get_dark_mode_status = get_post_meta(get_the_ID(), 'villoz_enable_dark_mode', true);
    }
    $villoz_dynamic_dark_mode_status = isset($_GET['dark_mode']) ? $_GET['dark_mode'] : $villoz_get_dark_mode_status;
    if ('on' == $villoz_dynamic_dark_mode_status) {
        wp_enqueue_style('villoz-dark-mode', get_template_directory_uri() . '/assets/css/modes/villoz-dark.css', array(), time());
    }

    $villoz_get_rtl_mode_status = get_theme_mod('villoz_rtl_mode', false);

    if (is_page()) {
        $villoz_rtl_mode_status = get_post_meta(get_the_ID(), 'villoz_enable_rtl_mode', true);

        $villoz_get_rtl_mode_status = empty($villoz_rtl_mode_status) ? $villoz_get_rtl_mode_status : $villoz_rtl_mode_status;
    }

    $villoz_dynamic_rtl_mode_status = isset($_GET['rtl_mode']) ? $_GET['rtl_mode'] : $villoz_get_rtl_mode_status;
    if ('yes' == $villoz_dynamic_rtl_mode_status || true == is_rtl()) {
        wp_enqueue_style('villoz-custom-rtl', get_template_directory_uri() . '/assets/css/villoz-rtl.css', array(), time());
    }
}
add_action('wp_enqueue_scripts', 'villoz_scripts');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Implement the customizer feature.
 */
if (class_exists('Layerdrops\Villoz\Customizer')) {
    require get_template_directory() . '/inc/theme-customizer-styles.php';
}

/**
 * TGMPA Activation.
 */
require get_template_directory() . '/inc/plugins.php';



/*
* one click deomon import
*/
if (class_exists('OCDI_Plugin')) {
    require get_template_directory() . '/inc/demo-import.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}
