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

	<?php
	$product_ref = get_field_object( 'select_product' );
	$product_id = $product_ref['value'];
	?>

	<?php
	
	$products = new WP_Query(array(
		'post_type' => 'product',
		'posts_per_page' => 1,
		'post__in'=> array($product_id)
	));

	if ($products->have_posts()) {
		global $post;
		while ($products->have_posts()) {
			$products->the_post();
			$title = $post->post_title;
		}
		wp_reset_postdata();
	}
	?>

    <div class="s-container main-body <?php echo '-'.$GLOBALS['s_blog_layout_single']; ?>">
        
		<div class="breadcrumb-block">
			<a href="<?php echo home_url(); ?>"><? _e('Home'); ?></a><span> / </span>
			<a href="<?php echo home_url(); ?>/products-review"><? _e('Products Review'); ?></a><span> / </span>
			<span class="current-page"><?php the_title(); ?></span>
		</div>

		<div class="featured-img-video-block">
			<?php 

			$video = get_field( 'embed_video' );

			if( $video ):

				preg_match('/src="(.+?)"/', $video, $matches_url );
				$src = $matches_url[1];	

				preg_match('/embed(.*?)?feature/', $src, $matches_id );
				$id = $matches_id[1];
				$id = str_replace( str_split( '?/' ), '', $id );

			?>

			<div style="--plyr-color-main: #fff;" class="video-player" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo $id; ?>" data-poster="<?php if(has_post_thumbnail()) { echo get_the_post_thumbnail_url(null,'full');}?>"></div>

			<?php else : ?>

				<div class="pic">
					<a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
						<?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
					</a>
				</div>

			<?php endif; ?>
		</div>
		<div class="main-content">

			<h1 class="title-page"><?php the_title(); ?></h1>

			<div class="meta-block">
				<div class="grid-block -d3 -m3">
					<div class="grid-item -date">
						<span class="post-date"><?php the_date(); ?></span>
					</div>
					<div class="grid-item -reviewer">
						<div class="reviewer">
							<?php 
								$image = get_field('image_profile_reviewer');
								if( !empty( $image ) ): ?>
									<img width="30" height="auto" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									<?php else : ?>
										<img width="30" height="auto" src="/wp-content/uploads/2022/03/reviewer-blank.svg" alt="reviewer-blank" />
										
										<?php endif; 
							?>
							<span class="reviewer-name">
								<?php 
									$name_reviewer = get_field('reviewer');
									if( $name_reviewer ) {
										the_field('reviewer');
									} else {
										echo 'Anonymous';
									}
									?>
							</span>
						</div>
					</div>
					<div class="grid-item -share">
						<div class="share-block">
							<span style="margin-right: 10px;"><?php _e('Share : '); ?></span><?php echo do_shortcode('[Sassy_Social_Share]'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="review-block">
				<div class="grid-block -d2 -m2">
					<div class="grid-item -star">
						<?php 
					
							$rating = get_field( 'rating' );

							if ( $rating ) {

								$average_stars = round( $rating * 2 ) / 2;

								echo '<span class="avg-rating">'.$average_stars.'</span>';
							
								$drawn = 5;

								echo '<div class="star-rating">';
								
								// full stars.
								for ( $i = 0; $i < floor( $average_stars ); $i++ ) {
									$drawn--;
									echo '<svg aria-hidden="true" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#FFC700" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>';
								}

								// half stars.
								if ( $rating - floor( $average_stars ) === 0.5 ) {
									$drawn--;
									echo '<svg aria-hidden="true" data-prefix="fas" data-icon="star-half-alt" class="svg-inline--fa fa-star-half-alt fa-w-17" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 536 512"><path fill="#FFC700" d="M508.55 171.51L362.18 150.2 296.77 17.81C290.89 5.98 279.42 0 267.95 0c-11.4 0-22.79 5.9-28.69 17.81l-65.43 132.38-146.38 21.29c-26.25 3.8-36.77 36.09-17.74 54.59l105.89 103-25.06 145.48C86.98 495.33 103.57 512 122.15 512c4.93 0 10-1.17 14.87-3.75l130.95-68.68 130.94 68.7c4.86 2.55 9.92 3.71 14.83 3.71 18.6 0 35.22-16.61 31.66-37.4l-25.03-145.49 105.91-102.98c19.04-18.5 8.52-50.8-17.73-54.6zm-121.74 123.2l-18.12 17.62 4.28 24.88 19.52 113.45-102.13-53.59-22.38-11.74.03-317.19 51.03 103.29 11.18 22.63 25.01 3.64 114.23 16.63-82.65 80.38z"/></svg>';
								}

								// empty stars.
								for ( $i = 0; $i < $drawn; $i++ ) {
									echo '<svg aria-hidden="true" data-prefix="far" data-icon="star" class="svg-inline--fa fa-star fa-w-18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#FFC700" d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"/></svg>';
								}

								echo '</div>';
							}

						?>
					</div>

					<div class="grid-item -total-reviews">
						<span class="total-review">
							<?php if(get_field('total_reviews')): 
									echo the_field('total_reviews'); 
								else :
									echo '-';
							endif; ?>
						</span>
						<span><?php _e('Reviews'); ?></span>
					</div>
				</div>
			</div>

			<div class="see-more-product-block">
				<a href="<?php echo get_permalink($product_id); ?>"><?php _e('See product details'); ?><svg width="16" height="8" viewBox="0 0 16 8" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.00003 7.00028C7.76638 7.00073 7.53994 6.91936 7.36003 6.77028L1.36003 1.77028C1.15581 1.60054 1.02739 1.35663 1.00301 1.0922C0.978631 0.827773 1.06029 0.564492 1.23003 0.360275C1.39977 0.156059 1.64368 0.0276347 1.90811 0.00325496C2.17253 -0.0211248 2.43581 0.0605367 2.64003 0.230275L8.00003 4.71028L13.36 0.390276C13.4623 0.30721 13.58 0.245178 13.7064 0.207747C13.8327 0.170315 13.9652 0.158221 14.0962 0.17216C14.2272 0.186099 14.3542 0.225796 14.4699 0.28897C14.5855 0.352144 14.6875 0.437549 14.77 0.540276C14.8616 0.643097 14.931 0.763723 14.9738 0.894597C15.0166 1.02547 15.0319 1.16377 15.0187 1.30083C15.0056 1.4379 14.9643 1.57077 14.8974 1.69113C14.8305 1.81148 14.7395 1.91673 14.63 2.00028L8.63003 6.83028C8.44495 6.95579 8.22313 7.01565 8.00003 7.00028Z" fill="black"/>
					</svg>
				</a>
			</div>

			<div class="content-block">
				<div class="grid-block -d2 -m1">
					<div class="grid-item -featured-product">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'full', false ); ?>
						<img src="<?php echo $image[0]; ?>" data-id="<?php echo $product_id; ?>">
					</div>
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