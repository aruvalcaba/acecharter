<?php namespace TT\Lang\Responder;

use Redirect;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class LangResponder extends AbstractResponder{
    protected $payload_method = [ PayloadStatus::NOT_FOUND=>'notFound', PayloadStatus::FOUND=>'found' ];

    protected function found() {
        $this->redirect = Redirect::back();
    }
}
