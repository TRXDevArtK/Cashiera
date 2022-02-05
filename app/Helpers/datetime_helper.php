<?php
use CodeIgniter\I18n\Time;

    function timeset($time, $timezone){
        $time = Time::parse($time, $timezone);
        return $time->toDateTimeString();
    }


