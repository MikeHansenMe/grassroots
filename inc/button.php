<?php

function add_button_form( $atts ) {

	$defaults = array(
		'email' 	=> get_option( 'gr_email' ),
		'amount'	=> get_option( 'gr_amount' ),
		'orgname'	=> get_option( 'gr_orgname' ),
		'orgid'		=> get_option( 'gr_orgid' )
	);

	$atts = wp_parse_args( $atts, $defaults );

?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="<?php echo $atts['email']; ?>">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="amount" value="<?php echo $atts['amount']; ?>">
<input type="hidden" name="item_name" value="<?php echo $atts['orgname']; ?>">
<input type="hidden" name="item_number" value="<?php echo $atts['orgid']; ?>">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<?php

}
add_shortcode( 'donate', 'add_button_form' );