<?php namespace TT\Activity\Crud\Update\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use TT\Service\ActivityService;

class UpdateService extends AbstractService {
    public function __construct(ActivityService $activity_service) {
        $this->activity_service = $activity_service;
    }

    public function update(array $data,$id) {
        try {
            return $this->activity_service->update($data,$id);
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }
}
