<?php namespace TT\Goals\Infraction\Upload\Action;

use TT\Support\AbstractAction;

use TT\Goals\Infraction\Upload\Domain\UploadService;

use TT\Goals\Infraction\Upload\Responder\UploadResponder;

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
