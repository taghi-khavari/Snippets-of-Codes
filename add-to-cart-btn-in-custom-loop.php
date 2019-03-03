<?php
$args = array(
'post_type' => 'product',
'posts_per_page' => '4',
'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1),
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post(); 
global $product;
if ( has_post_thumbnail() ) { the_post_thumbnail(); }
the_title();
echo $product->get_price_html();
woocommerce_template_loop_add_to_cart();
endwhile; endif;
