<?php namespace TT\Goals\Infraction;

use Validator;
use TT\Support\FormModel;

class InfractionStoreForm extends FormModel
{
    protected function getPreparedRules()
    {
        return [
                'infraction'=>'required|csv'
               ];
    }
}
