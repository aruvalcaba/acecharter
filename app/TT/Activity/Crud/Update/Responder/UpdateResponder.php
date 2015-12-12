<?php namespace TT\Activity\Crud\Update\Responder;

use Session;

use Redirect;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class UpdateResponder extends AbstractResponder {
    protected $views_path = __DIR__;

    protected $payload_method = [ PayloadStatus::NOT_ACCEPTED =>'notAccepted', PayloadStatus::UPDATED => 'updated' ];
    
    public function notAccepted() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
        $this->redirect = Redirect::back()->withInput();
    }

    public function updated() {
        $alerts = $this->payload->getOutput()['alerts'];
        Session::flash('alerts',$alerts);
        $this->redirect = Redirect::route('home.admin')->withInput();
    }
}
