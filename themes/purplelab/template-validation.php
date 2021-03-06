<?php
/* Template Name: Validation */
session_start();
if (!empty($_SESSION)) {
    if (isset($_POST['Username']) && isset($_POST['Password'])) {

        $user = $_POST['Username'];
        $passwd = $_POST['Password'];
        $arr = callApi($user, $passwd);
        //var_dump($arr);
        if (isset($arr['error'][0])) { // error
        } else {
            $token = $arr['token_id'];
            if (!isNullOrEmptyString($token)) {
                $_SESSION['token'] = $token;
            }
        }
    }
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
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    get_template_part('give-us');
    get_footer();
} else {
    header('Location:' . home_url('login'));
}
?>