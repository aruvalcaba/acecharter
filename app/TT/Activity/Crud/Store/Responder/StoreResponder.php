<?php namespace TT\Activity\Crud\Store\Responder;

use Session;

use Redirect;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class StoreResponder extends AbstractResponder {
    protected $views_path = __DIR__;

    protected $payload_method = [ PayloadStatus::NOT_ACCEPTED =>'notAccepted', PayloadStatus::CREATED => 'created' ];
    
    public function notAccepted() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
        $this->redirect = Redirect::back()->withInput();
    }

    public function created() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
        $this->redirect = Redirect::route('home.admin')->withInput();
    }
}
