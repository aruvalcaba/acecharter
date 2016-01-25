<?php namespace TT\Home;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractHomeResponder extends AbstractResponder {
    protected $payload_method = [PayloadStatus::SUCCESS=>'home'];

    protected function init() {
        $view_names =  ['home'];

        $view_registry = $this->view->getViewRegistry();

        foreach($view_names as $name) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name); 
            $view_registry->set($name,$path);
        }
    }

    protected function home() {
        if( $this->payload ) {
            return $this->renderView('home');
        }
    }
}
