<?php
/**
 * Post Grid Block Template.
 */
require('post-ini.php');
$className .= ' s-grid';
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className)  ?>">
    <?php 
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        get_template_part( 'template-parts/content', strtolower($template) );
    }
    wp_reset_postdata();
    ?>
</div>