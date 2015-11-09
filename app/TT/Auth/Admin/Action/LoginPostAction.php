<?php namespace TT\Auth\Admin\Action;

use Input;

use TT\Auth\AbstractLoginPostAction;
use TT\Auth\Admin\Domain\LoginService;

use TT\Auth\Admin\Responder\LoginPostResponder;

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
