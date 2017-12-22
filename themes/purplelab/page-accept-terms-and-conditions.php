<?php
session_start();
if ($_SESSION["option"] != 1) {
    header('Location:' . home_url('sign-up'));
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
                <div id="cda" style="width: 100%;
                     height: 350px;
                     border: 1px solid #ccc;
                     background: #f2f2f2;
                     padding: 6px;
                     overflow: auto;">
                     <?php
                     the_content();
                     ?>
                </div>
                <form data-toggle="validator" role="form" action="<?php echo home_url('thank-submitting-cda'); ?>" method="post">
                    <div class="form-contact">

                        <div class="form-group mgt30">
                            <input type="checkbox" class="acceptance" id="term_accept" disabled="disabled"> <label for="accept-this-1">Check here if you accept these terms.</label>

                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send" class="btn" disabled="disabled">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</section>

<script>
    $('.acceptance').attr("disabled", true);
    $('#cda').scroll(function () {
        if ($('#cda').scrollTop() > 200) {
            $('.acceptance').removeAttr("disabled");
        }
    });

    $(function () {
        enable_cb();
        $("#term_accept").click(enable_cb);
    });

    function enable_cb() {
        if (this.checked) {
            $("input.btn").removeAttr("disabled");
        } else {
            $("input.btn").attr("disabled", true);
        }
    }

    $(document).ready(function () {
        $('#term_accept').change(function () {
            if ($(this).prop('checked')) {
                $('#form-submit').removeAttr('disabled');
            } else {
                preventDefault();

            }
        });
    });
</script>


<?php get_footer('cda'); ?>