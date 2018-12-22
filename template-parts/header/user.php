<?php
$current_user = get_user_by( 'ID', get_current_user_id() );
?>
<div class="user_block">

    <div class="button logout SubmitLogOut">
        <svg><use href="#logout"></use></svg>
        <span class="text">Exit</span>
    </div>

    <div class="avatar_container">
        <?php $current_user_avatar = get_user_meta( get_current_user_id(), 'avatar', true );
        if ( !$current_user_avatar['guid'] ) { $current_user_avatar['guid'] = get_template_directory_uri() . 'assets/img/avatar.png'; }
        ?>
        <img src="<?php echo $current_user_avatar['guid']; ?>">
    </div>

    <span class="title"><?php echo $current_user->last_name . ' ' . $current_user->first_name; ?></span>

    <?php $current_user_position = get_user_meta( get_current_user_id(), 'position', true );
    if ( !$current_user_position ) { $current_user_position = 'Developer'; } ?>

    <span class="sub_title"><?php echo $current_user_position; ?></span>

    <div class="button profile">
        <svg><use href="#cog"></use></svg>
        <span class="text">My profile</span>
    </div>

</div>
