'use strict';

import { Modal, CloseModal } from '../../../assets/js/render.js';
import { ClearEditableInArea, RunFieldsValidate, HandleFieldsValidate } from '../../../assets/js/fields.js';
import { HandleFormValidate, ValidateForm } from '../../../assets/js/forms.js';
import { CollectValidData, AjaxSend } from '../../../assets/js/data.js';
import { HandlePickers } from '../../../assets/js/pickers.js';

console.log( 'services.js loaded...' );

jQuery(document).ready( function () {

    jQuery(document).on( 'click', '.AddService', function () {

        let modal = {};
        modal['command'] = 'add';
        Modal({
            'modal'   : modal,
            'template': 'service_modal'
        });
        ClearEditableInArea('.Modal');
        HandleFieldsValidate('.ModalField');
        HandleFormValidate({
            'form': '.Modal',
            'fields': '.ModalField',
            'button': '.SubmitAddService'
        });
        HandlePickers({
            'area': '.Modal',
            'fields': '.DatePicker'
        });

    });

    jQuery(document).on ( 'click', '.EditService',  function () {
       let ServiceID = jQuery( this ).parents('.ServiceRow').attr('data-id');
       let RequestData = {
           'action': 'bo_services',
           'command': 'get_data',
           'payload': {
               'ID': ServiceID
           }
       };
       AjaxSend( RequestData ).then( function ( answer ) {
           if ( answer['result'] === 'success' ) {
               let modal = {};
               modal['command'] = 'update';
               modal['data'] = answer['payload'];
               Modal({
                   'modal'   : modal,
                   'template': 'service_modal'
               });
               ClearEditableInArea('.Modal');
               RunFieldsValidate('.ModalField');
               HandleFieldsValidate('.ModalField');
               HandlePickers({
                   'area': '.Modal',
                   'fields': '.DatePicker'
               });
               HandleFormValidate({
                   'form': '.Modal',
                   'fields': '.ModalField',
                   'button': '.SubmitUpdateService'
               });
               RunFieldsValidate('.ModalField');
               ValidateForm({
                   'form': '.Modal',
                   'fields': '.ModalField',
                   'button': '.SubmitEditService',
               });
           }
       })
    });

    jQuery(document).on( 'click', '.SubmitAddService', function () {
        ValidateForm({
            'form': '.Modal',
            'fields': '.ModalField',
            'button': '.SubmitAddService',
            'ThisElement': jQuery(this),
        });
        if ( !jQuery(this).hasClass('disabled') ) {
            let modal = {};
            modal['command'] = 'update';
            let ServiceData = CollectValidData('.ModalInput');
            let RequestData = {
                'action': 'bo_services',
                'command': 'add',
                'payload': ServiceData
            };
            AjaxSend( RequestData ).then( function (answer) {
                if ( answer['result'] === 'success' ) {
                    CloseModal();
                    if ( answer['payload']['html'] ) {
                        jQuery('.ServicesTableList').prepend( answer['payload']['html'] );
                    }
                }
            });
        }
    });

    jQuery(document).on( 'click', '.SubmitUpdateService', function () {
        ValidateForm({
            'form': '.Modal',
            'fields': '.ModalField',
            'button': '.SubmitEditService',
            'ThisElement': jQuery(this),
        });
        if ( !jQuery(this).hasClass('disabled') ) {

            let ServiceID = jQuery(this).attr('data-id');
            if ( ServiceID ) {
                let modal = {};
                modal['command'] = 'update';
                let ServiceData = CollectValidData('.ModalInput');
                ServiceData['ID'] = ServiceID;
                let RequestData = {
                    'action': 'bo_services',
                    'command': 'update',
                    'payload': ServiceData
                };
                AjaxSend( RequestData ).then( function (answer) {
                    if ( answer['result'] === 'success' ) {
                        CloseModal();
                        if ( answer['payload']['html'] ) {
                            let UpdatedService = jQuery('.ServicesTableList').find('.ServiceRow[data-id="' + answer['payload']['ID'] +'"]');
                            UpdatedService.replaceWith( answer['payload']['html'] );
                        }
                    }
                });
            }
        }
    });

});

