<?php

namespace App\Helpers;

class DateHelper
{
    public static function getFormattedDate($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }
    
    public static function isWeekend($date)
    {
        return in_array($date->format('l'), ['Saturday', 'Sunday']);
    }
}
