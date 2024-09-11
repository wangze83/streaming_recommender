<?php
/**
 * Install plugin network administration panel.
 *
 * @package
 * @subpackage Multisite
 * @since 3.1.0
 */

if ( isset( $_GET['tab'] ) && ( 'plugin-information' === $_GET['tab'] ) ) {
	define( 'IFRAME_REQUEST', true );
}

/** Load  Administration Bootstrap */
require_once __DIR__ . '/admin.php';

require ABSPATH . 'sr-admin/plugin-install.php';
