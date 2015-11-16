<?php namespace TT\Auth;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractLoginResponder extends AbstractResponder {
    protected $payload_method = [ PayloadStatus::SUCCESS=>'getLogin', PayloadStatus::AUTHENTICATED=>'authenticated', PayloadStatus::NOT_AUTHENTICATED => 'notAuthenticated' ];

    protected function init() {
        parent::init();

        $view_names = ['login','login.json'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $view_registry->set($name,$path);
        } 
    }

    protected function getLogin() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->renderView('login');
            }
        }    
    }

    protected function authenticated() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->renderView('login.json');
            }
        }
    }

    protected function notAuthenticated() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->response->status->setCode('401');
                $this->renderView('login.json');
            }
        }
    }
}

?>
