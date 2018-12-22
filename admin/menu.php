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

        	if ( class_exists( 'ITFF_INSERT' ) ) {

        		/** SVG Sprite **/
		        add_action( 'admin_head-' . $suffix, array( 'ITFF_INSERT', 'sprite') ); // SVG Sprite

		        /** Modals **/
		        add_action( 'admin_head-' . $suffix, array( 'ITFF_INSERT', 'modal_area') );
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_INSERT', 'modal_templates') );

		        /** Common framework css & js **/
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_INSERT', 'styles') );
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_INSERT', 'scripts') );

		        /** Color Picker Area **/
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_INSERT', 'color_picker_area') );
	        }

	        if ( class_exists( 'ITFF_NOTIFICATION' ) ) {

		        /** Notifications **/
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_NOTIFICATION', 'area') );
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_NOTIFICATION', 'js') );
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_NOTIFICATION', 'css') );
		        add_action( 'admin_print_footer_scripts-' . $suffix, array( 'ITFF_NOTIFICATION', 'templates') );

	        }

        }

        /** Settings page **/
        add_action( 'admin_print_footer_scripts-' . $settings_suffix, array( 'THEME_SETTINGS_PAGE', 'js') );
	    /** Settings page **/
	    add_action( 'admin_print_footer_scripts-' . $settings_suffix, array( 'THEME_SETTINGS_PAGE', 'css') );


    }

}

add_action( 'admin_menu', array ( 'THEME_ADMIN_MENU', 'construct' ) );