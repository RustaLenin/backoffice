<?php

Class THEME_SETTINGS_PAGE {

	public static function construct() {

		wp_enqueue_media();
        include ( THEME_TMP . '/svg/sprite.php');
        include ( THEME_CSS . '/vars.php');

		$settings = get_option( THEME_SETTINGS::$settings_name );

        include('templates/settings_body.php');
	}

	public static function js() {
		wp_enqueue_script( 'theme_settings_js', get_template_directory_uri() . '/modules/settings/js/settings.js' );
	}

	public static function css() {
		wp_enqueue_style( 'theme_settings_css', get_template_directory_uri() . '/modules/settings/css/settings.css' );
	}

	public static function templates() { ?>

<!--		<script id="send_to" type="text/ejs-template">-->
<!--			--><?php //include( 'templates/send_to.ejs' ); ?>
<!--		</script>-->

		<?php
	}

}