<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BackOffice
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="canonical" href="<?php echo get_site_url(); ?>"/>
    <script src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() . '/assets/fonts/text-security-disc.css'; ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <?php

//    if ( class_exists('THEME_SETTINGS') ) {
//	    $settings = get_option( THEME_SETTINGS::$settings_name );
//    }
    wp_head();

    ?>
</head>

<body>

<?php include ('template-parts/svg/sprite.php'); ?>

    <div class="site">

    <?php include( 'modules/header/templates/content.php'); ?>

