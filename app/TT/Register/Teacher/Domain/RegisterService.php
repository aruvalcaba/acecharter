<?php namespace TT\Register\Teacher\Domain;

use TT\Service\TeacherService;

use Aura\Payload\Payload;

use Aura\Payload\PayloadFactory;

use TT\Register\RegisterFormFactory;

use TT\Register\AbstractRegisterService;


class RegisterService extends AbstractRegisterService {
    public function __construct( TeacherService $teacher_service, RegisterFormFactory $register_factory, PayloadFactory $payload_factory ) {
        $this->teacher_service = $teacher_service;
        $this->register_factory = $register_factory;
        $this->payload_factory = $payload_factory;
    }

    public function register(array $input) {
        $form = $this->register_factory->newTeacherCreateForm();
        $payload = $this->payload_factory->newInstance();

        if( ! $form->isValid($input) ) {
            $messages = $form->getErrors();
            
            $payload->setStatus(Payload::NOT_ACCEPTED);
            $payload->setOutput(['response'=>['messages'=>$messages]]);

        }

        else {
            if( $this->teacher_service->create($input) ) {
                $payload->setStatus(Payload::CREATED);
                $messages = [$this->getMsg('messages.entity_store_success',['name'=>'Account'])];
                $payload->setOutput(['response'=>['messages'=>$messages]]);   
            }

            else {
                $payload->setStatus(Payload::NOT_CREATED);
                $messages = [$this->getMsg('messages.entity_store_failure',['name'=>'Account'])];
                $payload->setOutput(['response'=>['messages'=>$messages]]);  
            }
        }

        return $payload;
    }

    public function getData() {
        return [];
    }
}
