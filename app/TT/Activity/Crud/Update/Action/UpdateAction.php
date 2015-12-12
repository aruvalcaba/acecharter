<?php namespace TT\Activity\Crud\Update\Action;

use Input;

use TT\Support\AbstractAction;

use TT\Activity\Crud\Update\Domain\UpdateService;

use TT\Activity\Crud\Update\Responder\UpdateResponder;

class UpdateAction extends AbstractAction {
    public function __construct (UpdateService $domain, UpdateResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act($id) {
        $data = Input::all();
        $payload = $this->domain->update($data,$id);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
