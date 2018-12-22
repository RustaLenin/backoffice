console.log('interface.js loaded...');

export function HandleDocumentInterface() {
    TableHandlers( document );
}

/** Tables **/

function TableHandlers( Area) {

    var tables = jQuery( Area ).find('.NiceTable');
    tables.each( function () {

        jQuery(this).on('click', '.SetHighDensity', function () {
            SetDensityHigh( jQuery(this) );
        });

        jQuery(this).on('click', '.SetMediumDensity', function () {
            SetDensityMedium( jQuery(this) );
        });

        jQuery(this).on('click', '.SetLowDensity', function () {
            SetDensityLow( jQuery(this) );
        });

        jQuery(this).on('click', '.ToggleTableZebra', function () {
            ToggleTableZebra( jQuery(this) );
        });

        jQuery(this).on('click', '.ToggleAlignCenter', function () {
            ToggleAlignCenter( jQuery(this) );
        });

        jQuery(this).on('click', '.PinTableHeader', function () {
            PinTableHeader( jQuery(this) );
        });

    });
}

function SetDensityHigh( button ) {
    var table = button.parents('.NiceTable');
    table.removeClass('density_low density_medium');
    table.addClass('density_high');
}

function SetDensityMedium( button ) {
    var table = button.parents('.NiceTable');
    table.removeClass('density_low density_high');
    table.addClass('density_medium');
}

function SetDensityLow( button ) {
    var table = button.parents('.NiceTable');
    table.removeClass('density_medium density_high');
    table.addClass('density_low');
}

function ToggleTableZebra( button ) {
    var table = button.parents('.NiceTable');
    table.toggleClass('zebra');
}

function ToggleAlignCenter( button ) {
    var table = button.parents('.NiceTable');
    table.toggleClass('center');
}

function PinTableHeader( button ) {
    var table = button.parents('.NiceTable');
    table.toggleClass('sticky');
}