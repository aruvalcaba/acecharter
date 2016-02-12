<?php namespace TT\AddChild\Action;

use Input;

use TT\Support\AbstractAction;

use TT\AddChild\Domain\AddChildService;

use TT\AddChild\Responder\AddChildResponder;

class AddChildAction extends AbstractAction {
    public function __construct( AddChildService $domain, AddChildResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $input = Input::all();
        $payload = $this->domain->addChild($input);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
