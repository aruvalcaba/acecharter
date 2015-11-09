<?php namespace TT\Support;

class Lists  {
    public static function relationships() {
        return [
                ''=>'Select a relationship',
                'Mother'=>'Mother',
                'Father'=>'Father',
                'Sister'=>'Sister',
                'Brother'=>'Brother',
                'Aunt'=>'Aunt',
                'Uncle'=>'Uncle',
                'Grandmother'=>'Grandmother',
                'Grandfather'=>'Grandfather'
                ];
    }

    public static function confirm() {
        return [
                ''=>'',
                1=>'Yes',
                0=>'No'
                ];
    }

    public static function experience() {
        return [
                ''=>'',
                1=>'Fun',
                0=>'Boring'
                ];
    }

    public static function honorifics() {
        return ['Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms'];
    }

    public static function grades() {
        return ['K'=>'Kindergarten','1'=>'First'];
    }
}
