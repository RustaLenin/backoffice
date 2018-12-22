<?php

$menu = array(
    'element_1' => array(
        'icon_id' => 'internet',
        'title' => 'Main page',
        'href' => get_bloginfo('url'),
        'current' => true
    ),
    'element_2' => array(
        'icon_id' => 'service',
        'title' => 'Services',
        'href' => '/services/',
        'current' => false
    ),
    'element_3' => array(
        'icon_id' => 'optimization',
        'title' => 'Projects',
        'href' => '#',
        'current' => false
   ),
    'element_4' => array(
        'icon_id' => 'social-network',
        'title' => 'Team',
        'href' => '#',
        'current' => false
    ),
   'element_5' => array(
        'icon_id' => 'puzzle',
        'title' => 'Departments',
        'href' => '#',
       'current' => false
    ),
    'element_6' => array(
        'icon_id' => 'target',
        'title' => 'Our Vacancies',
        'href' => '#',
        'current' => false
    ),
    'element_7' => array(
        'icon_id' => 'blog',
        'title' => 'Blog',
        'href' => '#',
        'current' => false
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
