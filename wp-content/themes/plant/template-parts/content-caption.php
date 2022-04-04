<?php
/**
 * Loop Name: Content Caption
 */
?>
<article id="post-<?php the_ID();?>" <?php post_class('content-item -caption');?>>
    <div class="pic">
        <a href="<?php the_permalink();?>" title="Permalink to <?php the_title_attribute();?>" rel="bookmark">
            <?php if (has_post_thumbnail()) {the_post_thumbnail('large');} else {echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/thumb.jpg" alt="' . get_the_title() . '" />';}?>
        </a>
    </div>
    <div class="info">
        <header class="entry-header">
            <?php
                $entry_cat = "";
                foreach((get_the_category()) as $category) {
                    if ($category->category_parent == 0) {
                        $entry_cat = '<small class="entry-cat _heading" title="' . $category->name . '">' . $category->name . '</small>';
                    }
                }
                echo $entry_cat; 
            ?>
            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');?>
            <?php if ('post' === get_post_type()): ?>
            <div class="entry-meta">
                <?php do_action('plant_begin_archive_meta'); ?>
                <?php 
                    seed_posted_on(false); 
                    // seed_posted_by();
                    // seed_posted_cats();
                ?>
                <?php do_action('plant_end_archive_meta'); ?>
            </div>
            <?php endif;?>
        </header>
    </div>
</article>