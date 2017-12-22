<?php
/* Template Name: Our Offer */
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
    <div class="post-content">
        <?php the_content(); ?>
    </div>
    <div class="container mgt30">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content">
                    <?php
                    $group_values = rwmb_meta('list_with_images');
                    $ids = 1;
                    if (!empty($group_values)) {
                        foreach ($group_values as $group_value) {
                            ?>
                            <div class="row blocks mgb30">
                                <div class="col-xs-12 vcenter text-center">
                                    <div class="img-content-offer">
                                        <?php
                                        $image_ids = isset($group_value['sector-object-img']) ? $group_value['sector-object-img'] : array();
                                        foreach ($image_ids as $image_id) {
                                            $image = RWMB_Image_Field::file_info($image_id, array('size' => 'full'));
                                            echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" style="max-width: 100%;height: auto;">';
                                        }
                                        ?>
                                    </div> 
                                </div>
                                <div class="col-xs-12 vcenter">
                                    <?php
                                    $value = isset($group_value[$sub_field_key]) ? $group_value[$sub_field_key] : '';
                                    echo $group_value["text_list"];
                                    ?>
                                </div>
                            </div>
                            <?php
                            $ids = $ids + 1;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-white pdtb20">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <?php
                        $add_content = rwmb_meta('cont_des_add');
                        $add_content_des = apply_filters('the_content', $add_content);
                        echo $add_content_des;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pdtb20">
        <div class="container">
            <div class="post-content">
                <?php
                $add_content_2 = rwmb_meta('cont_des_add_2');
                $add_content_des_2 = apply_filters('the_content', $add_content_2);
                echo $add_content_des_2;
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>