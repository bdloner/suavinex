<?php 
/**
 * Template Name: Coming Soon
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <style type="text/css">
    body.coming-soon {
        background-color: var(--s-bg);
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        padding: 20px;
    }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class('coming-soon'); ?>>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'plant' ); ?></a>
    <main id="main" class="site-main hide-title">

        <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'page' ); ?>
        <?php endwhile; ?>

    </main>
    <div class="s-modal-bg"></div>
    <?php echo get_theme_mod( 'fe_code_footer',''); ?>
    <?php wp_footer(); ?>
</body>

</html>