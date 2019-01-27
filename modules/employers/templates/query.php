<?php ?>

<div class="employers_navigation">
    Отсюда будет управлять страницей
</div>

<div class="employers_feed">

    <?php

    $args = [
        'meta_query' => [
            [
                'key' => 'employer',
                'value' => true
            ]
        ],
        'number' => -1
    ];
    $users = get_users( $args );
    if ( !empty( $users ) ) {
        foreach ( $users as $user ) {
            include('user_card.php');
        }
    } else {
        _e('You have no employers yet. Hire some one or put info about yourself');
    }


    ?>

</div>
