<?php namespace TT\Activity\Crud\Create\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class CreateService extends AbstractService {
    public function fetchCreate() {
        try {
                $payload = $this->success();
                $output = $payload->getOutput();
                $output['data'] = $this->getData();
                $output['user'] = Sentry::getUser();
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
