<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<ul>
    <li><input type="text" class='search' value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" style="width:100% !important;" /></li>
    <li><input type="submit" class="button" id="searchsubmit" value="<?php _e('Search','rt_theme') ?> " /> </li>
</ul>
</form>
