<?php ?>

<span class="tab_title">
    Profile
</span>

<div class="profile_cards">

    <div class="nice_metabox niceMetaBox">

        <div class="head" onclick="Nice.toggleMetaBox( this );">
            <span class="title">
                <span class="about_icon"><?php echo nice_svg(['key' => 'cog', 'size' => 'tiny']); ?></span>
                BIO
            </span>
            <span class="collapse_icon">
                <?php echo nice_svg(['key' => 'arrow_down', 'size' => 'tiny' ]); ?>
            </span>
        </div>

        <div class="body">

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'user', 'size' => 'tiny']); ?> Name:</span>
                <span class="value"><?php echo $user->last_name . ' ' . $user->first_name; ?></span>
            </span>

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'calendar', 'size' => 'tiny']); ?> Birth date:</span>
                <span class="value"><?php $birth_date = get_user_meta($user->ID, 'birth_date', true ); if ( $birth_date ) { echo $birth_date; } else { echo 'No birth date stored'; } ?></span>
            </span>

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'language', 'size' => 'tiny']); ?> Speaks:</span>
                <span class="value"><?php $user_language = get_user_meta($user->ID, 'language', true ); if ( $user_language ) { echo $user_language; } else { echo 'Unknown'; } ?></span>
            </span>

        </div>

    </div>

    <div class="nice_metabox niceMetaBox">

        <div class="head" onclick="Nice.toggleMetaBox( this );">
            <span class="title">
                <span class="about_icon"><?php echo nice_svg(['key' => 'cog', 'size' => 'tiny']); ?></span>
                Contacts
            </span>
            <span class="collapse_icon">
                <?php echo nice_svg(['key' => 'arrow_down', 'size' => 'tiny' ]); ?>
            </span>
        </div>

        <div class="body">

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'email', 'size' => 'tiny']); ?> Email:</span>
                <span class="value"><?php echo $user->user_email; ?></span>
            </span>

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'smartphone', 'size' => 'tiny']); ?> Phone:</span>
                <span class="value"><?php $user_phone = get_user_meta($user->ID, 'phone', true ); if ( $user_phone ) { echo $user_phone; } else { echo 'No phone stored'; } ?></span>
            </span>

            <span class="profile_meta">
                <span class="key"><?php echo nice_svg(['key' => 'at', 'size' => 'tiny']); ?> Slack:</span>
                <span class="value"><?php $user_slack = get_user_meta($user->ID, 'slack', true ); if ( $user_slack ) { echo $user_slack; } else { echo 'No slack account stored'; } ?></span>
            </span>

        </div>

    </div>

    <?php if ( is_user_logged_in() && current_user_can('edit_users') ) { ?>

        <div class="nice_metabox niceMetaBox">

            <div class="head" onclick="Nice.toggleMetaBox( this );">
            <span class="title">
                <span class="about_icon"><?php echo nice_svg(['key' => 'cog', 'size' => 'tiny']); ?></span>
                Work info
            </span>
                <span class="collapse_icon">
                <?php echo nice_svg(['key' => 'arrow_down', 'size' => 'tiny' ]); ?>
            </span>
            </div>

            <div class="body">

            <span class="profile_meta">
                <span class="key">Position:</span>
                <span class="value"><?php echo $user_position; ?></span>
            </span>

                <span class="profile_meta">
                <span class="key">Salary:</span>
                <span class="value"><?php $salary = get_user_meta( $user->ID, 'salary', true ); if ( !$salary ) { echo 'Unknown'; } else { echo $salary . ' ' . get_user_meta( $user->ID, 'salary_currency', true ); } ?></span>
            </span>

                <span class="profile_meta">
                <span class="key">First day:</span>
                <span class="value"><?php $first_day = get_user_meta($user->ID, 'first_day', true ); if ( $first_day ) { echo $first_day; } else { echo 'Unknown'; } ?></span>
            </span>

                <span class="profile_meta">
                <span class="key">Description:</span>
                <span class="value"><?php echo $user->description; ?></span>
            </span>

            </div>

        </div>

    <?php } ?>

    <div class="nice_metabox niceMetaBox">

        <div class="head" onclick="Nice.toggleMetaBox( this );">
            <span class="title">
                <span class="about_icon"><?php echo nice_svg(['key' => 'cog', 'size' => 'tiny']); ?></span>
                Location
            </span>
            <span class="collapse_icon">
                <?php echo nice_svg(['key' => 'arrow_down', 'size' => 'tiny' ]); ?>
            </span>
        </div>

        <div class="body">

            <span class="profile_meta">
                <span class="key">Country:</span>
                <span class="value"><?php $resident = get_user_meta( $user->ID, 'resident', true ); if ( !$resident ) { echo 'Unknown'; } else { echo $resident; } ?></span>
            </span>

            <span class="profile_meta">
                <span class="key">Home Address:</span>
                <span class="value"><?php $home_address = get_user_meta( $user->ID, 'home_address', true ); if ( !$home_address ) { echo 'Unknown'; } else { echo $home_address; } ?></span>
            </span>

            <span class="profile_meta">
                <span class="key">Office:</span>
                <span class="value"><?php $offices = get_user_meta( $user->ID, 'office', true ); if ( $offices['ID'] ) { echo '<a href="' . get_the_permalink( $offices['ID'] ) .  '">' . get_the_title( $offices['ID'] ) . '</a>'; } ?></span>
            </span>

        </div>

    </div>

</div>