<?php

function create_subscribe_form_db(){
	global $wpdb;

	$table_name = $wpdb->prefix . "users_subscribed";

	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  name tinytext NOT NULL,
	  email text NOT NULL,
	  PRIMARY KEY  (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

add_action("after_switch_theme", "create_subscribe_form_db");

require_once('email-submissions-page.php');
function setup_theme_admin_menus() {
	add_menu_page('Email Submissions', 'Email Signups', 'read', 'email-submissions', 'email_submissions', 'dashicons-email'); 
}

add_action("admin_menu", "setup_theme_admin_menus");

?>