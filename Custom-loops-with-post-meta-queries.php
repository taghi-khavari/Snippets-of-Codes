
$args = array(
    'order' => 'ASC',
    'orderby'   => 'meta_value_num',
    'posts_per_page' => -1,
    'meta_key'      => 'product_id',
// add this if you want to query a specific product
//    'meta_query'    => array(
//        array(
//            'key'   =>'product_id',
//            'value' => array(1234,5678),
//            'compare' => 'IN'
//        )
//    )
);

$my_query = new WP_Query($args);
if($my_query->have_posts()):while($my_query->have_posts()):$my_query->the_post();

//do stuff here

endwhile;
endif;
