<?php
$current_user = get_user_by( 'ID', get_current_user_id() );
?>
<div class="user_card">
    <div class="user_header">
        <div class="avatar">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/0.png'; ?>">
        </div>

        <div class="status">
        <span class="name">Test User
            <!--            --><?php //echo $current_user->last_name . ' ' . $current_user->first_name; ?>
        </span>

            <?php $current_user_position = get_user_meta( get_current_user_id(), 'position', true );
            if ( !$current_user_position ) { $current_user_position = 'Developer'; } ?>

            <span class="position">Departament /Office mana
<!--                --><?php //echo $current_user_position; ?>
            </span>
        </div>
    </div>

    <div class="description">
        <span class="name_project">eSports</span>
        Tech Lead + Developing a back-end architecture of a trading platform and its internal CRM system.Tech Lead + Developing a back-end architecture of a trading platform and its internal CRM system.
    </div>
    <div class="user_bottom">
        <div class="settings">
            <svg><use href="#cog"></use></svg>
        </div>
        <div class="contact">
            <svg><use href="#contact-book"></use></svg>
        </div>
        <div class="achive">
            <svg><use href="#cog"></use></svg>
            <svg><use href="#cog"></use></svg>
        </div>
    </div>

</div>
