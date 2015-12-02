<?php namespace TT\Auth\Admin\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use TT\Auth\AuthFormFactory;

use TT\Auth\AbstractLoginService;

use Aura\Payload_Interface\PayloadStatus;

class LoginService extends AbstractLoginService {
    public function __construct(PayloadFactory $payload_factory, AuthFormFactory $form_factory ) {
        $this->payload_factory = $payload_factory;
        $this->form_factory = $form_factory;
    }

    public function login(array $credentials) {
        $payload = $this->payload_factory->newInstance();
        
        $form = $this->form_factory->newAdminAuthForm();

        if( ! $form->isValid($credentials) ) {
            $messages = $form->getErrors();

            $payload->setStatus(PayloadStatus::NOT_AUTHENTICATED);
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }

        try {
            $user = Sentry::authenticate($credentials,true);
            
            $payload->setStatus(PayloadStatus::AUTHENTICATED);
            $payload->setOutput(['response'=>[]]);
            return $payload;
        }

        catch(\Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $payload->setStatus(PayloadStatus::NOT_AUTHENTICATED);
            $messages = [$this->getMsg('messages.password_required')];
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }   
    }

    public function getData() {
		return [
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'admin' => ['val'=>$this->getmsg('constants.admin')],
				'login' => ['val'=>$this->getMsg('constants.login')],
				'email_label'=> ['val'=>$this->getMsg('constants.email')],
				'email_input' => ['type'=>'text','name'=>'email','attribs'=>['class'=>'form-control','id'=>'email','placeholder'=>$this->getMsg('messages.email_placeholder')]],
                'pwd_label'=> ['val'=>$this->getMsg('constants.password')],
                'pwd_input' => ['type'=>'password','name'=>'password','attribs'=>['class'=>'form-control','id'=>'password']],
                'login_btn' => ['type'=>'submit','name'=>'login','value'=>$this->getMsg('constants.login'),'attribs'=>['id'=>'login','class'=>'btn btn-success fleft']],
		];
    
    }
}

?>
