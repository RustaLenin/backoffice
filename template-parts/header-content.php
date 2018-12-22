<?php ?>

    <div class="left_panel LeftPanel">

        <div class="logo">
            <a href="<?php echo get_bloginfo('url'); ?>">
                <span class="full_logo"><svg><use href="#full_logo"></use></svg></span>
                <span class="collapsed_logo"><svg><use href="#small_logo"></use></svg></span>
            </a>
            <span class="mobile_menu_button ToggleMobileMenu"><svg><use href="#burger"></use></svg></span>
            <span class="mobile_user_button ToggleMobileUser"><svg><use href="#user"></use></svg></span>
        </div>

        <?php
        if ( is_user_logged_in() ) {
            include('header/user.php');
        } else {
            include('header/auth.php');
        }
        include('header/menu.php');
        ?>

    </div>