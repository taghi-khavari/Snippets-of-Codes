<?php

//This snippet is going to optimize file upload when it's necessary

add_filter( 'the_post', 'wt_create_global' );

function wt_create_global($posts){
    //Exit function immediately if no posts are present

    if(empty($posts)){
        return $posts;
    }

    //global variable to indicate if scripts should be loaded

    global $wt_load_scripts;

    $wt_load_scripts = false;

    //Cycle through posts and set flag if keyword is found

    foreach( $posts as $post ){

        $shortcode_pos = stripos( $post->post_content , '[shortcode_name]', 0);

        if( $shortcode_pos !== false ){
            $wt_load_scripts = true;
            return $posts;
        }
    }

    //return posts array unchanged

    return $posts;
}


// Now we can use the global $wt_load_scripts variable to indicate wether a code should be load or not 
// for example :
/*
    global $wt_load_scripts;
    
    if($wt_load_scripts){
        //load codes here
    }

*/
