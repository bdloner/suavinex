<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package seed
 */

get_header(); ?>

<?php 
	$singleclass ='';
	if ($GLOBALS['s_blog_layout_single'] == 'full-width') {
		$singleclass = 'single-area';
	}
	$pid = get_the_ID();
?>
<?php while ( have_posts() ) : the_post(); ?>

<div class="site-single <?php echo($singleclass);?>">
    <div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout_single']; ?>">
        
		<div class="breadcrumb-block">
			<a href="<?php echo home_url(); ?>"><? _e('Home'); ?></a><span> / </span>
			<a href="<?php echo home_url(); ?>/products-review"><? _e('Products Review'); ?></a><span> / </span>
			<span class="current-page"><?php the_title(); ?></span>
		</div>

		<div class="main-content">

			<h1 class="title-page"><?php the_title(); ?></h1>

			<div class="meta-block">
				<div class="grid-block -d2 -m2">
					<div class="grid-item -date">
						<span class="post-date"><?php the_date(); ?></span>
					</div>
					<div class="grid-item -share">
						<div class="share-block">
							<span><?php _e('Share : '); ?></span><?php echo do_shortcode('[Sassy_Social_Share]'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="featured-img-video-block">
				<div class="pic">
					<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
						<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
					</a>
				</div>
			</div>

			<div class="content-block">
				<div class="grid-block -d1 -m1">
					<div class="grid-item -review-content">
						<?php get_template_part( 'template-parts/content-single', get_post_type() ); ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>

        </div>

        <?php 
		switch ($GLOBALS['s_blog_layout_single']) {
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
</div>

<?php if(get_theme_mod('blog_related', 0)) {get_template_part( 'template-parts/single', 'related',  array('id' => $pid) );} ?>

<?php endwhile; ?>
<?php get_footer(); ?>