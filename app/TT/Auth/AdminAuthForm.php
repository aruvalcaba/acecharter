<?php namespace TT\Auth;

use Validator;

use TT\Support\FormModel;

class AdminAuthForm extends FormModel {
    protected function getPreparedRules() {
        return [
                'email'=>'required|email|exists:users,email|group:Admin',
                'password'=>'required'
                ];
    }

    protected function getMessages() {
        return [
                'email.required'=>'Email is required.',
                'email.email'=>'Email must be formatted correctly.',
                'email.exists'=>'Email does not exist.',
                'email.group'=>'You are not an admin',
                'password.required'=>'Password is required.',
                'password.password'=>'Password is incorrect.'
                ];
    }

    protected function getCustomAttributes() {
        return [];
    }
}

?>
