<?php

function nice_field( $field ) {

    if ( !$field )                     { $field                     = array(); }

    if ( !$field['value'] )            { $field['value']            = ''; }
    if ( !$field['type'] )             { $field['type']             = 'text'; }
    if ( !$field['size'] )             { $field['size']             = 'medium'; }
    if ( !$field['class'] )            { $field['class']            = ''; }
    if ( !$field['required'] )         { $field['required']         = 'false'; }
    if ( !$field['field_class'] )      { $field['field_class']      = ''; }
    if ( !$field['field_type'] )       { $field['field_type']       = 'regular'; }
    if ( !$field['icon_class'] )       { $field['icon_class']       = ''; }
    if ( !$field['spellcheck'] )       { $field['spellcheck']       = 'false'; }
    if ( !$field['name'] )             { $field['name']             = ''; }
    if ( !$field['validation'] )       { $field['validation']       = 'false'; }
    if ( !$field['placeholder'] )      { $field['placeholder']      = 'Type some text'; }
    if ( !$field['label'] )            { $field['label']            = 'Really nice field'; }
    if ( !$field['error_message'] )    { $field['error_message']    = 'Enter valid data'; }

    ob_start();

    include('templates/' . $field['field_type'] . '.php');

    $html = ob_get_clean();
    return $html;

}