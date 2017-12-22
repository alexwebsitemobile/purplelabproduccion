<?php
/* Template Name: Providers */
get_header();
the_post();
?>
<div class="clear"></div>
<section class="container-white pdtb40 pdtt">
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
        <div class="text-center pdb40 image-entry">
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
    <div class="container pdtb40">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-purple pdtb40">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <?php
                        $content_box_purple = rwmb_meta('content_box_purple');
                        $box_purple = apply_filters('the_content', $content_box_purple);
                        echo $box_purple;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pdtb40">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php
                    $content_box_white = rwmb_meta('content_box_white');
                    $box_white = apply_filters('the_content', $content_box_white);
                    echo $box_white;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-green pdtb40">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <?php
                        $content_box_green = rwmb_meta('content_box_green');
                        $box_green = apply_filters('the_content', $content_box_green);
                        echo $box_green;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pdtb40">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php
                    $content_box_white_two = rwmb_meta('content_box_white_two');
                    $box_white_two = apply_filters('the_content', $content_box_white_two);
                    echo $box_white_two;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-pink pdtb40">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <?php
                        $content_box_pink = rwmb_meta('content_box_pink');
                        $box_pink = apply_filters('the_content', $content_box_pink);
                        echo $box_pink;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pdtb40">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php
                    $content_box_white_three = rwmb_meta('content_box_white_three');
                    $box_white_three = apply_filters('the_content', $content_box_white_three);
                    echo $box_white_three;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>