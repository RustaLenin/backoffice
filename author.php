<?php
/**
 * The template for displaying author page.
 *
 * @package BackOffice
 */

function load_page_assets() {
    $directory_uri = get_template_directory_uri(); ?>
    <script type="text/javascript" src="<?php echo $directory_uri . '/modules/employers/js/employers.js' ;?>"></script>
    <link rel="stylesheet" href="<?php echo $directory_uri . '/modules/employers/css/employers.css' ;?>">
    <link rel="stylesheet" href="<?php echo $directory_uri . '/modules/blog/css/blog.css' ;?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'load_page_assets' );

get_header();

?>

    <div class="site_content">

        <?php include('modules/employers/templates/user_page.php'); ?>

    </div>

<?php
get_footer();