<?php namespace TT\Auth\Teacher\Action;

use TT\Auth\AbstractLoginGetAction;

use TT\Auth\Teacher\Domain\LoginService;
use TT\Auth\Teacher\Responder\LoginGetResponder;

class LoginGetAction extends AbstractLoginGetAction {
    public function __construct(LoginService $domain, LoginGetResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }
}

?>
