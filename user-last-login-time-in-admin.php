
//last time user logged in

function user_last_login($user_login, $user)
{
	update_user_meta($user->ID, 'wt_last_login', time());
}
add_action('wp_login', 'user_last_login', 10, 2);


add_filter('manage_users_columns', 'weblandtk_filter_posts_columns');
function weblandtk_filter_posts_columns($columns)
{
	$columns['wt_last_login'] = __('آخرین ورود');
	return $columns;
}

add_filter('manage_users_custom_column' , 'wt_last_column_value' , 10 , 3);

function wt_last_column_value( $value , $column , $user_id){
	$wt_last_login = get_user_meta( $user_id , 'wt_last_login');
	if('wt_last_login' == $column){
		if($wt_last_login[0]){
			return get_date_from_gmt(date_i18n('Y-m-d H:i:s', $wt_last_login[0]));
		}else{
			return 'ثبت نشده';
		}
	}
}
