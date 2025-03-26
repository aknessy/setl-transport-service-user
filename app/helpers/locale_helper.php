<?php
if(!function_exists('TimeOfDay')){
    function TimeOfDay($hour){
        $timeOfDay = '';

        if ($hour >= 5 && $hour < 12) {
            $timeOfDay = "morning";
        } elseif ($hour >= 12 && $hour < 17) {
            $timeOfDay = "afternoon";
        } else {
            $timeOfDay = "evening";
        }

        return ucfirst($timeOfDay);
    }
}