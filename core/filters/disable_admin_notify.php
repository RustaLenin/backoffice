<?php

function disable_wp_admin_notify() {
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none !important; }</style>';
}

add_action( 'admin_enqueue_scripts', 'disable_wp_admin_notify' );
add_action( 'login_enqueue_scripts', 'disable_wp_admin_notify' );