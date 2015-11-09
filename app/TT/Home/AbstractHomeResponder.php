<?php namespace TT\Home;

use Aura\Payload\Payload;

use TT\Support\AbstractResponder;

abstract class AbstractHomeResponder extends AbstractResponder {
    protected $payload_method = [Payload::SUCCESS=>'home'];

    protected function init() {
        $view_names =  ['home'];

        $view_registry = $this->view->getViewRegistry();

        foreach($view_names as $name) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name); 
            $view_registry->set($name,$path);
        }
    }

    protected function home() {
        if( $this->negotiateMediaType() ) {
            $this->renderView('home');
        }
    }
}
