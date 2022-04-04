<?php 
/**
 * Template Name: Form
 */
get_header(); ?>

<div class="page-form">

    <?php seed_banner_title(get_the_ID()); ?>

    <div class="s-container main-body">

        <div id="primary" class="content-area">
            <main id="main" class="site-main hide-title">

                <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

                <?php endwhile; ?>

            </main>
        </div>
    </div>
</div>

<?php get_footer(); ?>