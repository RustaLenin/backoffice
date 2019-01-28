<?php ?>
<a class="menu_element <?php if( $element['current'] ){ echo 'current'; } ?>" href="<?php echo $element['href'];?>">
    <?php echo nice_svg(['key' => $element['icon_id'], 'size' => 'small']); ?>
    <span class="title"><?php echo $element['title'];?></span>
</a>

