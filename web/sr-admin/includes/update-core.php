<?php
/**
 *  core upgrade functionality.
 *
 * @package
 * @subpackage Administration
 * @since 2.7.0
 */

/**
 * Stores files to be deleted.
 *
 * Bundled theme files should not be included in this list.
 *
 * @since 2.7.0
 *
 * @global array $_old_files
 * @var array
 * @name $_old_files
 */
global $_old_files;

$_old_files = array(
	// 2.0
	'sr-admin/import-b2.php',
	'sr-admin/import-blogger.php',
	'sr-admin/import-greymatter.php',
	'sr-admin/import-livejournal.php',
	'sr-admin/import-mt.php',
	'sr-admin/import-rss.php',
	'sr-admin/import-textpattern.php',
	'sr-admin/quicktags.js',
	'wp-images/fade-butt.png',
	'wp-images/get-firefox.png',
	'wp-images/header-shadow.png',
	'wp-images/smilies',
	'wp-images/wp-small.png',
	'wp-images/wpminilogo.png',
	'wp.php',
	// 2.0.8
	'sr-includes/js/tinymce/plugins/inlinepopups/readme.txt',
	// 2.1
	'sr-admin/edit-form-ajax-cat.php',
	'sr-admin/execute-pings.php',
	'sr-admin/inline-uploading.php',
	'sr-admin/link-categories.php',
	'sr-admin/list-manipulation.js',
	'sr-admin/list-manipulation.php',
	'sr-includes/comment-functions.php',
	'sr-includes/feed-functions.php',
	'sr-includes/functions-compat.php',
	'sr-includes/functions-formatting.php',
	'sr-includes/functions-post.php',
	'sr-includes/js/dbx-key.js',
	'sr-includes/js/tinymce/plugins/autosave/langs/cs.js',
	'sr-includes/js/tinymce/plugins/autosave/langs/sv.js',
	'sr-includes/links.php',
	'sr-includes/pluggable-functions.php',
	'sr-includes/template-functions-author.php',
	'sr-includes/template-functions-category.php',
	'sr-includes/template-functions-general.php',
	'sr-includes/template-functions-links.php',
	'sr-includes/template-functions-post.php',
	'sr-includes/wp-l10n.php',
	// 2.2
	'sr-admin/cat-js.php',
	'sr-admin/import/b2.php',
	'sr-includes/js/autosave-js.php',
	'sr-includes/js/list-manipulation-js.php',
	'sr-includes/js/wp-ajax-js.php',
	// 2.3
	'sr-admin/admin-db.php',
	'sr-admin/cat.js',
	'sr-admin/categories.js',
	'sr-admin/custom-fields.js',
	'sr-admin/dbx-admin-key.js',
	'sr-admin/edit-comments.js',
	'sr-admin/install-rtl.css',
	'sr-admin/install.css',
	'sr-admin/upgrade-schema.php',
	'sr-admin/upload-functions.php',
	'sr-admin/upload-rtl.css',
	'sr-admin/upload.css',
	'sr-admin/upload.js',
	'sr-admin/users.js',
	'sr-admin/widgets-rtl.css',
	'sr-admin/widgets.css',
	'sr-admin/xfn.js',
	'sr-includes/js/tinymce/license.html',
	// 2.5
	'sr-admin/css/upload.css',
	'sr-admin/images/box-bg-left.gif',
	'sr-admin/images/box-bg-right.gif',
	'sr-admin/images/box-bg.gif',
	'sr-admin/images/box-butt-left.gif',
	'sr-admin/images/box-butt-right.gif',
	'sr-admin/images/box-butt.gif',
	'sr-admin/images/box-head-left.gif',
	'sr-admin/images/box-head-right.gif',
	'sr-admin/images/box-head.gif',
	'sr-admin/images/heading-bg.gif',
	'sr-admin/images/login-bkg-bottom.gif',
	'sr-admin/images/login-bkg-tile.gif',
	'sr-admin/images/notice.gif',
	'sr-admin/images/toggle.gif',
	'sr-admin/includes/upload.php',
	'sr-admin/js/dbx-admin-key.js',
	'sr-admin/js/link-cat.js',
	'sr-admin/profile-update.php',
	'sr-admin/templates.php',
	'sr-includes/images/wlw/WpComments.png',
	'sr-includes/images/wlw/WpIcon.png',
	'sr-includes/images/wlw/WpWatermark.png',
	'sr-includes/js/dbx.js',
	'sr-includes/js/fat.js',
	'sr-includes/js/list-manipulation.js',
	'sr-includes/js/tinymce/langs/en.js',
	'sr-includes/js/tinymce/plugins/autosave/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/autosave/langs',
	'sr-includes/js/tinymce/plugins/directionality/images',
	'sr-includes/js/tinymce/plugins/directionality/langs',
	'sr-includes/js/tinymce/plugins/inlinepopups/css',
	'sr-includes/js/tinymce/plugins/inlinepopups/images',
	'sr-includes/js/tinymce/plugins/inlinepopups/jscripts',
	'sr-includes/js/tinymce/plugins/paste/images',
	'sr-includes/js/tinymce/plugins/paste/jscripts',
	'sr-includes/js/tinymce/plugins/paste/langs',
	'sr-includes/js/tinymce/plugins/spellchecker/classes/HttpClient.class.php',
	'sr-includes/js/tinymce/plugins/spellchecker/classes/TinyGoogleSpell.class.php',
	'sr-includes/js/tinymce/plugins/spellchecker/classes/TinyPspell.class.php',
	'sr-includes/js/tinymce/plugins/spellchecker/classes/TinyPspellShell.class.php',
	'sr-includes/js/tinymce/plugins/spellchecker/css/spellchecker.css',
	'sr-includes/js/tinymce/plugins/spellchecker/images',
	'sr-includes/js/tinymce/plugins/spellchecker/langs',
	'sr-includes/js/tinymce/plugins/spellchecker/tinyspell.php',
	'sr-includes/js/tinymce/plugins/wordpress/images',
	'sr-includes/js/tinymce/plugins/wordpress/langs',
	'sr-includes/js/tinymce/plugins/wordpress/wordpress.css',
	'sr-includes/js/tinymce/plugins/wphelp',
	'sr-includes/js/tinymce/themes/advanced/css',
	'sr-includes/js/tinymce/themes/advanced/images',
	'sr-includes/js/tinymce/themes/advanced/jscripts',
	'sr-includes/js/tinymce/themes/advanced/langs',
	// 2.5.1
	'sr-includes/js/tinymce/tiny_mce_gzip.php',
	// 2.6
	'sr-admin/bookmarklet.php',
	'sr-includes/js/jquery/jquery.dimensions.min.js',
	'sr-includes/js/tinymce/plugins/wordpress/popups.css',
	'sr-includes/js/wp-ajax.js',
	// 2.7
	'sr-admin/css/press-this-ie-rtl.css',
	'sr-admin/css/press-this-ie.css',
	'sr-admin/css/upload-rtl.css',
	'sr-admin/edit-form.php',
	'sr-admin/images/comment-pill.gif',
	'sr-admin/images/comment-stalk-classic.gif',
	'sr-admin/images/comment-stalk-fresh.gif',
	'sr-admin/images/comment-stalk-rtl.gif',
	'sr-admin/images/del.png',
	'sr-admin/images/gear.png',
	'sr-admin/images/media-button-gallery.gif',
	'sr-admin/images/media-buttons.gif',
	'sr-admin/images/postbox-bg.gif',
	'sr-admin/images/tab.png',
	'sr-admin/images/tail.gif',
	'sr-admin/js/forms.js',
	'sr-admin/js/upload.js',
	'sr-admin/link-import.php',
	'sr-includes/images/audio.png',
	'sr-includes/images/css.png',
	'sr-includes/images/default.png',
	'sr-includes/images/doc.png',
	'sr-includes/images/exe.png',
	'sr-includes/images/html.png',
	'sr-includes/images/js.png',
	'sr-includes/images/pdf.png',
	'sr-includes/images/swf.png',
	'sr-includes/images/tar.png',
	'sr-includes/images/text.png',
	'sr-includes/images/video.png',
	'sr-includes/images/zip.png',
	'sr-includes/js/tinymce/tiny_mce_config.php',
	'sr-includes/js/tinymce/tiny_mce_ext.js',
	// 2.8
	'sr-admin/js/users.js',
	'sr-includes/js/swfupload/plugins/swfupload.documentready.js',
	'sr-includes/js/swfupload/plugins/swfupload.graceful_degradation.js',
	'sr-includes/js/swfupload/swfupload_f9.swf',
	'sr-includes/js/tinymce/plugins/autosave',
	'sr-includes/js/tinymce/plugins/paste/css',
	'sr-includes/js/tinymce/utils/mclayer.js',
	'sr-includes/js/tinymce/wordpress.css',
	// 2.8.5
	'sr-admin/import/btt.php',
	'sr-admin/import/jkw.php',
	// 2.9
	'sr-admin/js/page.dev.js',
	'sr-admin/js/page.js',
	'sr-admin/js/set-post-thumbnail-handler.dev.js',
	'sr-admin/js/set-post-thumbnail-handler.js',
	'sr-admin/js/slug.dev.js',
	'sr-admin/js/slug.js',
	'sr-includes/gettext.php',
	'sr-includes/js/tinymce/plugins/wordpress/js',
	'sr-includes/streams.php',
	// MU
	'README.txt',
	'htaccess.dist',
	'index-install.php',
	'sr-admin/css/mu-rtl.css',
	'sr-admin/css/mu.css',
	'sr-admin/images/site-admin.png',
	'sr-admin/includes/mu.php',
	'sr-admin/wpmu-admin.php',
	'sr-admin/wpmu-blogs.php',
	'sr-admin/wpmu-edit.php',
	'sr-admin/wpmu-options.php',
	'sr-admin/wpmu-themes.php',
	'sr-admin/wpmu-upgrade-site.php',
	'sr-admin/wpmu-users.php',
	'sr-includes/images/wordpress-mu.png',
	'sr-includes/wpmu-default-filters.php',
	'sr-includes/wpmu-functions.php',
	'wpmu-settings.php',
	// 3.0
	'sr-admin/categories.php',
	'sr-admin/edit-category-form.php',
	'sr-admin/edit-page-form.php',
	'sr-admin/edit-pages.php',
	'sr-admin/images/admin-header-footer.png',
	'sr-admin/images/browse-happy.gif',
	'sr-admin/images/ico-add.png',
	'sr-admin/images/ico-close.png',
	'sr-admin/images/ico-edit.png',
	'sr-admin/images/ico-viewpage.png',
	'sr-admin/images/fav-top.png',
	'sr-admin/images/screen-options-left.gif',
	'sr-admin/images/wp-logo-vs.gif',
	'sr-admin/images/wp-logo.gif',
	'sr-admin/import',
	'sr-admin/js/wp-gears.dev.js',
	'sr-admin/js/wp-gears.js',
	'sr-admin/options-misc.php',
	'sr-admin/page-new.php',
	'sr-admin/page.php',
	'sr-admin/rtl.css',
	'sr-admin/rtl.dev.css',
	'sr-admin/update-links.php',
	'sr-admin/sr-admin.css',
	'sr-admin/sr-admin.dev.css',
	'sr-includes/js/codepress',
	'sr-includes/js/codepress/engines/khtml.js',
	'sr-includes/js/codepress/engines/older.js',
	'sr-includes/js/jquery/autocomplete.dev.js',
	'sr-includes/js/jquery/autocomplete.js',
	'sr-includes/js/jquery/interface.js',
	'sr-includes/js/scriptaculous/prototype.js',
	// Following file added back in 5.1, see #45645.
	//'sr-includes/js/tinymce/wp-tinymce.js',
	// 3.1
	'sr-admin/edit-attachment-rows.php',
	'sr-admin/edit-link-categories.php',
	'sr-admin/edit-link-category-form.php',
	'sr-admin/edit-post-rows.php',
	'sr-admin/images/button-grad-active-vs.png',
	'sr-admin/images/button-grad-vs.png',
	'sr-admin/images/fav-arrow-vs-rtl.gif',
	'sr-admin/images/fav-arrow-vs.gif',
	'sr-admin/images/fav-top-vs.gif',
	'sr-admin/images/list-vs.png',
	'sr-admin/images/screen-options-right-up.gif',
	'sr-admin/images/screen-options-right.gif',
	'sr-admin/images/visit-site-button-grad-vs.gif',
	'sr-admin/images/visit-site-button-grad.gif',
	'sr-admin/link-category.php',
	'sr-admin/sidebar.php',
	'sr-includes/classes.php',
	'sr-includes/js/tinymce/blank.htm',
	'sr-includes/js/tinymce/plugins/media/css/content.css',
	'sr-includes/js/tinymce/plugins/media/img',
	'sr-includes/js/tinymce/plugins/safari',
	// 3.2
	'sr-admin/images/logo-login.gif',
	'sr-admin/images/star.gif',
	'sr-admin/js/list-table.dev.js',
	'sr-admin/js/list-table.js',
	'sr-includes/default-embeds.php',
	'sr-includes/js/tinymce/plugins/wordpress/img/help.gif',
	'sr-includes/js/tinymce/plugins/wordpress/img/more.gif',
	'sr-includes/js/tinymce/plugins/wordpress/img/toolbars.gif',
	'sr-includes/js/tinymce/themes/advanced/img/fm.gif',
	'sr-includes/js/tinymce/themes/advanced/img/sflogo.png',
	// 3.3
	'sr-admin/css/colors-classic-rtl.css',
	'sr-admin/css/colors-classic-rtl.dev.css',
	'sr-admin/css/colors-fresh-rtl.css',
	'sr-admin/css/colors-fresh-rtl.dev.css',
	'sr-admin/css/dashboard-rtl.dev.css',
	'sr-admin/css/dashboard.dev.css',
	'sr-admin/css/global-rtl.css',
	'sr-admin/css/global-rtl.dev.css',
	'sr-admin/css/global.css',
	'sr-admin/css/global.dev.css',
	'sr-admin/css/install-rtl.dev.css',
	'sr-admin/css/login-rtl.dev.css',
	'sr-admin/css/login.dev.css',
	'sr-admin/css/ms.css',
	'sr-admin/css/ms.dev.css',
	'sr-admin/css/nav-menu-rtl.css',
	'sr-admin/css/nav-menu-rtl.dev.css',
	'sr-admin/css/nav-menu.css',
	'sr-admin/css/nav-menu.dev.css',
	'sr-admin/css/plugin-install-rtl.css',
	'sr-admin/css/plugin-install-rtl.dev.css',
	'sr-admin/css/plugin-install.css',
	'sr-admin/css/plugin-install.dev.css',
	'sr-admin/css/press-this-rtl.dev.css',
	'sr-admin/css/press-this.dev.css',
	'sr-admin/css/theme-editor-rtl.css',
	'sr-admin/css/theme-editor-rtl.dev.css',
	'sr-admin/css/theme-editor.css',
	'sr-admin/css/theme-editor.dev.css',
	'sr-admin/css/theme-install-rtl.css',
	'sr-admin/css/theme-install-rtl.dev.css',
	'sr-admin/css/theme-install.css',
	'sr-admin/css/theme-install.dev.css',
	'sr-admin/css/widgets-rtl.dev.css',
	'sr-admin/css/widgets.dev.css',
	'sr-admin/includes/internal-linking.php',
	'sr-includes/images/admin-bar-sprite-rtl.png',
	'sr-includes/js/jquery/ui.button.js',
	'sr-includes/js/jquery/ui.core.js',
	'sr-includes/js/jquery/ui.dialog.js',
	'sr-includes/js/jquery/ui.draggable.js',
	'sr-includes/js/jquery/ui.droppable.js',
	'sr-includes/js/jquery/ui.mouse.js',
	'sr-includes/js/jquery/ui.position.js',
	'sr-includes/js/jquery/ui.resizable.js',
	'sr-includes/js/jquery/ui.selectable.js',
	'sr-includes/js/jquery/ui.sortable.js',
	'sr-includes/js/jquery/ui.tabs.js',
	'sr-includes/js/jquery/ui.widget.js',
	'sr-includes/js/l10n.dev.js',
	'sr-includes/js/l10n.js',
	'sr-includes/js/tinymce/plugins/wplink/css',
	'sr-includes/js/tinymce/plugins/wplink/img',
	'sr-includes/js/tinymce/plugins/wplink/js',
	'sr-includes/js/tinymce/themes/advanced/img/wpicons.png',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/butt2.png',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/button_bg.png',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/down_arrow.gif',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/fade-butt.png',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/separator.gif',
	// Don't delete, yet: 'wp-rss.php',
	// Don't delete, yet: 'wp-rdf.php',
	// Don't delete, yet: 'wp-rss2.php',
	// Don't delete, yet: 'wp-commentsrss2.php',
	// Don't delete, yet: 'wp-atom.php',
	// Don't delete, yet: 'wp-feed.php',
	// 3.4
	'sr-admin/images/gray-star.png',
	'sr-admin/images/logo-login.png',
	'sr-admin/images/star.png',
	'sr-admin/index-extra.php',
	'sr-admin/network/index-extra.php',
	'sr-admin/user/index-extra.php',
	'sr-admin/images/screenshots/admin-flyouts.png',
	'sr-admin/images/screenshots/coediting.png',
	'sr-admin/images/screenshots/drag-and-drop.png',
	'sr-admin/images/screenshots/help-screen.png',
	'sr-admin/images/screenshots/media-icon.png',
	'sr-admin/images/screenshots/new-feature-pointer.png',
	'sr-admin/images/screenshots/welcome-screen.png',
	'sr-includes/css/editor-buttons.css',
	'sr-includes/css/editor-buttons.dev.css',
	'sr-includes/js/tinymce/plugins/paste/blank.htm',
	'sr-includes/js/tinymce/plugins/wordpress/css',
	'sr-includes/js/tinymce/plugins/wordpress/editor_plugin.dev.js',
	'sr-includes/js/tinymce/plugins/wordpress/img/embedded.png',
	'sr-includes/js/tinymce/plugins/wordpress/img/more_bug.gif',
	'sr-includes/js/tinymce/plugins/wordpress/img/page_bug.gif',
	'sr-includes/js/tinymce/plugins/wpdialogs/editor_plugin.dev.js',
	'sr-includes/js/tinymce/plugins/wpeditimage/css/editimage-rtl.css',
	'sr-includes/js/tinymce/plugins/wpeditimage/editor_plugin.dev.js',
	'sr-includes/js/tinymce/plugins/wpfullscreen/editor_plugin.dev.js',
	'sr-includes/js/tinymce/plugins/wpgallery/editor_plugin.dev.js',
	'sr-includes/js/tinymce/plugins/wpgallery/img/gallery.png',
	'sr-includes/js/tinymce/plugins/wplink/editor_plugin.dev.js',
	// Don't delete, yet: 'wp-pass.php',
	// Don't delete, yet: 'wp-register.php',
	// 3.5
	'sr-admin/gears-manifest.php',
	'sr-admin/includes/manifest.php',
	'sr-admin/images/archive-link.png',
	'sr-admin/images/blue-grad.png',
	'sr-admin/images/button-grad-active.png',
	'sr-admin/images/button-grad.png',
	'sr-admin/images/ed-bg-vs.gif',
	'sr-admin/images/ed-bg.gif',
	'sr-admin/images/fade-butt.png',
	'sr-admin/images/fav-arrow-rtl.gif',
	'sr-admin/images/fav-arrow.gif',
	'sr-admin/images/fav-vs.png',
	'sr-admin/images/fav.png',
	'sr-admin/images/gray-grad.png',
	'sr-admin/images/loading-publish.gif',
	'sr-admin/images/logo-ghost.png',
	'sr-admin/images/logo.gif',
	'sr-admin/images/menu-arrow-frame-rtl.png',
	'sr-admin/images/menu-arrow-frame.png',
	'sr-admin/images/menu-arrows.gif',
	'sr-admin/images/menu-bits-rtl-vs.gif',
	'sr-admin/images/menu-bits-rtl.gif',
	'sr-admin/images/menu-bits-vs.gif',
	'sr-admin/images/menu-bits.gif',
	'sr-admin/images/menu-dark-rtl-vs.gif',
	'sr-admin/images/menu-dark-rtl.gif',
	'sr-admin/images/menu-dark-vs.gif',
	'sr-admin/images/menu-dark.gif',
	'sr-admin/images/required.gif',
	'sr-admin/images/screen-options-toggle-vs.gif',
	'sr-admin/images/screen-options-toggle.gif',
	'sr-admin/images/toggle-arrow-rtl.gif',
	'sr-admin/images/toggle-arrow.gif',
	'sr-admin/images/upload-classic.png',
	'sr-admin/images/upload-fresh.png',
	'sr-admin/images/white-grad-active.png',
	'sr-admin/images/white-grad.png',
	'sr-admin/images/widgets-arrow-vs.gif',
	'sr-admin/images/widgets-arrow.gif',
	'sr-admin/images/wpspin_dark.gif',
	'sr-includes/images/upload.png',
	'sr-includes/js/prototype.js',
	'sr-includes/js/scriptaculous',
	'sr-admin/css/sr-admin-rtl.dev.css',
	'sr-admin/css/sr-admin.dev.css',
	'sr-admin/css/media-rtl.dev.css',
	'sr-admin/css/media.dev.css',
	'sr-admin/css/colors-classic.dev.css',
	'sr-admin/css/customize-controls-rtl.dev.css',
	'sr-admin/css/customize-controls.dev.css',
	'sr-admin/css/ie-rtl.dev.css',
	'sr-admin/css/ie.dev.css',
	'sr-admin/css/install.dev.css',
	'sr-admin/css/colors-fresh.dev.css',
	'sr-includes/js/customize-base.dev.js',
	'sr-includes/js/json2.dev.js',
	'sr-includes/js/comment-reply.dev.js',
	'sr-includes/js/customize-preview.dev.js',
	'sr-includes/js/wplink.dev.js',
	'sr-includes/js/tw-sack.dev.js',
	'sr-includes/js/wp-list-revisions.dev.js',
	'sr-includes/js/autosave.dev.js',
	'sr-includes/js/admin-bar.dev.js',
	'sr-includes/js/quicktags.dev.js',
	'sr-includes/js/wp-ajax-response.dev.js',
	'sr-includes/js/wp-pointer.dev.js',
	'sr-includes/js/hoverIntent.dev.js',
	'sr-includes/js/colorpicker.dev.js',
	'sr-includes/js/wp-lists.dev.js',
	'sr-includes/js/customize-loader.dev.js',
	'sr-includes/js/jquery/jquery.table-hotkeys.dev.js',
	'sr-includes/js/jquery/jquery.color.dev.js',
	'sr-includes/js/jquery/jquery.color.js',
	'sr-includes/js/jquery/jquery.hotkeys.dev.js',
	'sr-includes/js/jquery/jquery.form.dev.js',
	'sr-includes/js/jquery/suggest.dev.js',
	'sr-admin/js/xfn.dev.js',
	'sr-admin/js/set-post-thumbnail.dev.js',
	'sr-admin/js/comment.dev.js',
	'sr-admin/js/theme.dev.js',
	'sr-admin/js/cat.dev.js',
	'sr-admin/js/password-strength-meter.dev.js',
	'sr-admin/js/user-profile.dev.js',
	'sr-admin/js/theme-preview.dev.js',
	'sr-admin/js/post.dev.js',
	'sr-admin/js/media-upload.dev.js',
	'sr-admin/js/word-count.dev.js',
	'sr-admin/js/plugin-install.dev.js',
	'sr-admin/js/edit-comments.dev.js',
	'sr-admin/js/media-gallery.dev.js',
	'sr-admin/js/custom-fields.dev.js',
	'sr-admin/js/custom-background.dev.js',
	'sr-admin/js/common.dev.js',
	'sr-admin/js/inline-edit-tax.dev.js',
	'sr-admin/js/gallery.dev.js',
	'sr-admin/js/utils.dev.js',
	'sr-admin/js/widgets.dev.js',
	'sr-admin/js/wp-fullscreen.dev.js',
	'sr-admin/js/nav-menu.dev.js',
	'sr-admin/js/dashboard.dev.js',
	'sr-admin/js/link.dev.js',
	'sr-admin/js/user-suggest.dev.js',
	'sr-admin/js/postbox.dev.js',
	'sr-admin/js/tags.dev.js',
	'sr-admin/js/image-edit.dev.js',
	'sr-admin/js/media.dev.js',
	'sr-admin/js/customize-controls.dev.js',
	'sr-admin/js/inline-edit-post.dev.js',
	'sr-admin/js/categories.dev.js',
	'sr-admin/js/editor.dev.js',
	'sr-includes/js/tinymce/plugins/wpeditimage/js/editimage.dev.js',
	'sr-includes/js/tinymce/plugins/wpdialogs/js/popup.dev.js',
	'sr-includes/js/tinymce/plugins/wpdialogs/js/wpdialog.dev.js',
	'sr-includes/js/plupload/handlers.dev.js',
	'sr-includes/js/plupload/wp-plupload.dev.js',
	'sr-includes/js/swfupload/handlers.dev.js',
	'sr-includes/js/jcrop/jquery.Jcrop.dev.js',
	'sr-includes/js/jcrop/jquery.Jcrop.js',
	'sr-includes/js/jcrop/jquery.Jcrop.css',
	'sr-includes/js/imgareaselect/jquery.imgareaselect.dev.js',
	'sr-includes/css/wp-pointer.dev.css',
	'sr-includes/css/editor.dev.css',
	'sr-includes/css/jquery-ui-dialog.dev.css',
	'sr-includes/css/admin-bar-rtl.dev.css',
	'sr-includes/css/admin-bar.dev.css',
	'sr-includes/js/jquery/ui/jquery.effects.clip.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.scale.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.blind.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.core.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.shake.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.fade.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.explode.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.slide.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.drop.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.highlight.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.bounce.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.pulsate.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.transfer.min.js',
	'sr-includes/js/jquery/ui/jquery.effects.fold.min.js',
	'sr-admin/images/screenshots/captions-1.png',
	'sr-admin/images/screenshots/captions-2.png',
	'sr-admin/images/screenshots/flex-header-1.png',
	'sr-admin/images/screenshots/flex-header-2.png',
	'sr-admin/images/screenshots/flex-header-3.png',
	'sr-admin/images/screenshots/flex-header-media-library.png',
	'sr-admin/images/screenshots/theme-customizer.png',
	'sr-admin/images/screenshots/twitter-embed-1.png',
	'sr-admin/images/screenshots/twitter-embed-2.png',
	'sr-admin/js/utils.js',
	// Added back in 5.3 [45448], see #43895.
	// 'sr-admin/options-privacy.php',
	'wp-app.php',
	'sr-includes/class-wp-atom-server.php',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/ui.css',
	// 3.5.2
	'sr-includes/js/swfupload/swfupload-all.js',
	// 3.6
	'sr-admin/js/revisions-js.php',
	'sr-admin/images/screenshots',
	'sr-admin/js/categories.js',
	'sr-admin/js/categories.min.js',
	'sr-admin/js/custom-fields.js',
	'sr-admin/js/custom-fields.min.js',
	// 3.7
	'sr-admin/js/cat.js',
	'sr-admin/js/cat.min.js',
	'sr-includes/js/tinymce/plugins/wpeditimage/js/editimage.min.js',
	// 3.8
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/page_bug.gif',
	'sr-includes/js/tinymce/themes/advanced/skins/wp_theme/img/more_bug.gif',
	'sr-includes/js/thickbox/tb-close-2x.png',
	'sr-includes/js/thickbox/tb-close.png',
	'sr-includes/images/wpmini-blue-2x.png',
	'sr-includes/images/wpmini-blue.png',
	'sr-admin/css/colors-fresh.css',
	'sr-admin/css/colors-classic.css',
	'sr-admin/css/colors-fresh.min.css',
	'sr-admin/css/colors-classic.min.css',
	'sr-admin/js/about.min.js',
	'sr-admin/js/about.js',
	'sr-admin/images/arrows-dark-vs-2x.png',
	'sr-admin/images/wp-logo-vs.png',
	'sr-admin/images/arrows-dark-vs.png',
	'sr-admin/images/wp-logo.png',
	'sr-admin/images/arrows-pr.png',
	'sr-admin/images/arrows-dark.png',
	'sr-admin/images/press-this.png',
	'sr-admin/images/press-this-2x.png',
	'sr-admin/images/arrows-vs-2x.png',
	'sr-admin/images/welcome-icons.png',
	'sr-admin/images/wp-logo-2x.png',
	'sr-admin/images/stars-rtl-2x.png',
	'sr-admin/images/arrows-dark-2x.png',
	'sr-admin/images/arrows-pr-2x.png',
	'sr-admin/images/menu-shadow-rtl.png',
	'sr-admin/images/arrows-vs.png',
	'sr-admin/images/about-search-2x.png',
	'sr-admin/images/bubble_bg-rtl-2x.gif',
	'sr-admin/images/wp-badge-2x.png',
	'sr-admin/images/wordpress-logo-2x.png',
	'sr-admin/images/bubble_bg-rtl.gif',
	'sr-admin/images/wp-badge.png',
	'sr-admin/images/menu-shadow.png',
	'sr-admin/images/about-globe-2x.png',
	'sr-admin/images/welcome-icons-2x.png',
	'sr-admin/images/stars-rtl.png',
	'sr-admin/images/wp-logo-vs-2x.png',
	'sr-admin/images/about-updates-2x.png',
	// 3.9
	'sr-admin/css/colors.css',
	'sr-admin/css/colors.min.css',
	'sr-admin/css/colors-rtl.css',
	'sr-admin/css/colors-rtl.min.css',
	// Following files added back in 4.5, see #36083.
	// 'sr-admin/css/media-rtl.min.css',
	// 'sr-admin/css/media.min.css',
	// 'sr-admin/css/farbtastic-rtl.min.css',
	'sr-admin/images/lock-2x.png',
	'sr-admin/images/lock.png',
	'sr-admin/js/theme-preview.js',
	'sr-admin/js/theme-install.min.js',
	'sr-admin/js/theme-install.js',
	'sr-admin/js/theme-preview.min.js',
	'sr-includes/js/plupload/plupload.html4.js',
	'sr-includes/js/plupload/plupload.html5.js',
	'sr-includes/js/plupload/changelog.txt',
	'sr-includes/js/plupload/plupload.silverlight.js',
	'sr-includes/js/plupload/plupload.flash.js',
	// Added back in 4.9 [41328], see #41755.
	// 'sr-includes/js/plupload/plupload.js',
	'sr-includes/js/tinymce/plugins/spellchecker',
	'sr-includes/js/tinymce/plugins/inlinepopups',
	'sr-includes/js/tinymce/plugins/media/js',
	'sr-includes/js/tinymce/plugins/media/css',
	'sr-includes/js/tinymce/plugins/wordpress/img',
	'sr-includes/js/tinymce/plugins/wpdialogs/js',
	'sr-includes/js/tinymce/plugins/wpeditimage/img',
	'sr-includes/js/tinymce/plugins/wpeditimage/js',
	'sr-includes/js/tinymce/plugins/wpeditimage/css',
	'sr-includes/js/tinymce/plugins/wpgallery/img',
	'sr-includes/js/tinymce/plugins/wpfullscreen/css',
	'sr-includes/js/tinymce/plugins/paste/js',
	'sr-includes/js/tinymce/themes/advanced',
	'sr-includes/js/tinymce/tiny_mce.js',
	'sr-includes/js/tinymce/mark_loaded_src.js',
	'sr-includes/js/tinymce/wp-tinymce-schema.js',
	'sr-includes/js/tinymce/plugins/media/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/media/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/media/media.htm',
	'sr-includes/js/tinymce/plugins/wpview/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wpview/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/directionality/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/directionality/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wordpress/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wordpress/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wpdialogs/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wpdialogs/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wpeditimage/editimage.html',
	'sr-includes/js/tinymce/plugins/wpeditimage/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wpeditimage/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/fullscreen/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/fullscreen/fullscreen.htm',
	'sr-includes/js/tinymce/plugins/fullscreen/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wplink/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wplink/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wpgallery/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wpgallery/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/tabfocus/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/tabfocus/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/wpfullscreen/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/wpfullscreen/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/paste/editor_plugin.js',
	'sr-includes/js/tinymce/plugins/paste/pasteword.htm',
	'sr-includes/js/tinymce/plugins/paste/editor_plugin_src.js',
	'sr-includes/js/tinymce/plugins/paste/pastetext.htm',
	'sr-includes/js/tinymce/langs/wp-langs.php',
	// 4.1
	'sr-includes/js/jquery/ui/jquery.ui.accordion.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.autocomplete.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.button.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.core.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.datepicker.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.dialog.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.draggable.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.droppable.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-blind.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-bounce.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-clip.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-drop.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-explode.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-fade.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-fold.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-highlight.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-pulsate.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-scale.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-shake.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-slide.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect-transfer.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.effect.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.menu.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.mouse.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.position.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.progressbar.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.resizable.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.selectable.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.slider.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.sortable.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.spinner.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.tabs.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.tooltip.min.js',
	'sr-includes/js/jquery/ui/jquery.ui.widget.min.js',
	'sr-includes/js/tinymce/skins/wordpress/images/dashicon-no-alt.png',
	// 4.3
	'sr-admin/js/wp-fullscreen.js',
	'sr-admin/js/wp-fullscreen.min.js',
	'sr-includes/js/tinymce/wp-mce-help.php',
	'sr-includes/js/tinymce/plugins/wpfullscreen',
	// 4.5
	'sr-includes/theme-compat/comments-popup.php',
	// 4.6
	'sr-admin/includes/class-wp-automatic-upgrader.php', // Wrong file name, see #37628.
	// 4.8
	'sr-includes/js/tinymce/plugins/wpembed',
	'sr-includes/js/tinymce/plugins/media/moxieplayer.swf',
	'sr-includes/js/tinymce/skins/lightgray/fonts/readme.md',
	'sr-includes/js/tinymce/skins/lightgray/fonts/tinymce-small.json',
	'sr-includes/js/tinymce/skins/lightgray/fonts/tinymce.json',
	'sr-includes/js/tinymce/skins/lightgray/skin.ie7.min.css',
	// 4.9
	'sr-admin/css/press-this-editor-rtl.css',
	'sr-admin/css/press-this-editor-rtl.min.css',
	'sr-admin/css/press-this-editor.css',
	'sr-admin/css/press-this-editor.min.css',
	'sr-admin/css/press-this-rtl.css',
	'sr-admin/css/press-this-rtl.min.css',
	'sr-admin/css/press-this.css',
	'sr-admin/css/press-this.min.css',
	'sr-admin/includes/class-wp-press-this.php',
	'sr-admin/js/bookmarklet.js',
	'sr-admin/js/bookmarklet.min.js',
	'sr-admin/js/press-this.js',
	'sr-admin/js/press-this.min.js',
	'sr-includes/js/mediaelement/background.png',
	'sr-includes/js/mediaelement/bigplay.png',
	'sr-includes/js/mediaelement/bigplay.svg',
	'sr-includes/js/mediaelement/controls.png',
	'sr-includes/js/mediaelement/controls.svg',
	'sr-includes/js/mediaelement/flashmediaelement.swf',
	'sr-includes/js/mediaelement/froogaloop.min.js',
	'sr-includes/js/mediaelement/jumpforward.png',
	'sr-includes/js/mediaelement/loading.gif',
	'sr-includes/js/mediaelement/silverlightmediaelement.xap',
	'sr-includes/js/mediaelement/skipback.png',
	'sr-includes/js/plupload/plupload.flash.swf',
	'sr-includes/js/plupload/plupload.full.min.js',
	'sr-includes/js/plupload/plupload.silverlight.xap',
	'sr-includes/js/swfupload/plugins',
	'sr-includes/js/swfupload/swfupload.swf',
	// 4.9.2
	'sr-includes/js/mediaelement/lang',
	'sr-includes/js/mediaelement/lang/ca.js',
	'sr-includes/js/mediaelement/lang/cs.js',
	'sr-includes/js/mediaelement/lang/de.js',
	'sr-includes/js/mediaelement/lang/es.js',
	'sr-includes/js/mediaelement/lang/fa.js',
	'sr-includes/js/mediaelement/lang/fr.js',
	'sr-includes/js/mediaelement/lang/hr.js',
	'sr-includes/js/mediaelement/lang/hu.js',
	'sr-includes/js/mediaelement/lang/it.js',
	'sr-includes/js/mediaelement/lang/ja.js',
	'sr-includes/js/mediaelement/lang/ko.js',
	'sr-includes/js/mediaelement/lang/nl.js',
	'sr-includes/js/mediaelement/lang/pl.js',
	'sr-includes/js/mediaelement/lang/pt.js',
	'sr-includes/js/mediaelement/lang/ro.js',
	'sr-includes/js/mediaelement/lang/ru.js',
	'sr-includes/js/mediaelement/lang/sk.js',
	'sr-includes/js/mediaelement/lang/sv.js',
	'sr-includes/js/mediaelement/lang/uk.js',
	'sr-includes/js/mediaelement/lang/zh-cn.js',
	'sr-includes/js/mediaelement/lang/zh.js',
	'sr-includes/js/mediaelement/mediaelement-flash-audio-ogg.swf',
	'sr-includes/js/mediaelement/mediaelement-flash-audio.swf',
	'sr-includes/js/mediaelement/mediaelement-flash-video-hls.swf',
	'sr-includes/js/mediaelement/mediaelement-flash-video-mdash.swf',
	'sr-includes/js/mediaelement/mediaelement-flash-video.swf',
	'sr-includes/js/mediaelement/renderers/dailymotion.js',
	'sr-includes/js/mediaelement/renderers/dailymotion.min.js',
	'sr-includes/js/mediaelement/renderers/facebook.js',
	'sr-includes/js/mediaelement/renderers/facebook.min.js',
	'sr-includes/js/mediaelement/renderers/soundcloud.js',
	'sr-includes/js/mediaelement/renderers/soundcloud.min.js',
	'sr-includes/js/mediaelement/renderers/twitch.js',
	'sr-includes/js/mediaelement/renderers/twitch.min.js',
	// 5.0
	'sr-includes/js/codemirror/jshint.js',
	// 5.1
	'sr-includes/random_compat/random_bytes_openssl.php',
	'sr-includes/js/tinymce/wp-tinymce.js.gz',
	// 5.3
	'sr-includes/js/wp-a11y.js',     // Moved to: sr-includes/js/dist/a11y.js
	'sr-includes/js/wp-a11y.min.js', // Moved to: sr-includes/js/dist/a11y.min.js
	// 5.4
	'sr-admin/js/wp-fullscreen-stub.js',
	'sr-admin/js/wp-fullscreen-stub.min.js',
	// 5.5
	'sr-admin/css/ie.css',
	'sr-admin/css/ie.min.css',
	'sr-admin/css/ie-rtl.css',
	'sr-admin/css/ie-rtl.min.css',
	// 5.6
	'sr-includes/js/jquery/ui/position.min.js',
	'sr-includes/js/jquery/ui/widget.min.js',
	// 5.7
	'sr-includes/blocks/classic/block.json',
	// 5.8
	'sr-admin/images/freedoms.png',
	'sr-admin/images/privacy.png',
	'sr-admin/images/about-badge.svg',
	'sr-admin/images/about-color-palette.svg',
	'sr-admin/images/about-color-palette-vert.svg',
	'sr-admin/images/about-header-brushes.svg',
	'sr-includes/block-patterns/large-header.php',
	'sr-includes/block-patterns/heading-paragraph.php',
	'sr-includes/block-patterns/quote.php',
	'sr-includes/block-patterns/text-three-columns-buttons.php',
	'sr-includes/block-patterns/two-buttons.php',
	'sr-includes/block-patterns/two-images.php',
	'sr-includes/block-patterns/three-buttons.php',
	'sr-includes/block-patterns/text-two-columns-with-images.php',
	'sr-includes/block-patterns/text-two-columns.php',
	'sr-includes/block-patterns/large-header-button.php',
	'sr-includes/blocks/subhead/block.json',
	'sr-includes/blocks/subhead',
	'sr-includes/css/dist/editor/editor-styles.css',
	'sr-includes/css/dist/editor/editor-styles.min.css',
	'sr-includes/css/dist/editor/editor-styles-rtl.css',
	'sr-includes/css/dist/editor/editor-styles-rtl.min.css',
	// 5.9
	'sr-includes/blocks/heading/editor.css',
	'sr-includes/blocks/heading/editor.min.css',
	'sr-includes/blocks/heading/editor-rtl.css',
	'sr-includes/blocks/heading/editor-rtl.min.css',
	'sr-includes/blocks/post-content/editor.css',
	'sr-includes/blocks/post-content/editor.min.css',
	'sr-includes/blocks/post-content/editor-rtl.css',
	'sr-includes/blocks/post-content/editor-rtl.min.css',
	'sr-includes/blocks/query-title/editor.css',
	'sr-includes/blocks/query-title/editor.min.css',
	'sr-includes/blocks/query-title/editor-rtl.css',
	'sr-includes/blocks/query-title/editor-rtl.min.css',
	'sr-includes/blocks/tag-cloud/editor.css',
	'sr-includes/blocks/tag-cloud/editor.min.css',
	'sr-includes/blocks/tag-cloud/editor-rtl.css',
	'sr-includes/blocks/tag-cloud/editor-rtl.min.css',
	// 6.1
	'sr-includes/blocks/post-comments.php',
	'sr-includes/blocks/post-comments/block.json',
	'sr-includes/blocks/post-comments/editor.css',
	'sr-includes/blocks/post-comments/editor.min.css',
	'sr-includes/blocks/post-comments/editor-rtl.css',
	'sr-includes/blocks/post-comments/editor-rtl.min.css',
	'sr-includes/blocks/post-comments/style.css',
	'sr-includes/blocks/post-comments/style.min.css',
	'sr-includes/blocks/post-comments/style-rtl.css',
	'sr-includes/blocks/post-comments/style-rtl.min.css',
	'sr-includes/blocks/post-comments',
	'sr-includes/blocks/comments-query-loop/block.json',
	'sr-includes/blocks/comments-query-loop/editor.css',
	'sr-includes/blocks/comments-query-loop/editor.min.css',
	'sr-includes/blocks/comments-query-loop/editor-rtl.css',
	'sr-includes/blocks/comments-query-loop/editor-rtl.min.css',
	'sr-includes/blocks/comments-query-loop',
	// 6.3
	'sr-includes/images/wlw',
	'sr-includes/wlwmanifest.xml',
	'sr-includes/random_compat',
);

/**
 * Stores Requests files to be preloaded and deleted.
 *
 * For classes/interfaces, use the class/interface name
 * as the array key.
 *
 * All other files/directories should not have a key.
 *
 * @since 6.2.0
 *
 * @global array $_old_requests_files
 * @var array
 * @name $_old_requests_files
 */
global $_old_requests_files;

$_old_requests_files = array(
	// Interfaces.
	'Requests_Auth'                              => 'sr-includes/Requests/Auth.php',
	'Requests_Hooker'                            => 'sr-includes/Requests/Hooker.php',
	'Requests_Proxy'                             => 'sr-includes/Requests/Proxy.php',
	'Requests_Transport'                         => 'sr-includes/Requests/Transport.php',

	// Classes.
	'Requests_Auth_Basic'                        => 'sr-includes/Requests/Auth/Basic.php',
	'Requests_Cookie_Jar'                        => 'sr-includes/Requests/Cookie/Jar.php',
	'Requests_Exception_HTTP'                    => 'sr-includes/Requests/Exception/HTTP.php',
	'Requests_Exception_Transport'               => 'sr-includes/Requests/Exception/Transport.php',
	'Requests_Exception_HTTP_304'                => 'sr-includes/Requests/Exception/HTTP/304.php',
	'Requests_Exception_HTTP_305'                => 'sr-includes/Requests/Exception/HTTP/305.php',
	'Requests_Exception_HTTP_306'                => 'sr-includes/Requests/Exception/HTTP/306.php',
	'Requests_Exception_HTTP_400'                => 'sr-includes/Requests/Exception/HTTP/400.php',
	'Requests_Exception_HTTP_401'                => 'sr-includes/Requests/Exception/HTTP/401.php',
	'Requests_Exception_HTTP_402'                => 'sr-includes/Requests/Exception/HTTP/402.php',
	'Requests_Exception_HTTP_403'                => 'sr-includes/Requests/Exception/HTTP/403.php',
	'Requests_Exception_HTTP_404'                => 'sr-includes/Requests/Exception/HTTP/404.php',
	'Requests_Exception_HTTP_405'                => 'sr-includes/Requests/Exception/HTTP/405.php',
	'Requests_Exception_HTTP_406'                => 'sr-includes/Requests/Exception/HTTP/406.php',
	'Requests_Exception_HTTP_407'                => 'sr-includes/Requests/Exception/HTTP/407.php',
	'Requests_Exception_HTTP_408'                => 'sr-includes/Requests/Exception/HTTP/408.php',
	'Requests_Exception_HTTP_409'                => 'sr-includes/Requests/Exception/HTTP/409.php',
	'Requests_Exception_HTTP_410'                => 'sr-includes/Requests/Exception/HTTP/410.php',
	'Requests_Exception_HTTP_411'                => 'sr-includes/Requests/Exception/HTTP/411.php',
	'Requests_Exception_HTTP_412'                => 'sr-includes/Requests/Exception/HTTP/412.php',
	'Requests_Exception_HTTP_413'                => 'sr-includes/Requests/Exception/HTTP/413.php',
	'Requests_Exception_HTTP_414'                => 'sr-includes/Requests/Exception/HTTP/414.php',
	'Requests_Exception_HTTP_415'                => 'sr-includes/Requests/Exception/HTTP/415.php',
	'Requests_Exception_HTTP_416'                => 'sr-includes/Requests/Exception/HTTP/416.php',
	'Requests_Exception_HTTP_417'                => 'sr-includes/Requests/Exception/HTTP/417.php',
	'Requests_Exception_HTTP_418'                => 'sr-includes/Requests/Exception/HTTP/418.php',
	'Requests_Exception_HTTP_428'                => 'sr-includes/Requests/Exception/HTTP/428.php',
	'Requests_Exception_HTTP_429'                => 'sr-includes/Requests/Exception/HTTP/429.php',
	'Requests_Exception_HTTP_431'                => 'sr-includes/Requests/Exception/HTTP/431.php',
	'Requests_Exception_HTTP_500'                => 'sr-includes/Requests/Exception/HTTP/500.php',
	'Requests_Exception_HTTP_501'                => 'sr-includes/Requests/Exception/HTTP/501.php',
	'Requests_Exception_HTTP_502'                => 'sr-includes/Requests/Exception/HTTP/502.php',
	'Requests_Exception_HTTP_503'                => 'sr-includes/Requests/Exception/HTTP/503.php',
	'Requests_Exception_HTTP_504'                => 'sr-includes/Requests/Exception/HTTP/504.php',
	'Requests_Exception_HTTP_505'                => 'sr-includes/Requests/Exception/HTTP/505.php',
	'Requests_Exception_HTTP_511'                => 'sr-includes/Requests/Exception/HTTP/511.php',
	'Requests_Exception_HTTP_Unknown'            => 'sr-includes/Requests/Exception/HTTP/Unknown.php',
	'Requests_Exception_Transport_cURL'          => 'sr-includes/Requests/Exception/Transport/cURL.php',
	'Requests_Proxy_HTTP'                        => 'sr-includes/Requests/Proxy/HTTP.php',
	'Requests_Response_Headers'                  => 'sr-includes/Requests/Response/Headers.php',
	'Requests_Transport_cURL'                    => 'sr-includes/Requests/Transport/cURL.php',
	'Requests_Transport_fsockopen'               => 'sr-includes/Requests/Transport/fsockopen.php',
	'Requests_Utility_CaseInsensitiveDictionary' => 'sr-includes/Requests/Utility/CaseInsensitiveDictionary.php',
	'Requests_Utility_FilteredIterator'          => 'sr-includes/Requests/Utility/FilteredIterator.php',
	'Requests_Cookie'                            => 'sr-includes/Requests/Cookie.php',
	'Requests_Exception'                         => 'sr-includes/Requests/Exception.php',
	'Requests_Hooks'                             => 'sr-includes/Requests/Hooks.php',
	'Requests_IDNAEncoder'                       => 'sr-includes/Requests/IDNAEncoder.php',
	'Requests_IPv6'                              => 'sr-includes/Requests/IPv6.php',
	'Requests_IRI'                               => 'sr-includes/Requests/IRI.php',
	'Requests_Response'                          => 'sr-includes/Requests/Response.php',
	'Requests_SSL'                               => 'sr-includes/Requests/SSL.php',
	'Requests_Session'                           => 'sr-includes/Requests/Session.php',

	// Directories.
	'sr-includes/Requests/Auth/',
	'sr-includes/Requests/Cookie/',
	'sr-includes/Requests/Exception/HTTP/',
	'sr-includes/Requests/Exception/Transport/',
	'sr-includes/Requests/Exception/',
	'sr-includes/Requests/Proxy/',
	'sr-includes/Requests/Response/',
	'sr-includes/Requests/Transport/',
	'sr-includes/Requests/Utility/',
);

/**
 * Stores new files in wp-content to copy
 *
 * The contents of this array indicate any new bundled plugins/themes which
 * should be installed with the  Upgrade. These items will not be
 * re-installed in future upgrades, this behavior is controlled by the
 * introduced version present here being older than the current installed version.
 *
 * The content of this array should follow the following format:
 * Filename (relative to wp-content) => Introduced version
 * Directories should be noted by suffixing it with a trailing slash (/)
 *
 * @since 3.2.0
 * @since 4.7.0 New themes were not automatically installed for 4.4-4.6 on
 *              upgrade. New themes are now installed again. To disable new
 *              themes from being installed on upgrade, explicitly define
 *              CORE_UPGRADE_SKIP_NEW_BUNDLED as true.
 * @global array $_new_bundled_files
 * @var array
 * @name $_new_bundled_files
 */
global $_new_bundled_files;

$_new_bundled_files = array(
	'plugins/akismet/'          => '2.0',
	'themes/twentyten/'         => '3.0',
	'themes/twentyeleven/'      => '3.2',
	'themes/twentytwelve/'      => '3.5',
	'themes/twentythirteen/'    => '3.6',
	'themes/twentyfourteen/'    => '3.8',
	'themes/twentyfifteen/'     => '4.1',
	'themes/twentysixteen/'     => '4.4',
	'themes/twentyseventeen/'   => '4.7',
	'themes/twentynineteen/'    => '5.0',
	'themes/twentytwenty/'      => '5.3',
	'themes/twentytwentyone/'   => '5.6',
	'themes/twentytwentytwo/'   => '5.9',
	'themes/twentytwentythree/' => '6.1',
);

/**
 * Upgrades the core of .
 *
 * This will create a .maintenance file at the base of the  directory
 * to ensure that people can not access the web site, when the files are being
 * copied to their locations.
 *
 * The files in the `$_old_files` list will be removed and the new files
 * copied from the zip file after the database is upgraded.
 *
 * The files in the `$_new_bundled_files` list will be added to the installation
 * if the version is greater than or equal to the old version being upgraded.
 *
 * The steps for the upgrader for after the new release is downloaded and
 * unzipped is:
 *   1. Test unzipped location for select files to ensure that unzipped worked.
 *   2. Create the .maintenance file in current  base.
 *   3. Copy new  directory over old  files.
 *   4. Upgrade  to new version.
 *     4.1. Copy all files/folders other than wp-content
 *     4.2. Copy any language files to WP_LANG_DIR (which may differ from WP_CONTENT_DIR
 *     4.3. Copy any new bundled themes/plugins to their respective locations
 *   5. Delete new  directory path.
 *   6. Delete .maintenance file.
 *   7. Remove old files.
 *   8. Delete 'update_core' option.
 *
 * There are several areas of failure. For instance if PHP times out before step
 * 6, then you will not be able to access any portion of your site. Also, since
 * the upgrade will not continue where it left off, you will not be able to
 * automatically remove old files and remove the 'update_core' option. This
 * isn't that bad.
 *
 * If the copy of the new  over the old fails, then the worse is that
 * the new  directory will remain.
 *
 * If it is assumed that every file will be copied over, including plugins and
 * themes, then if you edit the default theme, you should rename it, so that
 * your changes remain.
 *
 * @since 2.7.0
 *
 * @global WP_Filesystem_Base $wp_filesystem           filesystem subclass.
 * @global array              $_old_files
 * @global array              $_old_requests_files
 * @global array              $_new_bundled_files
 * @global wpdb               $wpdb                    database abstraction object.
 * @global string             $wp_version
 * @global string             $required_php_version
 * @global string             $required_mysql_version
 *
 * @param string $from New release unzipped path.
 * @param string $to   Path to old  installation.
 * @return string|WP_Error New  version on success, WP_Error on failure.
 */
function update_core( $from, $to ) {
	global $wp_filesystem, $_old_files, $_old_requests_files, $_new_bundled_files, $wpdb;

	if ( function_exists( 'set_time_limit' ) ) {
		set_time_limit( 300 );
	}

	/*
	 * Merge the old Requests files and directories into the `$_old_files`.
	 * Then preload these Requests files first, before the files are deleted
	 * and replaced to ensure the code is in memory if needed.
	 */
	$_old_files = array_merge( $_old_files, array_values( $_old_requests_files ) );
	_preload_old_requests_classes_and_interfaces( $to );

	/**
	 * Filters feedback messages displayed during the core update process.
	 *
	 * The filter is first evaluated after the zip file for the latest version
	 * has been downloaded and unzipped. It is evaluated five more times during
	 * the process:
	 *
	 * 1. Before  begins the core upgrade process.
	 * 2. Before Maintenance Mode is enabled.
	 * 3. Before  begins copying over the necessary files.
	 * 4. Before Maintenance Mode is disabled.
	 * 5. Before the database is upgraded.
	 *
	 * @since 2.5.0
	 *
	 * @param string $feedback The core update feedback messages.
	 */
	apply_filters( 'update_feedback', __( 'Verifying the unpacked files&#8230;' ) );

	// Sanity check the unzipped distribution.
	$distro = '';
	$roots  = array( '/wordpress/', '/wordpress-mu/' );

	foreach ( $roots as $root ) {
		if ( $wp_filesystem->exists( $from . $root . 'readme.html' )
			&& $wp_filesystem->exists( $from . $root . 'sr-includes/version.php' )
		) {
			$distro = $root;
			break;
		}
	}

	if ( ! $distro ) {
		$wp_filesystem->delete( $from, true );

		return new WP_Error( 'insane_distro', __( 'The update could not be unpacked' ) );
	}

	/*
	 * Import $wp_version, $required_php_version, and $required_mysql_version from the new version.
	 * DO NOT globalize any variables imported from `version-current.php` in this function.
	 *
	 * BC Note: $wp_filesystem->wp_content_dir() returned unslashed pre-2.8.
	 */
	$versions_file = trailingslashit( $wp_filesystem->wp_content_dir() ) . 'upgrade/version-current.php';

	if ( ! $wp_filesystem->copy( $from . $distro . 'sr-includes/version.php', $versions_file ) ) {
		$wp_filesystem->delete( $from, true );

		return new WP_Error(
			'copy_failed_for_version_file',
			__( 'The update cannot be installed because some files could not be copied. This is usually due to inconsistent file permissions.' ),
			'sr-includes/version.php'
		);
	}

	$wp_filesystem->chmod( $versions_file, FS_CHMOD_FILE );

	/*
	 * `wp_opcache_invalidate()` only exists in  5.5 or later,
	 * so don't run it when upgrading from older versions.
	 */
	if ( function_exists( 'wp_opcache_invalidate' ) ) {
		wp_opcache_invalidate( $versions_file );
	}

	require WP_CONTENT_DIR . '/upgrade/version-current.php';
	$wp_filesystem->delete( $versions_file );

	$php_version    = PHP_VERSION;
	$mysql_version  = $wpdb->db_version();
	$old_wp_version = $GLOBALS['wp_version']; // The version of  we're updating from.
	/*
	 * Note: str_contains() is not used here, as this file is included
	 * when updating from older  versions, in which case
	 * the polyfills from sr-includes/compat.php may not be available.
	 */
	$development_build = ( false !== strpos( $old_wp_version . $wp_version, '-' ) ); // A dash in the version indicates a development release.
	$php_compat        = version_compare( $php_version, $required_php_version, '>=' );

	if ( file_exists( WP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) ) {
		$mysql_compat = true;
	} else {
		$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );
	}

	if ( ! $mysql_compat || ! $php_compat ) {
		$wp_filesystem->delete( $from, true );
	}

	$php_update_message = '';

	if ( function_exists( 'wp_get_update_php_url' ) ) {
		$php_update_message = '</p><p>' . sprintf(
			/* translators: %s: URL to Update PHP page. */
			__( '<a href="%s">Learn more about updating PHP</a>.' ),
			esc_url( wp_get_update_php_url() )
		);

		if ( function_exists( 'wp_get_update_php_annotation' ) ) {
			$annotation = wp_get_update_php_annotation();

			if ( $annotation ) {
				$php_update_message .= '</p><p><em>' . $annotation . '</em>';
			}
		}
	}

	if ( ! $mysql_compat && ! $php_compat ) {
		return new WP_Error(
			'php_mysql_not_compatible',
			sprintf(
				/* translators: 1:  version number, 2: Minimum required PHP version number, 3: Minimum required MySQL version number, 4: Current PHP version number, 5: Current MySQL version number. */
				__( 'The update cannot be installed because  %1$s requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.' ),
				$wp_version,
				$required_php_version,
				$required_mysql_version,
				$php_version,
				$mysql_version
			) . $php_update_message
		);
	} elseif ( ! $php_compat ) {
		return new WP_Error(
			'php_not_compatible',
			sprintf(
				/* translators: 1:  version number, 2: Minimum required PHP version number, 3: Current PHP version number. */
				__( 'The update cannot be installed because  %1$s requires PHP version %2$s or higher. You are running version %3$s.' ),
				$wp_version,
				$required_php_version,
				$php_version
			) . $php_update_message
		);
	} elseif ( ! $mysql_compat ) {
		return new WP_Error(
			'mysql_not_compatible',
			sprintf(
				/* translators: 1:  version number, 2: Minimum required MySQL version number, 3: Current MySQL version number. */
				__( 'The update cannot be installed because  %1$s requires MySQL version %2$s or higher. You are running version %3$s.' ),
				$wp_version,
				$required_mysql_version,
				$mysql_version
			)
		);
	}

	// Add a warning when the JSON PHP extension is missing.
	if ( ! extension_loaded( 'json' ) ) {
		return new WP_Error(
			'php_not_compatible_json',
			sprintf(
				/* translators: 1:  version number, 2: The PHP extension name needed. */
				__( 'The update cannot be installed because  %1$s requires the %2$s PHP extension.' ),
				$wp_version,
				'JSON'
			)
		);
	}

	/** This filter is documented in sr-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Preparing to install the latest version&#8230;' ) );

	/*
	 * Don't copy wp-content, we'll deal with that below.
	 * We also copy version.php last so failed updates report their old version.
	 */
	$skip              = array( 'wp-content', 'sr-includes/version.php' );
	$check_is_writable = array();

	// Check to see which files don't really need updating - only available for 3.7 and higher.
	if ( function_exists( 'get_core_checksums' ) ) {
		// Find the local version of the working directory.
		$working_dir_local = WP_CONTENT_DIR . '/upgrade/' . basename( $from ) . $distro;

		$checksums = get_core_checksums( $wp_version, isset( $wp_local_package ) ? $wp_local_package : 'en_US' );

		if ( is_array( $checksums ) && isset( $checksums[ $wp_version ] ) ) {
			$checksums = $checksums[ $wp_version ]; // Compat code for 3.7-beta2.
		}

		if ( is_array( $checksums ) ) {
			foreach ( $checksums as $file => $checksum ) {
				/*
				 * Note: str_starts_with() is not used here, as this file is included
				 * when updating from older  versions, in which case
				 * the polyfills from sr-includes/compat.php may not be available.
				 */
				if ( 'wp-content' === substr( $file, 0, 10 ) ) {
					continue;
				}

				if ( ! file_exists( ABSPATH . $file ) ) {
					continue;
				}

				if ( ! file_exists( $working_dir_local . $file ) ) {
					continue;
				}

				if ( '.' === dirname( $file )
					&& in_array( pathinfo( $file, PATHINFO_EXTENSION ), array( 'html', 'txt' ), true )
				) {
					continue;
				}

				if ( md5_file( ABSPATH . $file ) === $checksum ) {
					$skip[] = $file;
				} else {
					$check_is_writable[ $file ] = ABSPATH . $file;
				}
			}
		}
	}

	// If we're using the direct method, we can predict write failures that are due to permissions.
	if ( $check_is_writable && 'direct' === $wp_filesystem->method ) {
		$files_writable = array_filter( $check_is_writable, array( $wp_filesystem, 'is_writable' ) );

		if ( $files_writable !== $check_is_writable ) {
			$files_not_writable = array_diff_key( $check_is_writable, $files_writable );

			foreach ( $files_not_writable as $relative_file_not_writable => $file_not_writable ) {
				// If the writable check failed, chmod file to 0644 and try again, same as copy_dir().
				$wp_filesystem->chmod( $file_not_writable, FS_CHMOD_FILE );

				if ( $wp_filesystem->is_writable( $file_not_writable ) ) {
					unset( $files_not_writable[ $relative_file_not_writable ] );
				}
			}

			// Store package-relative paths (the key) of non-writable files in the WP_Error object.
			$error_data = version_compare( $old_wp_version, '3.7-beta2', '>' ) ? array_keys( $files_not_writable ) : '';

			if ( $files_not_writable ) {
				return new WP_Error(
					'files_not_writable',
					__( 'The update cannot be installed because your site is unable to copy some files. This is usually due to inconsistent file permissions.' ),
					implode( ', ', $error_data )
				);
			}
		}
	}

	/** This filter is documented in sr-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Enabling Maintenance mode&#8230;' ) );

	// Create maintenance file to signal that we are upgrading.
	$maintenance_string = '<?php $upgrading = ' . time() . '; ?>';
	$maintenance_file   = $to . '.maintenance';
	$wp_filesystem->delete( $maintenance_file );
	$wp_filesystem->put_contents( $maintenance_file, $maintenance_string, FS_CHMOD_FILE );

	/** This filter is documented in sr-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Copying the required files&#8230;' ) );

	// Copy new versions of WP files into place.
	$result = copy_dir( $from . $distro, $to, $skip );

	if ( is_wp_error( $result ) ) {
		$result = new WP_Error(
			$result->get_error_code(),
			$result->get_error_message(),
			substr( $result->get_error_data(), strlen( $to ) )
		);
	}

	// Since we know the core files have copied over, we can now copy the version file.
	if ( ! is_wp_error( $result ) ) {
		if ( ! $wp_filesystem->copy( $from . $distro . 'sr-includes/version.php', $to . 'sr-includes/version.php', true /* overwrite */ ) ) {
			$wp_filesystem->delete( $from, true );
			$result = new WP_Error(
				'copy_failed_for_version_file',
				__( 'The update cannot be installed because your site is unable to copy some files. This is usually due to inconsistent file permissions.' ),
				'sr-includes/version.php'
			);
		}

		$wp_filesystem->chmod( $to . 'sr-includes/version.php', FS_CHMOD_FILE );

		/*
		 * `wp_opcache_invalidate()` only exists in  5.5 or later,
		 * so don't run it when upgrading from older versions.
		 */
		if ( function_exists( 'wp_opcache_invalidate' ) ) {
			wp_opcache_invalidate( $to . 'sr-includes/version.php' );
		}
	}

	// Check to make sure everything copied correctly, ignoring the contents of wp-content.
	$skip   = array( 'wp-content' );
	$failed = array();

	if ( isset( $checksums ) && is_array( $checksums ) ) {
		foreach ( $checksums as $file => $checksum ) {
			/*
			 * Note: str_starts_with() is not used here, as this file is included
			 * when updating from older  versions, in which case
			 * the polyfills from sr-includes/compat.php may not be available.
			 */
			if ( 'wp-content' === substr( $file, 0, 10 ) ) {
				continue;
			}

			if ( ! file_exists( $working_dir_local . $file ) ) {
				continue;
			}

			if ( '.' === dirname( $file )
				&& in_array( pathinfo( $file, PATHINFO_EXTENSION ), array( 'html', 'txt' ), true )
			) {
				$skip[] = $file;
				continue;
			}

			if ( file_exists( ABSPATH . $file ) && md5_file( ABSPATH . $file ) === $checksum ) {
				$skip[] = $file;
			} else {
				$failed[] = $file;
			}
		}
	}

	// Some files didn't copy properly.
	if ( ! empty( $failed ) ) {
		$total_size = 0;

		foreach ( $failed as $file ) {
			if ( file_exists( $working_dir_local . $file ) ) {
				$total_size += filesize( $working_dir_local . $file );
			}
		}

		/*
		 * If we don't have enough free space, it isn't worth trying again.
		 * Unlikely to be hit due to the check in unzip_file().
		 */
		$available_space = function_exists( 'disk_free_space' ) ? @disk_free_space( ABSPATH ) : false;

		if ( $available_space && $total_size >= $available_space ) {
			$result = new WP_Error( 'disk_full', __( 'There is not enough free disk space to complete the update.' ) );
		} else {
			$result = copy_dir( $from . $distro, $to, $skip );

			if ( is_wp_error( $result ) ) {
				$result = new WP_Error(
					$result->get_error_code() . '_retry',
					$result->get_error_message(),
					substr( $result->get_error_data(), strlen( $to ) )
				);
			}
		}
	}

	/*
	 * Custom content directory needs updating now.
	 * Copy languages.
	 */
	if ( ! is_wp_error( $result ) && $wp_filesystem->is_dir( $from . $distro . 'wp-content/languages' ) ) {
		if ( WP_LANG_DIR !== ABSPATH . WPINC . '/languages' || @is_dir( WP_LANG_DIR ) ) {
			$lang_dir = WP_LANG_DIR;
		} else {
			$lang_dir = WP_CONTENT_DIR . '/languages';
		}
		/*
		 * Note: str_starts_with() is not used here, as this file is included
		 * when updating from older  versions, in which case
		 * the polyfills from sr-includes/compat.php may not be available.
		 */
		// Check if the language directory exists first.
		if ( ! @is_dir( $lang_dir ) && 0 === strpos( $lang_dir, ABSPATH ) ) {
			// If it's within the ABSPATH we can handle it here, otherwise they're out of luck.
			$wp_filesystem->mkdir( $to . str_replace( ABSPATH, '', $lang_dir ), FS_CHMOD_DIR );
			clearstatcache(); // For FTP, need to clear the stat cache.
		}

		if ( @is_dir( $lang_dir ) ) {
			$wp_lang_dir = $wp_filesystem->find_folder( $lang_dir );

			if ( $wp_lang_dir ) {
				$result = copy_dir( $from . $distro . 'wp-content/languages/', $wp_lang_dir );

				if ( is_wp_error( $result ) ) {
					$result = new WP_Error(
						$result->get_error_code() . '_languages',
						$result->get_error_message(),
						substr( $result->get_error_data(), strlen( $wp_lang_dir ) )
					);
				}
			}
		}
	}

	/** This filter is documented in sr-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Disabling Maintenance mode&#8230;' ) );

	// Remove maintenance file, we're done with potential site-breaking changes.
	$wp_filesystem->delete( $maintenance_file );

	/*
	 * 3.5 -> 3.5+ - an empty twentytwelve directory was created upon upgrade to 3.5 for some users,
	 * preventing installation of Twenty Twelve.
	 */
	if ( '3.5' === $old_wp_version ) {
		if ( is_dir( WP_CONTENT_DIR . '/themes/twentytwelve' )
			&& ! file_exists( WP_CONTENT_DIR . '/themes/twentytwelve/style.css' )
		) {
			$wp_filesystem->delete( $wp_filesystem->wp_themes_dir() . 'twentytwelve/' );
		}
	}

	/*
	 * Copy new bundled plugins & themes.
	 * This gives us the ability to install new plugins & themes bundled with
	 * future versions of  whilst avoiding the re-install upon upgrade issue.
	 * $development_build controls us overwriting bundled themes and plugins when a non-stable release is being updated.
	 */
	if ( ! is_wp_error( $result )
		&& ( ! defined( 'CORE_UPGRADE_SKIP_NEW_BUNDLED' ) || ! CORE_UPGRADE_SKIP_NEW_BUNDLED )
	) {
		foreach ( (array) $_new_bundled_files as $file => $introduced_version ) {
			// If a $development_build or if $introduced version is greater than what the site was previously running.
			if ( $development_build || version_compare( $introduced_version, $old_wp_version, '>' ) ) {
				$directory = ( '/' === $file[ strlen( $file ) - 1 ] );

				list( $type, $filename ) = explode( '/', $file, 2 );

				// Check to see if the bundled items exist before attempting to copy them.
				if ( ! $wp_filesystem->exists( $from . $distro . 'wp-content/' . $file ) ) {
					continue;
				}

				if ( 'plugins' === $type ) {
					$dest = $wp_filesystem->wp_plugins_dir();
				} elseif ( 'themes' === $type ) {
					// Back-compat, ::wp_themes_dir() did not return trailingslash'd pre-3.2.
					$dest = trailingslashit( $wp_filesystem->wp_themes_dir() );
				} else {
					continue;
				}

				if ( ! $directory ) {
					if ( ! $development_build && $wp_filesystem->exists( $dest . $filename ) ) {
						continue;
					}

					if ( ! $wp_filesystem->copy( $from . $distro . 'wp-content/' . $file, $dest . $filename, FS_CHMOD_FILE ) ) {
						$result = new WP_Error( "copy_failed_for_new_bundled_$type", __( 'Could not copy file.' ), $dest . $filename );
					}
				} else {
					if ( ! $development_build && $wp_filesystem->is_dir( $dest . $filename ) ) {
						continue;
					}

					$wp_filesystem->mkdir( $dest . $filename, FS_CHMOD_DIR );
					$_result = copy_dir( $from . $distro . 'wp-content/' . $file, $dest . $filename );

					/*
					 * If an error occurs partway through this final step,
					 * keep the error flowing through, but keep the process going.
					 */
					if ( is_wp_error( $_result ) ) {
						if ( ! is_wp_error( $result ) ) {
							$result = new WP_Error();
						}

						$result->add(
							$_result->get_error_code() . "_$type",
							$_result->get_error_message(),
							substr( $_result->get_error_data(), strlen( $dest ) )
						);
					}
				}
			}
		} // End foreach.
	}

	// Handle $result error from the above blocks.
	if ( is_wp_error( $result ) ) {
		$wp_filesystem->delete( $from, true );

		return $result;
	}

	// Remove old files.
	foreach ( $_old_files as $old_file ) {
		$old_file = $to . $old_file;

		if ( ! $wp_filesystem->exists( $old_file ) ) {
			continue;
		}

		// If the file isn't deleted, try writing an empty string to the file instead.
		if ( ! $wp_filesystem->delete( $old_file, true ) && $wp_filesystem->is_file( $old_file ) ) {
			$wp_filesystem->put_contents( $old_file, '' );
		}
	}

	// Remove any Genericons example.html's from the filesystem.
	_upgrade_422_remove_genericons();

	// Deactivate the REST API plugin if its version is 2.0 Beta 4 or lower.
	_upgrade_440_force_deactivate_incompatible_plugins();

	// Deactivate incompatible plugins.
	_upgrade_core_deactivate_incompatible_plugins();

	// Upgrade DB with separate request.
	/** This filter is documented in sr-admin/includes/update-core.php */
	apply_filters( 'update_feedback', __( 'Upgrading database&#8230;' ) );

	$db_upgrade_url = admin_url( 'upgrade.php?step=upgrade_db' );
	wp_remote_post( $db_upgrade_url, array( 'timeout' => 60 ) );

	// Clear the cache to prevent an update_option() from saving a stale db_version to the cache.
	wp_cache_flush();
	// Not all cache back ends listen to 'flush'.
	wp_cache_delete( 'alloptions', 'options' );

	// Remove working directory.
	$wp_filesystem->delete( $from, true );

	// Force refresh of update information.
	if ( function_exists( 'delete_site_transient' ) ) {
		delete_site_transient( 'update_core' );
	} else {
		delete_option( 'update_core' );
	}

	/**
	 * Fires after  core has been successfully updated.
	 *
	 * @since 3.3.0
	 *
	 * @param string $wp_version The current  version.
	 */
	do_action( '_core_updated_successfully', $wp_version );

	// Clear the option that blocks auto-updates after failures, now that we've been successful.
	if ( function_exists( 'delete_site_option' ) ) {
		delete_site_option( 'auto_core_update_failed' );
	}

	return $wp_version;
}

/**
 * Preloads old Requests classes and interfaces.
 *
 * This function preloads the old Requests code into memory before the
 * upgrade process deletes the files. Why? Requests code is loaded into
 * memory via an autoloader, meaning when a class or interface is needed
 * If a request is in process, Requests could attempt to access code. If
 * the file is not there, a fatal error could occur. If the file was
 * replaced, the new code is not compatible with the old, resulting in
 * a fatal error. Preloading ensures the code is in memory before the
 * code is updated.
 *
 * @since 6.2.0
 *
 * @global array              $_old_requests_files Requests files to be preloaded.
 * @global WP_Filesystem_Base $wp_filesystem        filesystem subclass.
 * @global string             $wp_version          The  version string.
 *
 * @param string $to Path to old  installation.
 */
function _preload_old_requests_classes_and_interfaces( $to ) {
	global $_old_requests_files, $wp_filesystem, $wp_version;

	/*
	 * Requests was introduced in  4.6.
	 *
	 * Skip preloading if the website was previously using
	 * an earlier version of .
	 */
	if ( version_compare( $wp_version, '4.6', '<' ) ) {
		return;
	}

	if ( ! defined( 'REQUESTS_SILENCE_PSR0_DEPRECATIONS' ) ) {
		define( 'REQUESTS_SILENCE_PSR0_DEPRECATIONS', true );
	}

	foreach ( $_old_requests_files as $name => $file ) {
		// Skip files that aren't interfaces or classes.
		if ( is_int( $name ) ) {
			continue;
		}

		// Skip if it's already loaded.
		if ( class_exists( $name ) || interface_exists( $name ) ) {
			continue;
		}

		// Skip if the file is missing.
		if ( ! $wp_filesystem->is_file( $to . $file ) ) {
			continue;
		}

		require_once $to . $file;
	}
}

/**
 * Redirect to the About  page after a successful upgrade.
 *
 * This function is only needed when the existing installation is older than 3.4.0.
 *
 * @since 3.3.0
 *
 * @global string $wp_version The  version string.
 * @global string $pagenow    The filename of the current screen.
 * @global string $action
 *
 * @param string $new_version
 */
function _redirect_to_about_wordpress( $new_version ) {
	global $wp_version, $pagenow, $action;

	if ( version_compare( $wp_version, '3.4-RC1', '>=' ) ) {
		return;
	}

	// Ensure we only run this on the update-core.php page. The Core_Upgrader may be used in other contexts.
	if ( 'update-core.php' !== $pagenow ) {
		return;
	}

	if ( 'do-core-upgrade' !== $action && 'do-core-reinstall' !== $action ) {
		return;
	}

	// Load the updated default text localization domain for new strings.
	load_default_textdomain();

	// See do_core_upgrade().
	show_message( __( ' updated successfully.' ) );

	// self_admin_url() won't exist when upgrading from <= 3.0, so relative URLs are intentional.
	show_message(
		'<span class="hide-if-no-js">' . sprintf(
			/* translators: 1:  version, 2: URL to About screen. */
			__( 'Welcome to  %1$s. You will be redirected to the About  screen. If not, click <a href="%2$s">here</a>.' ),
			$new_version,
			'about.php?updated'
		) . '</span>'
	);
	show_message(
		'<span class="hide-if-js">' . sprintf(
			/* translators: 1:  version, 2: URL to About screen. */
			__( 'Welcome to  %1$s. <a href="%2$s">Learn more</a>.' ),
			$new_version,
			'about.php?updated'
		) . '</span>'
	);
	echo '</div>';
	?>
<script type="text/javascript">
window.location = 'about.php?updated';
</script>
	<?php

	// Include admin-footer.php and exit.
	require_once ABSPATH . 'sr-admin/admin-footer.php';
	exit;
}

/**
 * Cleans up Genericons example files.
 *
 * @since 4.2.2
 *
 * @global array              $wp_theme_directories
 * @global WP_Filesystem_Base $wp_filesystem
 */
function _upgrade_422_remove_genericons() {
	global $wp_theme_directories, $wp_filesystem;

	// A list of the affected files using the filesystem absolute paths.
	$affected_files = array();

	// Themes.
	foreach ( $wp_theme_directories as $directory ) {
		$affected_theme_files = _upgrade_422_find_genericons_files_in_folder( $directory );
		$affected_files       = array_merge( $affected_files, $affected_theme_files );
	}

	// Plugins.
	$affected_plugin_files = _upgrade_422_find_genericons_files_in_folder( WP_PLUGIN_DIR );
	$affected_files        = array_merge( $affected_files, $affected_plugin_files );

	foreach ( $affected_files as $file ) {
		$gen_dir = $wp_filesystem->find_folder( trailingslashit( dirname( $file ) ) );

		if ( empty( $gen_dir ) ) {
			continue;
		}

		// The path when the file is accessed via WP_Filesystem may differ in the case of FTP.
		$remote_file = $gen_dir . basename( $file );

		if ( ! $wp_filesystem->exists( $remote_file ) ) {
			continue;
		}

		if ( ! $wp_filesystem->delete( $remote_file, false, 'f' ) ) {
			$wp_filesystem->put_contents( $remote_file, '' );
		}
	}
}

/**
 * Recursively find Genericons example files in a given folder.
 *
 * @ignore
 * @since 4.2.2
 *
 * @param string $directory Directory path. Expects trailingslashed.
 * @return array
 */
function _upgrade_422_find_genericons_files_in_folder( $directory ) {
	$directory = trailingslashit( $directory );
	$files     = array();

	if ( file_exists( "{$directory}example.html" )
		/*
		 * Note: str_contains() is not used here, as this file is included
		 * when updating from older  versions, in which case
		 * the polyfills from sr-includes/compat.php may not be available.
		 */
		&& false !== strpos( file_get_contents( "{$directory}example.html" ), '<title>Genericons</title>' )
	) {
		$files[] = "{$directory}example.html";
	}

	$dirs = glob( $directory . '*', GLOB_ONLYDIR );
	$dirs = array_filter(
		$dirs,
		static function( $dir ) {
			/*
			 * Skip any node_modules directories.
			 *
			 * Note: str_contains() is not used here, as this file is included
			 * when updating from older  versions, in which case
			 * the polyfills from sr-includes/compat.php may not be available.
			 */
			return false === strpos( $dir, 'node_modules' );
		}
	);

	if ( $dirs ) {
		foreach ( $dirs as $dir ) {
			$files = array_merge( $files, _upgrade_422_find_genericons_files_in_folder( $dir ) );
		}
	}

	return $files;
}

/**
 * @ignore
 * @since 4.4.0
 */
function _upgrade_440_force_deactivate_incompatible_plugins() {
	if ( defined( 'REST_API_VERSION' ) && version_compare( REST_API_VERSION, '2.0-beta4', '<=' ) ) {
		deactivate_plugins( array( 'rest-api/plugin.php' ), true );
	}
}

/**
 * @access private
 * @ignore
 * @since 5.8.0
 * @since 5.9.0 The minimum compatible version of Gutenberg is 11.9.
 * @since 6.1.1 The minimum compatible version of Gutenberg is 14.1.
 */
function _upgrade_core_deactivate_incompatible_plugins() {
	if ( defined( 'GUTENBERG_VERSION' ) && version_compare( GUTENBERG_VERSION, '14.1', '<' ) ) {
		$deactivated_gutenberg['gutenberg'] = array(
			'plugin_name'         => 'Gutenberg',
			'version_deactivated' => GUTENBERG_VERSION,
			'version_compatible'  => '14.1',
		);
		if ( is_plugin_active_for_network( 'gutenberg/gutenberg.php' ) ) {
			$deactivated_plugins = get_site_option( 'wp_force_deactivated_plugins', array() );
			$deactivated_plugins = array_merge( $deactivated_plugins, $deactivated_gutenberg );
			update_site_option( 'wp_force_deactivated_plugins', $deactivated_plugins );
		} else {
			$deactivated_plugins = get_option( 'wp_force_deactivated_plugins', array() );
			$deactivated_plugins = array_merge( $deactivated_plugins, $deactivated_gutenberg );
			update_option( 'wp_force_deactivated_plugins', $deactivated_plugins );
		}
		deactivate_plugins( array( 'gutenberg/gutenberg.php' ), true );
	}
}
