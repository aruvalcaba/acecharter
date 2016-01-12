<?php namespace TT\Roster\Store\Responder;

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
        if( $this->negotiateMediaType() )
        {
            if( $this->payload )
            {
                $alerts = $this->payload->getOutput()['alerts'];
                Session::flash('alerts',$alerts);
                $this->redirect = Redirect::route('roster.upload.show');
            }
        }
    }

    public function uploaded()
    {
        if( $this->negotiateMediaType() )
        {
            if( $this->payload )
            {
                $alerts = $this->payload->getOutput()['alerts'];
                Session::flash('alerts',$alerts);
                $this->redirect = Redirect::route('home.admin');
            }
        }
    }
}