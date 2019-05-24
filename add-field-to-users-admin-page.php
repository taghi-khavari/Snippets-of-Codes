<?php



// Hooks near the bottom of profile page (if current user) 
add_action('show_user_profile', 'custom_user_profile_fields');

// Hooks near the bottom of the profile page (if not current user) 
add_action('edit_user_profile', 'custom_user_profile_fields');

// @param WP_User $user
function custom_user_profile_fields($user)
{
  ?>
  <table class="form-table">
    <tr>
      <th>
        <label for="code"><?php _e('Taghi Field'); ?></label>
      </th>
      <td>
        <input type="text" name="code" id="code" value="<?php echo esc_attr(get_the_author_meta('code', $user->ID)); ?>" class="regular-text" />
      </td>
    </tr>
  </table>
<?php
}


// Hook is used to save custom fields that have been added to the WordPress profile page (if current user) 
add_action('personal_options_update', 'update_extra_profile_fields');

// Hook is used to save custom fields that have been added to the WordPress profile page (if not current user) 
add_action('edit_user_profile_update', 'update_extra_profile_fields');

function update_extra_profile_fields($user_id)
{
  if (current_user_can('edit_user', $user_id))
    update_user_meta($user_id, 'code', $_POST['code']);
}
