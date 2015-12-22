<?php namespace TT\Auth;

use Validator;

use TT\Support\FormModel;

class TeacherAuthForm extends FormModel {
    protected function getPreparedRules() {
        return [
                'email'=>'required|email|exists:users,email|group:Teacher',
                'password'=>'required'
                ];
    }

    protected function getMessages() {
        return [
				'email.required'=> $this->getMsg('validation.email.required'),
                'email.email'=> $this->getMsg('validation.email.email'),
                'email.exists'=> $this->getMsg('validation.email.exists'),
                'password.required'=> $this->getMsg('validation.password.required'),
                'email.group'=> $this->getMsg('validation.email_teacher.group'),               
                'password.password'=> $this->getMsg('validation.password.password')
                ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}

?>
