function custom_enqueue_script(){
    wp_enqueue_script('popper',plugin_dir_url(__FILE__).'js/popper.min.js',array('jquery'));
    wp_enqueue_script('bootstrapjs',plugin_dir_url(__FILE__).'js/bootstrap.js',array('jquery'));
    wp_enqueue_style('bootstrapcss',plugin_dir_url(__FILE__).'css/bootstrap.min.css');
}

add_action('wp_enqueue_scripts','custom_enqueue_script');
