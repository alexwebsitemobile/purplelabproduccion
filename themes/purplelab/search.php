<?php
get_header();
?>
<div class="clear"></div>
<section class="container-white pdtb40">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <h1>
                        <?php printf(__('Search Results for: %s'), '<span>' . get_search_query() . '</span>'); ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('content');
                    }
                } else {
                    ?>
                <div class="alert alert-warning">
                       
No results found for your search
                </div>
                <?php 
                }
                ?>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>