import { Debounce } from './logic.js'

console.log('forms.js loaded...');

let delayValidateForm = Debounce( ValidateForm, 1500 );
let littleDelayValidateForm = Debounce( ValidateForm, 300 );

export function ValidateForm( Selectors ) {

    let form;
    if ( typeof Selectors.ThisElement !== 'undefined' ) {
        form = Selectors.ThisElement.parents( Selectors.form );
    } else {
        form = jQuery( Selectors.form );
    }

    let button = form.find( Selectors.button );
    let fields = form.find( Selectors.fields );

    let amount_required = 0;

    fields.each(function ( ) {
        let required = jQuery(this).find('.input').attr('data-required');
        if ( required === 'true' ) {
            amount_required++
        }
    });

    if ( amount_required >= 1 ) {

        button.addClass('disabled');
        let amount_valid = 0;

        fields.each(function ( ) {

            let required = jQuery(this).find('.input').attr('data-required');
            if ( required !== 'false' ) {
                if ( jQuery(this).hasClass('success') ) {
                    amount_valid++
                }
            }

        });

        if ( amount_required === amount_valid ) {
            button.removeClass('disabled');
        } else {
            button.addClass('disabled');
        }

    }

}

export function HandleFormValidate( Selectors ) {

    let form = jQuery( Selectors.form );
    let fields = form.find( Selectors.fields );

    fields.each( function () {

        let ThisElement = jQuery( this );
        Selectors.ThisElement = ThisElement;

        ThisElement.on( 'input', function () {
            delayValidateForm( Selectors );
        });

        ThisElement.on( 'change', function () {
            delayValidateForm( Selectors );
        });

        ThisElement.on( 'DOMSubtreeModified', function () {
            delayValidateForm( Selectors );
        });

        ThisElement.on( 'focusin', function () {
            delayValidateForm( Selectors );
        });

        ThisElement.on( 'focusout', function () {
            littleDelayValidateForm( Selectors );
        });
    });

}