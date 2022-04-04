<?php 
/**
 * Template Name: Left & Right Sidebar
 */
get_header(); ?>

<?php seed_banner_title(get_the_ID()); ?>

<div class="s-container main-body -leftrightbar">

    <div id="primary" class="content-area -leftrightbar">
        <main id="main" class="site-main hide-title">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
            <?php endwhile; ?>
        </main>
    </div>
    <?php get_sidebar('left'); ?>
    <?php get_sidebar('right'); ?>

</div>

<?php get_footer(); ?>