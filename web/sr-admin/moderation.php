<?php
/**
 * Comment Moderation Administration Screen.
 *
 * Redirects to edit-comments.php?comment_status=moderated.
 *
 * @package
 * @subpackage Administration
 */
require_once dirname( __DIR__ ) . '/sr-load.php';
wp_redirect( admin_url( 'edit-comments.php?comment_status=moderated' ) );
exit;
