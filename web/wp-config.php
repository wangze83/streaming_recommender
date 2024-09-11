<?php
/**
 * The base configuration for
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 *
 * @package
 */

// IMPORTANT: this file needs to stay in-sync with https://github.com///blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com///blob/f27cb65e1ef25d11b535695a660e7282b98eb742/sr-admin/setup-config.php#L356-L392)

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
	function getenv_docker($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for  */
define( 'DB_NAME', getenv_docker('SR_DB_NAME', 'streaming_recommender_db') );

/** Database username */
define( 'DB_USER', getenv_docker('SR_DB_USER', 'example username') );

/** Database password */
define( 'DB_PASSWORD', getenv_docker('SR_DB_PASSWORD', 'example password') );

/**
 * Docker image fallback values above are sourced from the official  installation wizard:
 * https://github.com///blob/1356f6537220ffdc32b9dad2a6cdbe2d010b7a88/sr-admin/setup-config.php#L224-L238
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database hostname */
define( 'DB_HOST', getenv_docker('SR_DB_HOST', 'mysql') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('SR_DB_CHARSET', 'utf8') );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('SR_DB_COLLATE', '') );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ .org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'd2c5acdfe851b41a130ca172d7450a3f0480fe6b') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  'af0bd9b047cf960601e86274926ffd1e72f0b275') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    'a9b6a1e570ca155756c11f6d0c3d9599a49d52e6') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        'c06d00de41bcc529be1b0685112fe1adde7b1217') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        'dc6e197a68737051d7a34560a19eda4a357042c3') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'c7ea2528680adca6eef11591b980f97df03520d1') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   'f283a17b747df9a552aab79d647a7b55b3a936aa') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       '1819dc313a5f1bafa19757b87fbddb1ca130d16a') );
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 *  database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

/**
 * For developers:  debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 */
define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert  of that fact
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
	eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the  directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up  vars and included files. */
require_once ABSPATH . 'sr-settings.php';
