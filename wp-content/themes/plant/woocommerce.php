<?php get_header(); ?>
<?php
	$css_class = '';
	$show_sidebar = false;
	if($GLOBALS['s_shop_layout'] != 'full-width') {
		if(is_shop() or is_tax() or is_search()){
			$show_sidebar = true;
			$css_class = ' -' . $GLOBALS['s_shop_layout'] . '  -shopbar';
		}
	}
?>

<?php 
	if (is_shop()) {
		seed_banner_title(woocommerce_get_page_id('shop'));
		$css_class .= ' hide-title';
	} else {
		echo '<div class="s-container">';
		woocommerce_breadcrumb();
		echo '</div>';
	}
?>

<div class="s-container main-body <?php echo $css_class; ?>">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php 
			if(is_shop() && !(is_search()) && ($GLOBALS['s_shop_pagebuilder'] == 'enable')) { 
				/* Use Shop Page instead of Archive Product */
				edit_post_link('Edit', '<span class="edit-link">','</span>', $shop_page_id);
				$the_query = new WP_Query( array( 'page_id' => $shop_page_id ));
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
				the_content();
				endwhile; 
				wp_reset_postdata();
			} else {
				woocommerce_content();
				seed_entry_footer();
			}
			?>
        </main>
    </div>
    <?php if($show_sidebar) { get_sidebar('shop');} ?>
</div>
<?php get_footer(); ?>