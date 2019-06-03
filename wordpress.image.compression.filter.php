<?php	
//default is 82 in wordpress
add_filter('jpeg_quality', function($arg){return 90;});
