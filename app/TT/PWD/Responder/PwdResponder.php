<?php namespace TT\PWD\Responder;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

class PwdResponder extends AbstractResponder {
	protected $views_path = __DIR__;
    protected $payload_method = [ PayloadStatus::SUCCESS=>'getPwdChange', PayloadStatus::AUTHENTICATED=>'authenticated', PayloadStatus::NOT_AUTHENTICATED => 'notAuthenticated' ];

    protected function init() {
        parent::init();

        $view_names = ['pwd','pwd.json'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
			$view_registry->set($name,$path);
        } 
    }

    protected function getPwdChange() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->renderView('pwd');
            }
        }    
    }

    protected function authenticated() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->renderView('pwd.json');
            }
        }
    }

    protected function notAuthenticated() {
        if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->response->status->setCode('401');
                $this->renderView('pwd.json');
            }
        }
    }
}
