console.log('blog.js loaded...');

jQuery(document).ready(function () {

    jQuery(document).on('click', '.ToggleSpoiler', function () {
        jQuery(this).parents('.Spoiler').toggleClass('open');
        if ( !jQuery(this).parents('.Spoiler').hasClass('open') ) {
            jQuery(this).parents('.Spoiler')[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

});