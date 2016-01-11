<?php namespace TT\Roster\Upload\Action;

use TT\Support\AbstractAction;

use TT\Roster\Upload\Domain\UploadService;

use TT\Roster\Upload\Responder\UploadResponder;

class UploadAction extends AbstractAction
{
    public function __construct(UploadService $uploadService, UploadResponder $responder)
    {
        $this->domain = $uploadService;
        $this->responder = $responder;
    }

    public function act()
    {
        $payload = $this->domain->show();
        $this->responder->setPayload($payload);
        return $this->responder->__invoke();
    }
}
