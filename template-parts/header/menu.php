<?php

$uri_parts = explode('/', $_SERVER['REQUEST_URI'] );

$menu = array(
    'element_1' => array(
        'icon_id' => 'internet',
        'title' => 'Main page',
        'href' => get_bloginfo('url'),
        'current' => is_front_page()
    ),
    'element_2' => array(
        'icon_id' => 'service',
        'title' => 'Services',
        'href' => '/services/',
        'current' => in_array('services', $uri_parts )
    ),
    'element_3' => array(
        'icon_id' => 'user',
        'title' => 'Employers',
        'href' => '/employers',
        'current' => in_array('employers', $uri_parts )
   ),
    'element_4' => array(
        'icon_id' => 'social-network',
        'title' => 'Team',
        'href' => '#',
        'current' => in_array('teams', $uri_parts )
    ),
   'element_5' => array(
        'icon_id' => 'puzzle',
        'title' => 'Departments',
        'href' => '#',
       'current' => in_array('departments', $uri_parts )
    ),
    'element_6' => array(
        'icon_id' => 'target',
        'title' => 'Our Vacancies',
        'href' => '#',
        'current' => in_array('vacancies', $uri_parts )
    ),
    'element_7' => array(
        'icon_id' => 'blog',
        'title' => 'Blog',
        'href' => '#',
        'current' => in_array('blog', $uri_parts )
    ),
);
?>
<div class="main_menu">
    <div class="menu_container">
    <?php foreach ( $menu as $element ) {
        include( 'menu_element.php' );
    } ?>
    </div>


    <div class="back CollapseMenu">
        <svg><use href="#pointer"></use></svg>
    </div>


</div>
