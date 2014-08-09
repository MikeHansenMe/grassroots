<?php
add_action( 'admin_init', 'gr_form_process', 1 );
function gr_form_process() {

	if( ! current_user_can( 'manage_options' ) ) { return; }

	if( isset( $_POST['gr_submit'] ) && $_POST['gr_submit'] == 'Submit'  ) {

		if( empty( $_POST['gr_email'] ) ) {
			add_action( 'admin_notices', 'gr_email_error' );
			return;
		} else {
			$f_email = $_POST['gr_email'];
			if( preg_match( "/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $f_email ) ) { 
				update_option( 'gr_email', $_POST['gr_email'] );
			} else {
				add_action( 'admin_notices', 'gr_email_error' );
				return;
			}
		}
		
		if( empty( $_POST['gr_orgname'] ) ) { 
			add_action( 'admin_notices', 'gr_orgname_error' );
			return;
		} else {
			update_option( 'gr_orgname', $_POST['gr_orgname'] );
		}


		if( $_POST['gr_orgid'] != 'Orgnaization ID' ) {
			update_option( 'gr_orgid', $_POST['gr_orgid'] );
		}

		if( ! isset( $_POST['gr_amount'] ) ) { 
			add_action( 'admin_notices', 'gr_donation_error1' );
			return;
		} else {
			$f_amount = $_POST['gr_amount'];
			if( preg_match( '/([0-9])/', $f_amount ) ) {
				update_option( 'gr_amount', $f_amount );
			} else {
				add_action( 'admin_notices', 'gr_donation_error2' );
				return;
			}
		}

		add_action( 'admin_notices', 'gr_form_updated' );

	} else if ( isset( $_POST['gr_submit'] ) && $_POST['gr_submit'] == 'Reset Form' ) {

		update_option( 'gr_email', 'email@address.com' );
		update_option( 'gr_orgname', 'Organization Name' );
		update_option( 'gr_orgid', 'Organization ID' );
		update_option( 'gr_amount', '0' );
		add_action( 'admin_notices', 'gr_form_reset' );

	}
}

function gr_form_updated() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'success', 'el' => 'changes_saved' ) );
?>
	<div id="updated" class="updated">
		<p>Changes saved.</p>
	</div>
<?php
}
function gr_form_reset() {
	gr_log( array( 't' => 'event', 'ec'	=> 'update', 'ea' => 'success', 'el' => 'form_reset' ) );
?>
	<div id="updated" class="updated">
		<p>Form reset.</p>
	</div>
<?php
}

function gr_main_menu() {

$gr_email = get_option( 'gr_email', 'email@address.com' );
$gr_orgname = get_option( 'gr_orgname', 'Organization Name' );
$gr_orgid = get_option( 'gr_orgid', '' );
$gr_amount = get_option( 'gr_amount', '0' );

?>
<div class="gr_page">
	<div class="gr_inner_page">
		<a href="http://grassroots.org"><img alt='Grassroots' width='255' height='55' src='<?php echo GR_BASE_URL . 'img/gr_logo.png'; ?>'></a>

		<p>To add a donate button to your website, please fill out the following form:</p>

		<form class='gr_form' action='admin.php?page=grassroots' method='POST'>
		PayPal email address: <input type='text' name='gr_email' placeholder='<?php echo $gr_email; ?>' /><br />
		Organization name: <input type='text' name='gr_orgname' placeholder='<?php echo $gr_orgname; ?>' /><br />
		Organization ID (optional): <input type='text' name='gr_orgid' placeholder='<?php echo $gr_orgid; ?>' /><br />
		*Donation amount: <input type='text' name='gr_amount' placeholder='<?php echo $gr_amount; ?>' /><br />
		<input class='gr_btn' type='submit' name='gr_submit' value='Submit' />
		</form>
		<form action='admin.php?page=grassroots' method='POST'>
		<input type='hidden' name='gr_reset' value='true' />
		<input class='gr_btn' type='submit' name='gr_submit' value='Reset Form' />
		</form>
		<blockquote>Note: If you specify a donation amount, the amount will be fixed and the donor will not be able to donate a different amount. It is recommended that you leave that area blank so donors can donate what they are able.</blockquote>

	</div>
</div>

<?php
}
