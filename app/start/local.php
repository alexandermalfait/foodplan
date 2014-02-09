<?php

function asset_with_ts($asset) {
    return asset($asset) . "?nocache=" . File::lastModified(base_path('public/' . $asset));
}

function date_param(DateTime $date) {
    return $date->format("Y-m-d");
}

function date_add_days(DateTime $date, $days) {
    $clone = clone $date;

    if ($days > 0) {
        return $clone->add(new DateInterval("P{$days}D"));
    }
    else {
        return $clone->sub(new DateInterval("P". abs($days) . "D"));
    }
}

function date_get_monday(DateTime $date) {
    while($date->format("N") != "1") {
        $date = date_add_days($date, -1);
    }

    return $date;
}

/**
 * @param DateTime $monday
 * @return DateTime[]
 */
function date_get_dates_in_week(DateTime $monday) {
    $dates = [ $monday ];

    $date = $monday;

    do {
        $date = date_add_days($date, 1);

        $dates[] = $date;
    }
    while($date->format("N") != "7");

    return $dates;
}