<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset') ?>" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?php bloginfo('description') ?>" />
        <?php get_template_part('templates/icons'); ?>
        <?php wp_head() ?>
<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/2686874.js"></script>
<!-- End of HubSpot Embed Code -->

    </head>

    <body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage">

        <?php
        do_action('before_main_content');
        get_template_part('components/bs-main-navbar');
        ?>

        <header class="container-white pdtb20 brd">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-md-3 col-sm-12 hidden-xs">
                        <div class="wrap-logo">
                            <?php
                            $logo_src = get_option('theme_options_logo_src');
                            if (!empty($logo_src)) {
                                ?>
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo $logo_src; ?>" alt="<?php echo get_option('theme_options_logo_alt'); ?>" class="img-responsives">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <?php get_template_part('templates/menu'); ?>
                    </div>
                </div>
            </div>
        </header>


    