<?php namespace TT\Activity\Crud\Delete\Domain;

use Sentry;

use Aura\Payload\PayloadFactory;

use TT\Service\ActivityService;

use TT\Support\AbstractService;

use Aura\Payload_Interface\PayloadStatus;

class DeleteService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory, ActivityService $activity_service) {
        $this->payload_factory = $payload_factory;
		$this->activity_service = $activity_service;
    }

    public function delete($id) {
	
		try {
            return $this->activity_service->destroy($id);
        }

        catch(Exception $e) {
            return $this->error($e);
        }   
    }

    
}

?>
