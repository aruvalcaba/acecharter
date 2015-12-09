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
                $output['activities'] = $this->activity_service->getActivities($user);
				//dd($this->activity_service->getActivities($user));
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
				'logout' => $this->getMsg('logout'),
				'invitation' => ['val'=>$this->getMsg('constants.invitation')],
				'invitation_conference' => ['val'=>$this->getMsg('messages.invitation_conference')],
];
    }
}
