<?php ?>

<div class="nice_settings SettingsContainer">

    <div class="settings_header">

        <div class="settings_title">
            Theme Settings
        </div>

        <div class="settings_buttons">

            <div class="ExpandAllTabsBlocks">
                <span class="nice_svg medium"><svg><use href="#angle-double-down"></use></svg></span>
                <span class="ExpandSettings">Expand All</span>
            </div>

            <div class="CollapseAllTabsBloocks">
                <span class="nice_svg medium"><svg><use href="#angle-double-up"></use></svg></span>
                <span class="CollapseSettings">Collapse All</span>
            </div>

            <div class="UpdateSettings">
                <span class="nice_svg medium"><svg><use href="#check"></use></svg></span>
                <span class="settings__update_text">Save Settings</span>
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

            <div class="tabs_wrapper">

                <div class="tabs_content MenuContent current" data-tab="site">

                    <?php include('site_settings.php') ?>

                </div>

                <div class="tabs_content MenuContent" data-tab="header">

                    <?php include('header_settings.php') ?>

                </div>

            </div>

        </div>

    </div>

</div>