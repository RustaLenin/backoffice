<?php ?>

<span class="tab_title">
    Documents
</span>

<div class="user_docs">

    <?php $docs = get_user_meta( $user->ID, 'documents');
    if ( !empty( $docs ) ) {
        foreach ( $docs as $doc ) {
            if ( $doc['guid'] ) { ?>
                <div class="document_container">
                    <a data-fancybox="gallery" href="<?php echo $doc['guid']; ?>">
                        <img src="<?php echo $doc['guid']; ?>" alt="<?php echo $doc['alt']; ?>">
                    </a>

                    <div class="caption">
                        <span class="title"><?php echo $doc['post_title']; ?></span>
                        <span class="description"><?php echo $doc['post_content']; ?></span>
                    </div>

                </div>
            <?php
            }
        }
    }
    ?>

</div>