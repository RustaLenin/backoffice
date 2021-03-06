<?php

class THEME_ADMIN_MENU {

    public static function construct() {

        // After plugin's page created, page suffix will writen to var 'some_page_suffix'.
        // It needs to connect scripts and styles ONLY on plugin pages!!!
        // Other Pages will have no this plugins scrips and styles and wll work FAST.

        $settings_suffix = add_menu_page(
            'BackOffice',
            'BackOffice',
            8,
            'backoffice_admin_menu.php',
            array ( 'THEME_SETTINGS_PAGE', 'construct' ),
            'dashicons-palmtree',
            45, 5 );

        $suffixes = array(
            $settings_suffix,
        );

        foreach ( $suffixes as $suffix ) {
            if ( class_exists('NICE_FIELDS') ) {
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_FIELDS', 'wp_enqueue') );
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_TEMPLATES', 'wp_enqueue') );
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_SVG', 'simple_import') );
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_BUTTONS', 'wp_enqueue') );
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_NOTIFICATIONS', 'wp_enqueue') );
                add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_SETTINGS', 'wp_enqueue') );
            }

            add_action( 'admin_print_footer_scripts-' . $suffix, array( 'NICE_FIELD', 'wp_enqueue') );
        }

        /** Settings page **/
        add_action( 'admin_print_footer_scripts-' . $settings_suffix, array( 'THEME_SETTINGS_PAGE', 'js') );
	    add_action( 'admin_print_footer_scripts-' . $settings_suffix, array( 'THEME_SETTINGS_PAGE', 'css') );


    }

}

add_action( 'admin_menu', array ( 'THEME_ADMIN_MENU', 'construct' ) );