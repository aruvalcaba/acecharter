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
                $output['avg'] = $this->activity_service->getAvgActivityTime();
                $payload->setOutput($output);
            }
            
            return $payload;
        }

        catch(Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getData() {
        return [];
    }
}
