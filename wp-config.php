define( 'WP_DEBUG', true ); 
if ( WP_DEBUG ) {
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
    @ini_set( 'display_errors', 0 );
}

define('DISALLOW_FILE_EDIT',TRUE);
