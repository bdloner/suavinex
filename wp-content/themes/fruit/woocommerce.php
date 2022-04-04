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
	if (is_shop() || is_archive()) {
		$css_class .= ' hide-title'; ?>

		<section class="shop-banner">
			<div class="s-container">
				<h1 class="title-all-shop"><?php _e('All Products'); ?></h1>
			</div>
		</section>

		<div class="breadcrumb-block">
			<div class="s-container">
				<?php if (is_shop() || is_archive()): ?>
					<a href="<?php echo home_url(); ?>"><?php _e('Home'); ?></a><span> / </span><a href="<?php echo home_url(); ?>/products"><?php _e('Products'); ?></a><span> / </span><span class="current-page"><?php _e('All Products'); ?></span>
				<?php endif; ?>
			</div>
		</div>

		<div class="filter-block">
			<div class="s-container">
				<?php echo do_shortcode('[yith_wcan_filters slug="default-preset-2"]'); ?>
			</div>
		</div>

	<?php } else {?>
		<div class="breadcrumb-block">
			<div class="s-container">
				<a href="<?php echo home_url(); ?>"><?php _e('Home'); ?></a><span> / </span><a href="<?php echo home_url(); ?>/products"><?php _e('Products'); ?></a><span> / </span><span class="current-page"><?php the_title(); ?></span>
			</div>
		</div>
		<!-- woocommerce_breadcrumb(); -->
	<?php }
?>

<div class="s-container main-body <?php echo $css_class; ?>">
    <div class="main-products">
		<?php 
		if(is_shop() && !(is_search()) && ($GLOBALS['s_shop_pagebuilder'] == 'enable')) { 
			/* Use Shop Page instead of Archive Product */
			edit_post_link('Edit', '<span class="edit-link">','</span>', $shop_page_id);
			$the_query = new WP_Query( array( 
				'page_id' => $shop_page_id
			));
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
			the_content();
			endwhile; 
			wp_reset_postdata();
		} else {
			
			// if(!is_product()){

			// $args = array(
			// 	'post_type'   => 'product',
			// 	'post_status' => 'publish',
			// 	'posts_per_page' => -1,  // -1 will get all the product. Specify positive integer value to get the number given number of product
			// 	);
			// $the_query = new WP_Query( $args );
			// if ( $the_query->have_posts() ) {
			// 	echo '<ul class="products">';
			// 	while ( $the_query->have_posts() ) : $the_query->the_post();
			// 		get_template_part( 'template-parts/content', 'product-df' );

			// 	endwhile;
			// 	echo '</ul>';
			// } else {
			// 	echo __( 'No products found' );
			// }
			
			// wp_reset_postdata();

			// } else {
				woocommerce_content();
				seed_entry_footer();
			
			}

		// }
		
		?>
    </div>
    <?php if($show_sidebar) { get_sidebar('shop');} ?>
</div>
<?php get_footer(); ?>