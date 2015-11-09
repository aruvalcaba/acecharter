<?php namespace TT\Home\Admin\Action;

use TT\Support\AbstractAction;

use TT\Home\Admin\Domain\HomeService;

use TT\Home\Admin\Responder\HomeResponder;

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
