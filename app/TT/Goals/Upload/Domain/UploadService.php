<?php namespace TT\Goals\Upload\Domain;

use Input;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class UploadService extends AbstractService
{
    public function show()
    {
        try
        {
            $payload = $this->success();
            $output = $payload->getOutput();
            $output['data'] = $this->getData();
            $output['user'] = Sentry::getUser();
            $payload->setOutput($output);
            return $payload;
        }

        catch(Exception $e)
        {
            return $this->error($e);
        }
    }

    public function getData()
    {
        return [
                'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
                'changed_pwd' => $this->getMsg('constants.change_password'),
                'logout' => $this->getMsg('logout'),
                'create_btn' => ['type'=>'submit','name'=>'create','value'=>$this->getMsg('constants.create'),'attribs'=>['id'=>'create','class'=>'btn btn-skin']],
                'cancel_btn' => ['type'=>'button','name'=>'cancel','value'=>$this->getMsg('constants.cancel'),'attribs'=>['class'=>'btn btn-skin','data-dismiss'=>'cancel']],
                'hidden_input'=>['type'=>'hidden','name'=>'_token','value'=> csrf_token()],
                'goals_label'=>['val'=>$this->getMsg('constants.goals')],
                'goals_input'=>['type'=>'file','name'=>'goals','attribs'=>['class'=>'form-control','id'=>'goals','accept'=>'.csv']]
               ];
    }
}
