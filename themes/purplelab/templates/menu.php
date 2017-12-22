<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            $logo_src_r = get_option('theme_options_logo_src_r');
            if (!empty($logo_src_r)) {
                ?>
                <a href="<?php echo home_url(); ?>" class="navbar-brand visible-xs">
                    <img alt="Brand" src="<?php echo $logo_src_r; ?>" alt="<?php echo get_option('theme_options_logo_alt_r'); ?>">
                </a>
            <?php } ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            wp_nav_menu(
                    array(
                        'menu' => 'header-menu',
                        'theme_location' => 'header-menu',
                        'depth' => 2,
                        'container' => 'div',
                        //'container_class' => '',
                        'menu_class' => 'nav navbar-nav navbar-right navbar-purple',
                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                        'walker' => new wp_bootstrap_navwalker()
                    )
            );
            ?>
        </div>
    </div>
</nav>