<?php namespace TT\Home\Parent\Action;

use TT\Support\AbstractAction;

use TT\Home\Parent\Domain\HomeService;

use TT\Home\Parent\Responder\HomeResponder;

class HomeAction extends AbstractAction { 

    public function __construct(HomeResponder $responder, HomeService $home_service) {
        $this->responder = $responder;
        $this->home_service = $home_service;
    }

    public function act() {
        $payload = $this->home_service->home();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
