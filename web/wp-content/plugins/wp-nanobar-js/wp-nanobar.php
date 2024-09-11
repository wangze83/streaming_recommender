<?php
/*
Plugin Name: WP Nanobar.js
Description: Adds nanobar.js (by Jacobo Tabernero) to your WordPress-website.
Version: 1.0
Author: Wouter Postma
Author URI: https://wouterpostma.nl
*/

defined( 'ABSPATH' ) or die( 'Cannot access pages directly.' );

include 'settings.php';

function wpnanobarjs_loading_bar_include_js(){
	wp_enqueue_script( 'wpnanobarjs-loading-bar-js', plugins_url( '/js/nanobar.js', __FILE__ ), array(), false, false);
}
add_action('wp_enqueue_scripts', 'wpnanobarjs_loading_bar_include_js');



function wpnanobar_load_script_info(){

	if ( get_option('wp_nanobar_colour') ){

		if( preg_match('/(#)/', get_option('wp_nanobar_colour') ) ){
			$color = str_replace( array(',', '.'), "", get_option('wp_nanobar_colour') );
		}
		else{
			$color_code = str_replace( array(',', '.'), "", get_option('wp_nanobar_colour') );
			$color = '#'.$color_code;
		}
		
	}
	else{
		$color = '#000';
	}

	?>
		<script type="text/javascript">
			var options = { id:'wp-nanobar' };
			var nanobar = new Nanobar( options );
			nanobar.go(100);
		</script>
		<style> .nanobar .bar { background: <?php echo $color; ?>;} </style>
	<?php

}
add_action('wp_footer', 'wpnanobar_load_script_info');


?>