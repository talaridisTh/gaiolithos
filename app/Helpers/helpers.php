<?php

namespace App\Helpers;

use Carbon\Carbon;

function getFactoryDateHelper()
{
    $year = rand(2018, 2020);
    $month = rand(1, 12);
    $day = rand(1, 31);
    $hours = rand(0, 23);
    $mins = rand(0, 59);
    $secs = rand(0, 59);
    $date = Carbon::create($year, $month, $day, $hours, $mins, $secs);

    return $date;
}

