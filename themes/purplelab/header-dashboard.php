<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon">
        <meta charset="<?php bloginfo('charset') ?>" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?php bloginfo('description') ?>" />
        <?php get_template_part('templates/icons'); ?>
        <?php wp_head() ?>
        <script src="<?php bloginfo('template_url'); ?>/js/validator.js" type="text/javascript"></script>
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/2686874.js"></script>
        <!-- End of HubSpot Embed Code -->
    </head>

    <body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage">

        <?php
        do_action('before_main_content');
        get_template_part('components/bs-main-navbar');
        ?>

