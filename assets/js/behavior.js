console.log('behavior.js loaded...');

/**
 * Custom tabs Function
 * @param { object } tabs with name, content and parent
 * name - selector of tab button you click
 * content - selector what element should appear
 * parent - selector in what area this tab working
 **/
export function CustomTabs ( tabs ) {

    if ( !tabs['parent'] ) { tabs['parent'] = document }

    jQuery( document ).on( 'click', tabs['name'],  function (e) {

        e.stopImmediatePropagation();
        var tab_id = jQuery(this).attr('data-tab');                                       // Get id of tab on which we will switch

        if ( !tab_id ) {
            return
        }

        var this_parent = jQuery(this).parents( tabs['parent'] );                         // Get id of tab on which we will switch

        this_parent.find( tabs['content']).removeClass('current');                        // Remove active class from all tabs
        this_parent.find( tabs['name']).removeClass('current');                           // Remove active class from all tabs

        jQuery( this ).addClass('current');                                               // Add active class to clicked tab
        this_parent.find( tabs['content'] + '[data-tab='+tab_id+']').addClass('current'); // Add active class to needed tab

    });
}

export function ToggleShowText() {

    jQuery(document).on('click', '.ToggleShowText', function () {
        jQuery(this).parents('.NiceField').find('.input').toggleClass('hidetext');
    });

}