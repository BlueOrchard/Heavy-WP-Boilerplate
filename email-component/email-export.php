<?php
    define( 'WP_USE_THEMES', false );
    require( '../../../../wp-load.php' );

    global $wpdb;

    $table_name = $wpdb->prefix . "users_subscribed";
    $retrieve_data = $wpdb->get_results("SELECT * FROM $table_name");

    $f = fopen("export.csv", "w+");

    fputcsv($f, array('name', 'email'));

    foreach ($retrieve_data as $line) {
        $parsed = array($line->name, $line->email);
        fputcsv($f, $parsed); 
    }

    fseek($f, 0);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="export.csv";');

    fpassthru($f);
    fclose($f);
?>