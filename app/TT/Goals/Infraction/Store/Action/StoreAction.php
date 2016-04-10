<?php namespace TT\Goals\Infraction\Store\Action;

use Input;
use TT\Support\AbstractAction;

use TT\Goals\Infraction\Store\Domain\StoreService;
use TT\Goals\Infraction\Store\Responder\StoreResponder;

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
