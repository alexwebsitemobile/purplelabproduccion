<form id="searchform" action="<?php echo home_url('/') ?>" method="get" role="form" >
    <div class="input-group">
        <input type="text" class="form-control search-text" name="s" placeholder="<?php _e('Search') ?>">
        <span class="input-group-btn">
            <button class="btn btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
        </span>
    </div><!-- /input-group -->
</form>