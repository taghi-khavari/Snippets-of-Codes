
add_action( 'after_setup_theme', 'weblandtk_custom_image_size' );
function weblandtk_custom_image_size() {
  //  add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
    add_image_size( 'homepage-thumb', 207, 166, true ); // (cropped)
}


// Register the useful image size for use in Add Media modal
add_filter( 'image_size_names_choose', 'weblandtk_custom_size' );
function weblandtk_custom_size( $sizes ) {
    return array_merge( $sizes, array(
        'homepage-thumb' => __( 'Homepage thumbnail' )
    ) );
}
