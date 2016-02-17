<?php namespace TT\AddChild;

use Validator;
use TT\Support\FormModel;

class AddChildForm extends FormModel  {
    protected function getPreparedRules() {
        return [              
                'student_code' => 'required|min:5|exists:students_traits,ace_code'
               ];
    }

    protected function getMessages() {
        return [ 
        'student_code.required' => $this->getMsg('validation.student_code.required'),
        'student_code.min'=> $this->getMsg('validation.student_code.min'),
        'student_code.exists'=> $this->getMsg('validation.student_code.exists'),        
        ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}
