<?php

/**
 * Template Name: BackOffice Employers Page
 *
 * @package BackOffice
 */

function load_page_assets() {
    $directory_uri = get_template_directory_uri(); ?>
    <script type="module" src="<?php echo $directory_uri . '/modules/services/js/employers.js' ;?>"></script>
    <link rel="stylesheet" href="<?php echo $directory_uri . '/modules/employers/css/employers.css' ;?>">
    <?php
}
add_action( 'wp_print_footer_scripts', 'load_page_assets' );

get_header(); ?>

    <div class="site_content">

        <div class="employers_content">

            <div class="header">
                <span class="breadcrumbs_container"><?php echo kama_breadcrumbs(' » '); ?> » </span>
                <h1 class="page_title">Employers</h1>
            </div>

            <div class="body">
                <?php include ('modules/employers/templates/query.php'); ?>
            </div>

        </div>

    </div>

<?php
get_footer();