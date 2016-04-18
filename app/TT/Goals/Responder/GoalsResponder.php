<?php namespace TT\Goals\Responder;

use Session;
use Redirect;

use TT\Support\AbstractResponder;

use Aura\Payload_Interface\PayloadStatus;

use Aura\Payload\Payload;

class GoalsResponder extends AbstractResponder {
	protected $views_path = __DIR__;
	protected $payload_method = [ PayloadStatus::SUCCESS=>'success',PayloadStatus::NOT_VALID => 'notValid' ];

	
	protected function init() {
        parent::init();

        $view_names = ['goal_1/goal','goal_2/goal','goal_3/goal','goal_4/goal'];

        $view_registry = $this->view->getViewRegistry();

        foreach( $view_names as $name ) {
            $path = sprintf('%s/views/%s.php',$this->views_path,$name);
			$view_registry->set($name,$path);
        } 
    }	

	protected function success() {
            if( $this->payload ) {
				
				$id = $this->payload->getOutput()['goal_id'];
				$view = 'goal_'.$id.'/goal';
				return $this->renderView($view);
            }
        
    }
	
	public function notValid()
    {
        if( $this->payload ) {
            $alerts = $this->payload->getOutput()['alerts'];
            Session::flash('alerts',$alerts);
            return Redirect::route('home.parent');
        }
    }
}
