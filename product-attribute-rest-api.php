<?php
 
 add_action( 'rest_api_init' , 'wt_rest_api');
 
 function wt_rest_api(){
    register_rest_route('wtwoo' , 'products' , array(
            'methods'   => WP_REST_SERVER::READABLE,
            'callback'  => 'wtWooResults'
        ));
 }

function wtWooResults($data){
	$wt_product_id = (int)$data['id'];
	$product = wc_get_product( $wt_product_id );
	$wt_get_attributes = [];
	$attributes = $product->get_attributes();
	foreach($attributes as $key ){
		$wt_get_attributes[$key->get_data()['name']] = $key->get_terms();
	}
	$product = $product->get_data();
	$result = array(
		'wt_get_attributes'		 => $wt_get_attributes ,
		$wt_product_id
		);
	return $result;
	wp_die();
}
