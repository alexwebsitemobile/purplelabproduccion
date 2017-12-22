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
                        $page = get_page_by_title('Evidence');
                        single_term_title();
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
                <?php single_term_title(); ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <h1 class="pdt20"><?php single_term_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">

                <?php
                $category = get_category(get_query_var('cat'));


                //global $post;

                if ($category) {
                    $args = array(
                        'taxonomy' => 'category',
                        'parent' => $category->term_id,
                    );

                    $children = get_terms($args);

                    foreach ($children as $child_term) {
                        $termid = $child_term->term_id;

                        $attachment_id = (array) get_term_meta($termid, '_thumbnail_id', true);
                        $image = wp_get_attachment_image_url(current($attachment_id), 'full');

                        if (empty($posts)) {
                            continue;
                        }

                        $title_color = $child_term->slug;

                        if ($title_color === 'experience-report') {
                            $title_color_var = 'title-category-blue';
                        }
                        if ($title_color === 'outcomes-report') {
                            $title_color_var = 'title-category-light-blue';
                        }
                        if ($title_color === 'appropriateness-report') {
                            $title_color_var = 'title-category-purple';
                        }
                        if ($title_color === 'cost-report') {
                            $title_color_var = 'title-category-dark-blue';
                        }
                        if ($title_color === 'experience-report-retriever') {
                            $title_color_var = 'title-category-blue';
                        }
                        if ($title_color === 'outcomes-report-retriever') {
                            $title_color_var = 'title-category-light-blue';
                        }
                        if ($title_color === 'appropriateness-report-retriever') {
                            $title_color_var = 'title-category-purple';
                        }
                        if ($title_color === 'cost-report-retriever') {
                            $title_color_var = 'title-category-dark-blue';
                        }
                        ?>

                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <div class="image-category">
                                    <?php if (!empty($image)) { ?>
                                        <img class="img-responsives" src="<?php echo $image ?>" alt="<?php echo $child_term->name ?>">  
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <?php echo '<h2 class="title-category' . ' ' . $title_color_var . '">' . $child_term->name . '</h2>'; ?>
                            </div>
                        </div>

                        <?php
                        $post_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field' => 'term_id',
                                    'terms' => $child_term->term_id,
                                ),
                            ),
                        );

                        $posts = get_posts($post_args);

                        foreach ($posts as $post) {
                            setup_postdata($post);
                            ?>
                            <article class="row">
                                <div class="col-xs-12">
                                    <h2><?php echo $term_clases ?></h2>
                                    <div class="box-purple <?php echo rwmb_meta('color_box'); ?>">
                                        <div class="row blocks">
                                            <div class="col-xs-12">
                                                <div class="category">
                                                    <?php
                                                    $term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
                                                    echo $term_list[1]->name;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="box-size">
                                                <?php
                                                $id = get_the_ID();
                                                ?>
                                                <div class="col-sm-12">
                                                    <div class="right-block right-block-<?php echo $id; ?>">
                                                        <div class="post-content">
                                                            <h3>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h3>
                                                        </div>
                                                        <div class="read-more text-right">
                                                            <a href="<?php the_permalink(); ?>" class="btn">
                                                                READ MORE
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php
                        }
                    }
                    wp_reset_postdata();
                }
                ?>


            </div>
            <div class="col-md-3 col-sm-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_template_part('give-us');
get_footer();
?>