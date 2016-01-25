<?php namespace TT\Auth;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractLoginResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::SUCCESS=>'getLogin', PayloadStatus::AUTHENTICATED=>'authenticated', PayloadStatus::NOT_AUTHENTICATED => 'notAuthenticated' ];

    protected function init() {
        parent::init();

        $view_names = ['login','login.json'];

        $views_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $views_registry->set($name,$path);
        } 
    }

    protected function getLogin() {
        if( $this->payload ) {
            return $this->renderView('login',200);
        }    
    }

    protected function authenticated() {
        if( $this->payload ) {
            return $this->renderView('login.json',200);
        }
    }

    protected function notAuthenticated() {
        if( $this->payload ) {
            return $this->renderView('login.json',406);
        }
    }
}
