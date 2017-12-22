<?php
get_header();
the_post();
?>
<div class="clear"></div>
<div class="container-title <?php echo rwmb_meta('color_box'); ?>" >
    <div class="container">
        <div class="row blocks">
            <div class="col-xs-12 right-block">
                <div class="post-content">
                    <h1 style="font-size:32px;">Lesson - <?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="container-white pdtb40">
    <div class="container">
        <div class="row post-content" style="margin-bottom: 25px;">
            <div class="col-sm-4 text-left text-center-xs mgb10r">
                <div class="">
                    <?php echo learndash_previous_post_link(); ?>
                </div>
            </div>
            <div class="col-sm-4 text-center mgb10r">
                <div class="">
                    <a href="<?php echo home_url('courses/use-objective-quantitative-performance-measures-applied-medical-administrative-claims-benchmark-providers'); ?>" class="button-purple">
                        Back to lesson menu
                    </a>
                </div>
            </div>
            <div class="col-sm-4 text-right text-center-xs">
                <div class="">
                    <?php echo learndash_next_post_link(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content post-content-image-round">
                    <?php the_post_thumbnail('full', array('class' => 'img-responsives alignleft')); ?>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <div class="row post-content">
            <div class="col-sm-4 text-left text-center-xs mgb10r">
                <div class="">
                    <?php echo learndash_previous_post_link(); ?>
                </div>
            </div>
            <div class="col-sm-4 text-center mgb10r">
                <div class="">
                    <a href="<?php echo home_url('courses/use-objective-quantitative-performance-measures-applied-medical-administrative-claims-benchmark-providers'); ?>" class="button-purple">
                        Back to lesson menu
                    </a>
                </div>
            </div>
            <div class="col-sm-4 text-right text-center-xs">
                <div class="">
                    <?php echo learndash_next_post_link(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>