<?php namespace TT\Support;

use Lang;

class Lists  {
    public static function relationships() {
        return [
                'Mother'=>trans('constants.mother'),
                'Father'=>trans('constants.father'),
                'Sister'=>trans('constants.sister'),
                'Brother'=>trans('constants.brother'),
                'Aunt'=>trans('constants.aunt'),
                'Uncle'=>trans('constants.uncle'),
                'Grandmother'=>trans('constants.grandmother'),
                'Grandfather'=>trans('constants.grandfather')
                ];
    }

    public static function confirm() {
        return [
                1=>'Yes',
                0=>'No'
                ];
    }

    public static function experience() {
        return [
                1=>'Fun',
                0=>'Boring'
                ];
    }

    public static function honorifics() {
        return [
                'Mr'=>'Mr',
                'Mrs'=>'Mrs',
                'Ms'=>'Ms'
                ];
    }

    public static function grades() {
        return [
                'K'=>'Kindergarten',
                '1'=>'First'
                ];
    }

    public static function schools() {
        return [
                'ACE Empower'=>'ACE Empower',
                'ACE Inspire'=>'ACE Inspire',
                'ACE High School'=>'ACE High School',
                'ACE Franklin McKinley'=>'ACE Franklin McKinley',
                'ACE Create Arts'=>'ACE Create Arts' 
               ];
    }
}
