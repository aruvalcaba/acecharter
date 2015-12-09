<?php namespace TT\PWD\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use TT\User\UserPasswordChangeForm;

use TT\Support\AbstractService;

use TT\Service\PasswordService;

use Aura\Payload\Payload;

class PwdService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory, UserPasswordChangeForm $form_factory, PasswordService $password_service ) {
        $this->payload_factory = $payload_factory;
        $this->UserPasswordChangeForm = $form_factory;
		$this->password_service = $password_service;
    }

	public function fetchPwdChange() {
        try {
                $payload = $this->success();
                $output = $payload->getOutput();

                if(Sentry::check() ) {
                    $output['user'] = Sentry::getUser();
                }
				
                $output['data'] = $this->getData();
                $payload->setOutput($output);
                return $payload;
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }

    public function pwdChange(array $credentials) {
        $payload = $this->payload_factory->newInstance();
        
        $form = new $this->UserPasswordChangeForm;

		if( ! $form->isValid($credentials) ) {

            $messages = $form->getErrors();
            $payload->setStatus(PayloadStatus::NOT_VALID);
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }

        try {
		
			if($this->password_service->changePassword($credentials)){
				$messages = [$this->getMsg('messages.pwd_changed_success')];
            	$payload->setStatus(PayloadStatus::ACCEPTED);
				
            	$payload->setOutput(
									[
										'response'=>[],
										'alerts'=>['messages'=>$messages,'class'=>['class'=>'alert alert-success m-t']]]
									);
			}
            return $payload;
        }

        catch(Exception $e) {
            $payload->setStatus(PayloadStatus::NOT_VALID);
            $messages = [$this->getMsg('messages.wrong_password')];
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }   
    }

    public function getData() {
        return [				
				'current_pwd_label'=> ['val'=>$this->getMsg('constants.current_pwd')],
				'old_pwd_input' => ['type'=>'password','name'=>'old_password','attribs'=>['class'=>'form-control','id'=>'old_password']],
				'new_pwd_label'=> ['val'=>$this->getMsg('constants.new_pwd')],
				'new_pwd_input' => ['type'=>'password','name'=>'password','attribs'=>['class'=>'form-control','id'=>'password']],
				'confirm_pwd_label'=> ['val'=>$this->getMsg('constants.confirm_pwd')],
				'confirm_pwd_input' => ['type'=>'password','name'=>'password_confirmation','attribs'=>['class'=>'form-control','id'=>'password_confirmation']],
				'change_pwd_btn' => ['type'=>'submit','name'=>'change_password','value'=>$this->getMsg('constants.change_pwd'),'attribs'=>['id'=>'change_password','class'=>'btn btn-success fleft']],
				'cancel_btn' => ['type'=>'button','name'=>'cancel','value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-skin','data-dismiss'=>'cancel']],
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('constants.logout'),
				
		
];
    }
}

?>
