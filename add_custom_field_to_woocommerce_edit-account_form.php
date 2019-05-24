<?php

// Add the custom field "code"
add_action('woocommerce_edit_account_form', 'add_favorite_color_to_edit_account_form');
function add_favorite_color_to_edit_account_form()
{
  $user = wp_get_current_user();
  ?>
  <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label for="favorite_color"><?php _e('Taghi Field', 'woocommerce'); ?>
      <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="code" id="code" value="<?php echo esc_attr($user->code); ?>" />
  </p>
<?php
}

// Save the custom field 'code' 
add_action('woocommerce_save_account_details', 'save_code_account_details', 12, 1);
function save_code_account_details($user_id)
{
  // For Favorite color
  if (isset($_POST['code']))
    update_user_meta($user_id, 'code', sanitize_text_field($_POST['code']));

  // For Billing email (added related to your comment)
  if (isset($_POST['account_email']))
    update_user_meta($user_id, 'billing_email', sanitize_text_field($_POST['account_email']));
}


