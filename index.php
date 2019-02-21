<?php
/**
 * The template for displaying main-page.
 *
 * @package backOffice
 */

function load_page_assets() {
    $directory_uri = get_template_directory_uri(); ?>
    <script type="module" src="<?php echo $directory_uri . '/modules/blog/js/blog.js' ;?>"></script>
    <link rel="stylesheet" href="<?php echo $directory_uri . '/modules/blog/css/blog.css' ;?>">
    <?php
}
add_action( 'wp_print_footer_scripts', 'load_page_assets' );

get_header(); ?>

    <div class="site_content">
		<div style="display: flex; flex-direction: column">
            <span class="nice_button large" style="margin-bottom:12px;" onClick="Nice.notify({'type': 'success'})">Notify Success</span>
            <span class="nice_button medium accent" style="margin-bottom:12px;" onClick="Nice.notify({'type': 'info'})">Notify Info</span>
            <span class="nice_button small" style="margin-bottom:12px;" onClick="Nice.notify({'type': 'warning'})">Notify Warning</span>
            <span class="nice_button tiny accent" style="margin-bottom:12px;" onClick="Nice.notify({'type': 'error'})">Notify Error</span>
            <span class="nice_submit medium accent" style="margin-bottom:12px;" onClick="Nice.modal('', {} );">Test Modal</span>
            <span class="nice_submit medium " style="margin-bottom:12px;" onClick="Nice.modal('', {} );Nice.addAndRunLoader( jQuery('.Modal') );">Modal with loader</span>

        </div>
    </div>

<?php
get_footer();