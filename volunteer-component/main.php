<?php

//Equeue Frontend Scripts
if(!is_admin()){
	wp_register_script('volunteer_ajax_js', get_template_directory_uri() . '/volunteer-component/email-ajax.js', array('jquery'), null, true);
	$template_directory = get_template_directory_uri();
	wp_localize_script('volunteer_ajax_js', 'templateDirectory', $template_directory);
	wp_enqueue_script('volunteer_ajax_js');
}

//Upgrade DB
if(isset($_GET['upgrade-volunteer-db'])){
	create_subscribe_form_db_v();
}

function create_subscribe_form_db_v(){
	require_once('setup-db.php');

	global $wpdb;

	$table_name = $wpdb->prefix . "users_volunteered";

	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  name tinytext NOT NULL,
	  email text NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	foreach($options_db as $option){
		$sql = "CREATE TABLE $table_name (
				$option->slug text NOT NULL
		) $charset_collate;";

		dbDelta( $sql );
	}
}

add_action("after_switch_theme", "create_subscribe_form_db_v");

require_once('email-options-page.php');
require_once('email-submissions-page.php');
function setup_theme_admin_menus_v() {
	add_menu_page('Volunteer Submissions', 'Volunteer Signups', 'read', 'volunteer-submissions', 'volunteer_submissions', 'dashicons-groups'); 

	//Still Under construction
	//add_options_page('Email Submission Settings', 'Signup Settings', 'read', 'email-submission-settings', 'email_settings', 'dashicons-email');
}

add_action("admin_menu", "setup_theme_admin_menus_v");

?>