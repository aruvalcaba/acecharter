<?php namespace TT\Activity\Crud\Create\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class CreateService extends AbstractService {
    public function fetchCreate() {
        try {
                $payload = $this->success();
                $output = $payload->getOutput();
                $output['data'] = $this->getData();
                $output['user'] = Sentry::getUser();
                $payload->setOutput($output);
                return $payload;
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }

    public function getData() {
		return [
				'title_label' => ['val'=>$this->getMsg('constants.title')],
				'title_input' => ['type'=>'text','name'=>'title','attribs'=>['class'=>'form-control','id'=>'title','required'=>'required']],

				'activity_label' => ['val'=>$this->getMsg('constants.activity')],
				'activity_input' => ['type'=>'file','name'=>'activity','attribs'=>['class'=>'form-control','id'=>'activity']],
				'description_label' => ['val'=>$this->getMsg('constants.description')],
				'description_input' => ['type'=>'file','name'=>'description','attribs'=>['class'=>'form-control','id'=>'description']],
				'time_label' => ['val'=>$this->getMsg('constants.time')],
				'time_input' => ['type'=>'number','name'=>'time','attribs'=>['class'=>'form-control','id'=>'time','min'=>'1','value'=>'1']],	
               'create_btn' => ['type'=>'submit','name'=>'create','value'=>$this->getMsg('constants.create'),'attribs'=>['id'=>'create','class'=>'btn btn-skin']],
				'hidden_input' => ['type'=>'hidden','name'=>'_token','value'=> csrf_token()],
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('logout'),

               
        ];
  
    
    }
}
