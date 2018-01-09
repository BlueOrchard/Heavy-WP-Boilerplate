<?php
    define( 'WP_USE_THEMES', false );
    require( '../../../../wp-load.php' );

    require_once('setup-db.php');

    global $wpdb;

    $table_name = $wpdb->prefix . "users_volunteered";
    $retrieve_data = $wpdb->get_results("SELECT * FROM $table_name");

    $f = fopen("export_volunteer.csv", "w+");

    $column_names = array();
    foreach($options_db as $option){
        $column_names[] = $option->slug;
    }

    fputcsv($f, $column_names);

    foreach ($retrieve_data as $line) {
        $row_data = array();

        foreach($options_db as $option){
            $slug = $option->slug;
            $row_data[] = $line->$slug;
        }

        fputcsv($f, $row_data); 
    }

    fseek($f, 0);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="export.csv";');

    fpassthru($f);
    fclose($f);
?>