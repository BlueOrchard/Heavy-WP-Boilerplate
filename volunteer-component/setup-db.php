<?php
    $json_path = get_template_directory().'/volunteer-component/database.json';

    if(!file_exists($json_path) || isset($_GET["upgrade-volunteer-db"])){
        $file = fopen($json_path, 'w');

        //Add arrays to this array for more values.
        // index 0 = title - can be anything
        // index 1 = slug - must be the same as "name" in form
        // index 2 = required - true if required, false otherwise
        $fields = array(
            array('Host a fundraiser', 'option_fundraiser', false),
            array('Go door to door', 'option_door', false),
            array('Sport a bumper sticker', 'option_bumper', false),
            array('Display a yard sign', 'option_yard_sign', false),
            array('Work an election day poll', 'option_poll', false),
            array('Write a letter to an editor', 'option_editor', false),

            array('First Name', 'first_name', true),
            array('Last Name', 'last_name', true),
            array('Email', 'email', true),

            array('Phone Number', 'phone', false),

            array('Address', 'address', true),
            array('City', 'city', true),
            array('State', 'state', true),
            array('Zip', 'zip', true),

            array('Comment', 'comment', false),
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