'use strict';

import { HandleDocumentInterface } from './interface.js';
import { HandleModal, Notify } from './render.js';
import { ClearEditable, HandleFieldsValidate } from './fields.js';
import { CustomTabs, ToggleShowText } from './behavior.js';
import { HandleFormValidate } from './forms.js';
import { CollectData, AjaxSend } from './data.js';
import { AddOverlay, ClearOverlay } from './components/overlay.js';
import { WPMediaForFields } from './wp_staff.js';

console.log('index.js loaded...');

jQuery(document).ready( function () {

    window.AjaxSend = AjaxSend;

    Nice.insertCssVars( 'notFound' );
    Nice.insertNotifyArea();

    HandleDocumentInterface();
    HandleModal();
    ClearEditable();
    WPMediaForFields();

    CustomTabs({
        'parent': '.AuthCont',
        'name': '.AuthTab',
        'content': '.AuthForms'
    });

    ToggleShowText();

    HandleFieldsValidate('.NiceField');
    HandleFormValidate({
        'form': '.SignUpForm',
        'fields': '.NiceField',
        'button': '.SubmitSignUp',
    });
    HandleFormValidate({
        'form': '.SignInForm',
        'fields': '.NiceField',
        'button': '.SubmitSignIn',
    });

    jQuery('.CollapseMenu').on('click', function () {
       jQuery('.LeftPanel').toggleClass('collapsed');
    });

    jQuery('.SubmitSignUp').on('click', function () {
       if ( jQuery(this).hasClass('disabled') ) {
           Notify({
               'type':     'warning',
               'title':    'Disabled',
               'message':  'All fields must be valid'
           });
       } else {

           let AuthCont = jQuery(this).parents('.AuthCont');
           AddOverlay( AuthCont, {
               'loader': true,
               'with_message': false,
               'close_able': false
           });

           let SignUpData = CollectData('.SignUpField');
           let RequestData = {
               'action': 'theme_user',
               'command': 'sign_up',
               'payload': SignUpData
           };
           AjaxSend( RequestData ).then( function ( answer ) {
               ClearOverlay( AuthCont );
               AddOverlay( AuthCont, {
                   'loader': false,
                   'with_message': true,
                   'close_able': true,
                   'message_type': answer['result'],
                   'title': 'Response',
                   'message': answer['message']
               });
           });
       }
    });

    jQuery('.SubmitSignIn').on('click', function () {
        if ( jQuery(this).hasClass('disabled') ) {
            Notify({
                'type':     'warning',
                'title':    'Disabled',
                'message':  'All fields must be valid'
            });
        } else {

            let AuthCont = jQuery(this).parents('.AuthCont');
            AddOverlay( AuthCont, {
                'loader': true,
                'with_message': false,
                'close_able': false
            });

            let SignInData = CollectData('.SignInField');
            let RequestData = {
                'action': 'theme_user',
                'command': 'sign_in',
                'payload': SignInData
            };
            AjaxSend( RequestData ).then( function ( answer ) {
                ClearOverlay( AuthCont );
                if ( answer['result'] === 'success' ) {
                    location.reload();
                } else {
                    AddOverlay( AuthCont, {
                        'loader': false,
                        'with_message': true,
                        'close_able': true,
                        'message_type': answer['result'],
                        'title': 'Response',
                        'message': answer['message']
                    });
                }
            });
        }
    });

    jQuery('.SubmitLogOut').on('click', function () {
        let RequestData = {
            'action': 'theme_user',
            'command': 'log_out',
            'payload': {'something': 'something'}
        };
        AjaxSend( RequestData ).then( function ( answer ) {
            if ( answer['result'] === 'success') {
                location.reload();
            }
        });
    });

});