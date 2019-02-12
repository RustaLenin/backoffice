<?php

$uri_parts = explode('/', $_SERVER['REQUEST_URI'] );

$menu = array(
    'element_1' => array(
        'icon_id' => '1',
        'title' => 'Главная',
        'href' => get_bloginfo('url'),
        'current' => is_front_page()
    ),
    'element_2' => array(
        'icon_id' => '1',
        'title' => 'Сервисы',
        'href' => '/services/',
        'current' => in_array('services', $uri_parts )
    ),
    'element_3' => array(
        'icon_id' => '1',
        'title' => 'Сотрудники',
        'href' => '/employers',
        'current' => in_array('employers', $uri_parts )
   ),
    'element_4' => array(
        'icon_id' => '1',
        'title' => 'Team',
        'href' => '#',
        'current' => in_array('teams', $uri_parts )
    ),
   'element_5' => array(
        'icon_id' => '1',
        'title' => 'Departments',
        'href' => '#',
       'current' => in_array('departments', $uri_parts )
    ),
    'element_6' => array(
        'icon_id' => '1',
        'title' => 'Вакансии',
        'href' => '#',
        'current' => in_array('vacancies', $uri_parts )
    ),
    'element_7' => array(
        'icon_id' => '1',
        'title' => 'Блог',
        'href' => '#',
        'current' => in_array('blog', $uri_parts )
    ),
);

foreach ( $menu as $element ) {
    include( 'menu_element.php' );
}