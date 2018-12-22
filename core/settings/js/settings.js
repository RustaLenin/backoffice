console.log('settings.js loaded...');

jQuery(document).ready( function ($) {

	clear_editable();
	media_for_field();
	itff_interface();

	custom_tabs({
		'parent': '.SettingsMenu',
		'name': '.MenuTab',
		'content': '.MenuContent'
	});

	custom_slide({
		'parent': '.SettingsPart',
		'name': '.SlideOnClick',
		'content': '.SlideContainer'
	});

	close_all({
		'name': '.CollapseOnClick',
		'content': '.SlideContainer, .SlideOnClick'
	});
	open_all({
		'name': '.ExpandOnClick',
		'content': '.SlideContainer, .SlideOnClick'
	});

	jQuery( document ).on( 'click', '.ToggleArrowOnClick', function () {
		jQuery( this ).parents('.itf_settings__menu').toggleClass('open');
	});

	jQuery( document ).on( 'click', '.UpdateSettings', function () {

		var theme_settings = prepare_data('.ThemeSettingField');

		var sending_data = {
			'action': 'theme_settings',
			'command': 'update',
			'settings_data': theme_settings
		};
		ajax_send( sending_data ).then( function ( answer ) {

		});
	});

});