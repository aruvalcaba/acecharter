<?php namespace TT\DailyAttendance;

use Validator;
use TT\Support\FormModel;

class DailyAttendanceStoreForm extends FormModel
{
    protected function getPreparedRules()
    {
        return [
                'daily_attendance'=>'required|csv'
               ];
    }
}
