<?php ?>

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
