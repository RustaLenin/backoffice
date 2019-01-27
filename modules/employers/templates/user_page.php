<?php

$user = get_user_by( 'ID', $author );
if ( !$user->position ) { $user->position = 'Developer'; }

?>

<div class="user_page">

    <div class="info_panel">

        <div class="avatar">
            <img src="<?php if ( $user->avatar ) { echo $user->avatar['guid']; } else { echo get_template_directory_uri() . 'assets/img/avatar.png'; } ?>" >
        </div>

        <span class="name">
            <?php echo $user->last_name . ' ' . $user->first_name; ?>
        </span>

        <span class="position"><?php echo $user->position ?></span>

        <div class="description">
            <?php echo $user->user_description; ?>
        </div>

        <?php if ( is_user_logged_in() ) { ?>

        <div class="part">

            <span class="part_title">
                Contacts
            </span>

            <div class="part_content">

                <span class="contact_item">
                    <?php echo nice_svg(['key' => 'email', 'size' => 'small'] ); ?>
                    <span class="value"><a href="mailto:<?php echo $user->user_email; ?>"><?php echo $user->user_email; ?></a></span>
                </span>

                <?php if ( $user->phone ) { ?>

                    <span class="contact_item">
                        <?php echo nice_svg(['key' => 'smartphone', 'size' => 'small'] ); ?>
                        <span class="value"><a href="tel:<?php echo $user->phone; ?>"><?php echo $user->phone; ?></a></span>
                    </span>

                <?php } ?>

                <?php if ( $user->slack ) { ?>

                    <span class="contact_item">
                    <?php echo nice_svg(['key' => 'at', 'size' => 'small'] ); ?>
                        <span class="value"><?php echo $user->slack; ?></span>
                    </span>

                <?php } ?>

            </div>

        </div>

        <?php } ?>

    </div>

    <div class="user_page__content">

        <div class="tabs_container">

        </div>

        <div class="tabs_content">

        </div>

    </div>

</div>
