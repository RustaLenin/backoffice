<?php

echo nice_field( array(
    'label'         => 'Your login or email:',
    'name'          => 'user_login',
    'placeholder'   => 'dude@gmail.com',
    'icon'          => 'email',
    'field_class'   => 'SignInField',
    'validation'    => 'isNotEmpty',
    'error_message' => 'Enter some data',
    'required'      => 'true'
));

echo nice_field( array(
    'label'         => 'Your password:',
    'name'          => 'user_password',
    'placeholder'   => 'qwerty123ZXC"',
    'icon'          => 'eye',
    'icon_class'    => 'ToggleShowText click_able',
    'field_class'   => 'hidetext SignInField',
    'validation'    => 'isNotEmpty',
    'error_message' => 'Enter some data',
    'required'      => 'true'
));

?>

<div class="form_footer">
    <span class="nice_submit w100 SubmitSignIn disabled">Submit</span>
</div>