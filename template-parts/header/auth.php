<?php ?>
<div class="auth AuthCont">

    <div class="tabs">

        <span class="tab AuthTab current" data-tab="sign_in">
            <span class="icon"><svg><use href="#sign_in"></use></svg></span>
            <span class="title"> Sign In</span>
        </span>

        <span class="tab AuthTab" data-tab="sign_up">
            <span class="icon"><svg><use href="#sign_up"></use></svg></span>
            <span class="title">Sign Up</span>
        </span>

    </div>

    <div class="forms">

        <div class="form SignInForm AuthForms current" data-tab="sign_in">

            <?php include('sign_in.php'); ?>

        </div>

        <div class="form SignUpForm AuthForms" data-tab="sign_up">

            <?php include('sign_up.php'); ?>

        </div>

    </div>

    <div class="overlay Overlay">

    </div>

</div>