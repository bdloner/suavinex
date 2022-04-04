<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php 
        wp_head();
        echo get_theme_mod( 'fe_code_header','');
        if ( function_exists( 'plant_css' ) ) { plant_css(); }
        if ( function_exists( 'plant_var' ) ) { plant_var(); } 
        echo '<style id="fe_css" type="text/css">' . get_theme_mod( 'fe_code_css','') . '</style>';
    ?>
</head>
<?php 
    $bodyClass = ''; 
    if (is_active_sidebar( 'headbar_d' )) { 
        $bodyClass = 'headbar-d'; 
    } 
    if (is_active_sidebar( 'headbar_m' )) { 
        $bodyClass .= ' headbar-m'; 
    }
    if (get_theme_mod('scroll_fx', '0')) { 
        $scroll_fx_options = get_theme_mod('scroll_fx_option', ['auto']);
        if ( ! empty( $scroll_fx_options ) ) {
            foreach ( $scroll_fx_options as $scroll_fx_option ) {
                 $bodyClass .= ' scroll-fx-' . $scroll_fx_option; 
            }
        }
    }
?>

<body <?php body_class($bodyClass); ?>>
    <?php 
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    } 
    $headerClass = 's-' . $GLOBALS['s_header_style_m'] . '-m s-' . $GLOBALS['s_header_style_d'] .  '-d -' . $GLOBALS['s_header_layout'];
    $headerClass.= ' -' . get_theme_mod( 'header_layout_m','center-logo') . '-m';
    

    if($GLOBALS['s_header_effect'] == 'overlay') {
        $headerClass .= ' -overlay';
    }
    if($GLOBALS['s_header_layout'] == 'top-logo') {
        $navbar_begin = '<div class="site-navbar"><div class="s-container">';
        $navbar_end = '</div></div>';
    } else {
        $navbar_begin = '';
        $navbar_end = '';
    }
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'plant' ); ?></a>
    <div id="page" class="site">
        <header id="masthead" class="site-header _heading <?php echo $headerClass; ?>"
            data-scroll="<?php echo $GLOBALS['s_header_scroll']; ?>">
            <div class="s-container">
                <div class="site-branding">
                    <?php seed_logo(); ?>
                    <?php seed_title(); ?>
                </div>
                <?php 
                    if (is_active_sidebar( 'search' )) {
                        echo '<div class="action-center">';
                        dynamic_sidebar( 'search' ); 
                        echo '</div>';
                    } 
                ?>
                <div class="action-left">
                    <?php plant_header_action($GLOBALS['s_left_area'], $GLOBALS['s_left_area_phone'], $GLOBALS['s_left_area_custom'], get_theme_mod( 'left_area_menu_text', 'MENU' ) ); ?>
                </div>
                <div class="action-right">
                    <?php plant_header_action($GLOBALS['s_right_area'], $GLOBALS['s_right_area_phone'], $GLOBALS['s_right_area_custom'], get_theme_mod( 'right_area_menu_text', 'MENU' ) ); ?>
                </div>
                <?php echo $navbar_begin; ?>
                <nav id="site-nav-d" class="site-nav-d _desktop">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );?>
                </nav>
                <div class="site-action">
                    <?php 
                        do_action('plant_begin_site_action');
                        if (is_active_sidebar( 'action' )) {
                            dynamic_sidebar( 'action' );
                        }
                        if ( ! empty( $GLOBALS['s_header_action'] ) ) {
                            foreach ( $GLOBALS['s_header_action'] as $action ) {
                                switch ($action) {
                                    case 'search':
                                        echo '<a class="site-search s-modal-trigger m-user" onclick="return false;" data-popup-trigger="site-search">';
                                        seed_icon('search');
                                        echo '</a>';
                                        break;
                                    case 'cart':
                                        $cart_url = '';
                                        if ( function_exists( 'wc_get_cart_url' ) ) {
                                            $cart_url = wc_get_cart_url();
                                        }
                                        echo '<a class="site-cart" href="' .  $cart_url . '" title="' . __( 'View your shopping cart', 'plant' ) . '">';
                                        seed_icon($GLOBALS['s_cart_icon']);
                                        echo '<b id="cart-count-d" class="cart-count hide"></b>';
                                        echo '</a>';
                                        break;
                                    case 'my-account':
                                        seed_member_menu();
                                        break;
                                    case 'custom':
                                        // echo wp_kses(get_theme_mod('header_action_custom',''), wp_kses_allowed_html( 'post' ));
                                        echo '<div class="site-action-custom">' . do_shortcode(get_theme_mod('header_action_custom','')) . '</div>';
                                        break;
                                    default:
                                        break;
                                }
                            }
                        }
                        do_action('plant_end_site_action');
                    ?>
                </div>
                <?php echo $navbar_end; ?>
            </div>
            <nav id="site-nav-m" class="site-nav-m">
                <div class="s-container">
                    <?php do_action('plant_begin_nav_m'); ?>
                    <?php 
                        wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_id' => 'mobile-menu' ) ); 
                        if (is_active_sidebar( 'mobile_nav' )) {
                            dynamic_sidebar( 'mobile_nav' );
                        }
                    ?>
                    <?php do_action('plant_end_nav_m'); ?>
                </div>
            </nav>
        </header>
        <div class="s-modal -full" data-s-modal="site-search">
            <span class="s-modal-close"><?php seed_icon('x'); ?></span>
            <?php get_search_form(); ?>
        </div>
        <div class="site-header-space"></div>
        <?php 
		if (is_front_page()) {
			if (is_active_sidebar( 'home_banner' )) {
				echo '<div class="home-banner">'; dynamic_sidebar( 'home_banner' ); echo '</div>';
			} 
		}
		?>
        <div id="content" class="site-content">