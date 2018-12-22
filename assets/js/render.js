console.log('render.js loaded...');

/** Modals **/

export function Modal( props ) {

    let Data;

    if ( typeof props             === 'undefined' ) { props = {}; }
    if ( typeof props['template'] === 'undefined' ) { props['template'] = 'test_modal'; }
    if ( typeof props['area']     === 'undefined' ) { props['area'] = '.ModalArea'; }

    if ( typeof props['modal']    === 'undefined' ) { Data = {};
    } else { Data = props['modal'] }

    console.log( Data );
    let html = ejs.render( templates[props['template']], Data );
    jQuery( props['area'] ).html( html );
    ShowModal( props['area'] );
    HandleModal( props['area'] );
}

export function HandleModal( area ) {

    if ( typeof area === 'undefined' ) {
        area = '.ModalArea';
    }

    jQuery( area ).on('click', '.CollapseModal', function () {
        CollapseModal( area );
    });

    jQuery( area ).on('click', '.CloseModal', function () {
        CloseModal( area );
    });

    jQuery( area ).on('mousedown', function (e) {
        if ( e.target === this ) {
            CollapseModal( area );
        }
    });

    jQuery(document).on( 'keyup', function (e) {
        if ( e.key === 'Escape' ) {
            CollapseModal( area );
        }
    });

}

export function ShowModal( area = '.ModalArea' ) {
    jQuery( area ).addClass('show');
}

export function CollapseModal( area = '.ModalArea') {
    jQuery( area ).removeClass('show');
}

export function CloseModal( area = '.ModalArea' ) {
    jQuery( area ).removeClass('show');
    setTimeout( function () {
        jQuery(area).html('');
    }, 400);
}

/** Loader **/

function RunLoader( element) {
    element.prepend('<div class="loader Loader"></div>');
    element.find('.Loader').addClass('go'); /** For animation and visibility **/
}

function RemoveLoader( element ) {
    var loader = element.find('.Loader');
    loader.remove();
}

/** Notifications **/

export function Notify( notify ) {

    var area = '.NotifyArea';

    if ( typeof notify === 'undefined' ) { notify = {}; }
    if ( typeof notify['type'] === 'undefined' ) { notify['type'] = 'info'; }
    if ( typeof notify['title'] === 'undefined' ) { notify['title'] = 'Notification'; }
    if ( typeof notify['message'] === 'undefined' ) { notify['message'] = 'Something happens ¯\\_(ツ)_/¯'; }

    jQuery(area).prepend( RenderNotify( notify ) );
    jQuery(area).find('.Notify:first-of-type').addClass('show').delay(3500).animate({
        right: -800,
        opacity: 0
    }, 1000, function () {
        jQuery(this).remove();
    });

}

function RenderNotify( notify) {
    return `
    <div class="notify Notify ${notify.type}">
        <span class="nice_svg large"><svg><use href="#notify_${notify.type}"></use></svg></span>
        <div class="body">
            <span class="title">${notify.title}</span>
            <span class="message">${notify.message}</span>
        </div>
    </div>
    `;
}