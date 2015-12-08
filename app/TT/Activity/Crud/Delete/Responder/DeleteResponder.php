<?php namespace TT\Activity\Crud\Delete\Responder;

use Session;

use Redirect;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class DeleteResponder extends AbstractResponder {
    protected $views_path = __DIR__;

    protected $payload_method = [ PayloadStatus::NOT_DELETED =>'notDeleted', PayloadStatus::DELETED => 'deleted' ];
    
    public function notDeleted() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
    }

    public function deleted() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
    }
}
