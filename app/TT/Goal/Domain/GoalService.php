<?php namespace TT\Goal\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

use TT\Support\AbstractService;

use Aura\Payload\Payload;

class GoalService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory ) {
        $this->payload_factory = $payload_factory;
    }

    public function goal($id) {
        $payload = $this->payload_factory->newInstance();

		if($id!=="") { 
			$output['goal_id'] = $id;           
            $payload->setStatus(PayloadStatus::SUCCESS);
			 if(Sentry::check() ) {
                    $output['user'] = Sentry::getUser();
                }
				
			$output['data'] = $this->getData();
            $payload->setOutput($output);
            return $payload;
		}
          
    }

    public function getData() {
        return [
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'logout' => $this->getMsg('constants.logout'),
];
    }
}

?>
