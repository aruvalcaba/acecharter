<?php namespace TT\Activity\Crud\Store\Action;

use Input;

use TT\Support\AbstractAction;

use TT\Activity\Crud\Store\Domain\StoreService;

use TT\Activity\Crud\Store\Responder\StoreResponder;

class StoreAction extends AbstractAction {
    public function __construct (StoreService $domain, StoreResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $data = Input::all();
        $payload = $this->domain->store($data);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
