<?php namespace TT\Academic;

use Validator;
use TT\Support\FormModel;

class AcademicStoreForm extends FormModel
{
    protected function getPreparedRules()
    {
        return [
                'academic'=>'required|csv'
               ];
    }
}
