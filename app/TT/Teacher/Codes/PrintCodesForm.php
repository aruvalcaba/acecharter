<?php namespace TT\Teacher\Codes;

use Validator;

use TT\Support\FormModel;

class PrintCodesForm extends FormModel {
    protected function getPreparedRules() {
        return [
                'count'=>'required|numeric'
               ];
    }

    protected function getMessages() {
        return [
                
               ];
    }
}
