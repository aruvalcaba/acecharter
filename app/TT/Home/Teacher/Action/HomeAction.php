<?php namespace TT\Home\Teacher\Action;

use TT\Support\AbstractAction;

use TT\Home\Teacher\Domain\HomeService;

use TT\Home\Teacher\Responder\HomeResponder;

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
