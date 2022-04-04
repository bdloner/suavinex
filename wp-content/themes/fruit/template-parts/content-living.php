<?php
/**
 * Loop Name: Content Living
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-item -living'); ?>>
        
    <div class="pic">
        <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
            <?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
        </a>
    </div>

    <div class="info">
        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

        <div class="meta-date">
            <?php echo get_the_date(); ?>
        </div>
        
        <hr class="sep-post" />

        <div class="entry-summary">
            <?php the_excerpt();?>
        </div>

        <div class="read-more-block">
            <a href="<?php the_permalink(); ?>"><span><?php _e('Read more'); ?></span><svg width="27" height="17" viewBox="0 0 27 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8.43868C0 8.19004 0.098772 7.95159 0.274587 7.77577C0.450403 7.59996 0.68886 7.50118 0.9375 7.50118H23.0494L17.1488 1.60243C16.9727 1.4264 16.8738 1.18764 16.8738 0.938684C16.8738 0.68973 16.9727 0.450971 17.1488 0.274934C17.3248 0.0988966 17.5635 5.86557e-09 17.8125 0C18.0615 -5.86557e-09 18.3002 0.0988966 18.4762 0.274934L25.9762 7.77493C26.0636 7.86202 26.1328 7.96547 26.1801 8.07937C26.2273 8.19327 26.2517 8.31537 26.2517 8.43868C26.2517 8.562 26.2273 8.6841 26.1801 8.798C26.1328 8.91189 26.0636 9.01535 25.9762 9.10243L18.4762 16.6024C18.3002 16.7785 18.0615 16.8774 17.8125 16.8774C17.5635 16.8774 17.3248 16.7785 17.1488 16.6024C16.9727 16.4264 16.8738 16.1876 16.8738 15.9387C16.8738 15.6897 16.9727 15.451 17.1488 15.2749L23.0494 9.37618H0.9375C0.68886 9.37618 0.450403 9.27741 0.274587 9.1016C0.098772 8.92578 0 8.68732 0 8.43868Z" fill="black"/>
                </svg>
            </a>
        </div>
    </div>
</article>