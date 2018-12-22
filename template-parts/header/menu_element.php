<?php ?>
<a class="menu_element <?php if( $element['current'] ){ echo 'current'; } ?>" href="<?php echo $element['href'];?>">
    <svg><use href="#<?php echo $element['icon_id'];?>"></use></svg>
    <span class="title"><?php echo $element['title'];?></span>
</a>