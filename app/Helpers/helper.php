<?php

use App\Models\Holiday;

if (!function_exists('getPlatformHolidays')) {
    function getPlatformHolidays()
    {
        return Holiday::where('global',1)->get();

    }
}

if (!function_exists('filter_trim_and_null')) {
    function filter_trim_and_null($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $value = trim($value);

        return $value === '' ? null : $value;
    }
}
