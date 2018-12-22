<?php include ('template-parts/footer-content.php'); ?>
        </div> <!-- Main Area -->
    </div> <!-- Site -->
<?php
    wp_footer();
?>
<script type='text/javascript'>
    /* <![CDATA[ */
    window.ajaxurl                        = {"url": "<?php echo site_url(); ?>/wp-admin/admin-ajax.php"};
    window.templates                      = {};
    templates['overlay']                  = `<?php include 'template-parts/ejs/overlay.ejs'; ?>`;
    templates['nice_field']               = {};
    templates['nice_field']['regular']    = `<?php include 'components/nice_fields/templates/regular.ejs'; ?>`;
    templates['nice_field']['vanilla']    = `<?php include 'components/nice_fields/templates/vanilla.ejs'; ?>`;
    templates['nice_field']['checkbox']   = `<?php include 'components/nice_fields/templates/checkbox.ejs'; ?>`;
    templates['nice_field']['media']      = `<?php include 'components/nice_fields/templates/media.ejs'; ?>`;
    templates['service_modal']            = `<?php include 'modules/services/templates/service_modal.ejs'; ?>`;
    templates['test_modal']               = `<?php include 'template-parts/test_modal.ejs'; ?>`;
    window.models                         = {};
    models['services'] = jQuery.parseJSON('<?php echo json_encode( BO_SERVICES::$model ); ?>'); // I'm shocked myself O_o but it's work

    /* ]]> */
</script>

</body>
</html>

