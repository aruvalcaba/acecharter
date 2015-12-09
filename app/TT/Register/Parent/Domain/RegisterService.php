<?php namespace TT\Register\Parent\Domain;

use TT\Service\ParentService;

use Aura\Payload\PayloadFactory;

use TT\Register\RegisterFormFactory;

use TT\Register\AbstractRegisterService;

use Aura\Payload_Interface\PayloadStatus;

class RegisterService extends AbstractRegisterService {
    public function __construct( ParentService $parent_service, RegisterFormFactory $register_factory, PayloadFactory $payload_factory ) {
        $this->parent_service = $parent_service;
        $this->register_factory = $register_factory;
        $this->payload_factory = $payload_factory;
    }

    public function register(array $input) {
        $form = $this->register_factory->newParentCreateForm();
        $payload = $this->payload_factory->newInstance();

        if( ! $form->isValid($input) ) {
            $messages = $form->getErrors();
            
            $payload->setStatus(PayloadStatus::NOT_ACCEPTED);
            $payload->setOutput(['response'=>['messages'=>$messages]]);

        }

        else {
            if( $this->parent_service->createWithStudent($input) ) {
                $payload->setStatus(PayloadStatus::CREATED);
                $messages = [$this->getMsg('messages.entity_store_success',['name'=>'Account'])];
                $payload->setOutput(['response'=>['messages'=>$messages]]);   
            }

            else {
                $payload->setStatus(PayloadStatus::NOT_CREATED);
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
