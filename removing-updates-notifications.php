<?php 
// You can comment any of the filters below to be more specific about what you want to hide
// hide update notifications
function weblandtk_remove_core_updates(){
   global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','weblandtk_remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','weblandtk_remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','weblandtk_remove_core_updates'); //hide updates for all themes
