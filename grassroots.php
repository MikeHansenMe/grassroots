<?php

/**
 * Plugin Name: Grassroots Donator
 * Plugin URI: http://grassroots.org
 * Description: A quick way for individuals to contribute to your non-profit organization.
 * Author: Garth Mortensen
 * Author URI: http://gmortensen-ohwp.com
 */

if ( ! defined( 'WPINC' ) ) { die; }

define( 'GR_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'GR_BASE_URL', plugin_dir_url( __FILE__ ) );


require_once( GR_BASE_DIR . 'inc/button.php' );
require_once( GR_BASE_DIR . 'inc/menu.php' );
require_once( GR_BASE_DIR . 'inc/main.php' );
require_once( GR_BASE_DIR . 'inc/styles.php' );
require_once( GR_BASE_DIR . 'inc/errors.php' );
