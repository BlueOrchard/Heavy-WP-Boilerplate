<?php

//WIP
function email_settings(){
    require_once('setup-db.php');

    wp_enqueue_style( 'bplate-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );    
    wp_enqueue_style( 'bplate-custom', get_template_directory_uri().'/email-component/email-backend.css' );

    echo "<div class='header-ms'>";
    echo "<h1>Email Submission Settings</h1>";
    echo "<p><i class='fa fa-cogs' aria-hidden='true'></i> Powered By Majority Strategies</p>";
    echo "</div>";

    foreach($options_db as $option){
        $checked = "unchecked";

        echo '<div class="option">';
        echo '<input name="name" value="'.$option->name.'"/>';
        echo '<input name="slug" value="'.$option->slug.'"/>';

        if($option->required){
            $checked = "checked";
        }
        echo '<input name="required" type="checkbox" '.$checked.'/>';
        echo '</div>';
    }
}

?>