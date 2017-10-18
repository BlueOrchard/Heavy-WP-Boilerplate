<?php
    $json_path = get_template_directory().'/email-component/database.json';

    if(!file_exists($json_path) || isset($_GET["upgrade-email-db"])){
        $file = fopen($json_path, 'w');

        //Add arrays to this array for more values.
        // index 0 = title - can be anything
        // index 1 = slug - must be the same as "name" in form
        // index 2 = required - true if required, false otherwise
        $fields = array(
            array('Name', 'name', true),
            array('Email', 'email', true),
        );
        
        $options = array();

        foreach($fields as $field){
            $single_option = new stdClass();
            $single_option->name = $field[0];
            $single_option->slug = $field[1];
            $single_option->required = $field[2];
            $options[] = $single_option;
        }

        fwrite($file, json_encode($options));
        fclose($file);
    }

    $options_db = json_decode(file_get_contents($json_path));
?>