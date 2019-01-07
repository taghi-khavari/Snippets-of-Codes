



<?php
/**
 * Plugin name: Editing Admin Column's of the pages
 * Description: This is a simple plugin to add , remove and reorder the columns of different pages
 * Author: Taghi Khavari
 * Author Uri: http://weblandtk.ir
 * version: 1.0
 */

/*
 * A little Description
Changing the existing columns can be accomplished using two WordPress hooks:
***manage_[post_type]_posts_columns***
 * , which allows you to remove,reorder and add columns, and
 **** manage_[post_type]_posts_custom_column***.
 *  In place of [post_type], enter the post type you wish to target. For
pages, for example, you would use manage_page_posts_columns and manage_page_posts_custom_column, respectively.
*/


// 1


add_filter( 'manage_realestate_posts_columns', 'weblandtk_filter_posts_columns' );
function weblandtk_filter_posts_columns( $columns ) {
    $columns['image'] = __( 'Image' );
    $columns['price'] = __( 'Price', 'smashing' );
    $columns['area'] = __( 'Area', 'smashing' );
    return $columns;
}


// 2


add_filter( 'manage_realestate_posts_columns', 'weblandtk_realestate_columns' );
function weblandtk_realestate_columns( $columns ) {
    $columns = array(
        'cb' => $columns['cb'],
        'image' => __( 'Image' ),
        'title' => __( 'Title' ),
        'price' => __( 'Price', 'smashing' ),
        'area' => __( 'Area', 'smashing' ),
    );


    return $columns;
}


//Populating Columns

add_action('manage_realstate_posts_custom_column','weblandtk_realstate_column',10,2);
function weblandtk_realstate_column($column,$post_id){
    //Image column

    if('image'===$column){
        echo get_the_post_thumbnail($post_id,array(80,80));
    }

    // Monthly price column
    if ( 'price' === $column ) {
        $price = get_post_meta( $post_id, 'price_per_month', true );

        if ( ! $price ) {
            _e( 'n/a' );
        } else {
            echo '$ ' . number_format( $price, 0, '.', ',' ) . ' p/m';
        }
    }

    // Surface area column
    if ( 'area' === $column ) {
        $area = get_post_meta( $post_id, 'area', true );

        if ( ! $area ) {
            _e( 'n/a' );
        } else {
            echo number_format( $area, 0, '.', ',' ) . ' m2';
        }
    }

}


/*
manage_posts_columns

[
  [cb]          => <input type="checkbox" />
  [title]       => Title
  [author]      => Author
  [categories]  => Categories
  [tags]        => Tags
  [comments]    => [..] Comments [..]
  [date]        => Date
]
*/
//Making Columns Sortable


add_filter( 'manage_edit-realestate_sortable_columns', 'weblandtk_realestate_sortable_columns');
function weblandtk_realestate_sortable_columns( $columns ) {
    $columns['price'] = 'price_per_month';
    return $columns;
}



add_action( 'pre_get_posts', 'weblandtk_posts_orderby' );
function weblandtk_posts_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'price_per_month' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', 'price_per_month' );
        $query->set( 'meta_type', 'numeric' );
    }
}

/**************************NEW SECTION *********************/

//3

function weblandtk_new_order_column( $columns )
{
    $columns['my_column'] = 'My column';
    return $columns;
}
    add_filter( 'manage_edit-shop_order_columns', 'weblandtk_new_order_column' );

//4

/**
 *
 * Adds 'Profit' column header to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $columns
 * @return string[] $new_columns
 */
function weblandtk_add_order_profit_column_header( $columns ) {

    $new_columns = array();

    foreach ( $columns as $column_name => $column_info ) {

        $new_columns[ $column_name ] = $column_info;

        if ( 'order_total' === $column_name ) {
            $new_columns['order_profit'] = __( 'Profit', 'my-textdomain' );
        }
    }

    return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'weblandtk_add_order_profit_column_header', 20 );


//Populate new section

if ( ! function_exists( 'sv_helper_get_order_meta' ) ) :

    /**
     * Helper function to get meta for an order.
     *
     * @param \WC_Order $order the order object
     * @param string $key the meta key
     * @param bool $single whether to get the meta as a single item. Defaults to `true`
     * @param string $context if 'view' then the value will be filtered
     * @return mixed the order property
     */
    function sv_helper_get_order_meta( $order, $key = '', $single = true, $context = 'edit' ) {

        // WooCommerce > 3.0
        if ( defined( 'WC_VERSION' ) && WC_VERSION && version_compare( WC_VERSION, '3.0', '>=' ) ) {

            $value = $order->get_meta( $key, $single, $context );

        } else {

            // have the $order->get_id() check here just in case the WC_VERSION isn't defined correctly
            $order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;
            $value    = get_post_meta( $order_id, $key, $single );
        }

        return $value;
    }

endif;


/**
 * Adds 'Profit' column content to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $column name of column being displayed
 */
function weblandtk_add_order_profit_column_content( $column ) {
    global $post;

    if ( 'order_profit' === $column ) {

        $order    = wc_get_order( $post->ID );
        $currency = is_callable( array( $order, 'get_currency' ) ) ? $order->get_currency() : $order->order_currency;
        $profit   = '';
        $cost     = sv_helper_get_order_meta( $order, '_wc_cog_order_total_cost' );
        $total    = (float) $order->get_total();

        // don't check for empty() since cost can be '0'
        if ( '' !== $cost || false !== $cost ) {

            // now we can cast cost since we've ensured it was calculated for the order
            $cost   = (float) $cost;
            $profit = $total - $cost;
        }

        echo wc_price( $profit, array( 'currency' => $currency ) );
    }
}
add_action( 'manage_shop_order_posts_custom_column', 'weblandtk_add_order_profit_column_content' );

/**
 * Adjusts the styles for the new 'Profit' column.
 */
function weblandtk_add_order_profit_column_style() {

    $css = '.widefat .column-order_date, .widefat .column-order_profit { width: 9%; }';
    wp_add_inline_style( 'woocommerce_admin_styles', $css );
}
add_action( 'admin_print_styles', 'weblandtk_add_order_profit_column_style' );





//Register and sort  the new columns via a filter hook (‘manage_edit-product_columns’):
add_filter( 'manage_edit-product_columns', 'add_columns_to_product_grid', 10, 1 );

const BACKEND_PRODUCT_GRID_FIELD_SORTORDER
= [
    'cb',
    'thumb',
    'name',
    'pa_size_text',
    'sku',
    'is_in_stock',
    'price',
    'product_cat',
    'product_tag',
    'featured',
    'product_type',
    'date',
    'stats',
    'likes'
];

/**
 * Registers new columns for the backend products grid of Woocommerce.
 * Additionally it sorts the fields after
 * self::BACKEND_PRODUCT_GRID_FIELD_SORTORDER. Fields not included in
 * self::BACKEND_PRODUCT_GRID_FIELD_SORTORDER will be attached to the end of
 * the array.
 *
 * @param array $aColumns - the current Woocommerce backend grid columns
 *
 * @return array - the extended backend grid columns array
 */
public function add_columns_to_product_grid( $aColumns ) {
    $aColumns['pa_size_text'] = __( 'Unit size', 'sheldon_misc' );
    #unset($aColumns['thumb']);
    $aReturn = [];
    foreach ( self::BACKEND_PRODUCT_GRID_FIELD_SORTORDER as $sKey ) {
        if ( isset( $aColumns[ $sKey ] ) ) {
            $aReturn[ $sKey ] = $aColumns[ $sKey ];
        }
    }

    /**
     * search additional unknown fields and attache them to the end
     */
    foreach ( $aColumns as $sKey => $sField ) {
        if ( ! isset( $aReturn[ $sKey ] ) ) {
            $aReturn[ $sKey ] = $sField;
        }
    }

    return $aReturn;
}



//Register and sort  the new columns via a filter hook (‘manage_edit-product_columns’):
add_action( 'manage_product_posts_custom_column', 'add_columns_value_to_product_grid', 10, 2 );

/**
 * Adds the respective value of the custom attribute to each row of the
 * column
 *
 * @param string $sAttributeCode
 * @param int    $iPostId
 */
public function add_columns_value_to_product_grid(
    $sAttributeCode,
    $iPostId
) {
    if ( $sAttributeCode == 'pa_size_text' ) {
        $oProduct  = new WC_Product( $iPostId );
        $sSizeText = $oProduct->get_attribute( 'pa_size_text' );
        echo esc_attr( $sSizeText );
    }
}
