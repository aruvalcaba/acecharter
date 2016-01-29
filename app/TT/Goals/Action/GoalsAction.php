<?php namespace TT\Goals\Action;

use Input;

use TT\Support\AbstractAction;
use TT\Goals\Domain\GoalsService;

use TT\Goals\Responder\GoalsResponder;

class GoalsAction extends AbstractAction {
    public function __construct(GoalsService $domain, GoalsResponder $responder) {
        $this->domain = $domain;   
        $this->responder = $responder;
    }

    public function act($id) {
        $payload = $this->domain->goal($id);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
