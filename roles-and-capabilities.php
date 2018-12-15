<?php

// ** Adding a role **
function weblandtk_simple_role()
{
//add_role( string $role, string $display_name, array $capabilities = array() )
    add_role(
        'simple_role',
        'Simple Role',
        [
            'read'         => true,
            'edit_posts'   => true,
            'upload_files' => true,
        ]
    );
}
 
// add the simple_role
add_action('init', 'weblandtk_simple_role');



//** removing a role **

function weblandtk_simple_role_remove()
{
    remove_role('simple_role');
}
 
// remove the simple_role
add_action('init', 'weblandtk_simple_role_remove');




//** Adding Capabilities to a role **
// see this link for default capabilities
//https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table

function weblandtk_simple_role_caps()
{
    // gets the simple_role role object
    $role = get_role('simple_role');
 
    // add a new capability
    $role->add_cap('edit_others_posts', true);
}
 
// add simple_role capabilities, priority must be after the initial role definition
add_action('init', 'weblandtk_simple_role_caps', 11);


// ** Removing Capabilites **
// The implementation is similar to Adding Capabilities with the difference being the use of remove_cap() method for the role object.


//this is a master admin that has all capabalities of a super admin role , if you want to create a role just change the capabilities



function weblandtk_simple_role()
{
//add_role( string $role, string $display_name, array $capabilities = array() )
    add_role(
        'weblandtk_admin',
        'Weblandtk Admin',
        [
            //Subscriber
            'read'                     => true,

            //Contributor
            'edit_posts'               => true,
            'upload_files'             => true,

            'delete_posts'             => true,
            'delete_published_posts'   => true,
            'publish_posts'            => true,

            'edit_published_posts'     => true,

            //Editor Capabilities
            'unfiltered_html'          => true,
            'read_private_pages'       => true,

            'edit_private_pages'       => true,
            'delete_private_pages'     => true,
            'read_private_posts'       => true,
            'edit_private_posts'       => true,
            'delete_private_posts'     => true,
            'delete_others_posts'      => true,

            'delete_published_pages'   => true,
            'delete_others_pages'      => true,
            'delete_pages'             => true,
            'publish_pages'            => true,

            'edit_published_pages'     => true,
            'edit_others_pages'        => true,
            'edit_pages'               => true,

            'edit_others_posts'        => true,
            'manage_links'             => true,
            'manage_categories'        => true,

            'moderate_comments'        => true,

            //Administrator Capabilities
            'delete_site'              => true,
            'customize'                => true,

            'edit_dashboard'           => true,
            'update_themes'            => true,
            'update_plugins'           => true,

            'update_core'              => true,
            'switch_themes'            => true,
            'remove_users'             => true,

            'promote_users'            => true,
            'manage_options'           => true,
            'list_users'               => true,
            'install_themes'           => true,
            'install_plugins'          => true,


            'import'                   => true,
            'export'                   => true,
            'edit_users'               => true,
            'edit_themes'              => true,

            'edit_theme_options'       => true,
            'edit_plugins'             => true,
            'edit_files'               => true,

            'delete_users'             => true,
            'delete_themes'            => true,
            'delete_plugins'           => true,

            'create_users'             => true,
            'activate_plugins'         => true,

            //Super Admin Capabilities
            'setup_network'            => true,
            'upgrade_network'     => true,
            'upload_themes'        => true,
            'upload_plugins'               => true,

            'manage_network_options'        => true,
            'manage_network_themes'             => true,
            'manage_network_plugins'        => true,

            'manage_network_users'        => true,
            'manage_sites'              => true,
            'manage_network'                => true,

            'delete_sites'           => true,
            'create_sites'            => true

        ]
    );
}

// add the simple_role
add_action('init', 'weblandtk_simple_role');


