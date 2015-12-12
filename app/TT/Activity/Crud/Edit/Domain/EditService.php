<?php namespace TT\Activity\Crud\Edit\Domain;

use Sentry;

use TT\Models\Activity;

use TT\Service\ActivityService;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

class EditService extends AbstractService {

	 public function __construct(PayloadFactory $payload_factory, ActivityService $activity_service) {
        $this->activity_service = $activity_service;
        $this->payload_factory = $payload_factory;
    }

    public function fetchEdit($id) {
        try {
				$payload = $this->activity_service->find($id);     

				if( $payload->getStatus() == PayloadStatus::SUCCESS ) {          
					$output = $payload->getOutput();
					$activity = $output['activity'];

 
				$getData = function(Activity $activity) {
            return [
				'title_label' => ['val'=>$this->getMsg('constants.title')],
				'title_input' => ['type'=>'text','name'=>'title','value'=> $activity->title ,'attribs'=>['class'=>'form-control','id'=>'title','required'=>'required']],
				'activity_label' => ['val'=>$this->getMsg('constants.activity')],
				'activity_input' => ['type'=>'file','name'=>'activity','value'=>$activity->activity, 'attribs'=>['class'=>'form-control','id'=>'activity']],
				'description_label' => ['val'=>$this->getMsg('constants.description')],
				'description_input' => ['type'=>'file','name'=>'description','value'=> $activity->description, 'attribs'=>['class'=>'form-control','id'=>'description']],
				'time_label' => ['val'=>$this->getMsg('constants.time')],
				'time_input' => ['type'=>'number','name'=>'time','value'=> $activity->time,'attribs'=>['class'=>'form-control','id'=>'time','min'=>'1','value'=> $activity->time]],	
               'edit_btn' => ['type'=>'submit','name'=>'edit','value'=>'Edit','attribs'=>['id'=>'edit','class'=>'btn btn-skin']],
				'cancel_btn' => ['type'=>'button','name'=>'cancel','value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-skin','data-dismiss'=>'cancel']],
				'hidden_csrf' => ['type'=>'hidden','name'=>'_token','value'=> csrf_token()],
				'hidden_method' => ['type'=>'hidden','name'=>'_method','value'=> 'PUT'],
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('logout'),
				

               
       			 ];
		
  
    
 				};


				$output['data'] = $getData($activity);
                $output['user'] = Sentry::getUser();
                $payload->setOutput($output);
				}
                return $payload;
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }

    //public function getData(Activity $activity) {
	//	   }
}
