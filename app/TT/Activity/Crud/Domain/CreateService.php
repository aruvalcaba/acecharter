<?php namespace TT\Activity\Crud\Domain;

use TT\Support\AbstractService;

use TT\Service\ActivityService;

class CreateService extends AbstractService {
    public function __construct(ActivityService $activity_service) {
        $this->activity_service = $activity_service;
    }

    public function create($data) {
        return $this->activity_service->create($data);       
    }
}
