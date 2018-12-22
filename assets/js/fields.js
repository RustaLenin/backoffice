import { Debounce } from './logic.js'

console.log('fields.js loaded...');

window.validateTypes = {
    'email':    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    'login':    /^[-a-zA-Z0-9]+$/,
    'currency': /^[A-Z]{3,6}$/,
    'int':      /^[0-9]*$/,
    'ddmmyyyy': /^([0-3][0-9])[\.\-\\\/]([0-1][0-9])[\.\-\\\/]([0-9]{2,4})$/,
    'mmddyyyy': /^([0-1][0-9])[\.\-\\\/]([0-3][0-9])[\.\-\\\/]([0-9]{2,4})$/,
    'hex':      /^(#)[0-9a-fA-F]{6,8}$/,
    'url':      /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-z]{1,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/,
    'img_url':  /^(http)?s?:?(\/\/[^"']*\.(?:png|jpg|jpeg|gif|png|svg))$/,
    'phone':    /^[-0-9()+]*$/
};

window.validateFunc = {
    'isValidEmail': isValidEmail,
    'isValidLogin': isValidLogin,
    'isNotEmpty':   isNotEmpty,
    'isInt':        isInt,
    'isDate':       isDate,
    'isHex':        isHex,
    'isUrl':        isUrl,
    'isImgUrl':     isImgUrl,
    'isCurrency':   isCurrency,
    'isPhone':      isPhone
};

let delayValidateField = Debounce( ValidateField, 1200 );

function isCurrency( val ) {
    return validateTypes['currency'].test( val );
}

function isImgUrl( val ) {
    return validateTypes['img_url'].test( val );
}

function isUrl( val ) {
    return validateTypes['url'].test( val );
}

function isHex( val ) {
    return validateTypes['hex'].test( val );
}

function isDate( val ) {

    let isDmy = validateTypes['ddmmyyyy'].test( val );
    let isMdy = validateTypes['mmddyyyy'].test( val );

    if ( isDmy || isMdy ) {

        let first_part = parseInt( val.substring( 0, 2 ) );
        let second_part = parseInt( val.substring( 3, 5 ) );


        if ( isDmy ) {

            return ( first_part < 32 && second_part < 13 )

        }

        if ( isMdy ) {
            return ( first_part < 13 && second_part < 32 )
        }


    } else {
        return false
    }
}

function isInt( val ) {
    if ( val.length > 0 ) {
        return validateTypes['int'].test( val );
    } else {
        return false
    }

}

function isPhone( val ) {
    if ( val.length > 0 ) {
        return validateTypes['phone'].test( val );
    } else {
        return false
    }
}

function isValidEmail( val ) {
    return validateTypes['email'].test( val );
}

function isValidLogin( val ) {

    if ( val.length > 1 ) {
        return validateTypes['login'].test( val );
    } else {
        return false;
    }

}

function isNotEmpty( val ) {

    if ( typeof val === 'undefined' ) {
        return false
    } else {
         return val.length > 1;
    }

}

export function ValidateField( Validate ) {

    let container = Validate.field.parents('.NiceField');
    container.removeClass('error success');

    let value;
    if ( Validate.field.is( 'input') ) {
        value = Validate.field.val();
    } else {
        value = Validate.field.html();
    }

    let fn = validateFunc[Validate['type']];

    if ( typeof  fn !== 'function' ) {
        console.log('No such validation function');
    } else {

        let ValidateResult = fn( value );

        if ( ValidateResult ) {
            container.addClass('success');
        } else {
            container.addClass('error');
        }

    }

}

export function HandleFieldsValidate( selector ) {

    let input = jQuery( selector ).find('.input');

    input.each( function () {

        let ThisField = jQuery( this );
        let ValidType = ThisField .attr('data-validation');

        if ( ValidType && ValidType !== 'false' ) {

            ThisField.on( 'input', function () {
                ThisField.parents('.NiceField').removeClass('error');
                delayValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
            });

            ThisField.on( 'change', function () {
                ThisField.parents('.NiceField').removeClass('error');
                delayValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
            });

            ThisField.on( 'DOMSubtreeModified', function () {
                delayValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
            });

            ThisField.on( 'focusin', function () {
                delayValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
            });

            ThisField.on( 'focusout', function () {
                ValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
                setTimeout( function () {
                    ThisField.parents('.NiceField').removeClass('error');
                }, 1000 )
            });

            ThisField.on( 'paste', function () {
                ValidateField({
                    'field': ThisField,
                    'type': ValidType
                });
                setTimeout( function () {
                    ThisField.parents('.NiceField').removeClass('error');
                }, 1000 )
            });

        }
    });

}

export function RunFieldsValidate( selector ) {

    let input = jQuery( selector ).find('.input');

    input.each( function () {

        let ThisField = jQuery( this );
        let ValidType = ThisField .attr('data-validation');

        if ( ValidType && ValidType !== 'false' ) {

            ValidateField({
                'field': ThisField,
                'type': ValidType
            });
        }
    });

}

export function ClearEditable() {
    jQuery('*[contenteditable]').on('paste',function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        let plain_text = (e.originalEvent || e).clipboardData.getData('text/plain');
        if(typeof plain_text!=='undefined'){
            document.execCommand('insertText', false, plain_text);
        }
    });
}

export function ClearEditableInArea( area ) {

    let fileds = jQuery(area).find('[contenteditable]');
    fileds.on('paste',function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        let plain_text = (e.originalEvent || e).clipboardData.getData('text/plain');
        if(typeof plain_text!=='undefined'){
            document.execCommand('insertText', false, plain_text);
        }
    });

}