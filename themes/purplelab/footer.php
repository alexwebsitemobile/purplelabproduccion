<?php if (isset($_SESSION['login']) && $_SESSION['login'] == 1) { ?>
    <script>
        $("#menu-item-59").css("display", "none");
        $("#menu-item-1500").css("display", "none");
        $("#menu-primary").append("<li id='menu-item-1501'><a title='' href='#' data-toggle='dropdown' class='dropdown-toggle'>Account <span class='caret'></span></a></li>");
        $("#menu-item-1501").append("<ul id='dropaccount' role='menu' class='dropdown-menu'></ul>");
        $("#dropaccount").append("<li><a href='<?php echo home_url('dashboard') ?>'>Dashboard</a></li><li><a href='<?php echo home_url('logout') ?>'>Logout</a></li>");
    </script>

<?php } else { ?>
    <script>
        $("#menu-item-59").css("display", "inline-block");
        $("#menu-item-1500").css("display", "inline-block");
        $("#menu-primary").append("<li id='menu-item-1500'><a title='Sign In' href='<?php echo home_url('login') ?>'>Sign In</a></li>");
    </script>  
<?php } ?>

<?php
get_template_part('templates/footer');
//get_template_part('templates/responsive-helper');
wp_footer();
do_action('after_main_content');
?>
<script>
$("#popup4").click(function() {
  jQuery.ajax({type: 'POST', contentType: "application/json", url: '/hubspot_events_timeline.php', data: JSON.stringify({"id": new Date().getTime().toString(), "eventTypeId": 17623, "event": "View calculator", "email": "<?php echo $_SESSION['Username']; ?>"})});
});
</script>
<script src="<?php bloginfo('template_url'); ?>/js/main.js" type="text/javascript"></script>
</body>
</html>

