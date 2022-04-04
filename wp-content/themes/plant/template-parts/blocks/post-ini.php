<?php
// Load values and assing defaults.
$content_source     = get_field('content_source') ?: 'latest';
$template           = get_field('template') ?: 'card';
$order              = get_field('order') ?: 'Latest';
$posts_per_page     = get_field('posts_per_page') ?: '3';
$offset             = get_field('offset') ?: '0';
$custom             = get_field('custom') ?: 0;
$show_author        = get_field('show_author');
$to_grid            = get_field('to_grid');
$mobile_columns     = get_field('mobile_columns') ?: 1;
$desktop_columns    = get_field('desktop_columns') ?: 3;

$args = array(
    'posts_per_page' => $posts_per_page,
    'offset'         => $offset,
    'post_status'    => 'publish'
);
switch ($content_source) {
    case 'latest':
        break;
    case 'oldest':
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
        break;
    case 'categories':
        $args['cat'] = get_field('categories');
        if ($order == 'Oldest') $args['order'] = 'ASC';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    case 'custom':
        if($custom) {
            $args['post_type'] = 'any';
            $custom_arr = array();
            foreach( $custom as $custom_post) {
                array_push( $custom_arr , $custom_post);
            }
            $args['post__in'] = $custom_arr;
            $args['posts_per_page'] = count($custom_arr);
            $args['orderby'] = 'post__in';
        }
        break;
    default:
        break;
}

if (is_array($mobile_columns)) {
    $mobile_columns = array_values($mobile_columns)[0];
}
if (is_array($desktop_columns)) {
    $desktop_columns = array_values($desktop_columns)[0];
}

// Create id attribute allowing for custom "anchor" value.
$id = $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = '';
if( !empty($block['className']) ) {
    $className .= $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$className .= ' -m' . esc_attr($mobile_columns) . ' -d' . esc_attr($desktop_columns);

if( !$show_author ) {
    $className .= ' hide-author';
}

if( $to_grid ) {
    $className .= ' -togrid';
}

if( $template == 'Headline' ) {
    $className .= ' -dots-in';
}