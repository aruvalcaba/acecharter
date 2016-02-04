<?php namespace TT\Teacher\Codes\Action;

use TT\Support\AbstractAction;

use TT\Teacher\Codes\Domain\PrintCodesService;

use TT\Teacher\Codes\Responder\PrintCodesResponder;

class PrintCodesAction extends AbstractAction {
    public function __construct(PrintCodesService $domain, PrintCodesResponder $responder) {
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function act() {
        $payload = $this->domain->printCodes();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
