
//in function.php
add_action('pre_get_posts','weblandtk_add_custom_post_type_query');

function weblandtk_add_custom_post_type_query($query){
    if(!is_admin() && $query->is_main_query()){
        if($query->is_home()){
            $query->set('post_type',array('post','reviews','portfolio'));
        }
    }
}
/*
we can use code like 

//in the home page for making portfolio to be different
if('portfolio' == get_post_type()){
    //Do something here like
    echo '<div>This is a portfolio</div>';
}

in the front end of the site to differentiate between custom post type and regular posts
*/
