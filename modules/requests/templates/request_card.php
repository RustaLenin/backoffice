<?php ?>

<div class="request_row" data-id="12">

    <div class="request_icon">
        <?php echo nice_svg([]); ?>
    </div>

    <div class="request_employer">
        <?php echo '<img src="' . get_user_meta( $user->ID, 'avatar', true )['guid'] . '">'; ?>
    </div>

    <div class="request_type">
        Заявка на DayOff
    </div>

    <div class="request_boss">
        <?php echo '<img src="' . get_user_meta( $user->ID, 'avatar', true )['guid'] . '">'; ?>
    </div>

    <div class="request_status">
        На утверждение
    </div>

    <div class="request_approve">

    </div>

    <?php if ( current_user_can('manage_users') ) { ?>
        <div class="request_edit">

        </div>
    <?php } ?>

</div>
