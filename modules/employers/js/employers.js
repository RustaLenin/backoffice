'use strict';
console.log('employers.js loaded...');

function addRequest() {
    Nice.modal( Nice.modalTemplates['default'], { modal: {
            'modal_title_text': 'Создать заявку',
            'submit_modal_form': ' ',
            'modal_form': Nice.form( models['requests'] ),
            'modal_submit_text': 'Создать',
        }
    });
}