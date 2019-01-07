<?php ?>

<div class="setting_block SettingBlock">

	<div class="header SettingBlockTitle" onclick="ToggleSettingBlock(this)">
        <span class="title"> Title 1  </span>
		<span class="nice_svg medium"><svg><use href="#arrow_down"></use></svg></span>
	</div>

	<div class="content SettingBlockContainer">
        <?php
        $fields = array(1,2,3,4,5);
        foreach ($fields as $field ) {
            echo nice_field(array());
        } ?>
	</div>

</div>

<div class="setting_block SettingBlock">

    <div class="header SettingBlockTitle" onclick="ToggleSettingBlock(this)">
        <span class="title"> Title 1 </span>
        <span class="nice_svg medium"><svg><use href="#arrow_down"></use></svg></span>
    </div>

    <div class="content SettingBlockContainer">
        <?php
        $fields = array(1,2,3,4,5);
        foreach ($fields as $field ) {
            echo nice_field(array());
        } ?>
    </div>

</div>