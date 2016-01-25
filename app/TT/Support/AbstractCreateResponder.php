<?php namespace TT\Support;

use Aura\Payload_Interface\PayloadStatus;

class AbstractCreateResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::SUCCESS=>'getCreate' ];

    protected function init() {
        parent::init();

        $view_names = ['create'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $view_registry->set($name,$path);
        } 
    }

    protected function getCreate() {
        if( $this->payload ) {
            return $this->renderView('create',201);
        }
    }
}
