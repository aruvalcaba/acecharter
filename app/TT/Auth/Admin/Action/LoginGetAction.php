<?php namespace TT\Auth\Admin\Action;

use TT\Auth\AbstractLoginGetAction;

use TT\Auth\Admin\Domain\LoginService;
use TT\Auth\Admin\Responder\LoginGetResponder;

class LoginGetAction extends AbstractLoginGetAction {
    public function __construct(LoginService $domain, LoginGetResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }
}
