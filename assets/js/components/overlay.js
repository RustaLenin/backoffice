console.log('overlay.js loaded...');

const OverlayTemplate = templates.overlay;

export function AddOverlay( area, overlay ) {
    area.append( RenderOverlay( overlay ) );
    HandleOverlay( area );
}

function HandleOverlay( area ) {
    let overlay = area.find('.Overlay');
    overlay.on('click', '.CloseOverlay', function () {
        ClearOverlay( area );
    });
}

function RenderOverlay( overlay ) {

    if ( typeof overlay                 === 'undefined' ) { overlay = {} }
    if ( typeof overlay['loader']       === 'undefined' ) { overlay['loader'] = false; }
    if ( typeof overlay['close_able']   === 'undefined' ) { overlay['close_able'] = true; }
    if ( typeof overlay['with_message'] === 'undefined' ) { overlay['with_message'] = true; }
    if ( typeof overlay['message_type'] === 'undefined' ) { overlay['message_type'] = 'info'; }
    if ( typeof overlay['icon']         === 'undefined' ) { overlay['icon'] = false; }
    if ( typeof overlay['title']        === 'undefined' ) { overlay['title'] = 'Info'; }
    if ( typeof overlay['message']      === 'undefined' ) { overlay['message'] = 'Something Happens'; }

    return ejs.render( OverlayTemplate, {'overlay': overlay } );

}

export function ClearOverlay( area ) {

    let overlay = area.find('.Overlay');
    overlay.removeClass('show');
    setTimeout(function () {
        overlay.remove();
    }, 1500 );

}