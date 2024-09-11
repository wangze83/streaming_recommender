<?php

defined( 'ABSPATH' ) or die( 'Cannot access pages directly.' );

/* Uninstall */

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit(); // out!

delete_option('wp_nanobar_colour');

?>