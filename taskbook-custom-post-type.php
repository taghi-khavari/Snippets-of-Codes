function wpdocs_codex_Task_init() {
    $labels = array(
        'name'                  => _x( 'Tasks', 'Post type general name', 'Taskbook' ),
        'singular_name'         => _x( 'Task', 'Post type singular name', 'Taskbook' ),
        'menu_name'             => _x( 'Tasks', 'Admin Menu text', 'Taskbook' ),
        'name_admin_bar'        => _x( 'Task', 'Add New on Toolbar', 'Taskbook' ),
        'add_new'               => __( 'Add New', 'Taskbook' ),
        'add_new_item'          => __( 'Add New Task', 'Taskbook' ),
        'new_item'              => __( 'New Task', 'Taskbook' ),
        'edit_item'             => __( 'Edit Task', 'Taskbook' ),
        'view_item'             => __( 'View Task', 'Taskbook' ),
        'all_items'             => __( 'All Tasks', 'Taskbook' ),
        'search_items'          => __( 'Search Tasks', 'Taskbook' ),
        'parent_item_colon'     => __( 'Parent Tasks:', 'Taskbook' ),
        'not_found'             => __( 'No Tasks found.', 'Taskbook' ),
        'not_found_in_trash'    => __( 'No Tasks found in Trash.', 'Taskbook' ),
        'featured_image'        => _x( 'Task Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Taskbook' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Taskbook' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Taskbook' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Taskbook' ),
        'archives'              => _x( 'Task archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Taskbook' ),
        'insert_into_item'      => _x( 'Insert into Task', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Taskbook' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Task', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Taskbook' ),
        'filter_items_list'     => _x( 'Filter Tasks list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Taskbook' ),
        'items_list_navigation' => _x( 'Tasks list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Taskbook' ),
        'items_list'            => _x( 'Tasks list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Taskbook' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'Task' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'Task', $args );
}

add_action( 'init', 'wpdocs_codex_Task_init' );
