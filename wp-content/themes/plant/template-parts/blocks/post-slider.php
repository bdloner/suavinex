<?php
/**
 * Post Slider Block Template.
 */
require('post-ini.php');
$className .= ' s-slider';
?>
<div id="<?php echo esc_attr($id); ?>">
    <div class="<?php echo esc_attr($className);?>">
        <?php
        $the_query = new WP_Query( $args );
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            echo '<div class="slider">';
            get_template_part( 'template-parts/content', strtolower($template) );
            echo '</div>';
        }
        wp_reset_postdata();
        ?>
    </div>
</div>