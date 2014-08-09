<?php

function gr_email_error() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'error', 'el' => 'invalid_email' ) );
?>
	<div id="updated" class="error">
		<p>Valid email address required.</p>
	</div>
<?php
}

function gr_orgname_error() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'error', 'el' => 'org_name' ) );
?>
	<div id="updated" class="error">
		<p>You organization name is required.</p>
	</div>
<?php
}

function gr_donation_error1() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'error', 'el' => 'missing_donation_amount' ) );
?>
	<div id="updated" class="error">
		<p>You must provide a donation amount. Entering 0 will allow donators to choose their donation amount.</p>
	</div>
<?php
}

function gr_donation_error2() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'error', 'el' => 'invalid_donation_char' ) );
?>
	<div id="updated" class="error">
		<p>Your donation amount must be a numerical.</p>
	</div>
<?php
}
