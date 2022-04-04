<?php
/**
 * Theme Demo Importer
 *
 * https://ocdi.com/quick-integration-guide/
 */

function ocdi_import_files() {
  return [
    [
      'import_file_name'           => 'Plant with Sale Page',
      'categories'                 => [ 'Sale Page'],
      'import_file_url'            => 'http://seedcdn.com/demo/plant/v2/content.xml',
      'import_widget_file_url'     => 'http://seedcdn.com/demo/plant/v2/widgets.wie',
      'import_customizer_file_url' => 'http://seedcdn.com/demo/plant/v2/customizer.dat',
      'import_preview_image_url'   => 'http://seedcdn.com/demo/plant/v2/preview.jpg',
      'preview_url'                => 'https://plant.seeddemo.com/',
    ],
	[
      'import_file_name'           => 'Ongkorn • เว็บองค์กร',
      'categories'                 => [ 'Corporate'],
      'import_file_url'            => 'http://seedcdn.com/demo/ongkorn/v1/content.xml',
      'import_widget_file_url'     => 'http://seedcdn.com/demo/ongkorn/v1/widgets.wie',
      'import_customizer_file_url' => 'http://seedcdn.com/demo/ongkorn/v1/customizer.dat',
      'import_preview_image_url'   => 'http://seedcdn.com/demo/ongkorn/v1/preview.jpg',
      'preview_url'                => 'https://ongkorn.seeddemo.com/',
    ],
    [
      'import_file_name'           => 'Ranka • เว็บร้านค้า',
      'categories'                 => [ 'E-Commerce'],
      'import_file_url'            => 'http://seedcdn.com/demo/ranka/v1/content.xml',
      'import_widget_file_url'     => 'http://seedcdn.com/demo/ranka/v1/widgets.wie',
      'import_customizer_file_url' => 'http://seedcdn.com/demo/ranka/v1/customizer.dat',
      'import_preview_image_url'   => 'http://seedcdn.com/demo/ranka/v1/preview.jpg',
      'preview_url'                => 'https://ranka.seeddemo.com/',
    ],
  ];
}
add_filter( 'ocdi/import_files', 'ocdi_import_files' );

function ocdi_register_plugins( $plugins ) {

  $theme_plugins = [];
  
  // Check if user is on the theme recommeneded plugins step and a demo was selected.
  if (
    isset( $_GET['step'] ) &&
    $_GET['step'] === 'import' &&
    isset( $_GET['import'] )
  ) {

    // Plant & Ongkorn
    if ( $_GET['import'] === '0' ||  $_GET['import'] === '1' ) {
      $theme_plugins = [
        [ // A WordPress.org plugin repository example.
          'name'     => 'Forminator',
          'slug'     => 'forminator',
          'required' => true,
      ],
      [ 
          'name'     => 'GenerateBlocks',
          'slug'     => 'generateblocks',
          'required' => true,
        ]
      ];
    }
 
    // Ranka Demo Import
    if ( $_GET['import'] === '2' ) {
      $theme_plugins = [
        [
          'name'     => 'WooCommerce',
          'slug'     => 'woocommerce',
          'required' => true,
        ],
        [
          'name'     => 'Predictive Search for WooCommerce',
          'slug'     => 'woocommerce-predictive-search',
          'required' => true,
        ],
        [
          'name'     => 'Premmerce Product Filter for WooCommerce',
          'slug'     => 'premmerce-woocommerce-product-filter',
          'required' => true,
        ],
      ];
    }
  }
 
  return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'ocdi_register_plugins' );


function ocdi_after_import_setup() {

	// Assign menus
    $main_menu = get_term_by( 'slug', 'main', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id, 
      'mobile' => $main_menu->term_id,
    ));

    // Assign front page.
    $front_page_id = get_page_by_path( 'home' );
    $blog_page_id = get_page_by_path( 'blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

    if ($blog_page_id) {
      update_option( 'page_for_posts', $blog_page_id->ID );
    }
    
    // WooCommerce
    if ( 'Ranka • เว็บร้านค้า' === $selected_import['import_file_name'] ) {
      $page = get_page_by_path( 'shop' );
      update_option( 'woocommerce_shop_page_id', $page->ID );

      $page = get_page_by_path( 'cart' );
      update_option( 'woocommerce_cart_page_id', $page->ID );

      $page = get_page_by_path( 'checkout' );
      update_option( 'woocommerce_checkout_page_id', $page->ID );

      $page = get_page_by_path( 'terms-and-conditions' );
      update_option( 'woocommerce_terms_page_id', $page->ID );

      $page = get_page_by_path( 'my-account' );
      update_option( 'woocommerce_myaccount_page_id', $page->ID );
    }
}
add_action( 'ocdi/after_import', 'ocdi_after_import_setup' );


// Disable GenerateBlocsk Redirect
function ocdi_change_activation_redirect( ) {
	return false;
}
add_filter( 'generateblocks_do_activation_redirect', 'ocdi_change_activation_redirect', 10, 3 );