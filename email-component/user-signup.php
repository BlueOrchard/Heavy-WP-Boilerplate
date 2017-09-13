<?php
    define( 'WP_USE_THEMES', false );
    require( '../../../../wp-load.php' );

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $table_name = $wpdb->prefix . "users_subscribed";

    $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email
            )
        );

?>