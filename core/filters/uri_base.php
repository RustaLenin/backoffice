<?php

function change_author_base() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'user';
}

add_action('init', 'change_author_base');