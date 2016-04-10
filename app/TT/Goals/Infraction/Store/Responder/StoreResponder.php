<?php namespace TT\Goals\Infraction\Store\Responder;

use Session;
use Redirect;

use Aura\Payload_Interface\PayloadStatus;

use TT\Support\AbstractResponder;

class StoreResponder extends AbstractResponder
{
    protected $payload_method = [ PayloadStatus::SUCCESS => 'uploaded', PayloadStatus::NOT_ACCEPTED => 'notAccepted' ];
    protected $views_path = __DIR__;

    public function notAccepted()
    {
        if( $this->payload ) {
            $alerts = $this->payload->getOutput()['alerts'];
            Session::flash('alerts',$alerts);
            return Redirect::route('infraction.upload.show');
        }
    }

    public function uploaded()
    {
        if( $this->payload ) {
            $alerts = $this->payload->getOutput()['alerts'];
            Session::flash('alerts',$alerts);
            return Redirect::route('home.admin');
        }
    }
}
