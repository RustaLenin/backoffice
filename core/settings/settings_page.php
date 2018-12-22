<?php

Class THEME_SETTINGS_PAGE {

	public static function construct() {

		wp_enqueue_media();

		$settings = get_option( THEME_SETTINGS::$settings_name );

		?>

		<div class="itf_settings SettingsMenu">

			<div class="itf_settings__menu">

				<div class="itf_settings__menu_item MenuTab current" data-tab="site">
                    <span class="icon_svg_container large">
                        <svg><use xlink:href="#cogs"></use></svg>
                    </span>
					<span class="itf_settings__item_name">
                         Site Settings
                    </span>
				</div>

				<div class="itf_settings__menu_item MenuTab" data-tab="header">
                    <span class="icon_svg_container large">
                        <svg><use xlink:href="#palette"></use></svg>
                    </span>
					<span class="itf_settings__item_name">
                        Header Settings
                     </span>
				</div>

				<div class="itf_menu_toggle ToggleArrowOnClick">
                    <span class="icon_svg_container large">
                        <svg><use xlink:href="#chevron-circle-left"></use></svg>
                    </span>
				</div>
			</div>

			<!------------------------------------header-menu-line--------------------------------->


			<div class="itf_settings__line">
				<div class="itf_settings__line_item ExpandOnClick">
					<span class="icon_svg_container large"><svg><use href="#angle-double-down"></use></svg> </span>
					<span class="ExpandSettings">Expand All</span>
				</div>
				<div class="itf_settings__line_item CollapseOnClick">
					<span class="icon_svg_container large"><svg><use href="#angle-double-up"></use></svg></span>
					<span class="CollapseSettings">Collapse All</span>
				</div>
				<div class="itf_settings__update UpdateSettings">
					<span class="icon_svg_container small"><svg><use href="#check"></use></svg></span>
					<span class="itf_settings__update_text">Save Settings</span>
				</div>
			</div>

			<!------------------------------------content--------------------------------->
			<div class="itf_settings__tabs_wrapper">

				<div class="itf_settings__tabs_content MenuContent current" data-tab="site">

					<?php include( 'templates/site_settings.php' ) ?>

				</div>

				<div class="itf_settings__tabs_content MenuContent" data-tab="header">

					<?php include( 'templates/header_settings.php' ) ?>

				</div>

			</div>
		</div>

		<?php
	}

	public static function js() {
		wp_enqueue_script( 'theme_settings_js', get_template_directory_uri() . '/core/settings/js/settings.js' );
	}

	public static function css() {
		wp_enqueue_style( 'theme_settings_css', get_template_directory_uri() . '/core/settings/css/settings.css' );
	}

	public static function templates() { ?>

<!--		<script id="send_to" type="text/ejs-template">-->
<!--			--><?php //include( 'templates/send_to.ejs' ); ?>
<!--		</script>-->

		<?php
	}

}