<?php namespace TT\Auth\Teacher\Action;

use Input;

use TT\Auth\AbstractLoginPostAction;
use TT\Auth\Teacher\Domain\LoginService;

use TT\Auth\Teacher\Responder\LoginPostResponder;

class LoginPostAction extends AbstractLoginPostAction {
    public function __construct(LoginService $domain, LoginPostResponder $responder) {
        $this->domain = $domain;   
        $this->responder = $responder;
    }

    public function act() {
        $credentials = Input::all();
        $payload = $this->domain->login($credentials);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
