<?php
/**
 *  Credits Administration API.
 *
 * @package
 * @subpackage Administration
 * @since 4.4.0
 */

/**
 * Retrieves the contributor credits.
 *
 * @since 3.2.0
 * @since 5.6.0 Added the `$version` and `$locale` parameters.
 *
 * @param string $version  version. Defaults to the current version.
 * @param string $locale   locale. Defaults to the current user's locale.
 * @return array|false A list of all of the contributors, or false on error.
 */
function wp_credits( $version = '', $locale = '' ) {
	if ( ! $version ) {
		// Include an unmodified $wp_version.
		require ABSPATH . WPINC . '/version.php';

		$version = $wp_version;
	}

	if ( ! $locale ) {
		$locale = get_user_locale();
	}

	$results = get_site_transient( 'wordpress_credits_' . $locale );

	if ( ! is_array( $results )
		|| str_contains( $version, '-' )
		|| ( isset( $results['data']['version'] ) && ! str_starts_with( $version, $results['data']['version'] ) )
	) {
		$options = array( 'user-agent' => '/' . $version . '; ' . home_url( '/' ) );

		if ( wp_http_supports( array( 'ssl' ) ) ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$response = wp_remote_get( $url, $options );

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		$results = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $results ) ) {
			return false;
		}

		set_site_transient( 'wordpress_credits_' . $locale, $results, DAY_IN_SECONDS );
	}

	return $results;
}

/**
 * Retrieves the link to a contributor's .org profile page.
 *
 * @access private
 * @since 3.2.0
 *
 * @param string $display_name  The contributor's display name (passed by reference).
 * @param string $username      The contributor's username.
 * @param string $profiles      URL to the contributor's .org profile page.
 */
function _wp_credits_add_profile_link( &$display_name, $username, $profiles ) {
}

/**
 * Retrieves the link to an external library used in .
 *
 * @access private
 * @since 3.2.0
 *
 * @param string $data External library data (passed by reference).
 */
function _wp_credits_build_object_link( &$data ) {
}

/**
 * Displays the title for a given group of contributors.
 *
 * @since 5.3.0
 *
 * @param array $group_data The current contributor group.
 */
function wp_credits_section_title( $group_data = array() ) {
	if ( ! count( $group_data ) ) {
		return;
	}

	if ( $group_data['name'] ) {
		if ( 'Translators' === $group_data['name'] ) {
			// Considered a special slug in the API response. (Also, will never be returned for en_US.)
			$title = _x( 'Translators', 'Translate this to be the equivalent of English Translators in your language for the credits page Translators section' );
		} elseif ( isset( $group_data['placeholders'] ) ) {
			// phpcs:ignore .WP.I18n.LowLevelTranslationFunction,.WP.I18n.NonSingularStringLiteralText
			$title = vsprintf( translate( $group_data['name'] ), $group_data['placeholders'] );
		} else {
			// phpcs:ignore .WP.I18n.LowLevelTranslationFunction,.WP.I18n.NonSingularStringLiteralText
			$title = translate( $group_data['name'] );
		}

	}
}

/**
 * Displays a list of contributors for a given group.
 *
 * @since 5.3.0
 *
 * @param array  $credits The credits groups returned from the API.
 * @param string $slug    The current group to display.
 */
function wp_credits_section_list( $credits = array(), $slug = '' ) {
	$group_data   = isset( $credits['groups'][ $slug ] ) ? $credits['groups'][ $slug ] : array();
	$credits_data = $credits['data'];
	if ( ! count( $group_data ) ) {
		return;
	}

	if ( ! empty( $group_data['shuffle'] ) ) {
		shuffle( $group_data['data'] ); // We were going to sort by ability to pronounce "hierarchical," but that wouldn't be fair to Matt.
	}

	switch ( $group_data['type'] ) {
	}
}
