<?php
get_header('cda');
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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                            <div id="cda" style="width: 100%;
    height: 350px;
    border: 1px solid #ccc;
    background: #f2f2f2;
    padding: 6px;
    overflow: auto;">
<?php the_content(); ?>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer('cda'); ?>