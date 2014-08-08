<?php

/*
Plugin Name: Grassroots Donator
Plugin URI: http://grassroots.org
Description: A quick way for individuals to contribute to your non-profit organization.
Author: Garth Mortensen
Author URI: http://gmortensen-ohwp.com
Version: 0.0.3
GitHub Plugin URI: https://github.com/voldemortensen/grassroots
GitHub Branch: master
*/

if ( ! defined( 'WPINC' ) ) { die; }

define( 'GR_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'GR_BASE_URL', plugin_dir_url( __FILE__ ) );


require_once( GR_BASE_DIR . 'inc/button.php' );
require_once( GR_BASE_DIR . 'inc/menu.php' );
require_once( GR_BASE_DIR . 'inc/main.php' );
require_once( GR_BASE_DIR . 'inc/styles.php' );
require_once( GR_BASE_DIR . 'inc/errors.php' );

function gr_load_updater() {
	if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		
		$github = array(
			'updater'	=> GR_BASE_DIR . 'updater/class-github-updater.php',
			'api'		=> GR_BASE_DIR . 'updater/class-github-api.php',
			'plugin'	=> GR_BASE_DIR . 'updater/class-plugin-updater.php'
		);
		
		if( ! class_exists( 'GitHub_Updater' ) && file_exists( $github['updater'] ) ) { 
			require_once( $github['updater'] );
		}
		
		if( ! class_exists( 'GitHub_Updater_GitHub_API' ) && file_exists( $github['api'] ) ) {
			require_once( $github['api'] );
		}
		
		if( ! class_exists( 'GitHub_Plugin_Updater' ) && file_exists( $github['plugin'] ) ) {
			require_once( $github['plugin'] );
		}
		
		new GitHub_Plugin_Updater;
	}
}
add_action( 'admin_init', 'gr_load_updater' );
