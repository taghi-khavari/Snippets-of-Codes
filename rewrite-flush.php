<?php
function weblandtk_rewrite_flush(){
    //here you can place the name of the function like custom_post_type() that needs flushing;
    flush_rewrite_rules();
}
//for plugins we do this
register_activation_hook(__FILE__,'weblandtk_rewrite_flush');

//for theme we do this
add_action('after_switch_theme','weblandtk_rewrite_flush');
