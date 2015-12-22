<?php namespace TT\Register;

use Validator;
use TT\Support\FormModel;

class ParentCreateForm extends FormModel  {
    protected function getPreparedRules() {
        return [
                'parent_fullname' => 'required',
                'student_fullname' => 'required',
                'student_code' => 'required|min:5|exists:teachers_codes,student_code',
                'email' => 'required|email|unique:users',
                'relationship' => 'required'
               ];
    }

    protected function getMessages() {
        return [ 
        'parent_fullname.required' => $this->getMsg('validation.parent_fullname.required'),
        'student_fullname.required' => $this->getMsg('validation.student_fullname.required'),
        'email.required'=> $this->getMsg('validation.email.required'),
        'email.email' => $this->getMsg('validation.email.email.'),
        'email.unique'=> $this->getMsg('validation.email.unique'),
        'student_code.required' => $this->getMsg('validation.student_code.required'),
        'student_code.min'=> $this->getMsg('validation.student_code.min'),
        'student_code.exists'=> $this->getMsg('validation.student_code.exists'),
        'relationship.required' => $this->getMsg('validation.relationship.required')
        ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}
