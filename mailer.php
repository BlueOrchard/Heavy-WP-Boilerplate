<?php

//File requires wp-load.php and setup-db.php to function

$message = "";
$name = "";
$options_array = [];
$info = "<b>Information: </b><br><br>";
$selected_options = "<b>Options: </b>\n\n";

foreach($options_db as $option){
    if(strpos($option->slug, 'option_') !== false && $option->slug){
        $options_array[] = $option->name;
    } else {
        $info .= $option->name . ": " . $_POST[$option->slug] . "<br>";
    }
    
}

$server_name = "[" . get_bloginfo('name') . "]";

$to = "joseph.richey@majoritystrategies.com";
$subject = $server_name . " New Signup";
$headers = array('Content-Type: text/html; charset=UTF-8');

if(!empty($options_array)){
    $options_string = implode(", ", $options_array);
    $selected_options .= $options_string;
} else {
    $selected_options = "";
}
$message = "<html><body>";
$message .= $info . "<br><br>" . $selected_options;
$message .= "</html></body>";

//wp_mail($to, $subject, $message, $headers);

?>