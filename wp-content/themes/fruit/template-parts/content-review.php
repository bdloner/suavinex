<?php
/**
 * Loop Name: Content Review
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-item -review'); ?>>
    
    <?php 

    $video = get_field( 'embed_video' );

    if( $video ):

        preg_match('/src="(.+?)"/', $video, $matches_url );
        $src = $matches_url[1];	

        preg_match('/embed(.*?)?feature/', $src, $matches_id );
        $id = $matches_id[1];
        $id = str_replace( str_split( '?/' ), '', $id );

    ?>
    
    <div style="--plyr-color-main: #fff;" class="video-player" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo $id; ?>" data-poster="<?php if(has_post_thumbnail()) { echo get_the_post_thumbnail_url();}?>"></div>
    
    <?php else : ?>

        <div class="pic">
            <a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" rel="bookmark">
                <?php if(has_post_thumbnail()) { the_post_thumbnail('full');} else { echo '<img src="' . esc_url( get_template_directory_uri()) .'/img/thumb.jpg" alt="'. get_the_title() .'" />'; }?>
            </a>
        </div>
    
    <?php endif; ?>
    
    <div class="info">
        <div class="meta-date">
            <?php echo get_the_date(); ?>
        </div>

        <header class="entry-header">
            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

        <div class="meta-reviewer">
            <div class="grid-block -d2 -m1">
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
                <div class="star-rating-meta">
                    <?php
                        $rating = get_field( 'rating' );

                        if ( $rating ) {
                            $average_stars = round( $rating * 2 ) / 2;
                        
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
            </div>
        </div>

        <div class="entry-summary">
            <?php the_excerpt();?>
        </div>

        <div class="read-more-block">
            <a href="<?php the_permalink(); ?>"><?php _e('Read more'); ?><svg width="27" height="17" viewBox="0 0 27 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 8.43868C0 8.19004 0.098772 7.95159 0.274587 7.77577C0.450403 7.59996 0.68886 7.50118 0.9375 7.50118H23.0494L17.1488 1.60243C16.9727 1.4264 16.8738 1.18764 16.8738 0.938684C16.8738 0.68973 16.9727 0.450971 17.1488 0.274934C17.3248 0.0988966 17.5635 5.86557e-09 17.8125 0C18.0615 -5.86557e-09 18.3002 0.0988966 18.4762 0.274934L25.9762 7.77493C26.0636 7.86202 26.1328 7.96547 26.1801 8.07937C26.2273 8.19327 26.2517 8.31537 26.2517 8.43868C26.2517 8.562 26.2273 8.6841 26.1801 8.798C26.1328 8.91189 26.0636 9.01535 25.9762 9.10243L18.4762 16.6024C18.3002 16.7785 18.0615 16.8774 17.8125 16.8774C17.5635 16.8774 17.3248 16.7785 17.1488 16.6024C16.9727 16.4264 16.8738 16.1876 16.8738 15.9387C16.8738 15.6897 16.9727 15.451 17.1488 15.2749L23.0494 9.37618H0.9375C0.68886 9.37618 0.450403 9.27741 0.274587 9.1016C0.098772 8.92578 0 8.68732 0 8.43868Z" fill="black"/>
                </svg>
            </a>
        </div>
    </div>
</article>