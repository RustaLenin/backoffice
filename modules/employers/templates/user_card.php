<?php ?>

<?php  if ( !$user->position ) { $user->position = 'Developer'; } ?>

<div class="user_card">

    <div class="image">
        <a href="<?php echo get_author_posts_url( $user->ID); ?>">
            <img src="<?php if ( $user->avatar ) { echo $user->avatar['guid']; } else { echo get_template_directory_uri() . 'assets/img/avatar.png'; } ?>" >
        </a>
    </div>

    <div class="body">

        <div class="header">
            <span class="name">
                <a href="<?php echo get_author_posts_url( $user->ID); ?>">
                    <?php echo $user->last_name . ' ' . $user->first_name; ?>
                </a>
            </span>
            <span class="position"><?php echo $user->position ?></span>
        </div>

        <div class="content">

            <div class="description">
                <?php echo $user->user_description; ?>
            </div>

            <div class="footer">

                <div class="skills">
                    <?php $skills = get_user_meta( $user->ID, 'skills');
                    if ( !empty( $skills ) ) {
                        foreach ( $skills as $skill ) { ?>
                            <span class="skill">
                                <a href="<?php echo get_term_link( (int) $skill['term_id'], 'skill' ); ?>">
                                    <?php echo $skill['name']; ?>
                                </a>
                            </span>
                        <?php }
                    }
                    ?>
                </div>

                <div>
                    <?php  if ( current_user_can( 'edit_users') ) {
                        echo nice_svg( ['id' => 'cog', 'size' => 'small', 'click_able' => true ] );
                    } ?>
                </div>

            </div>

        </div>

    </div>

</div>
