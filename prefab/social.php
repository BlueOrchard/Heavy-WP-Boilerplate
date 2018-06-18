<?php
    //Can't use this at the moment with the current hosting
    //function social_icon($type, $link, ...$classes){
    function social_icon(){
        //Workaround for variadic function
        $type = func_get_arg(0);
        $link = func_get_arg(1);
        $classes = [];

        for($i = 0; $i < func_num_args(); $i++){
            array_push($classes, func_get_arg($i));
        }
        //End workaround

        $typeClass;
        $classString;
        $linkParser;
        $fontFamily = "fab";

        if($classes){
            $classString = " " . implode($classes, ' ');
        }

        if($link){
            $linkParser = 'href="'. $link .'"';
        }

        switch($type){
            case 'fb':
            case 'facebook':
                $typeClass = 'fa-facebook-f';
                break;
            case 'tw':
            case 'twitter':
                $typeClass = 'fa-twitter';
                break;
            case 'ig':
            case 'instagram':
                $typeClass = 'fa-instagram';
                break;
            case 'sc':
            case 'snapchat':
                $typeClass = 'fa-snapchat';
                break;
            case 'yt':
            case 'youtube':
                $typeClass = 'fa-youtube';
                break;
            default:
                $typeClass = 'fa-share-alt';
                break;
        }

        $returnVal = '<a '. $linkParser .' target="_blank" class="social'. $classString .'">
                        <i class="' . $fontFamily . ' ' . $typeClass .'"></i>
                      </a>';
                      
        print($returnVal);
    }

?>