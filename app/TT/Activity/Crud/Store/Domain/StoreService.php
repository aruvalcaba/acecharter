<?php namespace TT\Activity\Crud\Store\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

use TT\Service\ActivityService;

class StoreService extends AbstractService {
    public function __construct(ActivityService $activity_service) {
        $this->activity_service = $activity_service;
    }

    public function store(array $data) {
        try {
            return $this->activity_service->create($data);
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }
}
