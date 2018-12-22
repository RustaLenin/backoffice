<?php

echo nice_field( array(
    'label'         => 'Your login:',
    'name'          => 'user_login',
    'placeholder'   => 'Dude-1968',
    'icon'          => 'user',
    'validation'    => 'isValidLogin',
    'error_message' => 'Only eng letters, -, and numerals, min 2 symbols',
    'field_class'   => 'SignUpField',
    'required'      => 'true'
));

echo nice_field( array(
    'label'         => 'Your email:',
    'name'          => 'user_email',
    'placeholder'   => 'dude@gmail.com',
    'icon'          => 'email',
    'validation'    => 'IsValidEmail',
    'error_message' => 'Enter valid email',
    'field_class'   => 'SignUpField',
    'required'      => 'true'
));

?>

<div class="form_footer">
    <span class="submit_button w100 SubmitSignUp disabled">Submit</span>
</div>