<?php

namespace AppBundle\Data;

class CategoryMaster
{
    public static function growingMethods()
    {
        return array(
            1 => 'NFT',
            2 => 'Drip Irrigation',
            3 => 'Ebb and Flow',
            4 => 'Soil/Organic',
        );
    }

    public static function areaUnits()
    {
        return array(
            1 => 'Holes',
            2 => 'Trays',
        );
    }

    public static function seedUnits()
    {
        return array(
            1 => 'seeds',
            2 => 'gr',
            3 => 'kg',
            4 => 'lbs',
            5 => 'oz',
        );
    }

    public static function deviceType()
    {
        return array(
            1 => 'Raspberry Pi',
            2 => 'Arduino',
            3 => 'ESP8266',
            4 => 'Other'
        );
    }
}
