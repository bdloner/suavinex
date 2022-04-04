<?php
/**
 * seed functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package seed
 */

if( class_exists('Kirki') ) { include_once( dirname( __FILE__ ) . '/inc/kirki.php' );}

/* LAYOUT */
if (!isset($GLOBALS['s_header_m']))             {$GLOBALS['s_header_m']             = 'auto-show';}     // standard, fixed, auto-show
if (!isset($GLOBALS['s_header_d']))             {$GLOBALS['s_header_d']             = 'auto-show';}     // standard, fixed, auto-show
if (!isset($GLOBALS['s_header_action']))        {$GLOBALS['s_header_action']        = array('search');} // search, cart, none
if (!isset($GLOBALS['s_blog_layout']))          {$GLOBALS['s_blog_layout']          = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_blog_layout_single']))   {$GLOBALS['s_blog_layout_single']   = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_blog_columns_m']))       {$GLOBALS['s_blog_columns_m']       = '1';}             // 1,2,3
if (!isset($GLOBALS['s_blog_columns_d']))       {$GLOBALS['s_blog_columns_d']       = '3';}             // 1,2,3,4,5,6
if (!isset($GLOBALS['s_blog_template']))        {$GLOBALS['s_blog_template']        = 'card';}          // list, card, hero, caption
if (!isset($GLOBALS['s_blog_profile']))         {$GLOBALS['s_blog_profile']         = 'enable';}        // disable, enable
if (!isset($GLOBALS['s_blog_archive_profile'])) {$GLOBALS['s_blog_archive_profile'] = 'enable';}        // disable, enable
if (!isset($GLOBALS['s_logo_path']))            {$GLOBALS['s_logo_path']            = 'none';}          // theme folder relative path, such as img/logo.svg .
if (!isset($GLOBALS['s_logo_width']))           {$GLOBALS['s_logo_width']           = '200';}           // any number, use in Custom Logo
if (!isset($GLOBALS['s_logo_height']))          {$GLOBALS['s_logo_height']          = '100';}           // any number, use in Custom Logo
if (!isset($GLOBALS['s_thumb_width']))          {$GLOBALS['s_thumb_width']          = '350';}           // any number
if (!isset($GLOBALS['s_thumb_height']))         {$GLOBALS['s_thumb_height']         = '184';}           // any number
if (!isset($GLOBALS['s_thumb_crop']))           {$GLOBALS['s_thumb_crop']           = true;}            // true, false
if (!isset($GLOBALS['s_title_style']))          {$GLOBALS['s_title_style']          = 'banner';}        // minimal, banner, hidden
if (!isset($GLOBALS['s_footer_columns']))       {$GLOBALS['s_footer_columns']       = '4';}             // 1,2,3,4,5,6

/* ADD-ON */
if (!isset($GLOBALS['s_cart_icon']))            {$GLOBALS['s_cart_icon']            = 'shopping-cart';} // shopping-bag, shopping-cart
if (!isset($GLOBALS['s_header_scroll']))        {$GLOBALS['s_header_scroll']        = '300';}           // 1-600 px scroll for header effect on home
if (!isset($GLOBALS['s_member_url']))           {$GLOBALS['s_member_url']           = 'none';}          // none, url path such as: /my-account/
if (!isset($GLOBALS['s_member_label']))         {$GLOBALS['s_member_label']         = 'Member';}        // ex: Member, สมาชิก, MEMBER_NAME
if (!isset($GLOBALS['s_style_css']))            {$GLOBALS['s_style_css']            = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_jquery']))               {$GLOBALS['s_jquery']               = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_fontawesome']))          {$GLOBALS['s_fontawesome']          = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_keen_slider']))          {$GLOBALS['s_keen_slider']          = 'enable';}        // disable, enable
if (!isset($GLOBALS['s_wp_comments']))          {$GLOBALS['s_wp_comments']          = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_admin_bar']))            {$GLOBALS['s_admin_bar']            = 'hide';}          // hide, show
if (!isset($GLOBALS['s_hide_plant']))           {$GLOBALS['s_hide_plant']           = 'disable';}       // hide, show

/* WOOCOMMERCE */
if (!isset($GLOBALS['s_shop_layout']))          {$GLOBALS['s_shop_layout']          = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_shop_pagebuilder']))     {$GLOBALS['s_shop_pagebuilder']     = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_woo_css']))              {$GLOBALS['s_woo_css']              = 'override';}      // override, none
if (!isset($GLOBALS['s_woo_th']))               {$GLOBALS['s_woo_th']               = 'enable';}        // disable, enable

/* CHECK WOOCOMMERCE */
if( function_exists( 'is_woocommerce' ) ){
    $GLOBALS['s_is_woo'] = true;
    $GLOBALS['s_member_url'] = site_url('/my-account/');
    if ($GLOBALS['s_woo_css'] == 'override') {
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    }
} else {
    $GLOBALS['s_is_woo'] = false;
}

/* Admin Bar */
if ($GLOBALS['s_admin_bar'] == 'hide') {
    add_filter('show_admin_bar', '__return_false');
} else {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Setup Theme
 */
if (!function_exists('seed_setup')) {
    function seed_setup() {
        load_theme_textdomain('plant', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('custom-logo', array(
            'width'       => $GLOBALS['s_logo_width'],
            'height'      => $GLOBALS['s_logo_height'],
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size($GLOBALS['s_thumb_width'], $GLOBALS['s_thumb_height'], $GLOBALS['s_thumb_crop']);
        register_nav_menus(array(
            'primary' => esc_html__('Desktop Menu', 'plant'),
            'mobile'  => esc_html__('Mobile Menu', 'plant'),
        ));
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('align-wide');
    }
}
add_action('after_setup_theme', 'seed_setup');

function seed_content_width() {
    $GLOBALS['content_width'] = apply_filters('seed_content_width', 750);
}
add_action('after_setup_theme', 'seed_content_width', 0);

/**
 * Register widget area.
 */
function seed_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Right Sidebar', 'plant'),
        'id'            => 'rightbar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Left Sidebar', 'plant'),
        'id'            => 'leftbar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'plant'),
        'id'            => 'shopbar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Home Banner', 'plant'),
        'id'            => 'home_banner',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Header Search', 'plant'),
        'id'            => 'search',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Header Action', 'plant'),
        'id'            => 'action',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Mobile Nav', 'plant'),
        'id'            => 'mobile_nav',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Footer Blocks', 'plant'),
        'id'            => 'footer_blocks',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="footer_blocks %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<!--',
        'after_title'   => '-->',
    ));
    if(get_theme_mod( 'is_footer_column', true )) {
        seed_register_footer($GLOBALS['s_footer_columns']);
    }
}
function seed_register_footer($columns = 4) {
    $i = 0;
    while( $i < $columns ) {
        $i++;
        register_sidebar(array(
            'name'          => esc_html__('Footer Column ' , 'plant') . $i,
            'id'            => 'footer-' . $i,
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ));
    }
}
add_action('widgets_init', 'seed_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function seed_scripts() {

    $s_theme = wp_get_theme();
    $s_theme_version = $s_theme->get( 'Version' );

    wp_enqueue_style('s-mobile', get_theme_file_uri('/css/mobile.css'), array(), $s_theme_version);
    wp_enqueue_style('s-desktop', get_theme_file_uri('/css/desktop.css'), array(), $s_theme_version , '(min-width: 992px)');

    if ($GLOBALS['s_style_css'] == 'enable') {
        wp_enqueue_style('s-style', get_stylesheet_uri());
    }

    if ($GLOBALS['s_is_woo']) {
        if ($GLOBALS['s_woo_css'] == 'override') {
            wp_enqueue_style('s-woo', get_theme_file_uri('/css/woo.css'));
        }
        if (get_locale() == 'th' && 'enable' == $GLOBALS['s_woo_th']) {
            wp_enqueue_style('s-woo-th', get_theme_file_uri('/css/woo-th.css'));
        }
        wp_enqueue_script('s-woo', get_theme_file_uri('/js/woo.js'), array('jquery'), $s_theme_version, true);
    }

    if ($GLOBALS['s_fontawesome'] == 'enable') {
        wp_enqueue_style('s-fa', get_theme_file_uri('/fonts/fontawesome/css/all.min.css'), array(),'5.13.0');
    }

    // SALE PAGE
    if (is_page_template( 'page-templates/salepage.php' )) {
        wp_enqueue_style('s-salepage', get_theme_file_uri('/css/page-salepage.css'), array(), $s_theme_version);
        wp_enqueue_script('s-salepage', get_theme_file_uri('/js/page-salepage.js'), array(), $s_theme_version, true);
    }

    // SCROLL FX
    if (get_theme_mod('scroll_fx', '0')) {
        wp_enqueue_style('s-fx', get_theme_file_uri('/css/scroll-fx.css'), array(), $s_theme_version);
        wp_enqueue_script('s-fx', get_theme_file_uri('/js/scroll-fx.js'), array(), $s_theme_version, true);
    }

    wp_enqueue_script('s-scripts', get_theme_file_uri('/js/scripts.js'), array(), $s_theme_version, true);

    if ($GLOBALS['s_keen_slider'] == 'enable') {
        wp_enqueue_script('s-slider', get_theme_file_uri('/js/keen-slider.js'), array(), $s_theme_version, true);
    }
    
    wp_enqueue_script('s-vanilla', get_theme_file_uri('/js/main-vanilla.js'), array(), $s_theme_version, true);

    if (($GLOBALS['s_jquery'] == 'enable') || $GLOBALS['s_is_woo']) {
        wp_enqueue_script('s-jquery', get_theme_file_uri('/js/main-jquery.js'), array('jquery'), $s_theme_version, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'seed_scripts');



/**
 * Admin CSS & JS
 */
function seed_admin($hook) {
    wp_enqueue_style('s-admin', get_template_directory_uri() . '/css/wp-admin.css');
    if ('post.php' == $hook) {
        wp_enqueue_script('s-admin-sp', get_theme_file_uri('/js/page-salepage-admin.js'), array(), false, true);
    }
}
add_action('admin_enqueue_scripts', 'seed_admin');

function seed_admin_js() {
    $be_code_js = get_theme_mod( 'be_code_js','');
    if ($be_code_js) {
        echo '<script type="text/javascript">' .  $be_code_js . '</script>';
    }
}
add_action('admin_footer', 'seed_admin_js');

function seed_admin_css_kirki() {
    echo '<style type="text/css">';
    if (get_template_directory() != get_stylesheet_directory()) {
        // CHILD THEME ACTIVATED
        if ($GLOBALS['s_hide_plant'] == 'enable') {
            echo 'h1 .theme-count {display: none;}';
            echo '.theme-browser .theme[data-slug=plant] {display: none !important;}';
        }
    }
    echo get_theme_mod( 'be_code_css','');
    echo '</style>';
}
add_action( 'admin_head', 'seed_admin_css_kirki' );


/**
 * Remove "Category: ", "Tag: ", "Taxonomy: " from archive title
 */
add_filter('get_the_archive_title', 'seed_get_the_archive_title');
function seed_get_the_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    return $title;
}

/**
 * Custom WooCommerce Settings
 */
if ($GLOBALS['s_is_woo']) {
    require get_template_directory() . '/inc/woo.php';
    if (get_locale() == 'th' && 'enable' == $GLOBALS['s_woo_th']) {
        require get_template_directory() . '/inc/woo-th.php';
    }
}

/**
 * Custom Shortcode
 */
require get_template_directory() . '/inc/shortcode.php';

/**
 * Redirect after login / Subscriber to home page.
 */
function seed_redirect_to_request( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'subscriber', $user->roles ) ) {
            return home_url();
        } else {
            return $redirect_to;
        }
    } else {
        return $redirect_to;
    }
}
if($GLOBALS['s_member_url'] != 'none') {  
    add_filter('login_redirect', 'seed_redirect_to_request', 10, 3);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Theme Demo.
 */
if (class_exists( 'OCDI_Plugin' )) {
    require get_template_directory() . '/inc/demo.php';
}


/**
 * Forminator Upload Path
 */
if (class_exists( 'Forminator' )) {
    require get_template_directory() . '/inc/forminator.php';
}

/**
 * Line notify
 */
require get_template_directory() . '/inc/line-notify.php';

/**
 * Seed Stat Pro
 */
require get_template_directory() . '/inc/seed-stat-pro.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {require get_template_directory() . '/inc/jetpack.php';}

/**
 * Include Advanced Custom Fields
 */
define( 'S_ACF_PATH', get_template_directory() . '/vendor/acf/' );
define( 'S_ACF_URL', get_template_directory_uri() . '/vendor/acf/' );
include_once( S_ACF_PATH . 'acf.php' );
add_filter('acf/settings/url', 'seed_acf_settings_url');
function seed_acf_settings_url( $url ) {
    return S_ACF_URL;
}
/**
 * ACF Blocks
 */
require get_template_directory() . '/inc/blocks.php';

function seed_theme_updater() {
	require( get_template_directory() . '/vendor/seedwebs/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'seed_theme_updater' );

/**
 * TGMPA
 */
require_once get_template_directory() . '/vendor/TGMPA/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'plant_register_required_plugins' );

function plant_register_required_plugins() {
	$plugins = array(
        array(
			'name'               => 'Kirki',
			'slug'               => 'kirki',
			'source'             => get_template_directory() . '/vendor/kirki/kirki.4.0.3.zip',
			'required'           => true,
			'version'            => '4.0.3',
			'force_activation'   => true,
			'force_deactivation' => false,
        ),
		array(
			'name'               => 'Smart Slider 3 Pro',
			'slug'               => 'nextend-smart-slider3-pro',
			'source'             => get_template_directory() . '/vendor/nextend/smartslider3-wordpress-PRO-3.5.1.2.zip',
			'required'           => false,
			'version'            => '3.5.1.2',
			'force_activation'   => false,
			'force_deactivation' => false,
        ),
        array(
			'name'               => 'One Click Demo Import',
			'slug'               => 'one-click-demo-import',
			'source'             => get_template_directory() . '/vendor/ocdi/one-click-demo-import.3.0.2.zip',
			'required'           => false,
			'version'            => '3.0.2',
			'force_activation'   => false,
			'force_deactivation' => false,
        ),

	);
	$config = array(
		'id'           => 'plant',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',   
		'has_notices'  => true,                    
		'dismissable'  => true,                    
		'dismiss_msg'  => '',                      
		'is_automatic' => true,                   
		'message'      => '',                      
	);
	tgmpa( $plugins, $config );
}