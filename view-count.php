//This function would count the times a page has been viewd
function weblandtk_page_count(){
  $post_id = get_the_id();
  
  $page_count = ( get_post_meta( $post_id , 'page_count' , true ) ? get_post_meta( $post_id , 'page_count' , true ) : 1;
  
  $page_count++;
  
  add_post_meta( $post_id , 'page_count' , $page_count );
}

add_action( 'do_my_page_count' , 'page_count' );


//query for popular posts by page count

$args = array(
    'post_type'   => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'ignore_sticky_posts' => 1,
    'meta_key'            => 'page_count',
    'meta_type'           => 'DECIMAL',
    'orderby'             => 'meta_value_num',
    'order'               => 'DESC'
  );
  
$popular_query = new WP_Query( $args );
