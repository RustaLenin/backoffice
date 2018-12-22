import { Notify } from './render.js'

console.log('data.js loaded...');

/**
 * Send some data via AJAX and get promise
 *
 * @param {object} data - Data we sending
 * @param {boolean} silent - Should we render notification
 * @param {string} url  - url for request
 *
 * After we receive an answer we can show auto notification
 * Answer from server must be in JSON
 * If we will not set url, function will search global var ajaxurl
 * If no such var, it will take hostname of current site, like
 * http://example.com from page http://example.com/blog/article
 *
 */
export function AjaxSend( data, silent = true, url ) {

    /** Look Description about url in head **/
    if ( typeof url === 'undefined' )    {
        if ( typeof ajaxurl !== 'undefined' ) {
            url = ajaxurl
        } else {
            url = location.protocol + '//' + location.hostname;
        }
    }

    /** You can read about Promises here -
     * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise
     **/
    return new Promise( function ( resolve, reject ) {

        jQuery.post( url, data, function( response ) {         // Send request and receive response

            let answer = jQuery.parseJSON( response );         // Response must be in JSON, so we parse it to JS

            if ( !answer ) {

                answer = {                                     // Anyway we must return answer for promise, so we prepare answer if it's missing
                    'result': 'error',
                    'message': 'No response from server',
                    'payload': {}
                };

                if ( !silent ) {                               // Show notification if not silent
                    Notify({
                        'type':  answer['result'],
                        'message': answer['message']
                    });
                }
                reject( answer );                              // return answer to promise
            } else {

                if ( !silent ) {                               // Show notification if not silent
                    Notify({
                        'type':  answer['result'],
                        'message': answer['message']
                    });
                }
                resolve( answer );                             // return answer to promise
            }
            console.log(answer);
        });
    });
}

/**
 * Prepare data from all elements with special class selector
 * @param {string} selector - css selector
 */
export function CollectData( selector ) {

    let data = {}; // Prepare empty object for data

    if ( typeof selector === 'undefined' ) { return data }       // Return empty object if no selector received

    jQuery( selector ).each(function() {                         // Start iterating all fields

        let data_name, data_value;

        /** This part for getting values and store it in object for vanilla inputs**/
        if ( jQuery(this).is('input') ) {
            if (
                jQuery( this ).attr('type') === 'text'   ||      // Certainly we need to add more types here later
                jQuery( this ).attr('type') === 'email'  ||
                jQuery( this ).attr('type') === 'number' ||
                jQuery( this ).attr('type') === 'tel'    ||
                jQuery( this ).attr('type') === 'url'
            ) {
                data_name = jQuery(this).attr('name');           // Take key from input name attribute
                data_value  = jQuery(this).val();                // Take val from input
            } else if (
                jQuery( this ).attr('type') === 'checkbox' ||
                jQuery( this ).attr('type') === 'radio'
            ) {
                if ( jQuery(this).is(':checked') ) {             // Take value only if checked
                    data_name = jQuery( this ).attr('name');     // Take key from input name attribute
                    data_value  = jQuery( this ).val();          // Take val from input
                }
            }

        }

        /** This part is for textarea **/
        else if ( jQuery(this).is("textarea") ) {
            data_name = jQuery( this ).attr('name');             // Take key from textarea name attribute
            data_value  = jQuery( this ).val();                  // Take value from textarea

        }

        /** This part is for NiceFields based on contenteditable="true" elements with data attributes **/
        else {

            let data_type = jQuery( this ).attr('data-type');     // Take field type

            if (                                                  // This types store value in data attribute
                data_type === 'select' ||
                data_type === 'checkbox' ||
                data_type === 'bool'
            ) {
                data_name = jQuery( this ).attr('data-name');     // Take key from field data-name attribute
                data_value  = jQuery( this ).attr('data-value');  // Take val from field data-value attribute
            }

            else if ( data_type === 'text' ) {                    // This type store data in the html
                data_name = jQuery( this ).attr('data-name');
                data_value  = jQuery( this ).html();
            }

            else if ( data_type === 'single_check') {             // This type data must be taken only if checked
                if ( jQuery( this ).hasClass('checked') ) {
                    data_name = jQuery( this ).attr('data-name');
                    data_value  = jQuery( this ).attr('data-value');
                }
            }
        }

        /** At this moment we have key => value pair, what we store in object **/
        data[data_name] = data_value;

    });
    return data;
}

/**
 * Prepare data from all elements with special class selector if fields a valid
 * @param {string} selector - css selector
 */
export function CollectValidData( selector ) {

    let data = {};

    jQuery( selector ).each(function() {

        let container = jQuery( this ).parents('.NiceField');

        if ( container.hasClass('success') ) {

            let data_name, data_value;

            /** This part for getting values and store it in object for vanilla inputs**/
            if ( jQuery(this).is('input') ) {
                if (
                    jQuery( this ).attr('type') === 'text'   ||      // Certainly we need to add more types here later
                    jQuery( this ).attr('type') === 'email'  ||
                    jQuery( this ).attr('type') === 'number' ||
                    jQuery( this ).attr('type') === 'tel'    ||
                    jQuery( this ).attr('type') === 'url'
                ) {
                    data_name = jQuery(this).attr('name');           // Take key from input name attribute
                    data_value  = jQuery(this).val();                // Take val from input
                } else if (
                    jQuery( this ).attr('type') === 'checkbox' ||
                    jQuery( this ).attr('type') === 'radio'
                ) {
                    if ( jQuery(this).is(':checked') ) {             // Take value only if checked
                        data_name = jQuery( this ).attr('name');     // Take key from input name attribute
                        data_value  = jQuery( this ).val();          // Take val from input
                    }
                }

            }

            /** This part is for textarea **/
            else if ( jQuery(this).is("textarea") ) {
                data_name = jQuery( this ).attr('name');             // Take key from textarea name attribute
                data_value  = jQuery( this ).val();                  // Take value from textarea

            }

            /** This part is for NiceFields based on contenteditable="true" elements with data attributes **/
            else {

                let data_type = jQuery( this ).attr('data-type');     // Take field type

                if (                                                  // This types store value in data attribute
                    data_type === 'select' ||
                    data_type === 'checkbox' ||
                    data_type === 'bool'
                ) {
                    data_name = jQuery( this ).attr('data-name');     // Take key from field data-name attribute
                    data_value  = jQuery( this ).attr('data-value');  // Take val from field data-value attribute
                }

                else if ( data_type === 'text' ) {                    // This type store data in the html
                    data_name = jQuery( this ).attr('data-name');
                    data_value  = jQuery( this ).html();
                }

                else if ( data_type === 'single_check') {             // This type data must be taken only if checked
                    if ( jQuery( this ).hasClass('checked') ) {
                        data_name = jQuery( this ).attr('data-name');
                        data_value  = jQuery( this ).attr('data-value');
                    }
                }
            }

            /** At this moment we have key => value pair, what we store in object **/
            data[data_name] = data_value;

        }

    });
    return data;
}