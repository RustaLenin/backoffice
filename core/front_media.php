<?php

function load_wp_media_on_front() {
    wp_enqueue_media();
}

function filter_media( $query ) {
    // admins get to see everything
    if ( ! current_user_can( 'manage_options' ) )
        $query['author'] = get_current_user_id();
    return $query;
}

add_action('wp_enqueue_scripts', 'load_wp_media_on_front');
add_filter( 'ajax_query_attachments_args', 'filter_media' );