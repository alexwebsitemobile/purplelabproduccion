<?php
session_start();
if ($_SESSION['login'] == 1) {
    get_header();
    the_post();
    ?>
    <div class="clear"></div>
    <section class="container-white pdt40 pdtt">
        <div class="container hidden-xs">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <h1 class="pdt20">Videos</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="row mgt30">
                <div class="post-content">
                    <?php
                    $args = array(
                        'posts_per_page' => -1,
                        'post_type' => 'videos',
                    );
                    $videos = get_posts($args);
                    ?>
                    <?php
                    foreach ($videos as $post) {
                        ?>
                        <div class="col-md-4 col-sm-6 text-center">
                            <div class="btn-block-dashboard">
                                <iframe src="//player.vimeo.com/video/<?php echo rwmb_meta('id_video_url'); ?>" class="video" width="100%" height="280" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				<?php echo $post->post_title; ?><br>
<p><?php
                    echo $post->post_content;
                    ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </section>
 <script>
        jQuery.ajax({type: 'POST', contentType: "application/json", url: '/hubspot_events_timeline.php', data: JSON.stringify({"id": new Date().getTime().toString(), "eventTypeId": 17623, "event": "Visit videos page", "email": "<?php echo $_SESSION['Username']; ?>"})});
    </script>
    <?php
    get_template_part('give-us');
    get_footer();
} else {
    header('Location:' . home_url('login'));
}
?>