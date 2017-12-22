<?php
session_start();
if (isset($_POST['Username']) && isset($_POST['Password'])) {

    $user = $_POST['Username'];
    $passwd = $_POST['Password'];
    $arr = callApi($user, $passwd);
    //var_dump($arr);
    if (isset($arr['error'][0])) { // error
    } else {
        $token = $arr['token_id'];
        if (!isNullOrEmptyString($token)) {
            $_SESSION['token'] = $token;
        }
    }
}
?>
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
        <style>
            #menu-item-59{
                display:none;
            }

            #menu-item-1500{
                display: block;
            }
        </style>
    </head>

    <body <?php body_class() ?>>

        <?php
        do_action('before_main_content');
        get_template_part('components/bs-main-navbar');
        ?>


        <header class="container-white pdtb20 brd" id="header-page">
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