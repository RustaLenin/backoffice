<?php ?>

<span class="tab_title">
    User Images
</span>

<div class="user_docs">

    <?php $images = get_posts( ['post_type' => 'attachment', 'post_status' => 'inherit', 'author' => $user->ID, 'posts_per_page' => 50 ] );
    if ( !empty( $images ) ) {
        foreach ( $images as $image ) {
            if ( $image->guid ) { ?>
                <div class="document_container">
                    <a data-fancybox="gallery" href="<?php echo $image->guid; ?>">
                        <img src="<?php echo $image->guid; ?>" alt="<?php echo $image->alt; ?>">
                    </a>

                    <div class="caption">
                        <span class="title"><?php echo $image->post_title; ?></span>
                        <span class="description"><?php echo $image->post_content; ?></span>
                    </div>

                </div>
                <?php
            }
        }
    }
    ?>

</div>
