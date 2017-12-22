<footer class="mgt50">
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center-xs">
                    <div class="text-copy">
                        <a href="https://www.purplelab.com/?page_id=299">Privacy Policy</a> | <a href="https://www.purplelab.com/?page_id=302">Terms</a> | &copy; Copyright <?php echo the_date('Y'); ?>.
                    </div>
                </div>
                <?php
                $facebook = get_option('theme_options_facebook');
                $twitter = get_option('theme_options_twitter');
                $googleplus = get_option('theme_options_googleplus');
                $youtube = get_option('theme_options_youtube');
                $linkedin = get_option('theme_options_linkedin');
                ?>
                <div class="col-sm-6 text-right text-center-xs">
                    <ul class="menu-social">
                        <?php
                        if (!empty($linkedin)) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $linkedin; ?>">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($twitter)) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $twitter; ?>">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($facebook)) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $facebook; ?>">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($youtube)) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $youtube; ?>">
                                    <i class="fa fa-youtube-play"></i>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($googleplus)) {
                            ?>
                            <li>
                                <a target="_blank" href="<?php echo $googleplus; ?>">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
//get_template_part('templates/responsive-helper');
wp_footer();
do_action('after_main_content');
?>
</body>
</html>
