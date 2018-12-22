'use strict';

console.log('pikers.js loaded...');

export function HandleDatePicker( props ) {

    let fields = jQuery( props['area'] ).find( props['fields'] );
    fields.each(function () {
        jQuery( this ).datepicker();
    });

}

export function HandleColorPicker( props ) {

}

export function HandlePickers( props ) {

    if ( typeof props           === 'undefined' ) { props           = {}; }
    if ( typeof props['area']   === 'undefined' ) { props['area']   = document; }
    if ( typeof props['fields'] === 'undefined' ) { props['fields'] = '.DatePicker'; }

    HandleDatePicker( props );
    HandleColorPicker( props );
}