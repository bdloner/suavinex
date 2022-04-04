<?php
/**
 * Product Gird Block Template.
 */
require('product-ini.php');
$desktop_columns    = get_field('desktop_columns') ?: 4;
if (is_array($desktop_columns)) {
    $desktop_columns = array_values($desktop_columns)[0];
}
$className .= ' columns-' . esc_attr($desktop_columns);
?>
<ul id="<?php echo esc_attr($id); ?>" class="products <?php echo esc_attr($className)  ?>">
    <?php 
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        wc_get_template_part( 'template-parts/content-product', strtolower($template) );
    }
    wp_reset_postdata();
    ?>
</ul>