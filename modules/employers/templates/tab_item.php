<?php ?>

<div class="tab_item TabItem <?php if ( $tab['current'] ) { echo 'current'; } ?>" data-tab="<?php echo $tab['slug']; ?>"
     onclick="Nice.switchTabs( this, {'container': '.UserPage', 'nav': '.TabItem', 'cont': '.TabItem'} );">
    <?php echo nice_svg(['key' => $tab['icon'], 'size' => 'small' ]); ?>
    <span class="label"><?php echo $tab['label']; ?></span>
</div>