console.log('wp_staff loaded...');

import { ValidateField } from './fields.js';

export function WPMediaForFields() {

    jQuery(document).on( 'click', '.MediaFieldButton', function (e) {

        let button = jQuery( this );
        let media_field = button.siblings('.MediaField');

        e.preventDefault();
        let media_frame = wp.media({
            title: 'Выбрать картинку',
            multiple : false,
            library : {
                type : 'image',
            }
        });

        media_frame.on( 'close', function() {
            let selection =  media_frame.state().get('selection');
            selection.each( function( attachment ) {
                media_field.html(attachment['attributes']['url']);
                if ( media_field.attr('data-validation') ) {
                    ValidateField({
                        'field': media_field,
                        'type': media_field.attr('data-validation')
                    });
                }
            });
        });

        media_frame.open();

    });

}