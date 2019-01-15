<?php

/**
 * Ingot - Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BackOffice
 */

/**
 * Define Constants
 **/

define( 'THEME_DIR', dirname( __FILE__ )                              );
define( 'THEME_ADM', dirname( __FILE__ ) . '/admin/'                  );
define( 'THEME_COR', dirname( __FILE__ ) . '/core/'                   );
define( 'THEME_MOD', dirname( __FILE__ ) . '/modules/'                );
define( 'THEME_COM', dirname( __FILE__ ) . '/components/'             );
define( 'THEME_ASS', dirname( __FILE__ ) . '/assets/'	                );
define( 'THEME_CSS', dirname( __FILE__ ) . '/assets/css/'             );
define( 'THEME_JS',  dirname( __FILE__ ) . '/assets/js/'              );
define( 'THEME_TMP', dirname( __FILE__ ) . '/template-parts'          );

/**
 * Admin Parts and pages
 **/

require_once( THEME_COR . 'setup.php' );


/**
 * WP Media for FrontEnd
 */

require_once( THEME_COR . 'front_media.php' );

/**
 * Admin Menu
 **/

require_once( 'admin/menu.php' );

/**
 * Theme Settings
 **/

require_once( 'modules/settings/settings.php' );
require_once( 'modules/settings/settings_page.php' );

/**
 * Include files if module is supported
 **/

require_once( THEME_MOD . 'kama_breadcrumbs.php' );
require_once( THEME_MOD . 'quick_tags.php' );
require_once( THEME_MOD . 'dereg.php' );
require_once( THEME_COR . 'filters/disable_admin_notify.php' );
require_once( THEME_COR . 'filters/content.php' );

/**
 * BackEnd for BO
 */

require_once( THEME_MOD . 'services/services.php' );
require_once( THEME_MOD . 'user/user.php' );

@ini_set( 'upload_max_size' , '500M' );

$path = get_template_directory_uri();