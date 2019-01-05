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

Class NICE_FIELD {

    public static function wp_enqueue() {
        $template_directory_uri = get_template_directory_uri();
        wp_enqueue_style('nice_field_css', $template_directory_uri . '/components/nice_fields/nice_fields.css' );
        wp_enqueue_script( 'nice_field_js', $template_directory_uri . '/components/nice_fields/nice_fields.js' );
    }

}

add_action( 'wp_enqueue_scripts', array( 'NICE_FIELD', 'wp_enqueue' ) );