<?php
get_header();
the_post();
?>
<div class="clear"></div>
<?php putRevSlider('image-hero', 'homepage'); ?>
<section class="container-white pdtb40">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-pink pdtb40">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php echo rwmb_meta('cont_des'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container-white pdtb40 content-global">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php echo rwmb_meta('cont_des_2'); ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>