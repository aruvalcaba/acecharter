<?php namespace TT\Register;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractRegisterResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::NOT_CREATED=>'notCreated', Payload::CREATED => 'created', Payload::NOT_ACCEPTED=>'notAccepted' ];

    protected function init() {
        parent::init();

        $view_names = ['create.json'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $view_registry->set($name,$path);
        } 
    }

    public function notCreated() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->response->status->setCode('409');
                $this->renderView('create.json');
            }
        }
    }

    public function created() {
          if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->response->status->setCode('201');
                $this->renderView('create.json');
            }
        }
    }

    public function notAccepted() {
         if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->response->status->setCode('422');
                $this->renderView('create.json');
            }
        }
    }
}
