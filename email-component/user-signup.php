<?php
    define( 'WP_USE_THEMES', false );
    require( '../../../../wp-load.php' );

    require_once('setup-db.php');

    $values = array();

    foreach($options_db as $option){
        echo $_POST[$option->slug];
        $values[$option->slug] = filter_var($_POST[$option->slug], FILTER_SANITIZE_STRING);
    }

    $table_name = $wpdb->prefix . "users_subscribed";

    $wpdb->insert(
            $table_name,
            $values
        );

?>