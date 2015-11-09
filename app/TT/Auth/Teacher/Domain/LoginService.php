<?php namespace TT\Auth\Teacher\Domain;

use Sentry;

use TT\Support\Lists;

use Aura\Payload\Payload;
use Aura\Payload\PayloadFactory;

use TT\Auth\AuthFormFactory;
use TT\Auth\AbstractLoginService;

class LoginService extends AbstractLoginService {
    public function __construct(PayloadFactory $payload_factory, AuthFormFactory $form_factory ) {
        $this->payload_factory = $payload_factory;
        $this->form_factory = $form_factory;
    }

    public function login(array $credentials) {
        $payload = $this->payload_factory->newInstance();
        
        $form = $this->form_factory->newTeacherAuthForm();

        if( ! $form->isValid($credentials) ) {
            $messages = $form->getErrors();

            $payload->setStatus(Payload::NOT_AUTHENTICATED);
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }

        try {
            $user = Sentry::authenticate($credentials,true);
            
            $payload->setStatus(Payload::AUTHENTICATED);
            $payload->setOutput(['response'=>[]]);
            return $payload;
        }

        catch(\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $payload->setStatus(Payload::NOT_AUTHENTICATED);
            $messages = [$this->getMsg('messages.wrong_password')];
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }   
    }

    public function getData() {
        return [
                'signup_btn' => ['type'=>'button','name'=>'signup','value'=>'Signup for free','attribs'=>['id'=>'signup','class'=>'btn btn-skin','data-toggle'=>'modal','data-target'=>'#signupModal']],
                'email_label'=> ['val'=>'Email :'],
                'email_input' => ['type'=>'text','name'=>'email','attribs'=>['class'=>'form-control','id'=>'email']],
                'pwd_label'=> ['val'=>'Password :'],
                'pwd_input' => ['type'=>'password','name'=>'password','attribs'=>['class'=>'form-control','id'=>'password']],
                'login_btn' => ['type'=>'submit','name'=>'login','value'=>'Login in','attribs'=>['id'=>'login','class'=>'btn btn-success fleft']],
                'forgot_pwd_btn' => ['type'=>'button','name'=>'forgot_pwd','value'=>'Forgot Password','attribs'=>['class'=>'btn btn-default','data-toggle'=>'modal','data-target'=>'#forgotPasswordModal']],
                'titles_input'=>['type'=>'select','name'=>'title','value'=>'','attribs'=>['class'=>'form-control','placeholder'=>$this->getMsg('messages.titles_input_placeholder')],'options'=> Lists::honorifics()],
                'grades_input'=>['type'=>'select','name'=>'grade','value'=>'','attribs'=>['class'=>'form-control','placeholder'=>$this->getMsg('messages.grades_input_placeholder')],'options'=> Lists::grades()],
        ];
    }
}

?>