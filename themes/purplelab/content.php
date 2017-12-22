<article class="row">
    <div class="col-xs-12">
        <div class="box-purple <?php echo rwmb_meta('color_box'); ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="category">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo esc_html($categories[0]->name);
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box-size">
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
</article>