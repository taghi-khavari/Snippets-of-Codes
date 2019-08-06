<?php 
//Creating rest route for calling pages

add_action( 'rest_api_init' , 'wt_rest_api');

function wt_rest_api(){
    register_rest_route('wtrest','events',array(
            'methods'   => WP_REST_SERVER::READABLE,
            'callback'  => 'wtEventResults'
        )); 

    register_rest_route('wtmember','members',array(
        'method'    => WP_REST_SERVER::READABLE,
        'callback'  => 'wtMemberResults'
    ));
}


function wtEventResults($data){
    WPBMap::addAllMappedShortcodes(); // This does all the work
    $events = new WP_Query([
        'post_type' => 'event',
        'post__in'  => array( (int)$data['id'] )
        ]);
        
    $eventsResults = [];
    
    while($events->have_posts()){
        $events->the_post();

        
        array_push($eventsResults , [
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'content'   => apply_filters( 'the_content' ,  get_the_content() )
            ]);
    }
        
    return $eventsResults;
    
}


function wtMemberResults($data){
    WPBMap::addAllMappedShortcodes(); // This does all the work
    $members = new WP_Query([
        'post_type' => 'member',
        'post__in'  => array( (int)$data['id'] )
        ]);
        
    $membersResults = [];
    
    while($members->have_posts()){
        $members->the_post();
        array_push($membersResults , [
            'title' => get_the_title(),
            'permalink' => get_the_permalink()
            ]);
    }
        
    return $membersResults;
    
}
