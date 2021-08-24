<?php

namespace App\Services;

class Distance
{
    public static function get(float $latitudeFrom, float $longitudeFrom, float $latitudeTo, float $longitudeTo)
    {
        $distance = acos(
                cos(deg2rad($latitudeFrom)) * cos(deg2rad($longitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($longitudeTo))
                + cos(deg2rad($latitudeFrom)) * sin(deg2rad($longitudeFrom)) * cos(deg2rad($latitudeTo)) * sin(deg2rad($longitudeTo))
                + sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo))
            ) * 6378;

        if (true === is_nan($distance)) {
            return 0;
        }

        return $distance;
    }

    public static function format(float $distance): string
    {
        if ($distance < 1) {
            return sprintf('%sm', round($distance * 1000));
        } else {
            return sprintf('%skm', round($distance, 1));
        }
    }
}
