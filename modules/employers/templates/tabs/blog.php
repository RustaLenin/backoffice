<?php ?>

<span class="tab_title">
    Blog
</span>

<div class="user_feed">

    <?php

    if ( $wp_query->have_posts() ) {
        while( $wp_query->have_posts() ) {
            $wp_query->the_post();
            include( THEME_MOD . 'blog/templates/post_card.php');
        }
    } else {
        echo $user->last_name . ' ' . $user->first_name . ' have no posts yet';
    }

    ?>

</div>