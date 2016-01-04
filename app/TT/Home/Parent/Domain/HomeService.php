<?php namespace TT\Home\Parent\Domain;

use Sentry;

use TT\Support\AbstractService;

use TT\Service\ActivityService;

use Aura\Payload\PayloadFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory, ActivityService $activity_service) {
        $this->activity_service = $activity_service;
        $this->payload_factory = $payload_factory;
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                $user = Sentry::getUser();
                $output['user'] = $user;
                $output['acts'] = $this->activity_service->getActivities($user);
				$output['avg'] = $this->activity_service->getAvgActivityTime();
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
				'welcome' => ['val'=>$this->getMsg('constants.welcome')],
				'changed_pwd' => $this->getMsg('constants.change_password'),
				'ace_family_link' => ['val' =>$this->getMsg('constants.ace_family_link')],
				'parents' => ['val'=>$this->getMsg('constants.parents')],
				'teachers' => ['val'=>$this->getMsg('constants.teachers')],
				'logout' => $this->getMsg('constants.logout'),
				'invitation' => ['val'=>$this->getMsg('constants.invitation')],
				'invitation_conference' => ['val'=>$this->getMsg('messages.invitation_conference')],
				'view' => ['val'=>$this->getMsg('constants.view')],
				'progress_report' => ['val' => $this->getMsg('constants.progress_report')],
				'daily_attendance' => ['val' => $this->getMsg('constants.daily_attendance')],
				'daily_homework' => ['val' => $this->getMsg('constants.daily_homework')],
				'positive_behavior' => ['val' => $this->getMsg('constants.positive_behavior')],
				'growth_mindset' => ['val' => $this->getMsg('constant.growth_mindset')],
				'academic_success' => ['val' => $this->getMsg('constants.academic_success')],
				'academic_achievement_ela' => ['val' => $this->getMsg('constants.academic_achievement_ela')],
				'academic_achievement_math' => ['val' => $this->getMsg('constants.academic_achievement_math')],
				'ela_proficiency' => ['val' => $this->getMsg('constants.ela_proficiency')],
				'math_proficiency' => ['val' => $this->getmsg('constants.math_proficiency')],
				'ok' => ['type'=>'button','name'=>'ok','value'=>$this->getMsg('constants.ok'),'attribs'=>['class'=>'btn btn-success','data-dismiss'=>'modal']],
				'goal_1_detail' => $this->getMsg('goals.goal_1_detail'),
				'goal_1_detail_2' => $this->GetMsg('goals.goal_1_detail_2'),
				'goal_2_detail' => $this->getMsg('goals.goal_2_detail'),
				'goal_2_detail_2' => $this->GetMsg('goals.goal_2_detail_2'),				
				'goal_3_detail' => $this->getMsg('goals.goal_3_detail'),
				'goal_3_detail_2' => $this->GetMsg('goals.goal_3_detail_2'),
				'goal_4_detail' => $this->getMsg('goals.goal_4_detail'),
				'goal_4_detail_2' => $this->GetMsg('goals.goal_4_detail_2'),
				'footer_msg' => $this->GetMsg('messages.footer_msg'),
				'footer_here' => $this->GetMsg('messages.footer_here'),
	];

    }
}
