<?php namespace TT\Roster;

use Validator;
use TT\Support\FormModel;

class RosterStoreForm extends FormModel
{
    protected function getPreparedRules()
    {
        return [
                'roster'=>'required|csv'
               ];
    }
}
