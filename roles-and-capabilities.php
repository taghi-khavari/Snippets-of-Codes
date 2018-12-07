<?php

// ** Adding a role **
function wporg_simple_role()
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
add_action('init', 'wporg_simple_role');



//** removing a role **

function wporg_simple_role_remove()
{
    remove_role('simple_role');
}
 
// remove the simple_role
add_action('init', 'wporg_simple_role_remove');




//** Adding Capabilities to a role **
// see this link for default capabilities
//https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table

function wporg_simple_role_caps()
{
    // gets the simple_role role object
    $role = get_role('simple_role');
 
    // add a new capability
    $role->add_cap('edit_others_posts', true);
}
 
// add simple_role capabilities, priority must be after the initial role definition
add_action('init', 'wporg_simple_role_caps', 11);


// ** Removing Capabilites **
// The implementation is similar to Adding Capabilities with the difference being the use of remove_cap() method for the role object.




