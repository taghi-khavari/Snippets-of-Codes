<?php

add_action( 'admin_menu', 'weblandtk_remove_menu_pages' ,999);

function weblandtk_remove_menu_pages() {
  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  remove_menu_page( 'edit-comments.php' );          //Comments
  remove_menu_page( 'themes.php' );                 //Appearance
  remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  remove_menu_page( 'options-general.php' );        //Settings
  remove_menu_page('persian-wc');
  remove_menu_page('vc-general');

  
   remove_submenu_page( 'options-general.php','options-media.php' );
   remove_submenu_page( 'options-general.php','options-discussion.php' );
   remove_submenu_page( 'options-general.php', 'akismet-key-config' );
   remove_submenu_page( 'admin.php', 'wp_mailjet_options_campaigns_menu' );

}



function wpcodex_adjust_the_wp_menu() {
   $page = remove_submenu_page( 'index.php', 'update-core.php' );
   // $page[0] is the menu title
   // $page[1] is the minimum level or capability required
   // $page[2] is the URL to the item's file
}
add_action( 'admin_menu', 'wpcodex_adjust_the_wp_menu', 999 );
