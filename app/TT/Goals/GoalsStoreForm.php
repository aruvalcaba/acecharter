<?php namespace TT\Goals;

use Validator;
use TT\Support\FormModel;

class GoalsStoreForm extends FormModel
{
    protected function getPreparedRules()
    {
        return [
                'goals'=>'required|csv'
               ];
    }
}
