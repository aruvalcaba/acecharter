<?php namespace TT\AddChild\Responder;

use Session;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class AddChildResponder extends AbstractResponder {
    protected $views_path = __DIR__;
	protected $payload_method = [ PayloadStatus::NOT_CREATED=>'notCreated', PayloadStatus::SUCCESS =>'success', PayloadStatus::NOT_VALID=>'notValid' ];

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

    public function success() {
        if( $this->payload ) {
			$alerts = $this->payload->getOutput()['alerts'];       		            
            return $this->renderView('create.json',202);
        }
    }

    public function notValid() {
        if( $this->payload ) {
            return $this->renderView('create.json',406);
        }
    }
}
