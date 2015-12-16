<?php namespace TT\PWD\RESET_PWD\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use TT\User\UserPasswordResetForm;

use TT\Support\AbstractService;

use TT\Service\PasswordService;

use Aura\Payload\Payload;

class PwdResetService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory, UserPasswordResetForm $form_factory, PasswordService $password_service ) {
        $this->payload_factory = $payload_factory;
        $this->UserPasswordResetForm = $form_factory;
		$this->password_service = $password_service;
    }

    public function pwdReset(array $credentials) {
        $payload = $this->payload_factory->newInstance();
        
        $form = new $this->UserPasswordResetForm;

		if( ! $form->isValid($credentials) ) {

            $messages = $form->getErrors();
            $payload->setStatus(PayloadStatus::NOT_VALID);
            $payload->setOutput(['response'=>['messages'=>$messages]]);
            return $payload;
        }

        try {
		
			if($this->password_service->resetPassword($credentials)){
				$messages = [$this->getMsg('messages.pwd_reset_success')];
            	$payload->setStatus(PayloadStatus::SUCCESS);
				
            	$payload->setOutput(
									[
										'response'=>['messages'=>$messages],
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
        return [];
    }
}

?>
