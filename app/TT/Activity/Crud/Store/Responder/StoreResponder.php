<?php namespace TT\Activity\Crud\Store\Responder;

use Redirect;

use TT\Support\AbstractResponder;

use TT\Payload_Interface\PayloadStatus;

class StoreResponder extends AbstractResponder {
    protected $views_path = __DIR__;

    protected $payload_method = [ PayloadStatus::NOT_ACCEPTED =>'notAccepted', PayloadStatus::CREATED => 'created' ];
    
    public function notAccepted() {
        $alerts = $this->response->getPayload()->getOutput()['alerts'];
        $this->redirect = Redirect::back()->with('alerts',$alerts);
    }

    public function created() {
        $alerts = $this->response->getPayload()->getOutput()['alerts'];
        $this->redirect = Redirect::route('home.admin')->with('alerts',$alerts);
    }
}
