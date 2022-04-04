<?php
/**
 * Loop Name: Content Post Detail
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-single'); ?>>
    <?php if ('hidden' != get_theme_mod( 'body_title_hidden','0') && 'hidden' != get_field( 'title_style')): ?>
    <header class="entry-header">
        <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </a>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php do_action('plant_begin_entry_meta'); ?>
            <?php seed_posted_on(); ?>
            <?php seed_posted_by(); ?>
            <?php seed_posted_cats(); ?>
            <?php do_action('plant_end_entry_meta'); ?>
        </div>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    <div class="entry-content">
        <?php do_action('plant_begin_entry_content'); ?>
        <?php the_content(); ?>
        <?php do_action('plant_before_entry_tags'); ?>
        <?php seed_posted_tags(); ?>
        <?php do_action('plant_before_entry_author'); ?>
        <?php if($GLOBALS['s_blog_profile'] == 'enable') :?>
        <div class="entry-author">
            <div class="pic">
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                    rel="author"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'author_bio_avatar_size', 160 ) ); ?></a>
            </div>
            <div class="info">
                <h2 class="name">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
                        rel="author"><?php the_author(); ?></a>
                </h2>
                <?php if(get_the_author_meta( 'description' )) {
                    echo '<div class="desc">'. get_the_author_meta( 'description' ). '</div>';
                }
                ?>
            </div>
        </div>
        <?php endif; ?>
        <?php do_action('plant_end_entry_content'); ?>
    </div>
    <footer class="entry-footer">
        <?php seed_entry_footer(); ?>
    </footer>
</article>