<?php namespace TT\Activity\Crud\Create\Action;

use TT\Support\AbstractAction;

use TT\Activity\Crud\Create\Domain\CreateService;
use TT\Activity\Crud\Create\Responder\CreateResponder;

class CreateAction extends AbstractAction {
    public function __construct (CreateService $domain, CreateResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $payload = $this->domain->fetchCreate();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
