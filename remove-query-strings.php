//* weblandtk.ir Remove Query String from Static Resources
function weblandtk_remove_css_js_ver( $src ) {
if( strpos( $src, '?ver=' ) )
$src = remove_query_arg( 'ver', $src );
return $src;
}
add_filter( 'style_loader_src', 'weblandtk_remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'weblandtk_remove_css_js_ver', 10, 2 ); 
