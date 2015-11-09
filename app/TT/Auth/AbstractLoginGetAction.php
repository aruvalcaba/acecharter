<?php namespace TT\Auth;

use TT\Support\AbstractAction;

abstract class AbstractLoginGetAction extends AbstractAction {
    public function act() {
        $payload = $this->domain->fetchLogin();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}

?>
