<?php namespace TT\Auth\Parent\Action;

use Input;

use TT\Auth\AbstractLoginPostAction;
use TT\Auth\Parent\Domain\LoginService;

use TT\Auth\Parent\Responder\LoginPostResponder;

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