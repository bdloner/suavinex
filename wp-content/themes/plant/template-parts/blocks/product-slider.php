<?php
/**
 * Product Slider Block Template.
 */
require('product-ini.php');
$mobile_columns     = get_field('mobile_columns') ?: 1;
$desktop_columns    = get_field('desktop_columns') ?: 4;
$center_m           = get_field('mobile_centered') ?: false;

if (is_array($mobile_columns)) {
    $mobile_columns = array_values($mobile_columns)[0];
}
if (is_array($desktop_columns)) {
    $desktop_columns = array_values($desktop_columns)[0];
}
if ($center_m ) {
    $className .= ' -center-m';
}
$className .= ' -m' . $mobile_columns . ' -d' . $desktop_columns  . ' s-slider';
?>
<ul id="<?php echo esc_attr($id); ?>" class="products <?php echo esc_attr($className)  ?>">
    <?php 
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<div class="slider">';
        wc_get_template_part( 'template-parts/content-product', strtolower($template) );
        echo '</div>';
    }
    wp_reset_postdata();
    ?>
</ul>