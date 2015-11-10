<?php namespace TT\Register;

use TT\Support\FormModel;

class TeacherCreateForm extends FormModel {
    protected function getPreparedRules() {
        return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'grade' => 'required',
                'zipcode' => 'required|regex:/^\d{5,}$/',
                'title'=>'required',
                'school' => 'required',
               ];
    }

    protected function getMessages() {
        return [ 
            'zipcode.regex'=>'A 5 digit zicode required.',
        ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}
