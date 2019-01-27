<?php ?>

<div class="nice_settings SettingsContainer">

    <div class="settings_header">

        <div class="settings_title">
            Theme Settings
        </div>

        <div class="settings_buttons">

            <div class="nice_button regular small ExpandAllTabsBlocks" onclick="ExpandAllTabsBlocks(this)">
                <span class="nice_svg tiny"><svg><use href="#double_arrow_down"></use></svg></span>
                <span class="text">Expand All</span>
            </div>

            <div class="nice_button regular small CollapseAllTabsBloocks" onclick="CollapseAllTabsBlocks(this)">
                <span class="nice_svg tiny"><svg><use href="#double_arrow_down"></use></svg></span>
                <span class="text">Collapse All</span>
            </div>

            <div class="nice_submit accent small UpdateSettings">
                <span class="nice_svg small"><svg><use href="#check"></use></svg></span>
                <span class="text">Save Settings</span>
            </div>

        </div>

    </div>

    <div class="settings_body">

        <div class="settings_navigation SettingsNavigation">

            <div class="tabs_head">
                <?php
                $settings_model = array(
                    0 => array(
                        'slug'    => 'site',
                        'title'   => 'Настройки Сайта',
                        'icon'    => 'calendar',
                        'current' => true
                    ),
                    1 => array(
                        'slug'  => 'header',
                        'title' => 'Настройки шапки',
                        'icon'  => 'link',
                        'current' => false
                    ),
                    2 => array(
                        'slug'  => 'footer',
                        'title' => 'Настройки футера',
                        'icon' => 'edit',
                        'current' => false
                    ),
                );
                foreach ( $settings_model as $tab_id => $setting_tab ) {
                    echo nice_setting_nav_element( $setting_tab );
                } ?>
            </div>

            <div class="menu_toggle" onclick="ToggleCollapseSettingsMenu(this)">
                <span class="nice_svg medium">
                    <svg><use href="#arrow_down"></use></svg>
                </span>
                <span class="text">Свернуть</span>
            </div>

        </div>

        <div class="settings_content">

            <div class="tabs_content TabsContent current" data-tab="site">

                <?php include('site_settings.php') ?>

            </div>

            <div class="tabs_content TabsContent" data-tab="header">

                <?php include('header_settings.php') ?>

            </div>

        </div>

    </div>

</div>