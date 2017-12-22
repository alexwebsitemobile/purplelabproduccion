<?php
get_header();
?>
<div class="clear"></div>
<section class="container-white pdtb40 pdtt">
    <div class="container visible-xs">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <h1 class="pdt20">
                        <?php
                        $page = get_page_by_title('Our Insights');
                        echo $page->post_title;
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <?php
    $image = get_the_post_thumbnail($page->ID, 'full', array('class' => 'img-responsives'));
    if (!empty($image)) {
        ?>
        <div class="text-center pdb40 image-entry">
            <?php
            echo $image
            ?>
            <div class="title-image hidden-xs">
                <?php echo $page->post_title; ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <h1 class="pdt20"><?php echo $page->post_title; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('content');
                    }
                }
                ?>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <?php get_template_part('templates/bs-default-pagination'); ?>
            </div>
        </div>
    </div>
</section>
<?php
get_template_part('give-us');
get_footer();
?>