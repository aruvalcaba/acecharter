<?php namespace TT\Common\Action;

use TT\Support\AbstractAction;

use TT\Common\Domain\NotAuthService;

use TT\Common\Responder\NotAuthResponder;

class NotAuthAction extends AbstractAction {
    public function __construct(NotAuthService $domain, NotAuthResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $payload = $this->domain->notAuthorized();;
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();        
    }
}

