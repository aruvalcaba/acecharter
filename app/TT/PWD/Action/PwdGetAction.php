<?php namespace TT\PWD\Action;

use TT\Support\AbstractAction;

use TT\PWD\Domain\PwdService;
use TT\PWD\Responder\PwdResponder;

class PwdGetAction extends AbstractAction {
    public function __construct(PwdService $domain, PwdResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }
	public function act() {
        $payload = $this->domain->fetchpwdChange();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}

?>
