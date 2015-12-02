<?php namespace TT\Activity\Crud\Create\Domain;

use TT\Support\AbstractService;

class CreateService extends AbstractService {
    public function __construct() {
        $this->activity_service = $activity_service;
    }

    public function fetchCreate() {
        try {
                $payload = $this->success();
                $output = $payload->getOutput();
                $output['data'] = $this->getData();
                $payload->setOutput($output);
                return $payload;
        }

        catch(Exception $e) {
            return $this->error($e);
        }
    }

    public function getData() {
    
    }
}
