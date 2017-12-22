<?php
/* Template Name: Full Page */
get_header();
the_post();
?>
<div class="clear"></div>
<section class="container-white pdt40 pdtt">
    <div class="container visible-xs">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <h1 class="pdt20"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (has_post_thumbnail()) {
        ?>
        <div class="text-center image-entry">
            <?php the_post_thumbnail('full', array('class' => 'img-responsives')); ?>
            <div class="title-image hidden-xs">
                <?php the_title(); ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container <?php
        if (!has_post_thumbnail()) {
            echo 'hidden-xs';
        }
        ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <h1 class="pdt20"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php the_content(); ?>
</section>
<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>