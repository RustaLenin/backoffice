<?php

/**
 * The template for displaying single post
 *
 * @package BackOffice
 */
?>

    <article id="post-<?php the_ID(); ?>" class="post_card single_post">

        <div class="image">
            <?php echo get_the_post_thumbnail( $post->ID, 'large'); ?>
        </div>

        <div class="content">

            <div class="header">

                <div class="header_meta">

                    <div class="header_meta__left">

                        <div class="header_meta__author">
                            <img class="avatar" src="<?php echo get_user_meta(  $post->post_author, 'avatar', true )['guid']; ?>">
                            <a class="author_url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ); ?>">
                                <?php echo get_the_author_meta('display_name',  $post->post_author ); ?>
                            </a>
                        </div>

                        <span class="divider"></span>

                        <div class="header_meta__data">
                            <?php echo get_the_date('j F Y'); ?>
                        </div>
                    </div>

                    <?php $cats = wp_get_post_categories( $post->ID );
                    if ( !empty( $cats ) ) {
                    $cat = get_category( $cats[0] ); ?>
                    <a href="<?php echo get_category_link( $cat ); ?>" class="header_meta__category">
                        <?php echo $cat->name; ?>
                </div>
                <?php } ?>

                </a>

                <div class="header_title">
                    <?php echo get_the_title( $post->ID ); ?>
                </div>

            </div>

            <div class="body">
                <div class="post_content">
                    <?php echo wpautop( do_shortcode( get_the_content( $post->ID ) ) ); ?>
                </div>
            </div>

            <div class="footer">

                <div class="footer_tags">
                    <?php $tags =  wp_get_post_tags( $post->ID);
                    foreach ( $tags as $tag ) { ?>
                        <span class="tag"><a href="<?php echo get_tag_link( $tag->tag_id ); ?>"><?php echo $tag->name; ?></a></span>
                    <?php } ?>
                </div>

                <div class="footer_comments">
                    <span class="nice_svg small"><svg><use href="#comment"></use></svg></span>
                    <?php echo get_comments_number( $post->ID ) ?>
                </div>

            </div>

        </div>

    </article>

<?php //comments_template(); ?>