<?php namespace TT\Goals\Upload\Action;

use TT\Support\AbstractAction;

use TT\Goals\Upload\Domain\UploadService;

use TT\Goals\Upload\Responder\UploadResponder;

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
