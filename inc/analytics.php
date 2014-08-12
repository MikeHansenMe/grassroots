<?php

function gr_log( $args = array() ) {
	$url = "https://ssl.google-analytics.com/collect";
	
	global $title;

	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$path = explode( 'wp-admin', $_SERVER['REQUEST_URI'] );

	if ( empty( $path ) || empty( $path[1] ) ) {
		$path = array( "", " " );
	}
	
	$defaults = array(
		'v'		=> '1',
		'tid'	=> 'UA-53669141-1',
		't'		=> 'pageview', //hit type
		'cid' 	=> md5( get_option( 'siteurl' ) ),
		'uid'	=> md5( get_option( 'siteurl' ) . get_current_user_id() ), //user
		'cn'	=> 'grassroots_wp_plugin', //campaign name
		'cs'	=> 'grassroots_wp_plugin', //campaign source
		'cm'	=> 'plugin_admin', //campaign medium
		'ul'	=> get_locale(), //language
		'dp'	=> $path[1], //path
		'sc'	=> '', //start or end
		'ua'	=> $_SERVER['HTTP_USER_AGENT'],
		'dl'	=> $path[1],
		'dh'	=> get_option( 'siteurl' ),
		'dt'	=> $title, //title
		'ec'	=> '', //event category
		'ea'	=> '', //event action
		'el'	=> '', //event label
		'ev'	=> '', //event value
	);

	if( isset( $_SERVER['REMOTE_ADDR'] ) ) {
		$defaults['uip'] = $_SERVER['REMOTE_ADDR'];
	}

	$params = wp_parse_args( $args, $defaults );

	//use test account for testing
	if( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		$params['tid'] = 'UA-53669141-1'; 
	}

	$params['z'] = (int) mt_rand( 100000000000, 999999999999 );

	$query = http_build_query( array_filter( $params ) );
	
	$args = array(
		'body'		=> $query,
		'method'	=> 'POST',
		'blocking'	=> false
	);
	
	wp_remote_post( $url, $args );
}
add_action( 'admin_footer-admin.php', 'gr_log', 9 );

function gr_log_start() {
	$session = array(
		'sc'	=> 'start'
	);
	mm_ux_log( $session );
	$event = array(
		't' => 'event',
		'ec' => 'user_action',
		'ea' => 'login',
	);
	mm_ux_log( $event );
}
add_action( 'wp_login', 'mm_ux_log_start' );

function gr_log_end() {
	$session = array(
		'sc'	=> 'end'
	);
	mm_ux_log( $session );
	$user = get_user_by( 'id', get_current_user_id() );
	$role = $user->roles;
	$event = array(
		't' => 'event',
		'ec' => 'user_action',
		'ea' => 'logout',
		'el' => $role[0],
	);
	mm_ux_log( $event );
}
add_action( 'wp_logout', 'mm_ux_log_end' );
