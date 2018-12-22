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
		<?php
        if ( have_posts() ) { ?>
            <div class="article_feed">
            <?php while ( have_posts() ) {
                the_post();
                include('modules/blog/templates/post_card.php');

            } ?>
            </div>
            <?php
        }


		the_posts_pagination( array(
			'mid_size' => 2,
			'prev_text' => __( 'Prev', 'theme' ),
			'next_text' => __( 'Next', 'theme' ),
		) );
		?>
    </div>

<?php
get_footer();