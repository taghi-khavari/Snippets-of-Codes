 add_action( 'rest_api_init' , 'wt_rest_api');
 
 function wt_rest_api(){
    register_rest_route('wtrest','products',array(
            'methods'   => WP_REST_SERVER::READABLE,
            'callback'  => 'wtProductResults'
        )); 
 }
 
 
 function wtProductResults($data){
     $products = new WP_Query([
            'post_type' => 'product',
            'cat'       => $data['cat']
         ]);
         
     $productsResults = [];
     
     while($products->have_posts()){
         $products->the_post();
         array_push($productsResults , [
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
             ]);
     }
         
     return $products->posts;
     
 }
 
