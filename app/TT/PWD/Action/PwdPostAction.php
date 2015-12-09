<?php namespace TT\PWD\Action;

use Input;

use TT\Support\AbstractAction;
use TT\PWD\Domain\PwdService;

use TT\PWD\Responder\PwdResponder;

class PwdPostAction extends AbstractAction {
    public function __construct(PwdService $domain, PwdResponder $responder) {
        $this->domain = $domain;   
        $this->responder = $responder;
    }

    public function act() {
        $credentials = Input::all();
        $payload = $this->domain->pwdChange($credentials);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
