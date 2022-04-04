<?php
    $pid = false;
    if ( $args['id'] ) {
        $pid = $args['id'];
    }
?>
<div class="s-sec single-related">
    <div class="s-container">
        <h2 class="s-title"><?php echo get_theme_mod( 'blog_related_title','Related Posts'); ?></h2>
        <div class="s-grid -m1 -d3">
            <?php 
                $total = get_theme_mod( 'blog_related_num',3);
                $related_posts = [];
                if( have_rows('related', $pid) ) {
                    while( have_rows('related', $pid) ) {
                        the_row();
                        $related_posts[] =  get_sub_field('post');
                    }
                }
                if (empty($related_posts)) {
                    $more = $total;
                } else {
                    $args = array(
                        'post__in' => $related_posts,
                        'orderby' => 'post__in', 
                        'posts_per_page' => count($related_posts)
                    );
                    $the_query = new WP_Query( $args );
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    }
                    wp_reset_postdata();
                    $more = $total - count($related_posts);
                }
                if ($more > 0) {
                    $related_posts[] = $pid;
                    $args = array(
                        'post__not_in' => $related_posts,
                        'category__in' => wp_get_post_categories($pid),
                        'posts_per_page' => $more
                    );
                    $the_query = new WP_Query( $args );
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        get_template_part( 'template-parts/content', 'card' );
                    }
                    wp_reset_postdata();
                }
            ?>
        </div>
    </div>
</div>