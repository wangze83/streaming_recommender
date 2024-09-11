<?php
/**
 * Credits administration panel.
 *
 * @package
 * @subpackage Administration
 */

/**  Administration Bootstrap */
require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/includes/credits.php';

// Used in the HTML title tag.
$title = __( 'Credits' );

list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );

require_once ABSPATH . 'sr-admin/admin-header.php';

$credits = wp_credits();
?>
<div class="wrap about__container">







<?php
if ( ! $credits ) {
	echo '</div>';
	require_once ABSPATH . 'sr-admin/admin-footer.php';
	exit;
}
?>



	<?php if ( isset( $credits['groups']['translators'] ) || isset( $credits['groups']['validators'] ) ) : ?>
	<div class="about__section">
		<div class="column">
			<?php wp_credits_section_title( $credits['groups']['validators'] ); ?>
			<?php wp_credits_section_list( $credits, 'validators' ); ?>
			<?php wp_credits_section_list( $credits, 'translators' ); ?>
		</div>
	</div>

	<hr />
	<?php endif; ?>

	<div class="about__section">
		<div class="column">
			<?php wp_credits_section_title( $credits['groups']['libraries'] ); ?>
			<?php wp_credits_section_list( $credits, 'libraries' ); ?>
		</div>
	</div>
</div>
<?php

require_once ABSPATH . 'sr-admin/admin-footer.php';

return;

// These are strings returned by the API that we want to be translatable.
__( 'Project Leaders' );
/* translators: %s: The current  version number. */
__( 'Core Contributors to  %s' );
__( 'Noteworthy Contributors' );
__( 'Cofounder, Project Lead' );
__( 'Lead Developer' );
__( 'Release Lead' );
__( 'Release Design Lead' );
__( 'Release Deputy' );
__( 'Core Developer' );
__( 'External Libraries' );
