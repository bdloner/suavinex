<?php
/**
 * Preset filters list - Admin view
 *
 * @author  YITH
 * @package YITH WooCommerce Ajax Product Filter
 * @version 4.0.0
 */

/**
 * @var $preset bool|YITH_WCAN_Preset
 */

if ( ! defined( 'YITH_WCAN' ) ) {
	exit;
} // Exit if accessed directly
?>

<div class="preset-filters-wrapper">
	<h4><?php echo esc_html_x( 'Filters of this preset', '[Admin] Label in new preset page', 'yith-woocommerce-ajax-navigation' ); ?></h4>

	<div class="preset-filters">
		<?php
		$filters = $preset ? $preset->get_filters() : array();

		YITH_WCAN()->admin->show_empty_content(
			array(
				'item_name' => _x( 'filter', '[Admin] Name of the item missing, shown in preset-empty-content template', 'yith-woocommerce-ajax-navigation' ),
				'hide' => ! empty( $filters ),
				'button_label' => _x( 'Add a new filter', '[Admin] New filter button label', 'yith-woocommerce-ajax-navigation' ),
				'button_class' => 'add-new-filter',
			)
		);

		if ( ! empty( $filters ) ) :
			foreach ( $filters as $id => $filter ) :
				include( YITH_WCAN_DIR . 'templates/admin/preset-filter.php' );
			endforeach;
		endif;
		?>
	</div>

	<a href="#" id="add_new_filter" style="<?php echo empty( $filters ) ? 'display: none;' : ''; ?>" class="add-new-filter"><?php echo esc_html_x( '+ Add filter', '[Admin] Add new filter in new preset page', 'yith-woocommerce-ajax-navigation' ); ?></a>
</div>

<script type="text/template" id="tmpl-yith-wcan-filter">
	<?php
	$filter = yith_wcan_get_filter();
	$id     = '{{data.id}}';

	include( YITH_WCAN_DIR . 'templates/admin/preset-filter.php' );
	?>
</script>

<script type="text/template" id="tmpl-yith-wcan-filter-term">
	<?php
	$term_id      = '{{data.term_id}}';
	$id           = '{{data.id}}';
	$term_name    = '{{data.name}}';
	$term_options = array(
		'label'   => '{{data.label}}',
		'tooltip' => '{{data.tooltip}}',
	);

	YITH_WCAN()->admin->filter_term_field( $id, $term_id, $term_name, $term_options );
	?>
</script>

<script type="text/template" id="tmpl-yith-wcan-filter-range">
	<?php
	$range_id = '{{data.range_id}}';
	$id       = '{{data.id}}';
	$range    = array(
		'min' => '{{data.min}}',
		'max' => '{{data.max}}',
	);

	include( YITH_WCAN_DIR . 'templates/admin/preset-filter-range.php' );
	?>
</script>
