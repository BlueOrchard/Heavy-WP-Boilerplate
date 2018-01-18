<?php
    function display_form($type){
        $class;
        
        switch($type){
            case 'email':
            case 'email-form':
                $class = 'email-form';
                break;
            case 'volunteer':
            case 'volunteer-form':
                $class = 'volunteer-form';
                break;
            default:
                $class = 'email-form';
                break;
        }

        $returnVal = '<div class="'. $class .'"></div>';

        print($returnVal);
    }
?>