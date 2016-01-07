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
				'goal_1_detail' => $this->getMsg('goals.goal_1_detail'),
				'goal_1_detail_2' => $this->GetMsg('goals.goal_1_detail_2'),
				'goal_2_detail' => $this->getMsg('goals.goal_2_detail'),
				'goal_2_detail_2' => $this->GetMsg('goals.goal_2_detail_2'),				
				'goal_3_detail' => $this->getMsg('goals.goal_3_detail'),
				'goal_3_detail_2' => $this->GetMsg('goals.goal_3_detail_2'),
				'goal_4_detail' => $this->getMsg('goals.goal_4_detail'),
				'goal_4_detail_2' => $this->GetMsg('goals.goal_4_detail_2'),
				'progress_report' => ['val' => $this->getMsg('constants.progress_report')],
				'daily_attendance' => ['val' => $this->getMsg('constants.daily_attendance')],
				'daily_homework' => ['val' => $this->getMsg('constants.daily_homework')],
				'positive_behavior' => ['val' => $this->getMsg('constants.positive_behavior')],
				'academic_success' => ['val' => $this->getMsg('constants.academic_success')],
				'footer_msg' => $this->GetMsg('messages.footer_msg'),
				'footer_here' => $this->GetMsg('messages.footer_here'),

				

				
];
    }
}

?>
