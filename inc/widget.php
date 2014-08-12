<?php

class gr_donator extends WP_Widget {

	function gr_donator() {
		parent::WP_Widget( false, $name = "Grassroots Donator" );
	}

	function widget( $args, $instance ) {
		extract ( $args );

		$atts = array(
			'email'		=> get_option( 'gr_email' ),
			'amount'	=> get_option( 'gr_amount' ),
			'orgname'	=> get_option( 'gr_orgname' ),
			'orgid'		=> get_option( 'gr_orgid' )
		);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$textarea = $instance['textarea'];

		echo $before_widget;

		if( $title ) {
			echo $before_title . $title . $after_title;
		}

		if( $textarea ) {
			echo '<div class="widget-textarea">' . $textarea . '</div><br />';
		}

		echo '<center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="' . $atts['email'] .'">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="amount" value="' . $atts['amount'] .'">
		<input type="hidden" name="item_name" value="' . $atts['orgname'] .'">
		<input type="hidden" name="item_number" value="' . $atts['orgid'] .'">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form></center>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['textarea'] = strip_tags( $new_instance['textarea'] );
		return $instance;
	}

	function form( $instance ) {

	$title = esc_attr( $instance['title'] );
	$textarea = esc_attr( $instance['textarea'] );

	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php
_e( 'Title' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'textarea' ); ?>"><?php _e( 'Give a brief description of your cause:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'textarea' ); ?>" name="<?php echo $this->get_field_name( 'textarea' ); ?>"><?php echo $textarea; ?></textarea>
	</p>

	<?php
	}
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "gr_donator" );' ) );
