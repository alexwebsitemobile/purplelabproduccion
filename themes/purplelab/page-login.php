<?php
session_start();
if (!$_SESSION['login'] == 1) {
    if (isset($_POST['Username']) && isset($_POST['Password'])) {
        $user = $_POST['Username'];
        $passwd = $_POST['Password'];
        $arr = callApi($user, $passwd);
        if (isset($arr['error'][0])) { // error
            //echo "error en el login ". $arr['error'][0];
        } else {
            $token = $arr['token_id'];
            if (!isNullOrEmptyString($token)) {
                $_SESSION['token'] = $token;
                $_SESSION['login'] = 1;
                $_SESSION['Username'] = $_POST['Username'];
                $_SESSION['Password'] = $_POST['Password'];
                //var_dump($token);
            }
            header('Location:' . home_url('dashboard'));
        }
    }

    get_header('dashboard');
    the_post();
    ?>

    <!-- Login Screen -->
    <div class="login-screen">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post-content text-center">
                        <div class="mgb30 mgt30">
                            <?php
                            $logo_src = get_option('theme_options_logo_src');
                            if (!empty($logo_src)) {
                                ?>
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo $logo_src; ?>" alt="<?php echo get_option('theme_options_logo_alt'); ?>" class="img-responsives">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <div class="login-page">
                        <div class="form form-contact">
                            <form data-toggle="validator" role="form" action="./" method="post">
                                <h3>Sign In</h3>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Username" id="Username" placeholder="Username" value="<?php echo $user; ?>" data-error="Field Required" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" id="Password" name="Password" placeholder="Password" data-error="Field Required" class="form-control"  required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <?php
                                if (isset($arr['error'][0])) {
                                    ?>
                                    <div class="alert alert-danger">
                                        <?php echo "Your account is invalid"; ?>
                                    </div>

                                    <?php
                                }
                                ?>
                                <button type="submit" class="btn">login</button>
                                <p class="message lost">Did you forget your  <a href="https://rr.purplelab.com/#/forgotPassword">password?</a></p>
                                <p class="message">Not registered? <a href="<?php echo home_url('sign-up') ?>">Sign Up</a></p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Screen -->
    <?php
    get_footer('dashboard');
} else {
    header('Location:' . home_url('dashboard'));
}
?>