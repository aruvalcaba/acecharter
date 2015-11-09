<?php namespace TT\Register\Teacher\Action;

use Input;

use TT\Register\AbstractRegisterAction;

use TT\Register\Teacher\Domain\RegisterService;

use TT\Register\Teacher\Responder\RegisterResponder;

class RegisterAction extends AbstractRegisterAction {
    public function __construct( RegisterService $domain, RegisterResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $input = Input::all();
        $payload = $this->domain->register($input);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
