<?php
session_start();
$us = "apiuser";
$pass = "Test123#";
if (!$_SESSION['login'] == 1) {
    if (isset($_POST['password']) && isset($_POST['username']) && isset($_POST['contact_phone']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['company']) && isset($_POST['annualrevenue'])) {

        $passwd = $_POST['password'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['contact_phone'];
        $company = $_POST['company'];
        $annualrevenue = $_POST['annualrevenue'];
        $arr = callApi($us, $pass);
        $token = $arr['token_id'];
        $pagename = get_the_title();
        $url_form = '1acca04f-9c7f-43c5-baee-d94a574fcb7e';

        $arr1 = isValidToken($token);
        if ($arr1 == 'ok') {
            $arr2 = createUser($username, $email, $passwd, $firstname, $lastname, $phone, $company, $annualrevenue, $token);
            $_SESSION['token'] = $token;
            $agreeH = agreeHubspot($email, $firstname, $lastname, $phone, $company, $annualrevenue, $pagename, $url_form);
            if ($arr2 == 'ok') {
                $_SESSION["option"] = 1;
                header('Location:' . home_url('accept-terms-and-conditions'));
            } else {
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email;
                $_SESSION["first_name"] = $firstname;
                $_SESSION["last_name"] = $lastname;
                $_SESSION["contact_phone"] = $phone;
                $_SESSION["company"] = $company;
                $_SESSION["annualrevenue"] = $annualrevenue;
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
                    <?php
                    foreach ($arr2 as $item => $value) {
                        if ($value == 'username already exist.') {
                            
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $value; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <form data-toggle="validator" role="form" action="./" method="post">
                        <div class="form-contact">
                            <div class="form-group">
                                <label for="first_name">First Name <small>(Required)</small></label><br>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $_SESSION["first_name"]; ?>" data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name <small>(Required)</small></label><br>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $_SESSION["last_name"]; ?>" data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <small>(Required)</small></label><br>
                                <input type="email" name="email" id="email" onchange="rejectCompany()" value="<?php echo $_SESSION["email"]; ?>" size="40" class="form-control"  data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                                <span id="responseEmail" style="color: #a94442;"></span>
                            </div>

                            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION["username"]; ?>">

                            <div class="form-group">
                                <label for="password">Password <small>(Required)</small></label><br>
                                <input data-minlength="2" type="password" id="password" name="password" class="form-control"  data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="Password">Confirm Password <small>(Required)</small></label><br>
                                <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#password" data-error="Field Required" data-match-error="Whoops, these don't match" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="contact_phone">Phone <small>(Required)</small></label><br>
                                <input type="text" name="contact_phone" onkeypress="return isNumber(event)" value="<?php echo $_SESSION["contact_phone"]; ?>" class="form-control"  data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="company">Company <small>(Required)</small></label><br>
                                <input type="text" name="company" class="form-control" value="<?php echo $_SESSION["company"]; ?>" data-error="Field Required" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="company">Annual Revenue <small>(Required)</small></label><br>
                                <select name="annualrevenue" class="form-control"  data-error="Field Required" required>
                                    <option value="">Select a option</option>
                                    <option value="Under $25 Million">Under $25 Million</option>
                                    <option value="$25 Million - $50 Million">$25 Million - $50 Million</option>
                                    <option value="$50 Million - $100 Million">$50 Million - $100 Million</option>
                                    <option value="$100 Million - $500 Million">$100 Million - $500 Million</option>
                                    <option value="$500 Million - $2 Billion">$500 Million - $2 Billion</option>
                                    <option value="$2 Billion - $5 Billion">$2 Billion - $5 Billion</option>
                                    <option value="Over $5 Billion">Over $5 Billion</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="btn_send" value="Send" class=" btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false;
            for (var i in especiales) {
                if (key === especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) === -1 && !tecla_especial) {
                return false;
            }
        }

        function rejectCompany() {
            var str = document.getElementById('email').value;
            var res = str.split('@');
            var rejected = res[1];

            /* Domains */
            var domains = ["gmail.com", "hotmail.com", "outlook.com", "yahoo.com", "aol.com", "msn.com", "msn.es", "outlook.es", "inbox.com", "icloud.com", "mac.com", "mail.com", "zoho.com", "yandex.com", "protonmail.com"];
            var response_var = $.inArray(rejected.valueOf(), domains);
            if (response_var === -1) {
                $('span#responseEmail').html('');
                document.getElementById("btn_send").disabled = false;
            } else {
                $('span#responseEmail').html('Please use a business email address');
                document.getElementById("btn_send").disabled = true;

            }
        }
        ;

        $("#email").change(function () {
            var price = $(this).val();
            var total = (price);
            $("#username").val(total);
        });

        function updateEmail(val)
        {
            $("#email").val(val);
            $("#email").trigger('change');
        }

        updateEmail();

    </script>
    <?php
    get_footer();
} else {
    header('Location:' . home_url('dashboard'));
}
?>