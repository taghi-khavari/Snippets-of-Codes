
function weblandtk_product_shortcode($atts){

    $array_att = shortcode_atts(
        array(
            'posts_per_page'    => 8
        ) , $atts , 'product'
    );

    $args = array(
        'post_type' => 'product',
        'posts_per_page'  => $array_att['posts_per_page']
    );
    ob_start();
    $your_loop = new WP_Query( $args );
    ?> <div class="row"> <?php
    if ( $your_loop->have_posts() ) : while ( $your_loop->have_posts() ) : $your_loop->the_post(); ?>


        <div class="col-md-3 col-sm-4 col-xs-6 custom-product-each">
            <div class="custom-product-each-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(300,300))?></a></div>
            <div class="custom-product-each-title">
                <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                <div class="weblandtk-icon"></div>
            </div>
        </div>


    <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('product','weblandtk_product_shortcode');
