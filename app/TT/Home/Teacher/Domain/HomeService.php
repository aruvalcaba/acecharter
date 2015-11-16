<?php namespace TT\Home\Teacher\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                
                $user = Sentry::getUser();
                $students = $user->students();

                $output['user'] = $user;
                $output['students'] = ! empty($students) ? $students : [];
                $output['data'] = $this->getData();
                $payload->setOutput($output);
            }
            
            return $payload;
        }

        catch(Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getData() {
        return [
                'register_btn'=>['type'=>'button','name'=>'register_btn','value'=>$this->getMsg('constants.registration'),'attribs'=>['id'=>'register_btn','class'=>'btn btn-default active']],
                'all_students_btn'=>['type'=>'button','name'=>'all_students_btn','value'=>$this->getMsg('constants.all_students'),'attribs'=>['id'=>'all_students_btn','class'=>'btn btn-default']],
                'how_register_parents'=>$this->getMsg('constants.how_register_parents')
               ];
    }
}
