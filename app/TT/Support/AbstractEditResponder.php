<?php namespace TT\Support;

use Aura\Payload_Interface\PayloadStatus;

class AbstractEditResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::SUCCESS=>'getEdit' ];

    protected function init() {
        parent::init();

        $view_names = ['edit'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $view_registry->set($name,$path);
        } 
    }

    protected function getEdit() {
        if( $this->payload ) {
            return $this->renderView('edit');
        }
    }
}
