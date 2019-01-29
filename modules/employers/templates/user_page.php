<?php

$user = get_user_by( 'ID', $author );
$user_position = get_user_meta($user->ID, 'position', true );
if ( !$user_position ) { $user_position = 'Worker'; }

?>

<div class="user_page UserPage">

    <div class="info_panel">

        <div class="avatar">
            <img src="<?php if ( $user->avatar ) { echo $user->avatar['guid']; } else { echo get_template_directory_uri() . 'assets/img/avatar.png'; } ?>" >
        </div>

        <span class="name">
            <?php echo $user->last_name . ' ' . $user->first_name; ?>
        </span>

        <span class="position"><?php echo $user_position; ?></span>

        <div class="tabs_container">

            <?php
            $tabs = [
                '0' => [
                    'slug' => 'profile',
                    'label' => 'Profile',
                    'icon' => 'user',
                    'if_logged_in' => false,
                    'if_manage_users' => false,
                    'current' => true,
                ],
                '1' => [
                    'slug' => 'blog',
                    'label' => 'Blog',
                    'icon' => 'article',
                    'if_logged_in' => false,
                    'if_manage_users' => false,
                    'current' => false,
                ],
                '2' => [
                    'slug' => 'docs',
                    'label' => 'Documents',
                    'icon' => 'images',
                    'if_logged_in' => true,
                    'if_manage_users' => true,
                    'current' => false,
                ],
                '3' => [
                    'slug' => 'images',
                    'label' => 'Images',
                    'icon' => 'images',
                    'if_logged_in' => true,
                    'if_manage_users' => true,
                    'current' => false,
                ],
                '4' => [
                    'slug' => '',
                    'label' => '',
                    'icon' => '',
                    'if_logged_in' => '',
                    'if_manage_users' => '',
                    'current' => false,
                ],
            ];
            foreach ( $tabs as $tab ) {

                if ( $tab['slug'] ) {
                    if ( $tab['if_manage_users'] ) {
                        if ( current_user_can('edit_users') ) {
                            include('tab_item.php');
                        }
                    } else if ( !$tab['if_manage_users'] && $tab['if_logged_in']) {
                        if ( is_user_logged_in() ) {
                            include('tab_item.php');
                        }
                    } else if ( !$tab['if_manage_users'] && !$tab['if_logged_in']) {
                        include('tab_item.php');
                    }
                }

            }
            ?>

        </div>

    </div>

    <div class="user_page__content">

        <div class="tabs_content">

            <?php foreach ( $tabs as $tab ) {

                if ($tab['slug']) {?>
                <div class="tab TabItem <?php if($tab['current'] ) { echo 'current'; } ?>" data-tab="<?php echo $tab['slug']; ?>">

                    <?php

                        if ($tab['if_manage_users']) {
                            if (current_user_can('edit_users')) {
                                include('tabs/' . $tab['slug'] . '.php');
                            }
                        } else if (!$tab['if_manage_users'] && $tab['if_logged_in']) {
                            if (is_user_logged_in()) {
                                include('tabs/' . $tab['slug'] . '.php');
                            }
                        } else if (!$tab['if_manage_users'] && !$tab['if_logged_in']) {
                            include('tabs/' . $tab['slug'] . '.php');
                        }

                    ?>

                </div>
            <?php }

            }?>

        </div>

    </div>

</div>
