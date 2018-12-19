<?php 

function weblandtk_delete_post_type(){
    unregister_post_type( 'blocks' );
}
add_action('init','weblandtk_delete_post_type');
