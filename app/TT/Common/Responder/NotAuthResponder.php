<?php namespace TT\Common\Responder;

use Aura\Payload\Payload; 

use TT\Support\AbstractResponder;

class NotAuthResponder extends AbstractResponder {
    protected $payload_method = [ Payload::SUCCESS => 'notAuthorized' ];
    protected $views_path = __DIR__;

    protected function init() {
        parent::init();

        $view_names = ['unauthorized'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name) {
            $path = sprintf('%s/views/%s.php',__DIR__,$name);
            $view_registry->set($name,$path);
        }
    }

    public function notAuthorized() {
         if( $this->negotiateMediaType() ) {
            if( $this->payload ) {
                $this->renderView('unauthorized');
            }
        }    
    
    }
}
