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
                'email.required'=>'Email is required.',
                'email.email'=>'Email must be formatted correctly.',
                'email.exists'=>'Email does not exist.',
                'password.required'=>'Password is required.',
                'email.group'=>'You are not a parent'
                ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}

?>
