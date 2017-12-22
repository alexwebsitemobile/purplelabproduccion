<?php
session_start();
if ($_SESSION['login'] == 1) {
        $user = $_SESSION['Username'];
        $passwd = $_SESSION['Password'];
        $arr = callApi($user, $passwd);

    get_header();
    the_post();
    ?>

    <div <?php if (empty($_SESSION)) { ?> class="hidden" <?php } ?>>
        <div class="clear"></div>
        <?php ?>
        <section class="container-white pdt40 pdtt">
            <div class="container visible-xs">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post-content">
                            <h1 class="pdt20">Dashboard</h1>
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
                        Dashboard
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
                                <h1 class="pdt20">Dashboard</h1>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10 col-xs-12">
                        <div class="row">
                            <?php
                            $group_values = rwmb_meta('button-options');
                            if (!empty($group_values)) {
                                $ids = 1;
                                foreach ($group_values as $group_value) {
                                    $open_tab = $group_value['visibility_option'];
                                    $hide = $group_value['hide_option'];
                                    $option_show = $group_value['option_to_show'];
                                    if ($open_tab == 1) {
                                        $tab = 'target="_blank"';
                                    } else {
                                        $tab = '';
                                    }
                                    if (!$hide == 1) {
                                        ?>
                                        <div class="col-sm-6 text-center">
                                            <?php
                                            if ($option_show == 'Page') {
                                                echo '<a ' . $tab . 'href="' . $group_value['url_btn_dashboard'] . '" class="btn-block-dashboard">';
                                            } elseif ($option_show == 'Popup') {
                                                echo '<a href="#" class="btn-block-dashboard" data-toggle="modal" data-target="#popup' . $ids . '" id="#popup' . $ids . '">';
                                            }
                                            ?>
                                            <?php
                                            $image_ids = isset($group_value['btn-object-img']) ? $group_value['btn-object-img'] : array();
                                            foreach ($image_ids as $image_id) {
                                                $image = RWMB_Image_Field::file_info($image_id, array('size' => 'thumbnail'));
                                                echo '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '">';
                                            }
                                            ?>
                                            <h2>
                                                <?php
                                                echo $group_value['text_line_one'];
                                                ?>
                                                <br>
                                                <?php
                                                echo $group_value['text_line_two'];
                                                ?>
                                            </h2>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    if ($option_show == 'Popup') {
                                        $content_popup = $group_value['action_to_take'];
                                        ?>
                                        <div class="modal fade" id="popup<?php echo $ids; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        if ($content_popup == 'Video') {
                                                            echo $group_value['video_embed'];
                                                        } elseif ($content_popup == 'Map') {
                                                            echo $group_value['map_embed'];
                                                        } elseif ($content_popup == 'Code') {
                                                            $code_editor = $group_value['code_embed'];
                                                            $contact = apply_filters('the_content', 'do_shortcode', $code_editor);
                                                            echo $code_editor;
                                                        } elseif ($content_popup == 'Form') {
                                                            ?>
                                                            <div class="post-content">
                                                                <h3>
                                                                    <?php echo $group_value['form_embed_title']; ?>
                                                                </h3>
                                                            </div>
                                                            <?php
                                                            echo do_shortcode($group_value['form_embed']);
                                                            ?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php
                                    $ids = $ids + 1;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        jQuery.ajax({type: 'POST', contentType: "application/json", url: '/hubspot_events_timeline.php', data: JSON.stringify({"id": new Date().getTime().toString(), "eventTypeId": 17623, "event": "Log in the Dashboard", "email": "<?php echo $user ?>"})});
    </script>
    <?php
    get_template_part('give-us');
    get_footer();
} else {
    header('Location:' . home_url('login'));
}
?>