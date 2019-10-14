<?php
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect($redirect_to, $request, $user)
{
    //is there a user to check?
    if (isset($user->roles) && is_array($user->roles)) {
        //check for admins
        if (in_array('subscriber', $user->roles)) {
            // redirect them to the default place
            return home_url('/wt-user');
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('admin_init', 'disable_dashboard'); 
function disable_dashboard() { 
    if (!is_user_logged_in()) { 
        return null; 
    } if (!current_user_can('administrator') && is_admin()) { 
        wp_redirect(home_url()); 
        exit; 
    } 
}
