<?php namespace TT\Activity\Crud\Delete\Action;

use TT\Support\AbstractAction;

use TT\Activity\Crud\Delete\Domain\DeleteService;
use TT\Activity\Crud\Delete\Responder\DeleteResponder;

class DeleteAction extends AbstractAction {
    public function __construct(DeleteService $domain, DeleteResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }
	public function act($id) {        
        $payload = $this->domain->delete($id);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
