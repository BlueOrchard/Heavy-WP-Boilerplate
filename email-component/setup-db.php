<?php
    $json_path = get_template_directory().'/email-component/database.json';

    if(!file_exists($json_path) || isset($_GET["upgrade-email-db"])){
        $file = fopen($json_path, 'w');
        
        $options = array();

        $single_option = new stdClass();
        $single_option->name = 'Name';
        $single_option->slug = 'name';
        $options[] = $single_option;

        $single_option = new stdClass();
        $single_option->name = 'Email';
        $single_option->slug = 'email';
        $options[] = $single_option;

        fwrite($file, json_encode($options));
        fclose($file);
    }

    $options_db = json_decode(file_get_contents($json_path));
?>