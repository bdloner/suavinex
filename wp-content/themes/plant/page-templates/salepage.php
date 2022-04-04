<?php
/**
 * Template Name: Sales Page
 */
get_header(); ?>
<?php while (have_posts()): the_post(); ?>
<style>
<?php // CSS

echo '@media(max-width: 767px){';

if (get_field('img_width_m')) echo '.layout-m-list .pic{width:'. get_field('img_width_m') . '%}.layout-m-list .info{width:calc(100% - '. get_field('img_width_m') . '%)}';
if (get_field('columns_m')) echo '.layout-m-card {grid-template-columns: repeat('. get_field('columns_m') . ', 1fr)}';

echo '}';

echo '@media(min-width: 768px){';
if (get_field('img_width_d')) echo '.layout-d-list .pic{width:'. get_field('img_width_d') . '%}.layout-d-list .info{width:calc(100% - '. get_field('img_width_d') . '%)}';
if (get_field('columns_d')) echo '.layout-d-card {grid-template-columns: repeat('. get_field('columns_d') . ', 1fr)}';
echo '}';

if (get_field('hide_amount')) {
    echo '#sum .amount,#sp-products .amount{display:none}';
}

if (get_field('shipping_options')=='none') {
    echo '#shipping{display:none}';
}

if (get_field('show_header')) {
    echo '#masthead,.site-header-space{display:block;}';
}

else {
    echo '#masthead,.site-header-space{display:none;}';
}

if ( !get_field('show_footer')) {
    echo '#colophon,.site-footer-space{display:none;}';

    if(get_theme_mod('buttons_enable', 0)) {
        echo '.site-content{padding-bottom:100px}';
    }
}

if ( !get_field('show_summary')) {
    echo '#sum{display:none}';
}

if (get_field('background_color')) {
    echo 'body.page-template-salepage{background-color:'. get_field('background_color') . '}';
}

if (get_field('accent_color')) {
    echo ':root{--sp-accent:'. get_field('accent_color') . '}';
}

echo '.sp-logo img{border-radius:'. get_field('rounded_logo') . 'px}';

?>
</style>
<div class="page-salepage main-body">
    <div id="primary" class="content-area">
        <main id="main" class="site-main hide-title">
            <div class="sp-banner">
                <?php
				if (get_field('cover_m')) {
					echo wp_get_attachment_image(get_field('cover_m'), 'full', false, array('class' => 'mobile'));
				}
				if (get_field('cover_d')) {
					echo wp_get_attachment_image(get_field('cover_d'), 'full', false, array('class' => 'tablet'));
				}
				?>
            </div>
            <?php
				if(get_field('logo')) {
				echo '<div class="sp-logo">';
				echo wp_get_attachment_image(get_field('logo'), 'full');
				echo '</div>';
				}
			?>
            <div class="entry-content">
                <?php if(get_field('buy_now_button')) : ?>
                <div id="sp-buy" class="-sh">
                    <?php the_field('buy_now_text'); ?>
                </div>
                <?php endif; ?>
                <?php the_content(); ?>
                <div id="sp-start">
                    <?php 
                        $dc = 0;
                        if (get_field('title_text')) echo '<h2>' . get_field('title_text') . '</h2>';
                        if (get_field('decimals')) $dc = get_field('decimals');
                    ?>
                    <ul id="sp-products" data-selectone="<?php the_field('select_one'); ?>"
                        data-decimals="<?php echo $dc; ?>" data-soldout="<?php the_field('sold_out_text'); ?>"
                        data-limit="<?php the_field('limit_purchase'); ?>"
                        class="sp-products layout-m-<?php the_field('layout_m'); ?> layout-d-<?php the_field('layout_d'); ?> -m<?php the_field('columns_m'); ?> -d<?php the_field('columns_d'); ?>">
                        <?php
						$currency = '<small>' . get_field('currency') . '</small>';
						$currency_position = get_field('currency_position');
                        $limit_purchase = get_field('limit_purchase');
                        $i = 0;
                        $blank = 0;
						if( have_rows('products') ) {    
							while( have_rows('products') ) {
                                the_row();
                                $i++;
                                $image = get_sub_field('image');
                                $full_price = get_sub_field('full_price');
                                $sale_price = get_sub_field('sale_price');
                                
                                if (!$image && !$full_price && !$sale_price) {
                                    $blank++;
                                    continue;
                                }
                                $data  = ' data-selected="' . get_sub_field('selected') . '"';
                                if ($limit_purchase) $data .= ' data-stock="' . get_sub_field('stock') . '"';

                                echo '<li class="sp-product" id="p-'. $i .'"' . $data . '>';
                                echo '<div class="pic">';
                                echo '<b class="b-check"><i></i></b>';
                                
                                if($image) {
                                    echo wp_get_attachment_image( $image, 'large');
                                }
                                echo '</div>';

                                echo '<div class="info">';
                                echo '<h3>' . get_sub_field('name') . '</h3>';
                                if (get_sub_field('description')) {
                                    echo '<p>' . get_sub_field('description') . '</p>';
                                }
                                $price = 0;
                                if ($sale_price) {
                                    if ($full_price) echo '<span class="del">' . number_format($full_price, $dc) . '</span>';
                                    $price = $sale_price;
                                } else {
                                    if ($full_price) $price = $full_price;
                                }
                                if ($currency_position == 'left') {
                                    $show_price = $currency . number_format($price, $dc );
                                } else {
                                    $show_price = number_format($price , $dc) . $currency;
                                }
                                echo '<strong data-currency="'. $currency .'" data-currencyposition="'. $currency_position .'" data-price="' .$price . '" data-shipping="'.get_sub_field('shipping').'" class="sp-price">' .  $show_price . '</strong>';

                                // STOCK
                                if ($limit_purchase) {
                                    $stock = get_sub_field('stock');
                                    if ( $stock == 0) {
                                        echo '<div class="stock -soldout">' . get_field('sold_out_text') . '</div>';
                                    } else {
                                        if (get_field('show_stock')) {
                                            echo '<div class="stock">' . str_replace('[instock]', $stock, get_field('instock_text')) . '</div>';
                                        }
                                    }
                                }
                                echo '<div class="amount"><i class="minus">−</i><input class="num" value="0" disabled><i class="plus">+</i></div>';
                                echo '</div>';
                                echo '</li>';
							} 
							
						}
                        $i = $i - $blank;
					?>
                    </ul>
                    <div id="products-num" data-num="<?php echo $i;?>"></div>

                    <?php $table = get_field('table'); ?>
                    <table id="sum" class="table sp-table" data-free="<?php echo $table['free_shipping']; ?>">
                        <thead>
                            <tr>
                                <th><?php echo $table['product']; ?></th>
                                <th class="amount"><?php echo $table['amount']; ?></th>
                                <th><?php echo $table['total']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr id="shipping">
                                <td id="shipping_text"><?php echo $table['shipping']; ?></td>
                                <td class="amount"></td>
                                <td id="shipping_num"></td>
                            </tr>
                            <tr id="total">
                                <td id="total_text"><?php echo $table['total']; ?></td>
                                <td class="amount"></td>
                                <td>
                                    <?php
                                    $total_num = '<b id="total_num"></b>';
                                    if ($currency_position == 'left') {
                                        echo $currency . $total_num;
                                    } else {
                                        echo $total_num . $currency;
                                    }
                                ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <?php if (get_field('show_bank')) : // Bank Account ?>
                    <?php 
                        $bank = get_field('bank'); 
                        echo '<div class="hide"><div id="bank" class="sp-bank">';
                        echo '<div class="pic">';
                        if ($bank['bank_logo'] && ($bank['bank_logo'] != 'other')) {
                        echo '<img src="' . get_theme_file_uri('/img/b/') . $bank['bank_logo'] . '.png" width="60" height="60" alt="logo">';
                        } elseif ($bank['bank_logo'] == 'other' && $bank['custom_logo']) {
                        echo wp_get_attachment_image( $bank['custom_logo'], 'large' );
                        }
                        echo '</div>';
                        echo '<div class="info">';
                        echo $bank['bank_name'];
                        echo '<div id="acc-copy">';
                        echo __('Account No.', 'plant') . ' <input type="text" id="acc-no" value="' . $bank['account_no'] . '" readonly><i class="i-copy"></i>';
                        echo '<span class="acc-copied" aria-hidden="true">คัดลอกเรียบร้อย!</span>';
                        echo '</div>';
                        echo __('Account Name', 'plant') . ' ' . $bank['account_name'];
                        echo '</div>';
                        echo '</div></div>';
                    ?>
                    <?php endif; // End Bank Account ?>
                    <div id="sp-form" class="sp-form <?php echo $form == 'success' ? 'success' : '' ;?>">
                        <?php
                            if (get_field('use_forminator')) {
                                echo do_shortcode('[forminator_form id="' . get_field('form') . '"]');
                            } elseif (get_field('other_plugin_shortcode')) {
                                echo do_shortcode(get_field('other_plugin_shortcode'));
                            }
                        ?>
                        <div id="success-ms" class="success-ms">
                            <?php if (get_field('thank_you_message')) { the_field('thank_you_message'); } else {echo 'Thank you for your order!';} ?>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="entry-footer">
                <?php edit_post_link(sprintf('Edit',the_title( '<span class="screen-reader-text">"', '"</span>', false )),'<span class="edit-link">','</span>'); ?>
            </footer>
        </main>
    </div>
</div>
<?php
  $option = get_field('shipping_options');
  switch ( $option ) {
    case 'free':
      echo '<input type="hidden" value="free" class="shipping-option">';
      break;
    case 'flat':
      echo '<input type="hidden" value="flat" class="shipping-option">';
      echo '<input type="hidden" value="'.get_field('flat_cost').'" class="flat-cost">';
      break;
    case 'flat_free':
      echo '<input type="hidden" value="flat_free" class="shipping-option">';
      echo '<input type="hidden" value="'.get_field('flat_free_cost').'" class="flat-free-cost">';
      echo '<input type="hidden" value="'.get_field('flat_free_min').'" class="flat-free-min">';
      break;
    case 'cal':
      $cal_option = get_field('steps');
      $flat_cost = 0;
      $min_cost = 0;
      $start = 'false';
      $product = 'false';
      $cod = 'false';
      $free = 'false';
      foreach( $cal_option as $val ){
        if( $val == 'start' ){
          $flat_cost = get_field('flat_free_cost');
          $start = 'true';
        }
        if( $val == 'free' ){
          $min_cost = get_field('flat_free_min');
          $free = 'true';
        }
        if( $val == 'products' ){
          $product = 'true';
        }
        if( $val == 'cod' ){
            $cod = 'true';
          }
      }
      $cal_data  = ' data-start="' . $start . '" data-product="' . $product . '" data-free="'.$free.'" data-min="'.$min_cost.'"';
      $cal_data .= ' data-cod="' . $cod . '" data-codcost="' .  get_field('cod_cost') . '"';
      echo '<input type="hidden" value="cal" class="shipping-option">';
      echo '<input type="hidden" value="'.$flat_cost.'"class="cal-option"' . $cal_data . '>';
      break;
    default:
      echo '<input type="hidden" value="none" class="shipping-option">';
      break;
  }
?>
<?php 
  endwhile;
  echo get_theme_mod( 'fe_code_footer','');
  get_footer();
?>