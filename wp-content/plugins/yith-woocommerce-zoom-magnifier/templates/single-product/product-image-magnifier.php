<?php
/**
 * Single Product Image
 *
 * @author YITH
 * @package YITH\ZoomMagnifier\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $woocommerce, $product, $is_IE;

$enable_slider = get_option( 'yith_wcmg_enableslider' ) === 'yes' ? true : false;

$placeholder = function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : woocommerce_placeholder_img_src();

$slider_items = get_option( 'yith_wcmg_slider_items', 3 );
if ( ! isset( $slider_items ) || ( null === $slider_items ) ) {
	$slider_items = 3;
}

$extra_classes = apply_filters( 'yith_wcmg_single_product_image_extra_classes', array() );
if ( is_array( $extra_classes ) ) {
	$extra_classes = implode( ' ', $extra_classes );
}


$infinite = apply_filters( 'yith_wcmg_slider_infinite', get_option( 'yith_wcmg_slider_infinite', 'yes'  ) ) === 'yes' ? 'true' : 'false';
$circular =  apply_filters( 'yith_wcmg_slider_infinite_type', get_option( 'yith_wcmg_slider_infinite_type', 'circular'  ) ) === 'circular' && $infinite === 'true' ? 'true' : 'false';
$auto_slider =  ( 'yes' === get_option( 'ywzm_auto_carousel', 'no' ) ) ? 'true' : 'false';

?>
<input type="hidden" id="yith_wczm_traffic_light" value="free">

<div class="images
<?php
if ( $is_IE ) :
	?>
	ie<?php endif ?>">

	<?php
	if ( has_post_thumbnail() ) {

		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="woocommerce-product-gallery__image %s"><a href="%s" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image" title="%s">%s</a></div>', $extra_classes, $magnifier_url, $image_title, $image ), $post->ID ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

	} else {
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image %s"><img src="%s" alt="Placeholder" /></a>', $placeholder, $extra_classes, $placeholder ), $post->ID ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
	?>

	<div class="expand-button-hidden" style="display: none;">
	<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M15.3105 1.99164C15.1985 1.98716 15.1268 1.9782 15.0596 1.9782C14.4638 1.9782 13.8635 1.9782 13.2676 1.9782C12.8062 1.9782 12.4836 1.68251 12.4836 1.27035C12.4791 0.858183 12.8017 0.5625 13.2631 0.5625C14.4862 0.5625 15.7092 0.5625 16.9368 0.5625C17.4699 0.5625 17.7477 0.844743 17.7477 1.37787C17.7477 2.57852 17.7521 3.77917 17.7477 4.98431C17.7477 5.52639 17.2773 5.87136 16.7934 5.69663C16.5112 5.59359 16.3365 5.32927 16.332 4.99775C16.3275 4.42878 16.332 3.8643 16.332 3.29533C16.332 3.21469 16.332 3.13405 16.332 2.99517C16.2334 3.08477 16.1707 3.14301 16.1125 3.20125C14.4593 4.85439 12.8062 6.50304 11.1575 8.15618C10.9425 8.37122 10.705 8.49218 10.3959 8.40258C9.89863 8.25026 9.7239 7.67234 10.0554 7.26913C10.1092 7.20641 10.1674 7.15265 10.2257 7.09441C11.8519 5.46815 13.4782 3.84189 15.1 2.21564C15.1627 2.14844 15.2209 2.08572 15.3105 1.99164Z" fill="white"/>
		<path d="M2.05884 15.3058C2.1126 15.2341 2.16188 15.158 2.2246 15.0953C3.87325 13.4421 5.52639 11.789 7.17953 10.1403C7.39009 9.92977 7.63201 9.83121 7.9277 9.92081C8.1965 10.0014 8.3533 10.1896 8.41154 10.4539C8.47426 10.7451 8.34434 10.9691 8.14274 11.1707C6.65088 12.6581 5.16351 14.1455 3.67613 15.6329C3.46109 15.8479 3.24157 16.0585 2.97277 16.3183C3.11165 16.3228 3.18781 16.3318 3.26397 16.3318C3.85981 16.3318 4.46014 16.3318 5.05599 16.3318C5.49951 16.3318 5.82207 16.623 5.83104 17.0262C5.83999 17.4383 5.51295 17.7474 5.05599 17.7474C3.82397 17.7474 2.59196 17.7519 1.35995 17.7474C0.840263 17.7474 0.5625 17.4652 0.5625 16.9455C0.5625 15.7493 0.5625 14.5577 0.5625 13.3615C0.5625 12.8956 0.849223 12.573 1.26139 12.5685C1.68251 12.564 1.97819 12.8956 1.97819 13.3704C1.97819 13.9304 1.97819 14.4905 1.97819 15.0505C1.97819 15.1221 1.97819 15.1938 1.97819 15.2655C2.00508 15.2789 2.03196 15.2924 2.05884 15.3058Z" fill="white"/>
		</svg>

	</div>

	<div class="zoom-button-hidden" style="display: none;">
		<svg width="22px" height="22px" viewBox="0 0 22 22" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<defs>
				<rect id="path-1" x="0" y="0" width="30" height="30"></rect>
			</defs>
			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<g id="Product-page---example-1" transform="translate(-990.000000, -1013.000000)">
					<g id="edit-/-search" transform="translate(986.000000, 1010.000000)">
						<mask id="mask-2" fill="white">
							<use xlink:href="#path-1"></use>
						</mask>
						<g id="edit-/-search-(Background/Mask)"></g>
						<path d="M17.9704714,15.5960917 C20.0578816,12.6670864 19.7876957,8.57448101 17.1599138,5.94669908 C14.2309815,3.01776677 9.4822444,3.01776707 6.55331239,5.94669908 C3.62438008,8.87563139 3.62438008,13.6243683 6.55331239,16.5533006 C9.18109432,19.1810825 13.2736993,19.4512688 16.2027049,17.3638582 L23.3470976,24.5082521 L25.1148653,22.7404845 L17.9704714,15.5960917 C19.3620782,13.6434215 19.3620782,13.6434215 17.9704714,15.5960917 Z M15.3921473,7.71446586 C17.3447686,9.6670872 17.3447686,12.8329128 15.3921473,14.7855341 C13.4395258,16.7381556 10.273701,16.7381555 8.32107961,14.7855341 C6.36845812,12.8329127 6.36845812,9.66708735 8.32107961,7.71446586 C10.273701,5.76184452 13.4395258,5.76184437 15.3921473,7.71446586 C16.6938949,9.01621342 16.6938949,9.01621342 15.3921473,7.71446586 Z" fill="#000000" mask="url(#mask-2)"></path>
					</g>
				</g>
			</g>
		</svg>

	</div>


	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>


<script type="text/javascript" charset="utf-8">

	var yith_magnifier_options = {
		enableSlider: <?php echo $enable_slider ? 'true' : 'false'; ?>,

		<?php if ( $enable_slider ) : ?>
		sliderOptions: {
			responsive: 'true',
			circular: <?php echo $circular ?>,
			infinite: <?php echo $infinite ?>,
			direction: 'left',
			debug: false,
			auto: <?php echo $auto_slider; ?>,
			align: 'left',
			prev: {
				button: "#slider-prev",
				key: "left"
			},
			next: {
				button: "#slider-next",
				key: "right"
			},
			scroll: {
				items: 1,
				pauseOnHover: true
			},
			items: {
				visible: <?php echo esc_html( apply_filters( 'woocommerce_product_thumbnails_columns', $slider_items ) ); ?>
			}
		},

		<?php endif ?>


		<?php

		$sizes_default = Array(
			'dimensions' => array(
				'width' => '0',
				'height' => '0',
			));


		$zoom_window_sizes = get_option( 'ywzm_zoom_window_sizes', $sizes_default );

		$zoom_window_width = $zoom_window_sizes['dimensions']['width'];
		$zoom_window_height = $zoom_window_sizes['dimensions']['height'];

		if ( $zoom_window_width == '0' ){
			$zoom_window_width = 'auto';
		}

		if ( $zoom_window_height == '0' ){
			$zoom_window_height = 'auto';
		}

		?>

		showTitle: false,
		zoomWidth: '<?php echo esc_html( $zoom_window_width ); ?>',
		zoomHeight: '<?php echo esc_html(  $zoom_window_height ); ?>',
		position: '<?php echo apply_filters( 'yith_wcmg_zoom_position', esc_html( get_option( 'yith_wcmg_zoom_position' ) ) ); ?>',
		softFocus: <?php echo get_option( 'yith_wcmg_softfocus' ) === 'yes' ? 'true' : 'false'; ?>,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: '<?php echo apply_filters( 'yith_wcmg_zoom_position', esc_html( get_option( 'yith_wcmg_zoom_position' ) ) ); ?>',
		zoom_wrap_additional_css: '<?php echo esc_html( apply_filters( 'yith_ywzm_zoom_wrap_additional_css', '', $post->ID ) ); ?>',
		lensOpacity: '<?php echo esc_html( get_option( 'yith_wcmg_lens_opacity' ), '0.5' ); ?>',
		loadingLabel: '<?php echo esc_html( stripslashes( get_option( 'yith_wcmg_loading_label' ) ) ); ?>',
	};

</script>
