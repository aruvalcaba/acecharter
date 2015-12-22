<?php namespace TT\User;

use Validator;

use TT\Support\FormModel;

class UserPasswordChangeForm extends FormModel{

	protected function getPreparedRules()
    {
        return
			  [ 
                'old_password' => 'required|password',
                'password'=>'required|min:8|confirmed',
			];
    }

	protected function getMessages(){

		return [
                'old_password.required' => $this->getMsg('validation.old_password.required'),
                'old_password.password' => $this->getMsg('validation.old_password.password'),
                'password.required'=> $this->getMsg('validation.new_password.required'),
                'password.min'=> $this->getMsg('validation.password.min'),
                'password.confirmed'=> $this->getMsg('validation.password.confirmed')
			 ];
			   
	}

	protected function getCustomAttributes(){

		return [];	
	}

}
