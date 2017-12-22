<?php
if (is_front_page()) {
    ?>
    <?php get_template_part('give-us'); ?>
<?php } ?>

<footer class="mgt50" id="footer-page">
    <?php if (!is_page(array('thank-you', 'thank-submitting-cda'))) { ?>
    <div class="container-fluid">
        <div class="row bgcolorfull">
            <div class="col-md-4 bg1 bgg">
                <div class="post-content custom-h2">
                    <h2>PurpleLab</h2>
What provider profiling problems can we help you with?<a class="text-footer-purple" href="https://www.purplelab.com/?page_id=7"> Let us know</a>.

<?php echo do_shortcode('[contact-form-7 id="319" title="Quick Contact"]'); ?>
                </div>
            </div>
            <div class="col-md-4 bg2 bgg">
                <h2>Recent Insights</h2>
                <p>
                    <a href="https://www.purplelab.com/?page_id=10" class="text-footer-purple"> Access published evidence and customer use cases</a>
                </p>
                <?php
                $args = array(
                    'numberposts' => 7,
                    'post_type' => 'post'
                );
                $posts = get_posts($args);
                foreach ($posts as $post) {
                    ?>
                    <div class="post-footer">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php bloginfo('template_url'); ?>/images/bullet.png" alt="<?php the_title(); ?>"> <?php the_title(); ?>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-4 bg3 bgg" itemscope itemtype="http://schema.org/LocalBusiness">
                <div class="row">
                    <div class="col-xs-12 nopd">
                        <h2>Contact Us</h2>
                        <?php
                        $name = get_option('theme_options_name');
                        $addr = get_option('theme_options_addr');
                        $city = get_option('theme_options_city');
                        $state = get_option('theme_options_state');
                        $zip = get_option('theme_options_zip');
                        $country = get_option('theme_options_country');
                        $tel = get_option('theme_options_tel');
                        $email = get_option('theme_options_email');
                        $po = get_option('theme_options_po');
                        ?>
                        <p itemprop="name"><?php echo $name; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1 nopd">
                        <img src="<?php bloginfo('template_url'); ?>/images/greyaddress.png" alt="Address" class="img-responsives">
                    </div>
                    <div class="col-xs-11 nopd pdl10r">
                        <div class="footer-page-list" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <p class="itemp">
                                <span class="itemtype" itemprop="streetAddress"><?php echo $addr; ?></span>
                            </p>
                            <p>
                                <span><?php echo $po; ?></span>
                            <p>
                                <span itemprop="addressLocality"><?php echo $city; ?></span>
                                <span itemprop="addressRegion"><?php echo $state; ?></span>
                                <span style="display: inline-block;" itemprop="postalCode"><?php echo $zip; ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1 nopd">
                        <img src="<?php bloginfo('template_url'); ?>/images/greymail.png" alt="Email" class="img-responsives">
                    </div>
                    <div class="col-xs-11 nopd pdl10r">
                        <p itemprop="email"><?php echo $email; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-1 nopd">
                        <img src="<?php bloginfo('template_url'); ?>/images/greyphone.png" alt="Phone" class="img-responsives">
                    </div>
                    <div class="col-xs-11 nopd pdl10r">
                        <p class="phone-footer" itemprop="telephone"><?php echo $tel; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 nopd">
                        <p class="mgt30">
                            Disrupting the status quo with our Agile Provider Profiling Platform™
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Copy -->
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