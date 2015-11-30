<?php namespace TT\Lang\Action;

use TT\Support\AbstractAction;

use TT\Lang\Domain\LangService;

use TT\Lang\Responder\LangResponder;

class LangAction extends AbstractAction {
    public function __construct(LangService $domain, LangResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act($lang) {
        $payload = $this->domain->isRegisteredLang($lang);
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}

