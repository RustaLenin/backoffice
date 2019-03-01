<?php include ('template-parts/footer-content.php'); ?>
    </div> <!-- Site -->
<?php
    wp_footer();
?>
<script type='text/javascript'>
    /* <![CDATA[ */
    window.ajaxurl                        = {"url": "<?php echo site_url(); ?>/wp-admin/admin-ajax.php"};
    window.templates                      = {};
    templates['overlay']                  = `<?php include 'template-parts/ejs/overlay.ejs'; ?>`;
    templates['service_modal']            = `<?php include 'modules/services/templates/service_modal.ejs'; ?>`;
    templates['test_modal']               = `<?php include 'template-parts/test_modal.ejs'; ?>`;
    window.models                         = {};
    models['services'] = jQuery.parseJSON('<?php echo json_encode( BO_SERVICES::$model ); ?>'); // I'm shocked myself O_o but it's work
    models['requests'] = jQuery.parseJSON('<?php echo json_encode( UserRequest::$model ); ?>')

    /* ]]> */
</script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/index.js" type="module"></script>

</body>
</html>

