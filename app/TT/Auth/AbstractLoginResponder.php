<?php namespace TT\Auth;

use Aura\Payload\Payload;

use TT\Support\AbstractResponder;

abstract class AbstractLoginResponder extends AbstractResponder {
    protected $payload_method = [ Payload::SUCCESS=>'getLogin', Payload::AUTHENTICATED=>'authenticated', Payload::NOT_AUTHENTICATED => 'notAuthenticated' ];

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
