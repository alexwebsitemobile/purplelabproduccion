<?php
get_header();
the_post();
?>
<div class="clear"></div>
<div class="container-title <?php echo rwmb_meta('color_box'); ?>" >
    <div class="container">
        <div class="row blocks">
            <div class="col-xs-12 right-block">
                <div class="post-content">
                    <h1 style="font-size:32px;">Lesson - <?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="container-white pdtb40">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-content post-content-image-round">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$citation = rwmb_meta('citation_field');
if (!empty($citation)) {
    ?>
    <section class="container-pink">
        <div class="container pdtb40">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">
                        <div class="post-content">
                            <h3 class="nmg">Citation</h3>
                            <span class="">
                                <?php echo $citation ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $files = rwmb_meta('article_pdf', 'type=file');
            if (!empty($files)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right post-content">
                            <?php
                            if (!empty($files)) {
                                foreach ($files as $file) {
                                    echo "<a class='btn-custom-content btn-custom-content-purple-big' download href='{$file['url']}' title='{$file['title']}'>DOWNLOAD ARTICLE</a>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php
}
?>

<?php
$citation_2 = rwmb_meta('citation_field_2');
if (!empty($citation_2)) {
    ?>
    <section class="container-pink ">
        <div class="container pdtb40 citation">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">
                        <div class="post-content">
                            <h3 class="nmg">Citation</h3>
                            <span class="">
                                <?php echo $citation_2 ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $files = rwmb_meta('article_pdf_2', 'type=file');
            if (!empty($files)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right post-content">
                            <?php
                            if (!empty($files)) {
                                foreach ($files as $file) {
                                    echo "<a class='btn-custom-content btn-custom-content-purple-big' download href='{$file['url']}' title='{$file['title']}'>DOWNLOAD ARTICLE</a>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php
}
?>

<?php
$citation_3 = rwmb_meta('citation_field_3');
if (!empty($citation_3)) {
    ?>
    <section class="container-pink ">
        <div class="container pdtb40 citation">

            <div class="row">
                <div class="col-xs-12">
                    <div class="text-right">
                        <div class="post-content">
                            <h3 class="nmg">Citation</h3>
                            <span class="">
                                <?php echo $citation_3 ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $files = rwmb_meta('article_pdf_3', 'type=file');
            if (!empty($files)) {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right post-content">
                            <?php
                            if (!empty($files)) {
                                foreach ($files as $file) {
                                    echo "<a class='btn-custom-content btn-custom-content-purple-big' download href='{$file['url']}' title='{$file['title']}'>DOWNLOAD ARTICLE</a>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php
}
?>
<script>
    var rh = $('.right-block').height();
    var lh = $('.left-block').height();


    if (parseInt(rh) > parseInt(lh)) {
        $('.left-block').height(rh)
    }

    if (parseInt(rh) < parseInt(lh)) {
        $('.left-block').height(lh);

    }
</script>


<?php get_template_part('give-us'); ?>
<?php get_footer(); ?>