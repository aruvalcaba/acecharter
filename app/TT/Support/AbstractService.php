<?php namespace TT\Support;

use Lang;
use Aura\Payload\Payload;
use Aura\Payload\PayloadFactory;

abstract class AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    protected function success($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(Payload::SUCCESS);
        $payload->setOutput($output);
        return $payload;
    }

    protected function error($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(Payload::ERROR);
        $payload->setOutput($output);
        $payload->setMessages(['exception'=>$msg]);
        return $payload;
    }

    protected function getMsg($msg_path, array $args = []) {
        if( empty($msg_path) ) {
            return '';
        }

        else 
            return trans($msg_path,$args);
    }

    abstract function getData();
}
