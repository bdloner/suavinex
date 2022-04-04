<?php get_header(); ?>

<?php 
	if ( !is_front_page() && is_home() ) {
		$post_id = get_option( 'page_for_posts' );
		seed_banner_title($post_id); 
	}
?>

<div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout']; ?>">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <div class="_space _desktop"></div>

            <?php 

				while ( have_posts() ) {
					the_post();
					echo '<div class="s-grid">';
					get_template_part( 'template-parts/content', 'hero' );
					echo '</div>';
					break;
				}

				rewind_posts();

				echo '<div class="s-grid -m'.$GLOBALS['s_blog_columns_m'].' -d'.$GLOBALS['s_blog_columns_d'].'">';

				$is_first = true;
				while ( have_posts() )  {
					if ($is_first) {
						$is_first = false;
						the_post();
						continue;
					}
					the_post();
					get_template_part( 'template-parts/content', $GLOBALS['s_blog_template']);
				} 
				echo '</div>';
				seed_posts_navigation(); 
			?>

        </main>
    </div>

    <?php 
		switch ($GLOBALS['s_blog_layout']) {
			case 'rightbar':
				get_sidebar('right'); 
				break;
			case 'leftbar':
				get_sidebar('left'); 
				break;
			case 'full-width':
				break;
			default:
				break;
		}
	?>
</div>

<?php get_footer(); ?>