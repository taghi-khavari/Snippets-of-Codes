
function weblandtk_product_posttype() {
    $labels = array(
        'name'                  => _x( 'products', 'Post type general name', 'product' ),
        'singular_name'         => _x( 'product', 'Post type singular name', 'product' ),
        'menu_name'             => _x( 'products', 'Admin Menu text', 'product' ),
        'name_admin_bar'        => _x( 'product', 'Add New on Toolbar', 'product' ),
        'add_new'               => __( 'Add New', 'product' ),
        'add_new_item'          => __( 'Add New product', 'product' ),
        'new_item'              => __( 'New product', 'product' ),
        'edit_item'             => __( 'Edit product', 'product' ),
        'view_item'             => __( 'View product', 'product' ),
        'all_items'             => __( 'All products', 'product' ),
        'search_items'          => __( 'Search products', 'product' ),
        'parent_item_colon'     => __( 'Parent products:', 'product' ),
        'not_found'             => __( 'No products found.', 'product' ),
        'not_found_in_trash'    => __( 'No products found in Trash.', 'product' ),
        'featured_image'        => _x( 'product Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'product' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'product' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'product' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'product' ),
        'archives'              => _x( 'product archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'product' ),
        'insert_into_item'      => _x( 'Insert into product', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'product' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this product', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'product' ),
        'filter_items_list'     => _x( 'Filter products list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'product' ),
        'items_list_navigation' => _x( 'products list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'product' ),
        'items_list'            => _x( 'products list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'product' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'product' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'product', $args );
}

add_action( 'init', 'weblandtk_product_posttype' );


add_action( 'init', 'weblandtk_create_product_taxonomies', 0 );

function weblandtk_create_product_taxonomies() {
    $labels = array(
        'name'              => _x( 'Types', 'taxonomy general name', 'weblandtk' ),
        'singular_name'     => _x( 'Type', 'taxonomy singular name', 'weblandtk' ),
        'search_items'      => __( 'Search Types', 'weblandtk' ),
        'all_items'         => __( 'All Types', 'weblandtk' ),
        'parent_item'       => __( 'Parent Type', 'weblandtk' ),
        'parent_item_colon' => __( 'Parent Type:', 'weblandtk' ),
        'edit_item'         => __( 'Edit Type', 'weblandtk' ),
        'update_item'       => __( 'Update Type', 'weblandtk' ),
        'add_new_item'      => __( 'Add New Type', 'weblandtk' ),
        'new_item_name'     => __( 'New Type Name', 'weblandtk' ),
        'menu_name'         => __( 'Type', 'weblandtk' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'Type' ),
    );

    register_taxonomy( 'Type', array( 'product' ), $args );

}

