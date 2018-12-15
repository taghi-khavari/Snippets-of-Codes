<?php
//Hide all WordPress update notifications in dashboard


// hide update notifications
function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes

//with the code above we can hide update notifications and for removing the update-core.php page we need to use this code


function wpcodex_adjust_the_wp_menu() {
    $page = remove_submenu_page( 'index.php', 'update-core.php' );
    // $page[0] is the menu title
    // $page[1] is the minimum level or capability required
    // $page[2] is the URL to the item's file
}
add_action( 'admin_menu', 'wpcodex_adjust_the_wp_menu', 999 );


//or another way is to unset submenu pages like below

function remove_submenus() {
  global $submenu;
 
  //Dashboard menu
  unset($submenu['index.php'][10]); // Removes Updates
  //Posts menu
  unset($submenu['edit.php'][5]); // Leads to listing of available posts to edit
  unset($submenu['edit.php'][10]); // Add new post
  unset($submenu['edit.php'][15]); // Remove categories
  unset($submenu['edit.php'][16]); // Removes Post Tags
  //Media Menu
  unset($submenu['upload.php'][5]); // View the Media library
  unset($submenu['upload.php'][10]); // Add to Media library
  //Links Menu
  unset($submenu['link-manager.php'][5]); // Link manager
  unset($submenu['link-manager.php'][10]); // Add new link
  unset($submenu['link-manager.php'][15]); // Link Categories
  //Pages Menu
  unset($submenu['edit.php?post_type=page'][5]); // The Pages listing
  unset($submenu['edit.php?post_type=page'][10]); // Add New page
  //Appearance Menu
  unset($submenu['themes.php'][5]); // Removes 'Themes'
  unset($submenu['themes.php'][7]); // Widgets
  unset($submenu['themes.php'][15]); // Removes Theme Installer tab
  //Plugins Menu
  unset($submenu['plugins.php'][5]); // Plugin Manager
  unset($submenu['plugins.php'][10]); // Add New Plugins
  unset($submenu['plugins.php'][15]); // Plugin Editor
  //Users Menu
  unset($submenu['users.php'][5]); // Users list
  unset($submenu['users.php'][10]); // Add new user
  unset($submenu['users.php'][15]); // Edit your profile
  //Tools Menu
  unset($submenu['tools.php'][5]); // Tools area
  unset($submenu['tools.php'][10]); // Import
  unset($submenu['tools.php'][15]); // Export
  unset($submenu['tools.php'][20]); // Upgrade plugins and core files
  //Settings Menu
  unset($submenu['options-general.php'][10]); // General Options
  unset($submenu['options-general.php'][15]); // Writing
  unset($submenu['options-general.php'][20]); // Reading
  unset($submenu['options-general.php'][25]); // Discussion
  unset($submenu['options-general.php'][30]); // Media
  unset($submenu['options-general.php'][35]); // Privacy
  unset($submenu['options-general.php'][40]); // Permalinks
  unset($submenu['options-general.php'][45]); // Misc
 
}
add_action('admin_menu', 'remove_submenus');
