 add_action( 'rest_api_init' , 'wt_rest_api');
 
 function wt_rest_api(){
    register_rest_route('wtrest','products',array(
            'methods'   => WP_REST_SERVER::READABLE,
            'callback'  => 'wtProductResults'
        )); 
        
    register_rest_route('wtinstock' , 'products' , array(
            'methods'   => WP_REST_SERVER::READABLE,
            'callback'  => 'wtInStockResults'
        ));
 }
 
 

 function wtProductResults($data){
    global $woocommerce;
    $products = new WP_Query([
            'post_type' => 'product',
            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id', //can be set to ID
                                    'terms' => $data['cat'] //if field is ID you can reference by cat/term number
                                )
                            )
    ]);

    $productsResults = [];
    $results         = [];
    $currency        = get_woocommerce_currency_symbol();
    $product_cat     = get_term(  $data['cat'], 'product_cat', 'category', "OBJECT" );
    $children        = get_term_children($product_cat->term_id , 'product_cat');
    $childrenArray   = [];
    
    if($children){
        foreach($children as $child){
            $thumbnail_id = get_woocommerce_term_meta( $child, 'thumbnail_id', true );
            array_push($childrenArray ,[
                'imageUrl' => wp_get_attachment_url( $thumbnail_id ) ,
                'subCat' => get_term(  $child, 'product_cat', 'category', "OBJECT")
                ]);
        }
    }
    
    
    // get the thumbnail id using the queried category term_id
    $thumbnail_id = get_woocommerce_term_meta( $product_cat->term_id, 'thumbnail_id', true ); 

    // get the image URL
    $image = wp_get_attachment_url( $thumbnail_id ); 
    
    $catInfo = [
                'catImage' =>  $image,
                'category' =>  $product_cat
        ];
    while($products->have_posts()){
        $products->the_post();  
        //  $regularPrice = get_post_meta( get_the_ID(), '_regular_price', true);
        //  $sale = get_post_meta( get_the_ID(), '_sale_price', true);
        //  $price = get_post_meta( get_the_ID(), '_price', true );
        $product = wc_get_product( get_the_id() );
        array_push($productsResults , [
                'title'     => get_the_title(),
                'productId' => get_the_id(),
                'permalink' => get_the_permalink(),
                'thumbnail' => get_the_post_thumbnail(),
                'excerpt'   => get_the_excerpt(),
                'category'  => get_the_terms(get_the_id(),'product_cat'),
                'price'     => $product->get_price_html(),
        ]); 
    }
    array_push($results ,[
                'products' => $productsResults,
                'subCategories' => $childrenArray,
                'chosenCat' => $product_cat,
                'mainCatInfo' => $catInfo
                ]);
    wp_reset_postdata();    
    return $results;
}
 
//  function wtProductResults($data){
//     global $woocommerce;

//     $products = wc_get_products( array(
//         'status'    => 'publish',
//         'limit'     => -1,
//         'category'  => array($data['cat']),
//     ) );

//     $productsResults = [];
//     $currency        = get_woocommerce_currency_symbol();

//     if ( sizeof($products) > 0 ) :
//     foreach ( $products as $product ) :

//     $term_name = get_term( $data['cat'], 'product_cat' )->name;

//     if( $product->is_type('variable') ) {
//         // Min variation price
//         $regularPriceMin = $product->get_variation_regular_price(); // Min regular price
//         $salePriceMin    = $product->get_variation_sale_price(); // Min sale price
//         $priceMin        = $product->get_variation_price(); // Min price

//         // Max variation price
//         $regularPriceMax = $product->get_variation_regular_price('max'); // Max regular price
//         $salePriceMax    = $product->get_variation_sale_price('max'); // Max sale price
//         $priceMax        = $product->get_variation_price('max'); // Max price

//         // Multi dimensional array of all variations prices 
//         $variationsPrices = $product->get_variation_prices(); 

//         $regularPrice = $salePrice = $price = '';
//         $variationPrice = [
//             'min' => $product->get_variation_price('min'),
//             'max' => $product->get_variation_price('max')
//         ];
//     } 
//     // Other product types
//     else {
//         $regularPrice   = $product->get_regular_price();
//         $salePrice      = $product->get_sale_price();
//         $price          = $product->get_price(); 
//         $variationPrice = ['min' => '', 'max' => ''];
//     }

//     array_push( $productsResults , [
//       'title'          => $product->get_name(),
//       'productId'      => $product->get_id(),
//       'permalink'      => $product->get_permalink(),
//       'thumbnail'      => $product->get_image(),
//       'excerpt'        => $product->get_short_description(),
//       'regularPrice'   => $regularPrice,
//       'price'          => $price,
//       'salePrice'      => $salePrice,
//       'category'       => $term_name,
//       'variationPrice' => $variationPrice,
//     ]);

//     endforeach; 
//     endif;

//     return $productsResults;
// }
 
// function wtProductResults($data){
//     global $woocommerce;

//     $products = new WP_Query([
//       'post_type' => 'product',
//       'tax_query' => array( array(
//             'taxonomy' => 'product_cat',
//             'field' => 'term_id', //can be set to ID
//             'terms' => $data['cat'] //if field is ID you can reference by cat/term number
//         ) )
//     ]);

//     $productsResults = [];
//     $currency        = get_woocommerce_currency_symbol();

//     if ( $products->have_posts() ) :
//     while ( $products->have_posts() ) : $products->the_post();

//     $product_cat = get_term(  $data['cat'], 'product_cat', 'category', "OBJECT" );

//     // Get an instance of the WC_Product object
//     $product = wc_get_product( get_the_ID() );

//     if( $product->is_type('variable') ) {
//         // Min variation price
//         $regularPriceMin = $product->get_variation_regular_price(); // Min regular price
//         $salePriceMin    = $product->get_variation_sale_price(); // Min sale price
//         $priceMin        = $product->get_variation_price(); // Min price

//         // Max variation price
//         $regularPriceMax = $product->get_variation_regular_price('max'); // Max regular price
//         $salePriceMax    = $product->get_variation_sale_price('max'); // Max sale price
//         $priceMax        = $product->get_variation_price('max'); // Max price

//         // Multi dimensional array of all variations prices 
//         $variationsPrices = $product->get_variation_prices(); 

//         $regularPrice = $salePrice = $price = '';
//         $variationPrice = [
//             'min' => $product->get_variation_price(),
//             'max' => $product->get_variation_price('max')
//         ];
//     } 
//     // Other product types
//     else {
//         $regularPrice   = $product->get_regular_price();
//         $salePrice      = $product->get_sale_price();
//         $price          = $product->get_price(); 
//         $variationPrice = ['min' => '', 'max' => ''];
//     }

//     array_push( $productsResults , [
//       'title'          => get_the_title(),
//       'productId'      => get_the_id(),
//       'permalink'      => get_the_permalink(),
//       'thumbnail'      => get_the_post_thumbnail(),
//       'excerpt'        => get_the_excerpt(),
//       'regularPrice'   => $regularPrice,
//       'price'          => $price,
//       'salePrice'      => $salePrice,
//       'category'       => $product_cat->name,
//       'variationPrice' => $variationPrice,
//     ]);

//     endwhile; 
//     wp_reset_postdata();
//     endif;

//     return $productsResults;
// }

 function wt_shortcode_wtShowCat( $atts ) {
    //ATTRIBUTE
  $array_atts = shortcode_atts(
          array(
            'cat'       => '0',
            'banner'    => ''
          ), $atts, 'wtShowCat'
    );
    //USE PARAMS
    
    $product_cat = get_term(  $array_atts['cat'], 'product_cat', 'category', "OBJECT" );
    $children = get_term_children($product_cat->term_id , 'product_cat');
    //RETURN VALUE
    ob_start();
    
        ?>
            <div class="wtShowCat" data-cat="<?php echo $array_atts['cat']; ?>" data-catname="<?php echo $product_cat->name ?>" data-children="<?php echo implode(',',$children); ?>" data-banner="<?php echo $array_atts['banner']; ?>" >
                
            </div>
            
        <?php
    $outpout = ob_get_clean();
  return $outpout;
}
add_shortcode( 'wtShowCat', 'wt_shortcode_wtShowCat' );
 
