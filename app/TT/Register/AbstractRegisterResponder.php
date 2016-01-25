<?php namespace TT\Register;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractRegisterResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::NOT_CREATED=>'notCreated', PayloadStatus::CREATED => 'created', PayloadStatus::NOT_ACCEPTED=>'notAccepted' ];

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
        if( $this->payload ) {
            return $this->renderView('create.json',500);
        }
    }

    public function created() {
        if( $this->payload ) {
            return $this->renderView('create.json',201);
        }
    }

    public function notAccepted() {
        if( $this->payload ) {
            return $this->renderView('create.json',406);
        }
    }
}
