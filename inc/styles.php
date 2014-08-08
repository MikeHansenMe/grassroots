<?php

function gr_admin_style() {
	wp_enqueue_style( 'gr-admin-css', GR_BASE_URL . 'css/style.css' );
}
add_action( 'admin_head', 'gr_admin_style' );