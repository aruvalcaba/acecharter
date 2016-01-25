<?php namespace TT\Roster\Upload\Responder;

use Aura\Payload_Interface\PayloadStatus;

use TT\Support\AbstractResponder;

class UploadResponder extends AbstractResponder
{
    protected $payload_method = [ PayloadStatus::SUCCESS => 'show' ];
    protected $views_path = __DIR__;

    public function init()
    {
        parent::init();

        $view_names = ['upload'];

        $view_registry = $this->view->getViewRegistry();

        foreach($view_names as $name)
        {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
            $view_registry->set($name,$path);
        }
    }

    public function show()
    {
        if( $this->payload ) {
            return $this->renderView('upload');
        }
    }
}
