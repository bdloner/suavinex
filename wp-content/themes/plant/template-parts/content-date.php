<?php
/**
 * Loop Name: Content Date
 */
$s_date = get_the_date( 'j' ); 
$s_month = get_the_date( 'F' ); 

if (function_exists('get_field')) {
    if(get_field('date')) {
        $acf_date = DateTime::createFromFormat('Ymd', get_field('date'));
        $s_date = $acf_date->format('j');
        $s_month = $acf_date->format('F');
    }
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>" class="content-date">
        <div class="calendar">
            <div class="date"><?php echo $s_date; ?></div>
            <div class="month _heading"><?php echo $s_month; ?></div>
        </div>
        <div class="info">
            <header class="entry-header">
                <h2 class="entry-title"><?php the_title(); ?></h2>
            </header>
        </div>
    </a>
</article>