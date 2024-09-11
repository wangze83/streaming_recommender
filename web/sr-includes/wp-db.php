<?php
/**
 *  database access abstraction class.
 *
 * This file is deprecated, use 'sr-includes/class-wpdb.php' instead.
 *
 * @deprecated 6.1.0
 * @package
 */

if ( function_exists( '_deprecated_file' ) ) {
	// Note: WPINC may not be defined yet, so 'sr-includes' is used here.
	_deprecated_file( basename( __FILE__ ), '6.1.0', 'sr-includes/class-wpdb.php' );
}

/** wpdb class */
require_once __DIR__ . '/class-wpdb.php';
