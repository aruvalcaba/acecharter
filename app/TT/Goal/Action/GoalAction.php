<?php namespace TT\Goal\Action;

use Input;

use TT\Support\AbstractAction;
use TT\Goal\Domain\GoalService;

use TT\Goal\Responder\GoalResponder;

class GoalAction extends AbstractAction {
    public function __construct(GoalService $domain, GoalResponder $responder) {
        $this->domain = $domain;   
        $this->responder = $responder;
    }

    public function act($id) {
        $payload = $this->domain->goal($id);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
