<?php

function email_settings(){
    wp_enqueue_style( 'bplate-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );    
    wp_enqueue_style( 'bplate-custom', get_template_directory_uri().'/email-component/email-backend.css' );
}

?>