<?php

function add_gr_menu() {

	if( ! current_user_can( 'manage_options' ) ) { return; }
	add_menu_page( 'admin.php', 'Grassroots', 'administrator', 'grassroots', 'gr_main_menu', GR_BASE_URL . 'img/favicon_gr.png' );
}
add_action( 'admin_menu', 'add_gr_menu' );