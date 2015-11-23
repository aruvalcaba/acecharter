<?php namespace TT\Auth\Parent\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use TT\Auth\AuthFormFactory;

use TT\Auth\AbstractLoginService;

class LoginService extends AbstractLoginService {
    public function __construct(PayloadFactory $payload_factory, AuthFormFactory $form_factory ) {
        $this->payload_factory = $payload_factory;
        $this->form_factory = $form_factory;
    }

    public function login(array $credentials) {
        $payload = $this->payload_factory->newInstance();
        
        $form = $this->form_factory->newParentAuthForm();

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
            $messages = [$this->getMsg('messages.wrong_password')];
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }   
    }

    public function getData() {
        return [
				'login_msg' => ['val'=>$this->getMsg('messages.login_below')],
				'email_label'=> ['val'=>$this->getMsg('constants.email')],
				'email_input' => ['type'=>'text','name'=>'email','attribs'=>['class'=>'form-control','id'=>'email','placeholder'=>$this->getMsg('messages.email_placeholder')]],
                'pwd_label'=> ['val'=>$this->getMsg('constants.password')],
				'pwd_input' => ['type'=>'password','name'=>'password','attribs'=>['class'=>'form-control','id'=>'password']],
				'login_btn' => ['type'=>'submit','name'=>'login','value'=>$this->getMsg('constants.login'),'attribs'=>['id'=>'login','class'=>'btn btn-success fleft']],
				'forgot_pwd_btn' => ['type'=>'button','name'=>'forgot_pwd','value'=>$this->getMsg('forgot_password'),'attribs'=>['class'=>'btn btn-default','data-toggle'=>'modal','data-target'=>'#forgotPasswordModal']],
				'register_btn' => ['type'=>'button','name'=>'signup','value'=>$this->getMsg('constants.register'),'attribs'=>['id'=>'signup','class'=>'btn btn-skin','data-toggle'=>'modal','data-target'=>'#signupModal']],
				'welcome' => ['val'=>$this->getMsg('constants.welcome')],
				'parent' => ['val'=>$this->getmsg('constants.parent')],	
				'full_name' => ['val'=>$this->getMsg('constants.full_name')],
				'parent_fullname_input' => ['type'=>'text','name'=>'full_name','attribs'=>['class'=>'form-control','id'=>'parent_fullname','placeholder'=>$this->getMsg('messages.full_name_placeholder')]],
				'student' => ['val'=>$this->getMsg('constants.student')],
				'student_fullname_input' => ['type'=>'text','name'=>'student_fullname','attribs'=>['class'=>'form-control','id'=>'student_fullname']] ,	
				'code' => ['val'=>$this->getMsg('constants.code')],	
				'student_code_input' => ['type'=>'text','name'=>'student_code','attribs'=>['maxlength'=>'6','class'=>'form-control','id'=>'student_code','placeholder'=>$this->getMsg('messages.student_code_placeholder')]],
				'relationship_student' => ['val'=>$this->getMsg('constants.relationship_student')],
				'cancel_btn' => ['type'=>'button', 'name'=>'cancel', 'value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-default','data-dismiss'=>'modal']],
				'signup_btn' => ['type'=>'button', 'name'=>'student_signup', 'value'=>$this->getMsg('constants.sign_up'),'attribs'=>['class'=>'btn btn-success','id'=>'student_signup']],
				'registration' => ['val'=>$this->getMsg('constants.registration')],
				'signup_success' => ['val' =>$this->getMsg('messages.signup_success')],
				'ok' => ['type'=>'button','name'=>'ok','value'=>$this->getMsg('constants.ok'),'attribs'=>['class'=>'btn btn-success','data-dismiss'=>'modal']],
				'reset_pwd' => ['val'=>$this->getMsg('constants.reset_password')],
				'reset_pwd_btn' => ['type'=>'button', 'name'=>'reset_pwd','value'=>$this->getMsg('constants.reset_password'),'attribs'=>['id'=>'reset_password','class'=>'btn btn-primary']],
				'registered_email' => ['val'=>$this->getMsg('messages.registered_email')],
				'pwd_success' => ['val'=>$this->getMsg('messages.pwd_success')] ,
		
];
    }
}

?>
