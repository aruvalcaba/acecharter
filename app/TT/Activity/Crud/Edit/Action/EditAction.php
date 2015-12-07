<?php namespace TT\Activity\Crud\Edit\Action;

use TT\Support\AbstractAction;

use TT\Activity\Crud\Edit\Domain\EditService;
use TT\Activity\Crud\Edit\Responder\EditResponder;

class EditAction extends AbstractAction {
    public function __construct (EditService $domain, EditResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act($id) {
        $payload = $this->domain->fetchEdit($id);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
