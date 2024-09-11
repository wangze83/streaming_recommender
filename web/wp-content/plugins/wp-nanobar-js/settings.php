<?php

defined( 'ABSPATH' ) or die( 'Cannot access pages directly.' );

add_action( 'admin_menu', 'wpnb_add_admin_menu' );
add_action( 'admin_menu', 'wpnb_settings_init' );

function wpnb_add_admin_menu(  ) { 
	add_submenu_page( 'tools.php', 'WP Nanobar.js', 'WP Nanobar.js', 'manage_options', 'wp_nanobar.js', 'wpnb_options_page' );
}

function wpnb_settings_init(  ) { 
	register_setting( 'wpnbPluginPage', 'wpnb_settings' );
}

function wpnb_add_setting(){

	add_settings_section('wp_nanobar_section', '', '', 'wpnbPluginPage');

	add_settings_field( "wp_nanobar_colour", '<label for="wp_nanobar_colour">Color Code</label>', "wp_nanobar_custom_color_setting", "wpnbPluginPage", "wp_nanobar_section" );

	register_setting( 'wpnbPluginPage', 'wp_nanobar_colour' );

}
add_action( 'admin_init', 'wpnb_add_setting' );


function wpnb_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h1>WP Nanobar.js</h1>

		<?php
		settings_fields( 'wpnbPluginPage' );
		do_settings_sections( 'wpnbPluginPage' );
		submit_button();
		?>

	</form>
	<?php
}

function wp_nanobar_custom_color_setting(){
	?>
    	<input id="wp_nanobar_colour" name="wp_nanobar_colour" type="text" value="<?php echo esc_attr( get_option('wp_nanobar_colour') ); ?>">
    	<p class="description">Enter a colour for the Nanobar. If left empty, the default colour (black / #000) will be used.<br />Get your own custom colour using the <a href="https://www.google.com/search?q=color+picker+online" target="blank">Google Color Picker</a>.</p>
    <?php
}

?>