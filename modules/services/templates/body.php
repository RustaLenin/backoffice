<?php ?>

<div class="table_container">

    <table class="nice_table density_medium sticky center NiceTable w100">

        <thead class="head">

        <tr class="row settings">
            <td class="cell" colspan="100">
                <div class="table_settings">
                    <span class="nice_svg small click_able PinTableHeader"><svg><use href="#pin"></use></svg></span>
                    <span class="nice_svg small click_able ToggleTableZebra"><svg><use href="#marker"></use></svg></span>
                    <span class="nice_svg small click_able ToggleAlignCenter"><svg><use href="#align_center"></use></svg></span>
                    <span class="nice_svg small click_able SetLowDensity"><svg><use href="#arrows_in"></use></svg></span>
                    <span class="nice_svg small click_able SetMediumDensity"><svg><use href="#arrows_out_line"></use></svg></span>
                    <span class="nice_svg small click_able SetHighDensity"><svg><use href="#arrows_out_area"></use></svg></span>
                    <span class="nice_svg small click_able AddService"><svg><use href="#plus"></use></svg></span>
                </div>
            </td>
        </tr>

        <tr class="row accent">
            <td class="cell">
                Icon
            </td>
            <td class="cell">
                Name
            </td>
            <td class="cell">
                Description
            </td>
            <td class="cell">
                Access
            </td>
            <td class="cell">
                Payment
            </td>
            <td class="cell">
                Date
            </td>
            <td class="cell">
                Active
            </td>
            <td class="cell">
                Edit
            </td>
            <td class="cell">
                Remove
            </td>
        </tr>

        </thead>

        <tbody class="body ServicesTableList">

        <?php
        $args = array(
            'post_type' => 'services',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                global $post;
                include( 'service_row.php');
                wp_reset_postdata();
            }
        } ?>

        </tbody>


    </table>

</div>
