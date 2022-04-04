<?php
/**
 * Override seed_setup()
 */
/* 
function fruit_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 200,
		'height'      => 200,
		'flex-width' => true,
		) );
}
add_action( 'after_setup_theme', 'fruit_setup', 11);
*/

/**
 * Enqueue scripts and styles.
 */
function fruit_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style('fruit', get_theme_file_uri('/css/style.min.css'), array(), $theme_version );
	
	// Plyr Libary
	wp_enqueue_style('plyr_css', get_theme_file_uri('/js/plyr-lib/plyr.min.css'), array(), $theme_version );
	wp_enqueue_script('plyr_js', get_theme_file_uri('/js/plyr-lib/plyr.min.js'), array(),  $theme_version, true);
	wp_enqueue_script('plyr_js_poly', get_theme_file_uri('/js/plyr-lib/plyr.polyfilled.min.js'), array(),  $theme_version, true);
	
    // Featherlight Popup Libary
	wp_enqueue_style('popup_css', get_theme_file_uri('/js/featherlight-lib/featherlight.min.css'), array(), $theme_version );
	wp_enqueue_script('popup_js', get_theme_file_uri('/js/featherlight-lib/featherlight.min.js'), array(),  $theme_version, true);
	
    wp_enqueue_script('fruit', get_theme_file_uri('/js/main.js'), array(),  $theme_version, true);
}
add_action( 'wp_enqueue_scripts', 'fruit_scripts' , 20 );

// ================= Sticky Postion CPT ================= //

function wpb_cpt_sticky_at_top( $posts ) {
   
    // apply it on the archives only
    if ( is_main_query() && is_post_type_archive() ) {
        global $wp_query;
   
        $sticky_posts = get_option( 'sticky_posts' );
        $num_posts = count( $posts );
        $sticky_offset = 0;
   
        // Find the sticky posts
        for ($i = 0; $i < $num_posts; $i++) {
   
            // Put sticky posts at the top of the posts array
            if ( in_array( $posts[$i]->ID, $sticky_posts ) ) {
                $sticky_post = $posts[$i];
   
                // Remove sticky from current position
                array_splice( $posts, $i, 1 );
   
                // Move to front, after other stickies
                array_splice( $posts, $sticky_offset, 0, array($sticky_post) );
                $sticky_offset++;
   
                // Remove post from sticky posts array
                $offset = array_search($sticky_post->ID, $sticky_posts);
                unset( $sticky_posts[$offset] );
            }
        }
   
        // Look for more sticky posts if needed
        if ( !empty( $sticky_posts) ) {
   
            $stickies = get_posts( array(
                'post__in' => $sticky_posts,
                'post_type' => $wp_query->query_vars['post_type'],
                'post_status' => 'publish',
                'nopaging' => true
            ) );
   
            foreach ( $stickies as $sticky_post ) {
                array_splice( $posts, $sticky_offset, 0, array( $sticky_post ) );
                $sticky_offset++;
            }
        }
   
    }
   
    return $posts;
}
   
add_filter( 'the_posts', 'wpb_cpt_sticky_at_top' );
  
// Add sticky class in article title to style sticky posts differently
  
function cpt_sticky_class($classes) {
            if ( is_sticky() ) : 
            $classes[] = 'sticky';
            return $classes;
        endif; 
        return $classes;
	}
add_filter('post_class', 'cpt_sticky_class');

// ================= Relate Product Review Select ACF ================= //

if ( !function_exists('acf_load_product_field_choices') ){
	function acf_load_product_field_choices( $field ) {

		$choices = array();
		$products = new WP_Query(array(
		'post_type' => 'product',
		'post_per_page' => -1,
		'orderby' => 'post_title',
		'order' => 'ASC'
		));
		if ($products->have_posts()) {
			global $post;
			while ($products->have_posts()) {
				$products->the_post();
				$choices[$post->ID] = $post->post_title;
			}
			wp_reset_postdata();
		}
	
		$field['choices'] = $choices;
	
		// return the field
		return $field;
		
	}
	
	add_filter('acf/load_field/name=select_product', 'acf_load_product_field_choices');	
}


// ================= Custom Currency ฿ to BAHT ================= //

/**
 * Custom currency and currency symbol
 */
add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {
     $currencies['THB'] = __( 'Thailand', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'THB': $currency_symbol = 'BAHT'; break;
     }
     return $currency_symbol;
}

// ================= Get In stock on single product page ================= //

add_filter( 'woocommerce_get_availability', 'stock_availability', 1, 2);

function stock_availability( $availability, $_product ) {

    global $product;

    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
    $availability['availability'] = __('In Stock', 'woocommerce');
    }

    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
    $availability['availability'] = __('Sold out', 'woocommerce');
    }

    return $availability;
}

// ================= Replace add to cart to line contact single product page ================= //

add_action( 'woocommerce_single_product_summary', 'replace_add_to_cart_btn', 31 );
function replace_add_to_cart_btn() {
    $line_link = '#';
    $button_text = 'Continue with LINE';

    echo '<a href="'. $line_link .'" class="single_add_to_cart_button button alt"><svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M21.1763 10.1637C21.2689 10.1605 21.3613 10.176 21.4478 10.2092C21.5343 10.2425 21.6133 10.2928 21.68 10.3572C21.7466 10.4216 21.7996 10.4988 21.8359 10.5841C21.8721 10.6694 21.8907 10.7612 21.8907 10.8539C21.8907 10.9466 21.8721 11.0384 21.8359 11.1237C21.7996 11.209 21.7466 11.2862 21.68 11.3506C21.6133 11.415 21.5343 11.4653 21.4478 11.4986C21.3613 11.5318 21.2689 11.5473 21.1763 11.5441H19.2577V12.7745H21.1763C21.2695 12.77 21.3626 12.7844 21.4501 12.8169C21.5376 12.8494 21.6175 12.8994 21.6851 12.9637C21.7526 13.0281 21.8064 13.1055 21.8432 13.1913C21.8799 13.277 21.8989 13.3694 21.8989 13.4627C21.8989 13.556 21.8799 13.6483 21.8432 13.7341C21.8064 13.8199 21.7526 13.8973 21.6851 13.9616C21.6175 14.026 21.5376 14.0759 21.4501 14.1085C21.3626 14.141 21.2695 14.1554 21.1763 14.1509H18.5704C18.3882 14.1502 18.2137 14.0775 18.085 13.9485C17.9564 13.8195 17.884 13.6449 17.8838 13.4627V8.24593C17.8838 7.86616 18.1914 7.55446 18.5704 7.55446H21.1812C21.3583 7.56361 21.5251 7.64055 21.6471 7.76934C21.769 7.89813 21.8367 8.06889 21.8362 8.24624C21.8357 8.4236 21.7669 8.59395 21.6442 8.72201C21.5215 8.85007 21.3543 8.92602 21.1771 8.93412H19.2585V10.1645L21.1763 10.1637ZM16.9651 13.4619C16.9636 13.6446 16.89 13.8193 16.7604 13.948C16.6308 14.0767 16.4555 14.149 16.2729 14.1492C16.1647 14.1503 16.0578 14.1262 15.9605 14.0788C15.8633 14.0313 15.7784 13.962 15.7126 13.8761L13.0427 10.2449V13.4611C13.0427 13.6436 12.9702 13.8186 12.8412 13.9477C12.7121 14.0767 12.5371 14.1492 12.3545 14.1492C12.172 14.1492 11.997 14.0767 11.8679 13.9477C11.7389 13.8186 11.6664 13.6436 11.6664 13.4611V8.24429C11.6664 7.94982 11.8591 7.6857 12.1364 7.59137C12.2048 7.56719 12.277 7.55525 12.3496 7.5561C12.5629 7.5561 12.7597 7.67176 12.8918 7.83417L15.583 11.4736V8.24429C15.583 7.86451 15.8906 7.55282 16.2712 7.55282C16.6518 7.55282 16.9635 7.86451 16.9635 8.24429L16.9651 13.4619ZM10.6853 13.4619C10.6845 13.6448 10.6111 13.82 10.4814 13.949C10.3516 14.078 10.176 14.1503 9.99305 14.1501C9.81146 14.1485 9.6378 14.0754 9.50985 13.9465C9.3819 13.8177 9.31 13.6435 9.30979 13.4619V8.24511C9.30979 7.86534 9.61738 7.55364 9.99797 7.55364C10.3777 7.55364 10.6862 7.86534 10.6862 8.24511L10.6853 13.4619ZM7.98919 14.1501H5.37835C5.19558 14.1496 5.02037 14.0771 4.89075 13.9483C4.76113 13.8194 4.68758 13.6446 4.68606 13.4619V8.24511C4.68606 7.86534 4.99776 7.55364 5.37835 7.55364C5.75894 7.55364 6.06654 7.86534 6.06654 8.24511V12.7737H7.98919C8.17171 12.7737 8.34675 12.8462 8.47581 12.9753C8.60487 13.1043 8.67738 13.2794 8.67738 13.4619C8.67738 13.6444 8.60487 13.8194 8.47581 13.9485C8.34675 14.0776 8.17171 14.1501 7.98919 14.1501ZM26.2479 10.6542C26.2479 4.78039 20.356 0 13.1239 0C5.89182 0 0 4.78039 0 10.6542C0 15.9177 4.66966 20.3265 10.9749 21.164C11.4022 21.2534 11.983 21.4461 12.1331 21.8095C12.2651 22.1376 12.2184 22.6462 12.1757 22.9931L11.9961 24.1078C11.9444 24.4368 11.7312 25.403 13.1412 24.8132C14.5553 24.2235 20.7071 20.3536 23.4623 17.1825C25.3464 15.1196 26.2479 13.0001 26.2479 10.6542Z" fill="white"/>
    </svg>
    '. $button_text .'</a>';
}

// ================= Remove summary on single product page ================= //

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/* function so_43922864_add_content(){
    if( get_field('guide_condition') ) {
        $image = get_field('image_guide');
        if( !empty( $image ) ): ?>
            <div class="guide-block">
                <a href="#" data-featherlight="<?php echo esc_url($image['url']); ?>">
                    <?php _e('Guide'); ?>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.6575 18.551L17.9058 16.8002C18.2748 16.2369 18.5012 15.5922 18.5653 14.9219C18.6294 14.2516 18.5293 13.5757 18.2738 12.9527C18.0182 12.3297 17.6148 11.7782 17.0985 11.346C16.5821 10.9138 15.9683 10.6137 15.31 10.4718L15.2825 10.4668V7.076C15.2826 6.87939 15.2139 6.68893 15.0883 6.53767L15.0892 6.53934V6.53517C15.0734 6.51606 15.0567 6.4977 15.0392 6.48017L15.0325 6.47267L15.01 6.45017L8.81 0.250169C8.79275 0.232919 8.77467 0.216511 8.75583 0.201003L8.73417 0.186003C8.72063 0.174985 8.70674 0.164423 8.6925 0.154336L8.67167 0.139336L8.62667 0.111003L8.6075 0.101003C8.58861 0.0898915 8.56778 0.0796137 8.545 0.0701693L8.51833 0.0593359L8.47583 0.0443359L8.44583 0.0351693L8.3975 0.0226693L8.37417 0.0176693C8.35049 0.0127773 8.32657 0.00916093 8.3025 0.00683594H0.845833C0.622205 0.00770851 0.407948 0.0967607 0.249584 0.254657C0.0912205 0.412553 0.00153452 0.626545 0 0.850169L0 17.831C0.000217469 18.0556 0.0892959 18.2709 0.247778 18.43C0.40626 18.5891 0.621266 18.6791 0.845833 18.6802H14.4375C15.2501 18.6816 16.0447 18.4417 16.7208 17.991L16.7058 18.0002L18.4575 19.7518C18.619 19.8988 18.8309 19.9778 19.0491 19.9726C19.2674 19.9674 19.4753 19.8784 19.6296 19.7239C19.7839 19.5695 19.8728 19.3616 19.8779 19.1433C19.8829 18.9251 19.8037 18.7132 19.6567 18.5518L19.6575 18.5527V18.551ZM16.8867 14.5285C16.8867 14.8506 16.8233 15.1696 16.7001 15.4672C16.5769 15.7648 16.3963 16.0353 16.1685 16.2631C15.9408 16.4909 15.6704 16.6716 15.3728 16.795C15.0752 16.9183 14.7563 16.9818 14.4342 16.9818C14.112 16.9819 13.7931 16.9185 13.4954 16.7953C13.1978 16.6721 12.9274 16.4914 12.6996 16.2637C12.4718 16.036 12.291 15.7656 12.1677 15.468C12.0444 15.1704 11.9809 14.8515 11.9808 14.5293C11.9806 13.8788 12.2388 13.2548 12.6987 12.7946C13.1585 12.3345 13.7824 12.0758 14.4329 12.0756C15.0835 12.0754 15.7075 12.3336 16.1676 12.7934C16.6278 13.2533 16.8864 13.8771 16.8867 14.5277V14.5285ZM9.05667 2.8985L12.3842 6.22684H9.05667V2.8985ZM1.69833 1.6985H7.35917V7.076C7.35917 7.54517 7.73917 7.92517 8.20833 7.92517H13.5858V10.4668C11.6875 10.8727 10.2842 12.536 10.2842 14.5277C10.2842 15.4518 10.5858 16.3052 11.0967 16.9943L11.0883 16.9835H1.6975L1.69833 1.6985Z" fill="#373737"/>
                    </svg>
                </a>
            </div>
        <?php endif; 
    }
}
add_action( 'woocommerce_single_product_summary', 'so_43922864_add_content', 15 );
*/
