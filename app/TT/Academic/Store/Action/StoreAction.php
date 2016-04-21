<?php namespace TT\Academic\Store\Action;

use Input;
use TT\Support\AbstractAction;

use TT\Academic\Store\Domain\StoreService;
use TT\Academic\Store\Responder\StoreResponder;

class StoreAction extends AbstractAction
{
    public function __construct(StoreService $domain, StoreResponder $responder)
    {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act()
    {
        $input = Input::all();
        $payload = $this->domain->store($input);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}