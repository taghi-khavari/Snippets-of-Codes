
//Customizing Dashboard

function weblandtk_dashboard_widgets() {
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick Press
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );  // Recent Drafts
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );   // WordPress blog
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );   // Other WordPress News
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );   // Other WordPress News

    // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}
add_action( 'admin_init', 'weblandtk_dashboard_widgets' );
remove_action( 'welcome_panel','wp_welcome_panel');
function remove_plugin_metaboxes(){
    // Only run if the user is an Author or lower.
    //if ( ! current_user_can( 'delete_others_pages' ) ) {
        // Remove Edit Flow Editorial Metadata
        remove_meta_box( 'so-dashboard-news', 'dashboard', 'normal' );
    //}
}
add_action( 'do_meta_boxes', 'remove_plugin_metaboxes' );


function weblandtk_admin_footer(){
    echo 'Created By <a href="http://weblandtk.ir">Weblandtk</a>';
}

add_filter('admin_footer_text','weblandtk_admin_footer');


function weblandtk_footer_version(){
    remove_filter('update_footer','core_update_footer');
}

add_action('admin_menu','weblandtk_footer_version');


function change_login_logo(){
    ?>
    <style>
        #login h1 a{
            background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/images/final-black-logo.png");
            padding-bottom:30px;
        }
    </style>
<?php
}

add_action('login_enqueue_scripts','change_login_logo');


//--------------------------------
// Change the login logo URL and title
//--------------------------------

function change_login_logo_url(){
    return home_url();
}

function change_login_logo_url_title(){
    return "Hotel Parmida";
}
remove_filter('login_headertitle', 'ztjalali_login_text', 111);
add_filter('login_headerurl','change_login_logo_url');
add_filter('login_headertitle','change_login_logo_url_title');


