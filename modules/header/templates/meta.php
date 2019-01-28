<?php

echo '<div class="search_container">' . nice_svg( ['key' => 'search', 'size'=> 'small', 'click_able' => true] ) . '</div>';

if ( is_user_logged_in() ) {
    $current_user = get_user_by( 'ID', get_current_user_id() );
    $current_user_avatar = get_user_meta( get_current_user_id(), 'avatar', true );
    if ( !$current_user_avatar['guid'] ) { $current_user_avatar['guid'] = get_template_directory_uri() . 'assets/img/avatar.png'; }
    ?>

    <div class="header_profile">
        <img class="profile_avatar" src="<?php echo $current_user_avatar['guid']; ?>">
        <div class="profile_content">
            <span class="profile_title"><?php echo $current_user->last_name . ' ' . $current_user->first_name; ?><?php echo nice_svg(['key' => 'arrow_down', 'size' => 'micro']); ?></span>
            <span class="profile_position"><?php echo get_user_meta( get_current_user_id(), 'position', true ); ?></span>
        </div>
    </div>


    <?php
} else {
    echo nice_svg( ['key' => 'sign_in', 'size'=> 'small'] );
}

?>

