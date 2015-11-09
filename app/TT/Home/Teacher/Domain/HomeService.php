<?php namespace TT\Home\Teacher\Domain;

use Sentry;

use TT\Support\AbstractService;

use Aura\Payload\PayloadFactory;

class HomeService extends AbstractService {
    public function __construct(PayloadFactory $payload_factory) {
        $this->payload_factory = $payload_factory;
    }

    public function home() {
        try {
            $payload = $this->success();

            if( Sentry::check() ) {
                $output = $payload->getOutput();
                
                $user = Sentry::getUser();
                $students = $user->students();

                $output['user'] = $user;
                $output['students'] = ! empty($students) ? $students : [];
                $output['text'] = $this->getData();
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
