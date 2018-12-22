<?php

/**
 * Theme custom QuickTags
 * In this file all functions and action about theme QuickTags
 **/

function THEME_QuickTags() {
    if ( ! wp_script_is('quicktags') )
        return;
    ?>
    <script type="text/javascript">
        QTags.addButton( 'embed_tag', 'embed', '<embed>', '</embed>', 'o', 'Make Embed Tag', 777 );
    </script>

    <script type="text/javascript">
        QTags.addButton( 'spoiler_tag', 'spoiler', '<div class="spoiler Spoiler"><div class="spoiler_head ToggleSpoiler"><span class="spoiler_title">Click for spoiler</span><span class="nice_svg tiny"><svg><use href="#arrow_down"></use></svg></span></div><div class="spoiler_content">', '</div><div class="spoiler_footer click_able ToggleSpoiler"><span class="nice_svg small"><svg><use href="#arrow_down"></use></svg></span></div></div>', 'o', 'Make Embed Tag', 777 );
    </script>
    <?php
}

add_action( 'admin_print_footer_scripts', 'THEME_QuickTags' );