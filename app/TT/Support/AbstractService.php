<?php namespace TT\Support;

use DB;

use Log;

use Lang;

use Exception;

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

    protected function error(Exception $e) {
        Log::error($e);
        DB::rollback();
        $message = $this->getMsg('messages.oops');
 
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::ERROR);

        $payload->setOutput(['response'=>['message'=>$message,'exception'=>$e->getMessage()]]);
        return $payload;
    }

    protected function accepted($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function not_accepted($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_ACCEPTED);
        $payload->setOutput($output);
        return $payload;
    }
    
    protected function created($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::CREATED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function not_found($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_FOUND);
        $payload->setOutput($output);
        return $payload;
    }

    protected function deleted($output = []) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::DELETED);
        $payload->setOutput($output);
        return $payload;
    }

    protected function not_deleted($output) {
        $payload = $this->payload_factory->newInstance();
        $payload->setStatus(PayloadStatus::NOT_DELETED);
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
