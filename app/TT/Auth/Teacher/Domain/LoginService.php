<?php namespace TT\Auth\Teacher\Domain;

use Sentry;

use TT\Support\Lists;

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
        
        $form = $this->form_factory->newTeacherAuthForm();

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
                'signup_btn' => ['type'=>'button','name'=>'signup','value'=>'Signup for free','attribs'=>['id'=>'signup','class'=>'btn btn-skin','data-toggle'=>'modal','data-target'=>'#signupModal']],
                'email_label'=> ['val'=>$this->getMsg('constants.email')],
                'email_input' => ['type'=>'text','name'=>'email','attribs'=>['class'=>'form-control','id'=>'email']],
                'pwd_label'=> ['val'=>$this->getMsg('constants.password')],
                'pwd_input' => ['type'=>'password','name'=>'password','attribs'=>['class'=>'form-control','id'=>'password']],
                'login_btn' => ['type'=>'submit','name'=>'login','value'=>$this->getMsg('constants.login'),'attribs'=>['id'=>'login','class'=>'btn btn-success fleft']],
                'forgot_pwd_btn' => ['type'=>'button','name'=>'forgot_pwd','value'=>$this->getMsg('forgot_password'),'attribs'=>['class'=>'btn btn-default','data-toggle'=>'modal','data-target'=>'#forgotPasswordModal']],
                'titles_input'=>['type'=>'select','name'=>'title','value'=>'','attribs'=>['id'=>'title','class'=>'form-control','placeholder'=>$this->getMsg('messages.titles_input_placeholder')],'options'=> Lists::honorifics()],
                'grades_input'=>['type'=>'select','name'=>'grade','value'=>'','attribs'=>['id'=>'grade','class'=>'form-control','placeholder'=>$this->getMsg('messages.grades_input_placeholder')],'options'=> Lists::grades()],
                'schools_input'=>['type'=>'select','name'=>'school','value'=>'','attribs'=>['id'=>'school','class'=>'form-control','placeholder'=>$this->getMsg('messages.schools_input_placeholder')],'options'=> Lists::schools()],
				'cancel_btn' => ['type'=>'button', 'name'=>'cancel', 'value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-default','data-dismiss'=>'modal']],
				'welcome' => ['val'=>$this->getMsg('constants.welcome')],
				'title' => ['val'=>$this->getMsg('constants.title')],
				'first_name'=> ['val'=>$this->getMsg('constants.first_name')],
				'last_name' => ['val' =>$this->getMsg('constants.last_name')],
				'grade_teaching' => ['val'=>$this->getMsg('constants.grade_teaching')],
				'zip_code' => ['val'=>$this->getMsg('constants.zip_code')],
				'school_name' => ['val'=>$this->getMsg('constants.school_name')],
				'create_account_btn' => ['type'=>'button','name'=>'create_account', 'value'=>$this->getMsg('constants.create_account'),'attribs'=>array('id'=>'teacher_signup','class'=>'btn btn-success')],
        ];
    }
}

?>
