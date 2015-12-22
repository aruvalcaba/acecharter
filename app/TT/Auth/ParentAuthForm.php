<?php namespace TT\Auth;

use Validator;

use TT\Support\FormModel;

class ParentAuthForm extends FormModel {
    protected function getPreparedRules() {
        return [
                'email'=>'required|email|exists:users,email|group:Parent',
                'password'=>'required'
                ];
    }

    protected function getMessages() {
        return [
                'email.required'=> $this->getMsg('validation.email.required'),
                'email.email'=> $this->getMsg('validation.email.email'),
                'email.exists'=> $this->getMsg('validation.email.exists'),
                'password.required'=> $this->getMsg('validation.password.required'),
                'email.group'=> $this->getMsg('validation.email_parent.group')
                ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}

?>
