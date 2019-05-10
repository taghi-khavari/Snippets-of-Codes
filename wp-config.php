 // Enable WP_DEBUG mode
define( 'WP_DEBUG', true ); 

if ( WP_DEBUG ) {
    // Enable Debug logging to the /wp-content/debug.log file
    define( 'WP_DEBUG_LOG', true );

    // Disable display of errors and warnings 
    define( 'WP_DEBUG_DISPLAY', false );

    // Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
    @ini_set( 'display_errors', 0 );
}

define('DISALLOW_FILE_EDIT',TRUE);
