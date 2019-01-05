<?php

function nice_settings() {

}

function nice_setting_nav_element( $tab ) {

    if ( !$tab ) { $tab = array(); }

    if ( !$tab['slug'] )     { $tab['slug']     = uniqid(); }
    if ( !$tab['title'] )    { $tab['title']    = 'Another one tab'; }
    if ( !$tab['icon'] )     { $tab['icon']     = 'cogs'; }
    if ( !$tab['current'] )  { $tab['current']  = false; }

    extract( $tab );

    ob_start();
    include('templates/nav_element.php');
    $html = ob_get_clean();

    return $html;

}