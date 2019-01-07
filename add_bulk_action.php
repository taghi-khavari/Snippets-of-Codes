<?php 

/*
To add an option in the Bulk Actions dropdown HTML element, register a callback on the bulk_actions-{screen_id} filter 
that adds the new option onto the array. Replace {screen_id} with the ID of the admin screen to offer the bulk action on.
*/
add_filter( 'bulk_actions-edit-post', 'weblandtk_register_bulk_actions' );
 
function weblandtk_register_bulk_actions($bulk_actions) {
  $bulk_actions['email_to_eric'] = __( 'Email to Eric', 'email_to_eric');
  return $bulk_actions;
}

//Handling the form submission

add_filter( 'handle_bulk_actions-edit-post', 'my_bulk_action_handler', 10, 3 );
 
function my_bulk_action_handler( $redirect_to, $doaction, $post_ids ) {
  if ( $doaction !== 'email_to_eric' ) {
    return $redirect_to;
  }
  foreach ( $post_ids as $post_id ) {
    // Perform action for each post.
  }
  $redirect_to = add_query_arg( 'bulk_emailed_posts', count( $post_ids ), $redirect_to );
  return $redirect_to;
}

//Showing notices

add_action( 'admin_notices', 'my_bulk_action_admin_notice' );
 
function my_bulk_action_admin_notice() {
  if ( ! empty( $_REQUEST['bulk_emailed_posts'] ) ) {
    $emailed_count = intval( $_REQUEST['bulk_emailed_posts'] );
    printf( '<div id="message" class="updated fade">' .
      _n( 'Emailed %s post to Eric.',
        'Emailed %s posts to Eric.',
        $emailed_count,
        'email_to_eric'
      ) . '</div>', $emailed_count );
  }
}
