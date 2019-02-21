<?php ?>

<h2 class="page_title">Заявки</h2>

<div class="requests_navigation">

    <div class="requests_filters">
        Фильтры всякие
    </div>

    <div class="nice_submit medium accent AddRequest" onclick="addRequest();">
        Создать заявку
    </div>

</div>

<div class="requests_table">

    <?php

    include THEME_MOD . '/requests/templates/request_card.php';
    include THEME_MOD . '/requests/templates/request_card.php';
    include THEME_MOD . '/requests/templates/request_card.php';

    ?>

</div>
