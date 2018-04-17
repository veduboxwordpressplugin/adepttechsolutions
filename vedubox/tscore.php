<?php
//VEDUBOX
/**
* Plugin Name: vedubox
* Description:	An awesome plugin for used for get LMS data from vedubox api.
* Version:		1.0.0
* Author:		Shailendra Kumar(adepttechsolution.com)
*/


ob_start();
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('VEDUBOX', '1.0.0');
define('TSCORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('TSCORE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TSCORE_ASSETS_URL', plugins_url('assets', __FILE__));
define('TSCORE_VIEW_URL', plugins_url('views', __FILE__));
define('NETWORK', 'VEDUBOX');


register_activation_hook( __FILE__, 'create_blank_template_file' );
function create_blank_template_file() {
	//bool move_uploaded_file ( string $filename , string $destination )
	$sourse = 'http://adepttechsolutions.com/lms_test/wp-content/plugins/tscore/admin/blank_tempp.php';
	
	$destination = get_template_directory_uri().'/blank_tempp.php';
	copy($sourse, $destination);	
}



register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = 'lms_setting';

	$sql = "CREATE TABLE lms_setting(
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		url VARCHAR(250),
		token VARCHAR(50),
		course_list VARCHAR(30),
		course_search VARCHAR(30),
		teacher_list VARCHAR(30),
		teacher_photos VARCHAR(30),		
		login_button VARCHAR(30)		
		)";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
include_once(TSCORE_PLUGIN_PATH.'/functions.php');
?>