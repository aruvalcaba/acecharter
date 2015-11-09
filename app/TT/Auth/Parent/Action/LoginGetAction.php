<?php namespace TT\Auth\Parent\Action;

use TT\Auth\AbstractLoginGetAction;

use TT\Auth\Parent\Domain\LoginService;
use TT\Auth\Parent\Responder\LoginGetResponder;

class LoginGetAction extends AbstractLoginGetAction {
    public function __construct(LoginService $domain, LoginGetResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }
}

?>
