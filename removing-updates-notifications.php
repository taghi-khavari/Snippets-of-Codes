<?php 
// You can comment any of the filters below to be more specific about what you want to hide
// hide update notifications
function weblandtk_remove_core_updates(){
   global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','weblandtk_remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','weblandtk_remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','weblandtk_remove_core_updates'); //hide updates for all themes


function weblandtk_simple_role_caps()
{
   // gets the role object
   $role = get_role('administrator');

   $role->remove_cap('delete_plugins');
   $role->remove_cap('delete_themes');
   $role->remove_cap('install_plugins');
   $role->remove_cap('install_themes');
   $role->remove_cap('edit_plugins');
   $role->remove_cap('switch_themes');
}

// add or remove capabilities, priority must be after the initial role definition
add_action('init', 'weblandtk_simple_role_caps', 11);



function wpcodex_adjust_the_wp_menu() {
   $page = remove_submenu_page( 'index.php', 'update-core.php' );
   // $page[0] is the menu title
   // $page[1] is the minimum level or capability required
   // $page[2] is the URL to the item's file
}
add_action( 'admin_menu', 'wpcodex_adjust_the_wp_menu', 999 );
