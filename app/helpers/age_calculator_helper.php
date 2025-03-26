<?php

if(!function_exists('calculate_age')){
    function calculate_age($dob){
        $year = explode('-', $dob)[0];
        $current_year = date('Y');

        return intval($current_year - $year);
    }
}