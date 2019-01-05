console.log('settings.js loaded...');

function ToggleCollapseSettingsMenu( elem ) {
	jQuery(elem).parent('.SettingsNavigation').toggleClass('collapsed');
}