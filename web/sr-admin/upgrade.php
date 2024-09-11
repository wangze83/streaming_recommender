<?php
/**
 * Upgrade  Page.
 *
 * @package
 * @subpackage Administration
 */

/**
 * We are upgrading .
 *
 * @since 1.5.1
 * @var bool
 */
define( 'WP_INSTALLING', true );

/** Load  Bootstrap */
require dirname( __DIR__ ) . '/sr-load.php';

nocache_headers();

require_once ABSPATH . 'sr-admin/includes/upgrade.php';

delete_site_transient( 'update_core' );

if ( isset( $_GET['step'] ) ) {
	$step = $_GET['step'];
} else {
	$step = 0;
}

// Do it. No output.
if ( 'upgrade_db' === $step ) {
	wp_upgrade();
	die( '0' );
}

/**
 * @global string $wp_version             The  version string.
 * @global string $required_php_version   The required PHP version string.
 * @global string $required_mysql_version The required MySQL version string.
 * @global wpdb   $wpdb                    database abstraction object.
 */
global $wp_version, $required_php_version, $required_mysql_version, $wpdb;

$step = (int) $step;

$php_version   = PHP_VERSION;
$mysql_version = $wpdb->db_version();
$php_compat    = version_compare( $php_version, $required_php_version, '>=' );
if ( file_exists( WP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) ) {
	$mysql_compat = true;
} else {
	$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );
}

header( 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' ) );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
	<meta name="robots" content="noindex,nofollow" />
	<title><?php _e( ' &rsaquo; Update' ); ?></title>
	<?php wp_admin_css( 'install', true ); ?>
</head>
<body class="wp-core-ui">

<?php if ( (int) get_option( 'db_version' ) === $wp_db_version || ! is_blog_installed() ) : ?>

<h1><?php _e( 'No Update Required' ); ?></h1>
<p><?php _e( 'Your  database is already up to date!' ); ?></p>
<p class="step"><a class="button button-large" href="<?php echo get_option( 'home' ); ?>/"><?php _e( 'Continue' ); ?></a></p>

	<?php
elseif ( ! $php_compat || ! $mysql_compat ) :
	$version_url = sprintf(
		/* translators: %s:  version. */
		esc_url( __( '' ) ),
		sanitize_title( $wp_version )
	);

	$php_update_message = '</p><p>' . sprintf(
		/* translators: %s: URL to Update PHP page. */
		__( '<a href="%s">Learn more about updating PHP</a>.' ),
		esc_url( wp_get_update_php_url() )
	);

	$annotation = wp_get_update_php_annotation();

	if ( $annotation ) {
		$php_update_message .= '</p><p><em>' . $annotation . '</em>';
	}

	if ( ! $mysql_compat && ! $php_compat ) {
		$message = sprintf(
			/* translators: 1: URL to  release notes, 2:  version number, 3: Minimum required PHP version number, 4: Minimum required MySQL version number, 5: Current PHP version number, 6: Current MySQL version number. */
			__( 'You cannot update because <a href="%1$s"> %2$s</a> requires PHP version %3$s or higher and MySQL version %4$s or higher. You are running PHP version %5$s and MySQL version %6$s.' ),
			$version_url,
			$wp_version,
			$required_php_version,
			$required_mysql_version,
			$php_version,
			$mysql_version
		) . $php_update_message;
	} elseif ( ! $php_compat ) {
		$message = sprintf(
			/* translators: 1: URL to  release notes, 2:  version number, 3: Minimum required PHP version number, 4: Current PHP version number. */
			__( 'You cannot update because <a href="%1$s"> %2$s</a> requires PHP version %3$s or higher. You are running version %4$s.' ),
			$version_url,
			$wp_version,
			$required_php_version,
			$php_version
		) . $php_update_message;
	} elseif ( ! $mysql_compat ) {
		$message = sprintf(
			/* translators: 1: URL to  release notes, 2:  version number, 3: Minimum required MySQL version number, 4: Current MySQL version number. */
			__( 'You cannot update because <a href="%1$s"> %2$s</a> requires MySQL version %3$s or higher. You are running version %4$s.' ),
			$version_url,
			$wp_version,
			$required_mysql_version,
			$mysql_version
		);
	}

	echo '<p>' . $message . '</p>';
	?>
	<?php
else :
	switch ( $step ) :
		case 0:
			$goback = wp_get_referer();
			if ( $goback ) {
				$goback = sanitize_url( $goback );
				$goback = urlencode( $goback );
			}
			?>
	<h1><?php _e( 'Database Update Required' ); ?></h1>
<p><?php _e( ' has been updated! Next and final step is to update your database to the newest version.' ); ?></p>
<p><?php _e( 'The database update process may take a little while, so please be patient.' ); ?></p>
<p class="step"><a class="button button-large button-primary" href="upgrade.php?step=1&amp;backto=<?php echo $goback; ?>"><?php _e( 'Update  Database' ); ?></a></p>
			<?php
			break;
		case 1:
			wp_upgrade();

			$backto = ! empty( $_GET['backto'] ) ? wp_unslash( urldecode( $_GET['backto'] ) ) : __get_option( 'home' ) . '/';
			$backto = esc_url( $backto );
			$backto = wp_validate_redirect( $backto, __get_option( 'home' ) . '/' );
			?>
	<h1><?php _e( 'Update Complete' ); ?></h1>
	<p><?php _e( 'Your  database has been successfully updated!' ); ?></p>
	<p class="step"><a class="button button-large" href="<?php echo $backto; ?>"><?php _e( 'Continue' ); ?></a></p>
			<?php
			break;
endswitch;
endif;
?>
</body>
</html>