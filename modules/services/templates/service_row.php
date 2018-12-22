<?php ?>

<tr class="row ServiceRow" data-id="<?php echo $post->ID; ?>">
    <td class="cell">
        <img class="cell_icon" src="<?php if ( isset( $post->icon ) ) { echo $post->icon; } else { echo get_template_directory_uri() . '/assets/img/default_icon.png'; } ?>" width="32" height="32">
    </td>
    <td class="cell">
        <?php if ( $post->url ) { ?>
            <a href="<?php echo $post->url; ?>"><?php echo $post->post_title; ?></a>
        <?php } else { echo $post->post_title; } ?>
    </td>
    <td class="cell">
        <span class="nice_svg small"><svg><use href="#info"></use></svg></span>
    </td>
    <td class="cell">
        <span class="nice_svg small click_able SeviceAccess"><svg><use href="#key"></use></svg></span>
    </td>
    <td class="cell">
        <?php echo $post->cost . ' ' . $post->currency; ?>
    </td>
    <td class="cell">
        <?php echo $post->deadline; ?>
    </td>
    <td class="cell">
<!--        --><?php
//        echo nice_checkbox( array(
//            'size' => 'medium',
//            'name' => 'active',
//            'require' => 'false',
//            'checked' =>  $post->active
//        )); ?>
    </td>
    <td class="cell">
        <span class="nice_svg small click_able EditService"><svg><use href="#edit"></use></svg></span>
    </td>
    <td class="cell">
        <span class="nice_svg small click_able trash DeleteService"><svg><use href="#trash"></use></svg></span>
    </td>
</tr>