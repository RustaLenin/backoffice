<?php
/**
 * The template for displaying any single post.
 *
 * @package BackOffice
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
		<?php
		if ( have_posts() ) { ?>
            <div class="article_single">
			<?php while (have_posts()) {
				the_post();
				include('modules/blog/templates/post_single.php');
			} ?>
            </div>
            <?php
		}
		?>
    </div>

<?php
get_footer();