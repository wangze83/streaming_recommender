<div class="form_dt_user">
	<header>
		<h1><?php  _d("Welcome!"); ?></h1>
	</header>
	<?php do_action ('dt_register_form'); ?>
	<?php if( isset($_GET['form']) && $_GET['form'] == 'send') { /* none */ } else { get_template_part('pages/sections/register-form'); } ?>
</div>
