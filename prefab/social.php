<?php
    function social_icon($type, $link, ...$classes){
        $typeClass;
        $classString;
        $linkParser;

        if($classes){
            $classString = " " . implode($classes, ' ');
        }

        if($link){
            $linkParser = 'href="'. $link .'"';
        }

        switch($type){
            case 'fb':
            case 'facebook':
                $typeClass = 'fa-facebook';
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
                $typeClass = 'fa-youtube-play';
                break;
            default:
                $typeClass = 'fa-share-alt';
                break;
        }

        $returnVal = '<a '. $linkParser .' class="social'. $classString .'">
                        <i class="fa '. $typeClass .'"></i>
                      </a>';
                      
        print($returnVal);
    }

?>