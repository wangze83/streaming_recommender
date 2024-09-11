<?php
/**
 * Core Administration API
 *
 * @package
 * @subpackage Administration
 * @since 2.3.0
 */

if ( ! defined( 'WP_ADMIN' ) ) {
	/*
	 * This file is being included from a file other than sr-admin/admin.php, so
	 * some setup was skipped. Make sure the admin message catalog is loaded since
	 * load_default_textdomain() will not have done so in this context.
	 */
	$admin_locale = get_locale();
	load_textdomain( 'default', WP_LANG_DIR . '/admin-' . $admin_locale . '.mo', $admin_locale );
	unset( $admin_locale );
}

/**  Administration Hooks */
require_once ABSPATH . 'sr-admin/includes/admin-filters.php';

/**  Bookmark Administration API */
require_once ABSPATH . 'sr-admin/includes/bookmark.php';

/**  Comment Administration API */
require_once ABSPATH . 'sr-admin/includes/comment.php';

/**  Administration File API */
require_once ABSPATH . 'sr-admin/includes/file.php';

/**  Image Administration API */
require_once ABSPATH . 'sr-admin/includes/image.php';

/**  Media Administration API */
require_once ABSPATH . 'sr-admin/includes/media.php';

/**  Import Administration API */
require_once ABSPATH . 'sr-admin/includes/import.php';

/**  Misc Administration API */
require_once ABSPATH . 'sr-admin/includes/misc.php';

/**  Misc Administration API */
require_once ABSPATH . 'sr-admin/includes/class-wp-privacy-policy-content.php';

/**  Options Administration API */
require_once ABSPATH . 'sr-admin/includes/options.php';

/**  Plugin Administration API */
require_once ABSPATH . 'sr-admin/includes/plugin.php';

/**  Post Administration API */
require_once ABSPATH . 'sr-admin/includes/post.php';

/**  Administration Screen API */
require_once ABSPATH . 'sr-admin/includes/class-wp-screen.php';
require_once ABSPATH . 'sr-admin/includes/screen.php';

/**  Taxonomy Administration API */
require_once ABSPATH . 'sr-admin/includes/taxonomy.php';

/**  Template Administration API */
require_once ABSPATH . 'sr-admin/includes/template.php';

/**  List Table Administration API and base class */
require_once ABSPATH . 'sr-admin/includes/class-wp-list-table.php';
require_once ABSPATH . 'sr-admin/includes/class-wp-list-table-compat.php';
require_once ABSPATH . 'sr-admin/includes/list-table.php';

/**  Theme Administration API */
require_once ABSPATH . 'sr-admin/includes/theme.php';

/**  Privacy Functions */
require_once ABSPATH . 'sr-admin/includes/privacy-tools.php';

/**  Privacy List Table classes. */
// Previously in sr-admin/includes/user.php. Need to be loaded for backward compatibility.
require_once ABSPATH . 'sr-admin/includes/class-wp-privacy-requests-table.php';
require_once ABSPATH . 'sr-admin/includes/class-wp-privacy-data-export-requests-list-table.php';
require_once ABSPATH . 'sr-admin/includes/class-wp-privacy-data-removal-requests-list-table.php';

/**  User Administration API */
require_once ABSPATH . 'sr-admin/includes/user.php';

/**  Site Icon API */
require_once ABSPATH . 'sr-admin/includes/class-wp-site-icon.php';

/**  Update Administration API */
require_once ABSPATH . 'sr-admin/includes/update.php';

/**  Deprecated Administration API */
require_once ABSPATH . 'sr-admin/includes/deprecated.php';

/**  Multisite support API */
if ( is_multisite() ) {
	require_once ABSPATH . 'sr-admin/includes/ms-admin-filters.php';
	require_once ABSPATH . 'sr-admin/includes/ms.php';
	require_once ABSPATH . 'sr-admin/includes/ms-deprecated.php';
}
