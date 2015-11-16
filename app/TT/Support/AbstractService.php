<?php namespace TT\Support;

use Lang;

use Aura\Payload\PayloadFactory;

use Aura\Payload_Interface\PayloadStatus;

abstract class AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    protected function success($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::SUCCESS);
        $payload->setOutput($output);
        return $payload;
    }

    protected function error($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::ERROR);
        $payload->setOutput($output);
        return $payload;
    }

    protected function getMsg($msg_path, array $args = []) {
        if( empty($msg_path) ) {
            return '';
        }

        else 
            return trans($msg_path,$args);
    }

    protected function getData() {}
}
