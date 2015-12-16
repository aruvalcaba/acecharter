<?php namespace TT\PWD\RESET_PWD\Action;

use Input;

use TT\Support\AbstractAction;
use TT\PWD\RESET_PWD\Domain\PwdResetService;

use TT\PWD\RESET_PWD\Responder\PwdResetResponder;

class PwdResetAction extends AbstractAction {
    public function __construct(PwdResetService $domain, PwdResetResponder $responder) {
        $this->domain = $domain;   
        $this->responder = $responder;
    }

    public function act() {
        $credentials = Input::all();
        $payload = $this->domain->pwdReset($credentials);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
