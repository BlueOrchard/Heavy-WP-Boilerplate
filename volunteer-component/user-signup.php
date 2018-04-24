<?php
    define( 'WP_USE_THEMES', false );
    require( '../../../../wp-load.php' );

    require_once('setup-db.php');

    //Error handling for required fields
    $response = new stdClass();
    $response->error = false;

    $values = array();

    foreach($options_db as $option){
        if($option->required == true && $_POST[$option->slug] == ""){
            $response->error = true;
            $response->error_at = $option->slug;
            break;
        }
        $values[$option->slug] = filter_var($_POST[$option->slug], FILTER_SANITIZE_STRING);
        if($values[$option->slug] == "options"){
            $response->value = $_POST[$option->slug];
        }
    }

    if(!$response->error){
        $table_name = $wpdb->prefix . "users_volunteered";
        
        $wpdb->insert(
            $table_name,
            $values
        );

        require "../mailer.php";
    }

    echo(json_encode($response));
?>